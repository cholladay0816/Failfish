const weekdays = [
  'austinsunday', 'austinmonday', 'austintuesday', 'austinwednesday',
  'austinthursday', 'austinfriday', 'austinsaturday',
];

const centralDate = new Intl.DateTimeFormat('en-US', {
  timeZone: 'America/Chicago', year: 'numeric', month: 'numeric', day: 'numeric',
});

function centralParts(date) {
  return Object.fromEntries(
    centralDate.formatToParts(date).filter(part => part.type !== 'literal').map(part => [part.type, Number(part.value)]),
  );
}

export function secondsUntilNextCentralMidnight(date) {
  const today = centralParts(date);
  const currentSecond = Math.floor(date.getTime() / 1000);
  let low = currentSecond;
  let high = currentSecond + 27 * 60 * 60;

  // Find the first UTC second belonging to tomorrow in Chicago. This also
  // handles the 23- and 25-hour days around daylight saving changes.
  while (low + 1 < high) {
    const middle = Math.floor((low + high) / 2);
    const candidate = centralParts(new Date(middle * 1000));
    if (candidate.year === today.year && candidate.month === today.month && candidate.day === today.day) {
      low = middle;
    } else {
      high = middle;
    }
  }
  return Math.max(0, Math.floor((high * 1000 - date.getTime()) / 1000));
}

// Gregorian computus: unlike the old approximation, this also works in years
// when Easter falls in late April.
export function easterSunday(year) {
  const a = year % 19;
  const b = Math.floor(year / 100);
  const c = year % 100;
  const d = Math.floor(b / 4);
  const e = b % 4;
  const f = Math.floor((b + 8) / 25);
  const g = Math.floor((b - f + 1) / 3);
  const h = (19 * a + b - d - g + 15) % 30;
  const i = Math.floor(c / 4);
  const k = c % 4;
  const l = (32 + 2 * e + 2 * i - h - k + 7) % 7;
  const m = Math.floor((a + 11 * h + 22 * l) / 451);
  const month = Math.floor((h + l - 7 * m + 114) / 31);
  const day = ((h + l - 7 * m + 114) % 31) + 1;
  return { month, day };
}

export function imageForDate(date) {
  const { year, month, day } = centralParts(date);
  const weekday = new Date(Date.UTC(year, month - 1, day)).getUTCDay();

  if (month === 12 && day === 25) return 'austingrinch.png';

  // Last Thursday of November (US Thanksgiving).
  const lastNovemberDay = new Date(Date.UTC(year, 10, 30));
  const thanksgiving = 30 - ((lastNovemberDay.getUTCDay() - 4 + 7) % 7);
  if (month === 11 && day === thanksgiving) return 'austinturkey.png';

  const easter = easterSunday(year);
  if (month === easter.month && day === easter.day) return 'austineaster.png';
  if (day === 1) return 'austinfirst.jpg';

  return `${weekdays[weekday]}.png`;
}
