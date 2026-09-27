# Failfish

A collection of static images and one Cloudflare Worker serving Austin of the Day. No PHP runtime, database, cron job, or build pipeline is needed.

## Run

```sh
npm install
npm run dev
```

Open the local URL printed by Wrangler. `npm test` checks the calendar rules; `npm run deploy` deploys the Worker and the static files together. To verify the deployment package without publishing, run `npm run check`.

The Worker is configured on `failfish.com/*` and `www.failfish.com/*`. Both hostnames need proxied DNS records in the active Cloudflare zone; the existing records are retained. `npm run deploy` publishes the site and attaches both routes.

## Daily image

`/` serves the image itself (not an HTML page). `/daily.png` is an alias. The Worker selects an image using the current date in **America/Chicago** and returns the corresponding file from `public/img/`. The date changes at midnight Central time (CST or CDT automatically). Selection order matches the former Laravel schedule's image priority:

1. December 25: `austingrinch.png`
2. Last Thursday in November: `austinturkey.png`
3. Easter Sunday: `austineaster.png`
4. First day of the month: `austinfirst.jpg`
5. Otherwise: the appropriate weekday image

The daily image response is not cached, so a new request after midnight receives the new day's image without a scheduled job. Change the schedule in `src/schedule.js` and the available files in `public/img/`.
