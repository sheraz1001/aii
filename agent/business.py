"""Business configuration and call reporting.

The agent asks the aii web app (Laravel on Hostinger Cloud) which business owns the
dialled number, and reports every finished call back to it. When AII_API_URL is not
set (local testing), it falls back to demo_business.json and writes calls to ./calls.
"""

from __future__ import annotations

import json
import logging
import os
import time
from dataclasses import asdict, dataclass, field
from pathlib import Path
from typing import Any

import httpx

logger = logging.getLogger("aii-agent")

API_URL = os.getenv("AII_API_URL", "").rstrip("/")
API_TOKEN = os.getenv("AII_AGENT_TOKEN", "")
DEMO_FILE = Path(__file__).with_name("demo_business.json")
CALLS_DIR = Path(__file__).with_name("calls")


@dataclass
class CallState:
    business: dict[str, Any]
    caller_number: str
    called_number: str
    caller_identity: str
    started_at: float = field(default_factory=time.time)
    transcript: list[dict[str, Any]] = field(default_factory=list)
    messages: list[dict[str, Any]] = field(default_factory=list)
    transferred_to: str | None = None
    summary: str | None = None

    def as_payload(self) -> dict[str, Any]:
        data = asdict(self)
        data["business_id"] = self.business.get("id")
        data.pop("business", None)
        data["ended_at"] = time.time()
        data["duration_seconds"] = round(data["ended_at"] - self.started_at)
        return data


def _headers() -> dict[str, str]:
    return {"Authorization": f"Bearer {API_TOKEN}", "Accept": "application/json"}


def demo_business() -> dict[str, Any]:
    return json.loads(DEMO_FILE.read_text(encoding="utf-8"))


async def load_business(called_number: str) -> dict[str, Any]:
    """Return the business that owns `called_number`, or the demo business."""
    if not API_URL:
        return demo_business()
    try:
        async with httpx.AsyncClient(timeout=5) as client:
            resp = await client.get(
                f"{API_URL}/api/agent/business",
                params={"number": called_number},
                headers=_headers(),
            )
        if resp.status_code == 200:
            return resp.json()["data"]
        logger.warning("business lookup for %s returned %s", called_number, resp.status_code)
    except httpx.HTTPError as exc:
        logger.error("business lookup failed: %s", exc)
    return demo_business()


async def report_call(state: CallState) -> None:
    """Send the finished call to the web app (or save it locally)."""
    payload = state.as_payload()
    if API_URL:
        try:
            async with httpx.AsyncClient(timeout=15) as client:
                resp = await client.post(
                    f"{API_URL}/api/agent/calls", json=payload, headers=_headers()
                )
            resp.raise_for_status()
            logger.info("call reported to web app")
            return
        except httpx.HTTPError as exc:
            logger.error("call report failed, saving locally: %s", exc)
    CALLS_DIR.mkdir(exist_ok=True)
    path = CALLS_DIR / f"call-{int(state.started_at)}.json"
    path.write_text(json.dumps(payload, ensure_ascii=False, indent=2), encoding="utf-8")
    logger.info("call saved to %s", path)
