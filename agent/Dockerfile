FROM python:3.12-slim

ENV PYTHONUNBUFFERED=1 PIP_NO_CACHE_DIR=1
RUN apt-get update && apt-get install -y --no-install-recommends gcc g++ \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /app
COPY requirements.txt .
RUN pip install -r requirements.txt

COPY . .
# Download the voice-activity and turn-detector models at build time
RUN python agent.py download-files

# Health/metrics port used by LiveKit Agents in production mode
EXPOSE 8081
CMD ["python", "agent.py", "start"]
