# Marcia runtime showcase

These screenshots are generated from a real temporary WordPress 7.1.1 + WooCommerce installation running the current Marcia branch. The fixture creates normal WordPress pages, real WooCommerce products, local generated product media, a real cart session, and the theme's production templates/styles. It does not inject screenshot-only CSS into Marcia or ship demo data with the theme.

## Homepage

![Marcia homepage on desktop](images/marcia-home-desktop.png)

The homepage demonstrates the production `theme.json` palette, typography, spacing, button styles, cards, full-width groups, header, and footer on ordinary WordPress block content.

## Shop in action

![Marcia WooCommerce shop](images/marcia-shop-desktop.png)

The shop screenshot is the real WooCommerce product archive rendered through `templates/archive-product.html`. Product data and product media are generated only inside the documentation fixture.

## Cart in action

![Marcia WooCommerce cart with a product](images/marcia-cart-desktop.png)

Before this image is captured, the browser adds a real WooCommerce product to the cart and then opens the assigned Cart page. The theme still delegates cart behavior and session ownership to WooCommerce.

## Checkout in action

![Marcia WooCommerce checkout](images/marcia-checkout-desktop.png)

Checkout uses the assigned WordPress Checkout page through Marcia's `woocommerce/page-content-wrapper` + `core/post-content` template contract rather than a duplicated theme-owned checkout flow.

## Mobile viewport

![Marcia homepage on mobile](images/marcia-home-mobile.png)

The mobile screenshot is captured at a 390 × 844 viewport from the same WordPress runtime.

## Reproducing the screenshots

The branch-specific workflow `.github/workflows/capture-doc-screenshots.yml` installs WordPress and WooCommerce, loads `tools/setup-screenshot-demo.php`, launches the site, captures the screens with Chromium through `tools/capture-doc-screenshots.mjs`, uploads the images as a workflow artifact, and commits changed PNGs back to the documentation branch.

These documentation images are not a substitute for the separate WordPress.org `screenshot.png` release asset or for manual accessibility/browser review.
