=== Marcia ===
Contributors: agustealo
Requires at least: 6.8
Tested up to: 7.1
Requires PHP: 8.0
Stable tag: 2.1.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

A flexible WordPress block theme for business sites, publishing, portfolios, and WooCommerce stores.

== Description ==

Marcia is a native block theme built around WordPress Site Editing. It provides a reusable theme.json design system, style variations, curated block patterns, standard templates, and presentation-level WooCommerce integration.

WordPress core owns pattern discovery and site behavior. WooCommerce owns cart, checkout and commerce runtime behavior. Marcia does not replace caching policy, revisions, autosave, XML-RPC, embeds, memory settings, WooCommerce scripts, or other plugin/server responsibilities.

== Installation ==

1. Upload the Marcia ZIP from Appearance > Themes > Add New > Upload Theme.
2. Activate Marcia.
3. Open Appearance > Editor to customize styles, templates and navigation.
4. If using WooCommerce, install and configure WooCommerce normally. Marcia supplies presentation templates and styles without replacing WooCommerce business logic.

== Frequently Asked Questions ==

= Is Marcia a block theme? =

Yes. Marcia uses native WordPress block templates, template parts, patterns and theme.json.

= What WordPress version is required? =

WordPress 6.8 or newer. Nested pattern-directory discovery is delegated to WordPress core.

= Does Marcia work with WooCommerce? =

Yes. The release gate activates the current WooCommerce plugin on WordPress 7.1.1 and verifies theme support. Cart and Checkout page templates render the assigned WooCommerce page content rather than hard-coding functional blocks into the theme.

= Is accessibility compliance certified? =

No certification claim is made. The theme includes accessibility-minded defaults, while keyboard, screen-reader, contrast and browser verification remain release-test responsibilities.

= Does Marcia guarantee a PageSpeed score or load time? =

No. Performance depends on hosting, plugins, content, media and configuration, so Marcia does not publish an unverified numeric performance guarantee.

== Changelog ==

= 2.1.0 =
* Replaced the manual pattern loader with WordPress core discovery.
* Removed site/server/plugin authority from the theme runtime.
* Removed missing-font and placeholder-media dependencies from the release path.
* Moved WooCommerce block templates to the canonical theme template directory.
* Reworked Cart and Checkout templates to render assigned page content.
* Removed theme marketing content from the customer front page and footer.
* Added deterministic validation, WordPress/WooCommerce smoke CI, and release packaging.

== Resources ==

* Source and issue tracker: https://github.com/agustealo/Krys

== Copyright ==

Marcia is distributed under the GNU GPL v2 or later.
