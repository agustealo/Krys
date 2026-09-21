<?php
/**
 * Deterministic source validator for Marcia.
 *
 * @package Marcia
 */

declare( strict_types=1 );

$root   = dirname( __DIR__ );
$errors = array();
$notes  = array();

$fail = static function ( string $message ) use ( &$errors ): void {
	$errors[] = $message;
};

$required_files = array(
	'style.css',
	'functions.php',
	'theme.json',
	'README.txt',
	'parts/header.html',
	'parts/footer.html',
	'templates/index.html',
	'templates/page-cart.html',
	'templates/page-checkout.html',
	'templates/archive-product.html',
	'templates/single-product.html',
);

foreach ( $required_files as $file ) {
	if ( ! is_file( $root . '/' . $file ) ) {
		$fail( 'Missing required file: ' . $file );
	}
}

$style = is_file( $root . '/style.css' ) ? file_get_contents( $root . '/style.css' ) : '';
if ( false === $style ) {
	$style = '';
}

$required_headers = array( 'Theme Name', 'Requires at least', 'Tested up to', 'Requires PHP', 'Version', 'Text Domain' );
foreach ( $required_headers as $header ) {
	if ( ! preg_match( '/^' . preg_quote( $header, '/' ) . ':\s*.+$/mi', $style ) ) {
		$fail( 'style.css is missing header: ' . $header );
	}
}

if ( preg_match( '/^Requires at least:\s*(.+)$/mi', $style, $match ) && version_compare( trim( $match[1] ), '6.8', '<' ) ) {
	$fail( 'Nested /patterns discovery requires WordPress 6.8 or newer.' );
}

if ( ! preg_match( '/^Version:\s*2\.1\.0\s*$/mi', $style ) ) {
	$fail( 'style.css must declare version 2.1.0 for this release line.' );
}

$json_files = array_merge( array( $root . '/theme.json' ), glob( $root . '/styles/*.json' ) ?: array() );
foreach ( $json_files as $json_file ) {
	$decoded = json_decode( (string) file_get_contents( $json_file ), true );
	if ( JSON_ERROR_NONE !== json_last_error() || ! is_array( $decoded ) ) {
		$fail( 'Invalid JSON: ' . str_replace( $root . '/', '', $json_file ) . ' (' . json_last_error_msg() . ')' );
	}
}

$theme_json = json_decode( (string) file_get_contents( $root . '/theme.json' ), true );
if ( is_array( $theme_json ) ) {
	$font_families = $theme_json['settings']['typography']['fontFamilies'] ?? array();
	foreach ( $font_families as $family ) {
		foreach ( $family['fontFace'] ?? array() as $face ) {
			foreach ( $face['src'] ?? array() as $source ) {
				if ( 0 === strpos( $source, 'file:./' ) ) {
					$asset = $root . '/' . substr( $source, 7 );
					if ( ! is_file( $asset ) ) {
						$fail( 'theme.json references missing font: ' . substr( $source, 7 ) );
					}
				}
			}
		}
	}
}

$functions = (string) file_get_contents( $root . '/functions.php' );
preg_match_all( "/'(marcia-[a-z0-9-]+)'\s*=>/", $functions, $category_matches );
$registered_categories = array_unique( $category_matches[1] ?? array() );

$pattern_files = glob( $root . '/patterns/*/*.php' ) ?: array();
foreach ( $pattern_files as $pattern_file ) {
	$content  = (string) file_get_contents( $pattern_file );
	$relative = str_replace( $root . '/', '', $pattern_file );

	if ( ! preg_match( '/^\s*\*\s*Title:\s*.+$/mi', $content ) || ! preg_match( '/^\s*\*\s*Slug:\s*marcia\/[a-z0-9-]+\s*$/mi', $content ) ) {
		$fail( 'Pattern header is incomplete: ' . $relative );
	}

	if ( preg_match( '/^\s*\*\s*Categories:\s*(.+)$/mi', $content, $match ) ) {
		foreach ( array_map( 'trim', explode( ',', $match[1] ) ) as $category ) {
			if ( 0 === strpos( $category, 'marcia-' ) && ! in_array( $category, $registered_categories, true ) ) {
				$fail( $relative . ' uses unregistered category ' . $category );
			}
		}
	}

	preg_match_all( '#/assets/[A-Za-z0-9_./-]+#', $content, $asset_matches );
	foreach ( array_unique( $asset_matches[0] ?? array() ) as $asset_ref ) {
		$asset_ref = rtrim( $asset_ref, "\"'" );
		if ( ! is_file( $root . $asset_ref ) ) {
			$fail( $relative . ' references missing asset ' . $asset_ref );
		}
	}

	if ( preg_match( '#(?:src|poster)=["\'][^"\']*https?://(?:placehold\.co|via\.placeholder\.com)#i', $content ) ) {
		$fail( $relative . ' contains remote placeholder media.' );
	}
}

