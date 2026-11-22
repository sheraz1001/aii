# aii AI Secretary — voice agent

Python worker built on [LiveKit Agents](https://github.com/livekit/agents). It answers
phone calls that reach LiveKit through SIP, talks to the caller in English or Arabic,
takes messages and booking requests, can transfer to staff, and reports every call
(transcript, messages, summary) to the aii web app.

```
Caller → phone network → SIP trunk → LiveKit Cloud → this worker (Contabo)
                                                        │
                       aii web app (Hostinger Cloud) ◄──┘  business settings + call reports
```

## Files

| File | Purpose |
| --- | --- |
| `agent.py` | The worker: models, receptionist tools, call lifecycle |
| `prompts.py` | Receptionist instructions, greeting, summary prompt |
| `business.py` | Loads business settings from the web app; reports finished calls |
| `demo_business.json` | Demo clinic used when `AII_API_URL` is empty |

## Run locally

```bash
python -m venv .venv && . .venv/bin/activate
pip install -r requirements.txt
cp .env.example .env      # fill in the keys
python agent.py download-files
python agent.py console   # talk to it in your terminal with your microphone
python agent.py dev       # connect to LiveKit Cloud and take test calls
```

## Deploy on Contabo with Coolify

1. Coolify → New resource → Public/Private repository → this repo, base directory `/agent`, build pack **Dockerfile**.
2. Add every variable from `.env.example` under Environment Variables.
3. No domain or port mapping is needed: the worker connects out to LiveKit.
4. Deploy. Logs should show `registered worker`.

## Connect a phone number (LiveKit Cloud)

1. Telephony → SIP trunks → create an **inbound trunk** with your test number (Telnyx/Twilio for testing; e& or du later).
2. Telephony → Dispatch rules → create a rule for that trunk with `roomConfig.agents = [{"agentName": "aii-secretary"}]`.
3. Point the number at LiveKit's SIP URI in your provider's console. Call it.

## Arabic notes

- `stt_language` per business: `multi` (English with code-switching) or `ar` (Arabic-first lines).
  Test both with real Gulf-Arabic callers before launch.
- Choose an ElevenLabs voice that sounds natural in both Arabic and English and set it as
  `ELEVENLABS_VOICE_ID` (or per business as `tts_voice_id`).
