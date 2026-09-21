# Deployment

Marcia releases are source-derived and evidence-gated. Do not package an arbitrary working tree.

## Candidate process

1. Start from a clean branch whose base commit is known.
2. Run `php tools/validate-theme.php`.
3. Push the candidate and wait for every `Theme CI` job on the exact head SHA.
4. Perform the manual consumer gates in `TESTING.md`.
5. Build the installable archive with `php tools/build-release.php`.
6. Install that generated ZIP on a clean WordPress site and repeat the activation/storefront smoke.
7. Tag and publish only the exact commit that produced the verified archive.

The release builder packages runtime files only: theme metadata, `theme.json`, README.txt, assets, PHP integration, languages, template parts, patterns, style variations and templates. Development workflows, tooling, Git metadata, audit notes and source-only documentation are excluded from the customer ZIP.

## Supported baseline

- Minimum WordPress: 6.8
- Current CI WordPress target: 7.1.1
- Minimum PHP: 8.0
- WooCommerce: optional, tested by installing the current plugin in CI

Numeric performance scores are not release criteria because hosting, plugins, content and media materially affect them. Performance claims must be backed by a dated benchmark against a named environment before publication.