$runtime_files = array_merge( array( $root . '/functions.php' ), glob( $root . '/inc/*.php' ) ?: array() );
$banned_runtime_fragments = array(
	'Cache-Control: public',
	'WP_MEMORY_LIMIT',
	'AUTOSAVE_INTERVAL',
	'xmlrpc_enabled',
	"wp_dequeue_script( 'wc-cart-fragments'",
	"wp_dequeue_style( 'woocommerce-general'",
	"remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles'",
	'ob_gzhandler',
);
foreach ( $runtime_files as $runtime_file ) {
	$content = (string) file_get_contents( $runtime_file );
	foreach ( $banned_runtime_fragments as $fragment ) {
		if ( false !== strpos( $content, $fragment ) ) {
			$fail( str_replace( $root . '/', '', $runtime_file ) . ' contains site/server/plugin authority: ' . $fragment );
		}
	}
}

if ( is_file( $root . '/inc/block-patterns.php' ) || is_file( $root . '/inc/editor-config.php' ) || is_file( $root . '/inc/performance.php' ) ) {
	$fail( 'Removed legacy authority files have returned.' );
}

if ( is_dir( $root . '/templates/woocommerce' ) ) {
	$fail( 'WooCommerce block templates must live directly in /templates.' );
}

$cart     = (string) file_get_contents( $root . '/templates/page-cart.html' );
$checkout = (string) file_get_contents( $root . '/templates/page-checkout.html' );
foreach ( array( 'cart' => $cart, 'checkout' => $checkout ) as $page => $template ) {
	if ( false === strpos( $template, '<!-- wp:woocommerce/page-content-wrapper' ) || false === strpos( $template, '<!-- wp:post-content' ) ) {
		$fail( 'templates/page-' . $page . '.html must render assigned page content through WooCommerce page-content-wrapper.' );
	}
}
if ( false !== strpos( $cart, '<!-- wp:woocommerce/cart ' ) ) {
	$fail( 'page-cart.html must not hard-code the Cart block.' );
}
if ( false !== strpos( $checkout, '<!-- wp:woocommerce/checkout ' ) ) {
	$fail( 'page-checkout.html must not hard-code the Checkout block.' );
}

$footer = (string) file_get_contents( $root . '/parts/footer.html' );
if ( false !== strpos( $footer, '"url":"#"' ) || false !== strpos( $footer, 'Marcia. All rights reserved' ) ) {
	$fail( 'Footer contains theme-owned placeholder identity.' );
}

if ( is_file( $root . '/templates/front-page.html' ) ) {
	$fail( 'Theme marketing front-page.html must not override the customer homepage.' );
}

$package = json_decode( (string) file_get_contents( $root . '/package.json' ), true );
if ( ! is_array( $package ) ) {
	$fail( 'package.json is invalid.' );
} else {
	$test_script = $package['scripts']['test'] ?? '';
	if ( '' === $test_script || false !== stripos( $test_script, 'coming soon' ) || false !== strpos( $test_script, 'exit 0' ) ) {
		$fail( 'package.json test script is not a real gate.' );
	}
	if ( 'https://github.com/agustealo/Krys' !== ( $package['homepage'] ?? '' ) ) {
		$fail( 'package.json homepage is not the canonical repository.' );
	}
}

foreach ( array( 'README.md', 'README.txt' ) as $doc ) {
	$content = (string) file_get_contents( $root . '/' . $doc );
	if ( false !== strpos( $content, 'Zeus-Eternal/Krys' ) || false !== strpos( $content, '.marcia-theme.example' ) ) {
		$fail( $doc . ' contains stale or fake project URLs.' );
	}
}

if ( ! is_file( $root . '/screenshot.png' ) ) {
	$notes[] = 'screenshot.png is still a manual WordPress.org release gate.';
}

foreach ( $notes as $note ) {
	fwrite( STDOUT, "NOTE: {$note}\n" );
}

if ( $errors ) {
	foreach ( $errors as $error ) {
		fwrite( STDERR, "ERROR: {$error}\n" );
	}
	exit( 1 );
}

fwrite( STDOUT, "Marcia source validation passed.\n" );
