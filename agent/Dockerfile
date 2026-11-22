FROM python:3.12-slim

ENV PYTHONUNBUFFERED=1 PIP_NO_CACHE_DIR=1
# All dependencies ship prebuilt wheels for Python 3.12, so no compiler is needed.

WORKDIR /app
COPY requirements.txt .
RUN pip install --prefer-binary -r requirements.txt

COPY . .
# Download the voice-activity and turn-detector models at build time
RUN python agent.py download-files

# Health/metrics port used by LiveKit Agents in production mode
EXPOSE 8081
CMD ["python", "agent.py", "start"]
