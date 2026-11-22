#!/bin/sh
# One-time setup for aii.ae on Hostinger Cloud, run from an hPanel cron job:
#   sh /home/USER/domains/aii.ae/public_html/hostinger-setup.sh >> /home/USER/domains/aii.ae/setup.log 2>&1
# Run 1 creates ../.env.aii (outside public_html, safe from Git redeploys),
#        generates APP_KEY and AII_AGENT_TOKEN.
# Then put the database password into .env.aii (DB_PASSWORD=...).
# Run 2 creates the database tables and caches the configuration.
# Safe to run again after every deployment or settings change.
set -e
APP="$(cd "$(dirname "$0")" && pwd)"
ENVF="$(dirname "$APP")/.env.aii"
PHP="${PHP:-php}"
cd "$APP"
echo "---- $(date) ----"

if [ ! -f "$ENVF" ]; then
    cp "$APP/.env.hostinger" "$ENVF"
    chmod 600 "$ENVF"
    $PHP artisan key:generate --force
    TOKEN="$(openssl rand -hex 32)"
    sed -i "s/^AII_AGENT_TOKEN=\$/AII_AGENT_TOKEN=$TOKEN/" "$ENVF"
    echo "Created $ENVF with APP_KEY and AII_AGENT_TOKEN."
    echo "Next: set DB_PASSWORD in $ENVF, then let this script run again."
    exit 0
fi

if grep -q '^DB_PASSWORD=$' "$ENVF"; then
    echo "Waiting: DB_PASSWORD is still empty in $ENVF"
    exit 0
fi

$PHP artisan migrate --force
$PHP artisan config:cache
$PHP artisan route:cache
$PHP artisan view:cache
echo "aii.ae is ready."
