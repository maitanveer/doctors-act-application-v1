const puppeteer = require('puppeteer');

(async () => {
  const browser = await puppeteer.launch({args: ['--no-sandbox', '--disable-setuid-sandbox']});
  const page = await browser.newPage();

  const logs = [];

  page.on('console', msg => {
    const texts = msg.args().map(a => a.toString());
    logs.push({type: msg.type(), text: texts.join(' ')});
  });

  page.on('pageerror', err => {
    logs.push({type: 'pageerror', text: err.toString()});
  });

  page.on('response', response => {
    // collect failed resources
    if (response.status() >= 400) {
      logs.push({type: 'response', text: `${response.status()} ${response.url()}`});
    }
  });

  try {
    await page.goto('http://127.0.0.1:8000/', {waitUntil: 'networkidle2', timeout: 30000});
    // wait a moment for scripts to run
    await page.waitForTimeout(2000);
  } catch (e) {
    logs.push({type: 'navigation', text: e.toString()});
  }

  console.log('--- CONSOLE LOGS START ---');
  logs.forEach(l => console.log(`[${l.type}] ${l.text}`));
  console.log('--- CONSOLE LOGS END ---');

  await browser.close();
})();
