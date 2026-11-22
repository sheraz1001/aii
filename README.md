# aii.ae

AI receptionist and AI agents for UAE businesses.

| Folder | What it is | Runs on |
| --- | --- | --- |
| [`web/`](web) | Laravel website, demo-request form and the API the voice agent talks to | Hostinger Cloud Enterprise |
| [`agent/`](agent) | Python voice agent built on [LiveKit Agents](https://github.com/livekit/agents) | Contabo VPS (Coolify, Docker) |

```
Caller ─► e& / du ─► SIP trunk ─► LiveKit Cloud ─► agent/ (Contabo)
                                                    │  GET  /api/agent/business
                                                    └► POST /api/agent/calls ─► web/ (Hostinger) ─► email summary
```

---

## Deploy the website on Hostinger Cloud

**1. Create the database.** hPanel → Websites → aii.ae → Databases → MySQL: create a database and user. Note the three values.

**2. Get the code onto the server (SSH).** hPanel → Advanced → SSH access, then:

```bash
cd ~/domains/aii.ae
git clone https://github.com/sheraz1001/aii.git app      # use a GitHub deploy key or token for this private repo
cd app/web
composer install --no-dev --optimize-autoloader
cp .env.example .env
php artisan key:generate
nano .env        # fill DB_*, MAIL_* (Hostinger email), AII_* values
php artisan migrate --force
php artisan config:cache && php artisan route:cache && php artisan view:cache
```

**3. Point the domain at Laravel's `public` folder.**

```bash
cd ~/domains/aii.ae
mv public_html public_html_old
ln -s ~/domains/aii.ae/app/web/public public_html
```

**4. Update later.**

```bash
cd ~/domains/aii.ae/app && git pull && cd web \
 && composer install --no-dev --optimize-autoloader && php artisan migrate --force \
 && php artisan config:cache && php artisan route:cache && php artisan view:cache
```

No Node.js build step is needed: CSS and JavaScript are plain files in `web/public`.

### Cloudflare DNS

1. In hPanel copy the website's IP address (Websites → aii.ae → Dashboard).
2. In Cloudflare → DNS: `A  @  <Hostinger IP>` and `CNAME  www  aii.ae`, both **DNS only** (grey cloud) at first.
3. Install the free SSL in hPanel (Security → SSL). Once it is active, switch both records to **Proxied** and set Cloudflare SSL/TLS mode to **Full (strict)**.

### Email

Create `hello@aii.ae` in Hostinger Emails, then set `MAIL_USERNAME`/`MAIL_PASSWORD` in `.env`. Demo requests go to `AII_SALES_EMAIL`; call summaries go to each business's `owner_email`.

---

## Deploy the voice agent

See [`agent/README.md`](agent/README.md). Use the same random `AII_AGENT_TOKEN` in both `.env` files and set the agent's `AII_API_URL=https://aii.ae`.

Add your first business (until the dashboard exists):

```bash
php artisan tinker
>>> App\Models\Business::create(['name' => 'Smile Dental', 'phone_number' => '+9714XXXXXXX', 'owner_email' => 'you@aii.ae', 'languages' => ['English','Arabic'], 'hours' => '...', 'services_and_prices' => '...']);
```

`php artisan db:seed` creates the demo clinic from `agent/demo_business.json`, attached to `AII_DEMO_NUMBER`.

## Develop locally

```bash
cd web && composer install && cp .env.example .env && php artisan key:generate
# for local use set DB_CONNECTION=sqlite and remove the other DB_ lines
touch database/database.sqlite && php artisan migrate --seed && php artisan serve
php artisan test
```
