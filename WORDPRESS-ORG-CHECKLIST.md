# WordPress.org submission evidence

This file is intentionally conservative. Items remain open until there is evidence for the exact release candidate.

## Automated source gates

- [ ] Exact candidate SHA passes all `Theme CI` jobs.
- [ ] PHP 8.0 source validation passes.
- [ ] PHP 8.4 source validation passes.
- [ ] WordPress 7.1.1 clean activation smoke passes.
- [ ] Marcia native pattern discovery proof passes.
- [ ] WooCommerce install/activation and theme-support smoke passes.
- [ ] Release ZIP builds from the exact candidate SHA.

## Theme Review / consumer gates

- [ ] Theme Check has been run against the generated release ZIP and all required findings are resolved.
- [ ] `screenshot.png` exists, is representative of the theme, and satisfies the current WordPress.org screenshot requirements.
- [ ] Fresh ZIP installation succeeds on a clean site.
- [ ] No PHP warnings/notices are produced with debugging enabled.
- [ ] No console errors occur through the tested customer journeys.
- [ ] Keyboard-only navigation is verified.
- [ ] Screen-reader behavior is verified on primary templates.
- [ ] Default and variation contrast has been reviewed.
- [ ] Responsive behavior is verified on the supported viewport set.
- [ ] Current Chrome, Firefox, Safari and Edge are reviewed.
- [ ] A real WooCommerce product/cart/checkout/order flow passes when WooCommerce is part of the release claim.
- [ ] License/resource attribution is reviewed for every bundled third-party resource.
- [ ] Public README/readme claims match measured evidence.

## Architecture invariants

These are enforced by source validation and code review:

- Theme code owns presentation, not server/cache/database policy.
- WordPress core owns nested pattern discovery.
- `theme.json` owns the design system.
- WooCommerce owns commerce behavior and the Cart/Checkout blocks stored in assigned page content.
- No missing local media is referenced by shipped patterns.
- No remote placeholder media is shipped as theme content.
- No fake-green test command is accepted as release evidence.

## Current manual blocker

`screenshot.png` is not yet present. That does not block local theme activation, but it remains a public WordPress.org release task.
