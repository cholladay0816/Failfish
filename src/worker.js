import { imageForDate, secondsUntilNextCentralMidnight } from './schedule.js';

export default {
  async fetch(request, env) {
    const url = new URL(request.url);
    if (url.pathname !== '/' && url.pathname !== '/daily.png') {
      return env.ASSETS.fetch(request);
    }
    if (request.method !== 'GET' && request.method !== 'HEAD') {
      return new Response('Method not allowed', { status: 405, headers: { Allow: 'GET, HEAD' } });
    }

    const now = new Date();
    const selected = imageForDate(now);
    const assetUrl = new URL(`/img/${selected}`, url);
    const asset = await env.ASSETS.fetch(new Request(assetUrl, { method: request.method }));
    if (!asset.ok) return asset;

    const headers = new Headers(asset.headers);
    // Workers Cache serves repeat requests before invoking this Worker.
    headers.set('Cache-Control', `public, max-age=${secondsUntilNextCentralMidnight(now)}`);
    headers.set('X-Content-Type-Options', 'nosniff');
    return new Response(asset.body, { status: asset.status, headers });
  },
};
