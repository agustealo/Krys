# Changelog

## 2.1.0 - Unreleased

### Runtime authority
- Replaced the manual pattern-file loader with WordPress core nested pattern discovery and raised the minimum WordPress version to 6.8.
- Removed the theme-level performance module that modified cache headers, XML-RPC, embeds, revisions, autosave, memory, heartbeat, output compression, global styles, queries and WooCommerce runtime assets.
- Removed the experimental editor settings shim and made `theme.json` the design-system authority.
- Consolidated block-style registration and stylesheet loading.

### Consumer defaults
- Removed the theme marketing front-page override so customer content/settings determine the homepage.
- Removed placeholder social URLs and theme-owned copyright identity from the default footer.
- Replaced the missing Radnika dependency with an explicit system-font stack.
- Added missing `xxx-large` typography and `large` shadow tokens used by retained patterns.
- Pruned confirmed patterns that depended on missing images/video, remote placeholder media, or fake form/newsletter behavior.

### WooCommerce
- Moved product templates to the block-theme `/templates` authority.
- Replaced hard-coded Cart and Checkout functional templates with `woocommerce/page-content-wrapper` + `core/post-content` page templates.
- Removed classic-menu cart injection, unauthenticated cart-count AJAX, WooCommerce wrapper replacement and WooCommerce asset dequeues.

### Release engineering
- Replaced fake-green test scripts with deterministic source validation.
- Added WordPress 7.1.1 and WooCommerce activation smoke CI.
- Added validated runtime-only ZIP packaging.
- Rewrote release documentation to separate executable evidence from manual gates.

## 2.0.0 - Imported baseline
- Imported the pre-hardening Marcia block-theme baseline into `agustealo/Krys`.
