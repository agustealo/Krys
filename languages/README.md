# Krys Theme Translations

This directory contains translation files for the Krys theme.

## Translation Files

- `krys.pot` - Translation template file (will be generated)
- Language-specific `.po` and `.mo` files

## How to Translate

### For Translators

1. **Download the .pot file** from this directory
2. **Use a translation tool** like [Poedit](https://poedit.net/)
3. **Create a new translation** from the .pot template
4. **Save your translation** as `krys-{locale}.po` and `krys-{locale}.mo`
   - Examples: `krys-es_ES.po`, `krys-fr_FR.po`, `krys-de_DE.po`
5. **Submit your translation** via pull request or contact us

### Translation Tools

- [Poedit](https://poedit.net/) - Desktop translation editor
- [Loco Translate](https://wordpress.org/plugins/loco-translate/) - WordPress plugin
- [GlotPress](https://translate.wordpress.org/) - WordPress.org translation platform

## Available Languages

Currently available translations:
- English (default)

## Translation Status

Help us translate Krys into your language!

| Language | Status | Contributors |
|----------|--------|--------------|
| English  | 100%   | Core team    |

## Contributing Translations

We welcome translation contributions! Please see [CONTRIBUTING.md](../CONTRIBUTING.md) for guidelines.

### Translation Workflow

1. Fork the repository
2. Create a new branch: `git checkout -b translation/your-language`
3. Add your translation files
4. Submit a pull request

## Generating the POT File

For developers:

```bash
# Using WP-CLI
wp i18n make-pot . languages/krys.pot

# Or using npm script (if configured)
npm run makepot
```

## Text Domain

All translatable strings use the `krys` text domain:

```php
__( 'Translatable text', 'krys' )
esc_html__( 'Translatable text', 'krys' )
esc_attr__( 'Translatable text', 'krys' )
_e( 'Translatable text', 'krys' )
esc_html_e( 'Translatable text', 'krys' )
```

## RTL Languages

Krys includes RTL (Right-to-Left) language support for:
- Arabic
- Hebrew
- Persian
- Urdu
- And other RTL languages

## Questions?

If you have questions about translating Krys:
- Open an [issue](https://github.com/agustealo/Krys/issues)
- Contact us via the [support forum](https://wordpress.org/support/theme/krys)

## Credits

Thank you to all our translators!
