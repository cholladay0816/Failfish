import assert from 'node:assert/strict';
import { test } from 'node:test';
import { easterSunday, imageForDate } from '../src/schedule.js';
import worker from '../src/worker.js';

const pick = (date) => imageForDate(new Date(`${date}T12:00:00Z`));

test('holiday priority, including Easter on the first', () => {
  assert.equal(pick('2026-12-25'), 'austingrinch.png');
  assert.equal(pick('2026-11-26'), 'austinturkey.png');
  assert.equal(pick('2025-11-27'), 'austinturkey.png');
  assert.equal(pick('2026-04-05'), 'austineaster.png');
  assert.deepEqual(easterSunday(2018), { month: 4, day: 1 });
  assert.equal(pick('2018-04-01'), 'austineaster.png');
  assert.deepEqual(easterSunday(2038), { month: 4, day: 25 });
});

test('first of month and all weekdays', () => {
  assert.equal(pick('2026-09-01'), 'austinfirst.jpg');
  for (const [day, name] of ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'].entries()) {
    assert.equal(pick(`2026-09-${String(6 + day).padStart(2, '0')}`), `austin${name}.png`);
  }
  assert.equal(imageForDate(new Date('2026-09-02T00:01:00+02:00')), 'austinfirst.jpg');
});

test('the daily URL serves the selected static asset and prevents long caching', async () => {
  const paths = [];
  const env = { ASSETS: { fetch: async (request) => {
    paths.push(new URL(request.url).pathname);
    return new Response('image', { headers: { 'Content-Type': 'image/png' } });
  } } };
  const response = await worker.fetch(new Request('https://failfish.com/daily.png'), env);
  assert.equal(response.status, 200);
  assert.equal(paths[0], `/img/${imageForDate(new Date())}`);
  assert.equal(response.headers.get('Cache-Control'), 'public, max-age=60, must-revalidate');
  assert.equal((await worker.fetch(new Request('https://failfish.com/daily.png', { method: 'POST' }), env)).status, 405);
  await worker.fetch(new Request('https://failfish.com/'), env);
  assert.equal(paths[1], '/');
});
