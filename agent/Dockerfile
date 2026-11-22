FROM python:3.12-slim

ENV PYTHONUNBUFFERED=1 PIP_NO_CACHE_DIR=1
# All dependencies ship prebuilt wheels for Python 3.12, so no compiler is needed.

WORKDIR /app
COPY requirements.txt .
# Retries + long timeout so a flaky network doesn't fail the whole build
RUN for i in 1 2 3 4 5; do \
      pip install --prefer-binary --retries 10 --timeout 120 -r requirements.txt && break; \
      echo "pip attempt $i failed, retrying"; sleep 10; \
    done && python -c "import livekit.agents"

COPY . .
# Download the voice-activity and turn-detector models at build time
RUN python agent.py download-files

# Health/metrics port used by LiveKit Agents in production mode
EXPOSE 8081
CMD ["python", "agent.py", "start"]
