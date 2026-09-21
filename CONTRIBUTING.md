# Contributing to Marcia

Marcia is maintained in `agustealo/Krys` as a native WordPress block theme. Contributions should preserve the project's authority boundaries rather than adding parallel systems.

## Baseline

- WordPress 6.8 or newer
- PHP 8.0 or newer
- Current CI smoke target: WordPress 7.1.1
- WooCommerce is optional

Node.js is not required for the runtime or release build.

## Architecture rules

- WordPress core owns nested pattern discovery, site content, embeds, revisions, editor behavior, and platform runtime.
- `theme.json` owns design tokens and editor design controls.
- Theme PHP/CSS owns presentation setup and block styling.
- WooCommerce owns cart, checkout, sessions, commerce scripts, and merchant behavior.
- Do not add fake forms, fake AJAX endpoints, placeholder media, fabricated merchant promises, cache/server policy, or duplicate framework layers.

## Development workflow

1. Branch from current `main`.
2. Make a focused change.
3. Run the deterministic source gate:

```bash
php tools/validate-theme.php
find . -type f -name '*.php' -print0 | xargs -0 -n1 php -l
```

4. If the change affects release packaging, also run:

```bash
php tools/build-release.php
```

5. Open a pull request and require every `Theme CI` job to pass on the exact head SHA before merge.

## Coding standards

### PHP

- Follow WordPress PHP coding conventions.
- Prefix theme functions with `marcia_`.
- Escape output and sanitize/validate data at boundaries.
- Avoid adding site/server/plugin policy to theme code.

### CSS

- Prefer `theme.json` for global design decisions.
- Keep block CSS scoped to the block/style it owns.
- Avoid selectors that depend on unstable private plugin markup.
- Preserve visible focus and reduced-motion behavior.

### Block patterns

- Use WordPress pattern headers and let core discover files from `/patterns`.
- Patterns may contain editable starter copy, but must not pretend to implement a functional service the theme does not provide.
- Do not reference missing local assets or remote placeholder media.
- Do not add a pattern only to increase the pattern count.

### WooCommerce

- Product, cart, checkout, pricing, inventory, payment, shipping, returns, coupons, sessions, and account behavior remain WooCommerce/merchant-owned.
- Cart and Checkout templates must render assigned page content via `woocommerce/page-content-wrapper` and `core/post-content`.
- Never dequeue WooCommerce runtime assets from the theme as a blanket optimization.

## Pull requests

A good PR explains:

- the user-visible problem;
- the authority that should own the fix;
- the files changed;
- the automated evidence from the exact head;
- manual verification still required.

Visual changes should include screenshots or before/after evidence. Runtime or WooCommerce changes should include the relevant activation/storefront proof.

## Release discipline

Do not mark an item complete because it looks plausible in source. Release claims require executable or manual evidence tied to the candidate SHA. See `TESTING.md`, `DEPLOYMENT.md`, `WORDPRESS-ORG-CHECKLIST.md`, and `docs/RELEASE-EVIDENCE.md`.
