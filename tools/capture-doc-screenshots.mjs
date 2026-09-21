import fs from 'node:fs/promises';
import path from 'node:path';
import { chromium } from 'playwright';

const baseUrl = process.env.BASE_URL || 'http://127.0.0.1:8080';
const productId = process.env.DEMO_PRODUCT_ID;
const adminUser = process.env.WP_ADMIN_USER || 'admin';
const adminPassword = process.env.WP_ADMIN_PASSWORD || 'docs-capture-only';
const outputDir = path.resolve('docs/images');

if (!productId) {
  throw new Error('DEMO_PRODUCT_ID is required.');
}

await fs.rm(outputDir, { recursive: true, force: true });
await fs.mkdir(outputDir, { recursive: true });

const browser = await chromium.launch({ headless: true });

async function settle(page, delay = 700) {
  await page.waitForLoadState('domcontentloaded');
  await page.waitForLoadState('networkidle', { timeout: 10000 }).catch(() => {});
  await page.evaluate(async () => {
    if (document.fonts?.ready) {
      await document.fonts.ready;
    }
  }).catch(() => {});
  await page.waitForTimeout(delay);
}

async function capture(context, route, filename, delay = 700) {
  const page = await context.newPage();
  await page.goto(`${baseUrl}${route}`, { waitUntil: 'domcontentloaded' });
  await settle(page, delay);
  await page.screenshot({ path: path.join(outputDir, filename), fullPage: false });
  await page.close();
}

const desktop = await browser.newContext({
  viewport: { width: 1440, height: 960 },
  deviceScaleFactor: 1,
});

await capture(desktop, '/', 'marcia-home-desktop.png');
await capture(desktop, '/shop/', 'marcia-shop-desktop.png');
await capture(desktop, '/product/arc-desk-lamp/', 'marcia-product-desktop.png');

const actionPage = await desktop.newPage();
await actionPage.goto(`${baseUrl}/product/arc-desk-lamp/`, { waitUntil: 'domcontentloaded' });
await settle(actionPage);
const addToCart = actionPage.getByRole('button', { name: /add to cart/i }).first();
await addToCart.waitFor({ state: 'visible' });
await addToCart.click();
await actionPage.getByText(/has been added to your cart/i).waitFor({ state: 'visible' });
await settle(actionPage);
await actionPage.screenshot({ path: path.join(outputDir, 'marcia-add-to-cart-desktop.png'), fullPage: false });
await actionPage.close();
await desktop.close();

const mobile = await browser.newContext({
  viewport: { width: 390, height: 844 },
  deviceScaleFactor: 1,
  isMobile: true,
});
await capture(mobile, '/', 'marcia-home-mobile.png');
await mobile.close();

const admin = await browser.newContext({
  viewport: { width: 1600, height: 1000 },
  deviceScaleFactor: 1,
});

const loginPage = await admin.newPage();
await loginPage.goto(`${baseUrl}/wp-login.php`, { waitUntil: 'domcontentloaded' });
await loginPage.locator('#user_login').fill(adminUser);
await loginPage.locator('#user_pass').fill(adminPassword);
await Promise.all([
  loginPage.waitForURL(/\/wp-admin\//, { timeout: 15000 }),
  loginPage.locator('#wp-submit').click(),
]);
await settle(loginPage);
await loginPage.close();

async function openAdmin(route, delay = 1500) {
  const page = await admin.newPage();
  await page.goto(`${baseUrl}${route}`, { waitUntil: 'domcontentloaded' });
  await settle(page, delay);
  if (page.url().includes('wp-login.php')) {
    throw new Error(`Admin authentication was lost while opening ${route}.`);
  }
  return page;
}

async function saveAdmin(page, filename) {
  await page.screenshot({ path: path.join(outputDir, filename), fullPage: false });
  await page.close();
}

let page = await openAdmin('/wp-admin/site-editor.php');
await saveAdmin(page, 'marcia-admin-site-editor.png');

page = await openAdmin('/wp-admin/site-editor.php?path=/wp_global_styles');
await saveAdmin(page, 'marcia-admin-styles.png');

page = await openAdmin('/wp-admin/site-editor.php?path=/wp_global_styles');
const browseStyles = page.getByText('Browse styles', { exact: true }).first();
await browseStyles.waitFor({ state: 'visible', timeout: 10000 });
await browseStyles.click();
await settle(page, 1200);
await saveAdmin(page, 'marcia-admin-style-variations.png');

page = await openAdmin('/wp-admin/site-editor.php?path=/wp_template');
await saveAdmin(page, 'marcia-admin-templates.png');

page = await openAdmin('/wp-admin/site-editor.php?path=/patterns');
const heroCategory = page.getByText('Hero Sections', { exact: true }).first();
await heroCategory.waitFor({ state: 'visible', timeout: 10000 });
await heroCategory.click();
await settle(page, 1200);
await saveAdmin(page, 'marcia-admin-patterns.png');

const pagesResponse = await admin.request.get(`${baseUrl}/wp-json/wp/v2/pages?slug=home`);
if (!pagesResponse.ok()) {
  throw new Error(`Unable to resolve the Home page for editor capture: ${pagesResponse.status()}.`);
}
const pages = await pagesResponse.json();
if (!Array.isArray(pages) || !pages[0]?.id) {
  throw new Error('The Home page fixture was not available for editor capture.');
}

page = await openAdmin(`/wp-admin/post.php?post=${pages[0].id}&action=edit`, 2200);
const welcomeDialog = page.getByRole('dialog').filter({ hasText: /welcome to the editor/i }).first();
if (await welcomeDialog.isVisible().catch(() => false)) {
  const closeButton = welcomeDialog.getByRole('button', { name: /close/i }).first();
  if (await closeButton.isVisible().catch(() => false)) {
    await closeButton.click();
  } else {
    await page.keyboard.press('Escape');
  }
  await settle(page, 700);
}
await saveAdmin(page, 'marcia-admin-page-editor.png');

await admin.close();
await browser.close();
