# Failfish

A static site and a single Cloudflare Worker serving Austin of the Day. No PHP runtime, database, cron job, or build pipeline is needed.

## Run

```sh
npm install
npm run dev
```

Open the local URL printed by Wrangler. `npm test` checks the calendar rules; `npm run deploy` deploys the Worker and the static files together. To verify the deployment package without publishing, run `npm run check`.

The Worker is configured on `failfish.com/*` and `www.failfish.com/*`. Both hostnames need proxied DNS records in the active Cloudflare zone; the existing records are retained. `npm run deploy` publishes the site and attaches both routes.

## Daily image

The page is static. Its image points to `/daily.png`, which is the only dynamic route. The Worker selects an image using the current **UTC** date and returns the corresponding file from `public/img/`. Selection order matches the former Laravel schedule:

1. December 25: `austingrinch.png`
2. Last Thursday in November: `austinturkey.png`
3. Easter Sunday: `austineaster.png`
4. First day of the month: `austinfirst.jpg`
5. Otherwise: the appropriate weekday image

The stable image URL is cached for at most 60 seconds, so new visits receive the new day's image without a scheduled job. An already-open page updates when reloaded. Change the schedule in `src/schedule.js` and the available files in `public/img/`. UTC preserves the old app's configured timezone. The former raw-image homepage is now `/daily.png`; `/` is the static site.
