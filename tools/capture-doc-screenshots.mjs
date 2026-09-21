import fs from 'node:fs/promises';
import path from 'node:path';
import { chromium } from 'playwright';

const baseUrl = process.env.BASE_URL || 'http://127.0.0.1:8080';
const productId = process.env.DEMO_PRODUCT_ID;
const outputDir = path.resolve('docs/images');

if (!productId) {
  throw new Error('DEMO_PRODUCT_ID is required.');
}

await fs.mkdir(outputDir, { recursive: true });

const browser = await chromium.launch({ headless: true });

async function settle(page) {
  await page.waitForLoadState('networkidle');
  await page.evaluate(async () => {
    if (document.fonts?.ready) {
      await document.fonts.ready;
    }
  });
  await page.waitForTimeout(500);
}

async function capture(context, route, filename) {
  const page = await context.newPage();
  await page.goto(`${baseUrl}${route}`, { waitUntil: 'domcontentloaded' });
  await settle(page);
  await page.screenshot({ path: path.join(outputDir, filename), fullPage: false });
  await page.close();
}

const desktop = await browser.newContext({
  viewport: { width: 1440, height: 960 },
  deviceScaleFactor: 1,
});

await capture(desktop, '/', 'marcia-home-desktop.png');
await capture(desktop, '/shop/', 'marcia-shop-desktop.png');

const cartPage = await desktop.newPage();
await cartPage.goto(`${baseUrl}/?add-to-cart=${encodeURIComponent(productId)}`, { waitUntil: 'domcontentloaded' });
await settle(cartPage);
await cartPage.goto(`${baseUrl}/cart/`, { waitUntil: 'domcontentloaded' });
await settle(cartPage);
await cartPage.screenshot({ path: path.join(outputDir, 'marcia-cart-desktop.png'), fullPage: false });
await cartPage.close();

const checkoutPage = await desktop.newPage();
await checkoutPage.goto(`${baseUrl}/checkout/`, { waitUntil: 'domcontentloaded' });
await settle(checkoutPage);
await checkoutPage.screenshot({ path: path.join(outputDir, 'marcia-checkout-desktop.png'), fullPage: false });
await checkoutPage.close();
await desktop.close();

const mobile = await browser.newContext({
  viewport: { width: 390, height: 844 },
  deviceScaleFactor: 1,
  isMobile: true,
});
await capture(mobile, '/', 'marcia-home-mobile.png');
await mobile.close();

await browser.close();
