# Testing and release gates

A checkbox is not evidence. A gate is complete only when its command, workflow job, or manual test has been executed against the exact candidate SHA.

## Automated gates

Run locally:

```bash
php tools/validate-theme.php
find . -type f -name '*.php' -print0 | xargs -0 -n1 php -l
php tools/build-release.php
```

Pull requests run the same source contract on PHP 8.0 and 8.4, plus a WordPress 7.1.1 installation smoke. The smoke activates Marcia, verifies a clean boot with no pattern markup leaking into runtime output, confirms block-theme recognition and Marcia pattern discovery, then installs and activates WooCommerce and confirms theme support.

The release ZIP job only runs after both static and WordPress/WooCommerce gates pass.

## Manual consumer gates

These remain mandatory before a public release:

- Fresh ZIP install on a clean WordPress site.
- Site Editor navigation, style variation and template editing.
- Responsive review at phone, tablet, laptop and wide desktop sizes.
- Keyboard-only navigation and visible focus review.
- Screen-reader pass on header/navigation, blog loop, search, 404, product, cart and checkout flows.
- Contrast review for the default style and every style variation.
- Real WooCommerce product, cart, checkout, account and order flow using a test payment gateway.
- Browser review in current Chrome, Firefox, Safari and Edge.
- WordPress Theme Check review when targeting WordPress.org.
- Final screenshot review when targeting WordPress.org.

Record the exact commit SHA, WordPress version, WooCommerce version, browser/assistive technology versions, and any deviations with the release evidence.
