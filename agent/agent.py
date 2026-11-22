"""aii AI Secretary — voice agent worker (LiveKit Agents).

Answers inbound phone calls arriving through LiveKit SIP, using each business's
settings from the aii web app. Run locally with `python agent.py dev`, in
production with `python agent.py start` (see README.md).
"""

from __future__ import annotations

import asyncio
import logging
import os

from dotenv import load_dotenv
from livekit.agents import (
    Agent,
    AgentServer,
    AgentSession,
    JobContext,
    JobProcess,
    RunContext,
    cli,
    function_tool,
    get_job_context,
)
from livekit.agents.llm import ChatMessage
from livekit.plugins import deepgram, elevenlabs, silero
from livekit.plugins.turn_detector.multilingual import MultilingualModel

from business import CallState, load_business, report_call
from prompts import SUMMARY_PROMPT, build_instructions, greeting

load_dotenv()
logger = logging.getLogger("aii-agent")

LLM_PROVIDER = os.getenv("LLM_PROVIDER", "anthropic")  # anthropic | openai
LLM_MODEL = os.getenv("LLM_MODEL", "")
DEFAULT_VOICE = os.getenv("ELEVENLABS_VOICE_ID", "")
TTS_MODEL = os.getenv("ELEVENLABS_MODEL", "eleven_flash_v2_5")


# ---------- model factories ----------

def make_llm():
    if LLM_PROVIDER == "openai":
        from livekit.plugins import openai

        return openai.LLM(model=LLM_MODEL or "gpt-4.1-mini")
    from livekit.plugins import anthropic

    return anthropic.LLM(model=LLM_MODEL or "claude-sonnet-4-6", max_tokens=300)


def make_stt(business: dict):
    # "multi" = English + code-switching; "ar" = Arabic-first lines.
    return deepgram.STT(model="nova-3", language=business.get("stt_language") or "multi")


def make_tts(business: dict):
    kwargs = {"model": TTS_MODEL}
    voice = business.get("tts_voice_id") or DEFAULT_VOICE
    if voice:
        kwargs["voice_id"] = voice
    return elevenlabs.TTS(**kwargs)


async def summarise(state: CallState) -> str:
    """Short owner summary of the call; falls back to saved messages."""
    lines = [f"{t['role']}: {t['text']}" for t in state.transcript if t.get("text")]
    if not lines:
        return "Caller hung up before speaking."
    text = SUMMARY_PROMPT + "\n".join(lines)
    try:
        if LLM_PROVIDER == "openai":
            from openai import AsyncOpenAI

            r = await AsyncOpenAI().chat.completions.create(
                model=LLM_MODEL or "gpt-4.1-mini",
                messages=[{"role": "user", "content": text}],
                max_tokens=200,
            )
            return r.choices[0].message.content.strip()
        from anthropic import AsyncAnthropic

        r = await AsyncAnthropic().messages.create(
            model=LLM_MODEL or "claude-sonnet-4-6",
            max_tokens=200,
            messages=[{"role": "user", "content": text}],
        )
        return r.content[0].text.strip()
    except Exception as exc:  # summary must never block the call report
        logger.error("summary failed: %s", exc)
        return "; ".join(m["message"] for m in state.messages) or "See transcript."


# ---------- the receptionist ----------

class Secretary(Agent):
    def __init__(self, business: dict, state: CallState) -> None:
        super().__init__(instructions=build_instructions(business))
        self.business = business
        self.state = state

    @function_tool
    async def take_message(
        self,
        context: RunContext,
        caller_name: str,
        callback_number: str,
        message: str,
        urgent: bool = False,
    ) -> str:
        """Save a message or booking request for the business team.

        Args:
            caller_name: The caller's name.
            callback_number: The best number to call or WhatsApp the caller back.
            message: What the caller wants, including any preferred day and time.
            urgent: True if the caller needs help today or the matter is urgent.
        """
        self.state.messages.append(
            {
                "caller_name": caller_name,
                "callback_number": callback_number,
                "message": message,
                "urgent": urgent,
            }
        )
        logger.info("message saved for %s", self.business.get("name"))
        return "Saved. Tell the caller the team will contact them soon."

    @function_tool
    async def transfer_to_staff(self, context: RunContext, reason: str) -> str:
        """Transfer the caller to a member of staff.

        Args:
            reason: Why the caller needs a person.
        """
        number = self.business.get("transfer_number")
        if not number:
            return "Transfer is not available. Offer to take an urgent message instead."
        await context.session.say("One moment please, I'm connecting you now.")
        await context.wait_for_playout()
        self.state.transferred_to = number
        await get_job_context().transfer_sip_participant(
            self.state.caller_identity, f"tel:{number}"
        )
        return "Transferred."

    @function_tool
    async def end_call(self, context: RunContext) -> str:
        """End the call after you have said goodbye."""
        await context.wait_for_playout()
        job = get_job_context()
        asyncio.get_running_loop().call_later(1.0, lambda: asyncio.ensure_future(job.delete_room()))
        return "Call ending."


# ---------- worker ----------

def prewarm(proc: JobProcess) -> None:
    proc.userdata["vad"] = silero.VAD.load()


server = AgentServer(setup_fnc=prewarm)


@server.rtc_session(agent_name=os.getenv("AGENT_NAME", "aii-secretary"))
async def entrypoint(ctx: JobContext) -> None:
    await ctx.connect()
    caller = await ctx.wait_for_participant()
    called_number = caller.attributes.get("sip.trunkPhoneNumber", "")
    caller_number = caller.attributes.get("sip.phoneNumber", "")

    business = await load_business(called_number)
    state = CallState(
        business=business,
        caller_number=caller_number,
        called_number=called_number,
        caller_identity=caller.identity,
    )
    logger.info("call for %s", business.get("name"))

    session = AgentSession(
        stt=make_stt(business),
        llm=make_llm(),
        tts=make_tts(business),
        vad=ctx.proc.userdata["vad"],
        turn_detection=MultilingualModel(),
    )

    @session.on("conversation_item_added")
    def _on_item(ev) -> None:
        item = ev.item
        if isinstance(item, ChatMessage) and item.text_content:
            state.transcript.append(
                {"role": item.role, "text": item.text_content, "at": item.created_at}
            )

    async def _finish() -> None:
        state.summary = await summarise(state)
        await report_call(state)

    ctx.add_shutdown_callback(_finish)

    await session.start(agent=Secretary(business, state), room=ctx.room)
    await session.say(greeting(business), allow_interruptions=False)


if __name__ == "__main__":
    cli.run_app(server)
