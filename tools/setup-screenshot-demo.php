<?php
/**
 * Build deterministic WordPress/WooCommerce content used only by the docs screenshot workflow.
 *
 * This fixture is never packaged with customer content and does not run in the theme runtime.
 *
 * @package Marcia
 */

declare( strict_types=1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit( 1 );
}

if ( ! class_exists( 'WooCommerce' ) || ! class_exists( 'WC_Product_Simple' ) ) {
	throw new RuntimeException( 'WooCommerce must be active before creating screenshot fixtures.' );
}

update_option( 'blogname', 'Marcia Studio' );
update_option( 'blogdescription', 'Native WordPress design, polished for real storefronts.' );
update_option( 'permalink_structure', '/%postname%/' );

/**
 * Create or update a published page by slug.
 */
function marcia_docs_upsert_page( string $title, string $slug, string $content ): int {
	$page = get_page_by_path( $slug, OBJECT, 'page' );
	$args = array(
		'post_title'   => $title,
		'post_name'    => $slug,
		'post_content' => $content,
		'post_status'  => 'publish',
		'post_type'    => 'page',
	);

	if ( $page instanceof WP_Post ) {
		$args['ID'] = $page->ID;
		$result     = wp_update_post( $args, true );
	} else {
		$result = wp_insert_post( $args, true );
	}

	if ( is_wp_error( $result ) ) {
		throw new RuntimeException( $result->get_error_message() );
	}

	return (int) $result;
}

$home_content = <<<'HTML'
<!-- wp:group {"align":"full","gradient":"primary-gradient","textColor":"base","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","right":"var:preset|spacing|50","bottom":"var:preset|spacing|80","left":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-base-color has-primary-gradient-gradient-background has-text-color has-background" style="padding-top:var(--wp--preset--spacing--80);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--80);padding-left:var(--wp--preset--spacing--50)">
<!-- wp:paragraph {"align":"center","fontSize":"small"} --><p class="has-text-align-center has-small-font-size"><strong>WORDPRESS, WITHOUT THE PAGE-BUILDER TAX</strong></p><!-- /wp:paragraph -->
<!-- wp:heading {"textAlign":"center","level":1,"fontSize":"xxx-large"} --><h1 class="wp-block-heading has-text-align-center has-xxx-large-font-size">A sharper canvas for modern publishing and commerce.</h1><!-- /wp:heading -->
<!-- wp:paragraph {"align":"center","fontSize":"large"} --><p class="has-text-align-center has-large-font-size">Marcia keeps the editing experience native, the design system coherent, and WooCommerce in charge of commerce.</p><!-- /wp:paragraph -->
<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} --><div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"base","textColor":"contrast"} --><div class="wp-block-button"><a class="wp-block-button__link has-contrast-color has-base-background-color has-text-color has-background wp-element-button" href="/shop/">Browse the demo shop</a></div><!-- /wp:button --><!-- wp:button {"className":"is-style-marcia-outline"} --><div class="wp-block-button is-style-marcia-outline"><a class="wp-block-button__link wp-element-button" href="#system">Explore the design system</a></div><!-- /wp:button --></div><!-- /wp:buttons -->
</div><!-- /wp:group -->

<!-- wp:group {"anchor":"system","align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide" id="system" style="padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)">
<!-- wp:heading {"textAlign":"center","fontSize":"x-large"} --><h2 class="wp-block-heading has-text-align-center has-x-large-font-size">One design language, across the whole site.</h2><!-- /wp:heading -->
<!-- wp:paragraph {"align":"center","textColor":"gray-600"} --><p class="has-text-align-center has-gray-600-color has-text-color">Theme tokens, native blocks, responsive spacing, and additive WooCommerce styling work together instead of fighting for authority.</p><!-- /wp:paragraph -->
<!-- wp:columns {"style":{"spacing":{"margin":{"top":"var:preset|spacing|60"},"blockGap":{"left":"var:preset|spacing|50"}}}} --><div class="wp-block-columns" style="margin-top:var(--wp--preset--spacing--60)">
<!-- wp:column --><div class="wp-block-column"><!-- wp:group {"className":"is-style-marcia-card","layout":{"type":"constrained"}} --><div class="wp-block-group is-style-marcia-card"><!-- wp:heading {"level":3,"fontSize":"large"} --><h3 class="wp-block-heading has-large-font-size">Native editing</h3><!-- /wp:heading --><!-- wp:paragraph --><p>Build with core WordPress blocks and patterns instead of a proprietary canvas.</p><!-- /wp:paragraph --></div><!-- /wp:group --></div><!-- /wp:column -->
<!-- wp:column --><div class="wp-block-column"><!-- wp:group {"className":"is-style-marcia-card","layout":{"type":"constrained"}} --><div class="wp-block-group is-style-marcia-card"><!-- wp:heading {"level":3,"fontSize":"large"} --><h3 class="wp-block-heading has-large-font-size">Coherent tokens</h3><!-- /wp:heading --><!-- wp:paragraph --><p>Color, type, spacing, borders, and shadows come from one theme.json design system.</p><!-- /wp:paragraph --></div><!-- /wp:group --></div><!-- /wp:column -->
<!-- wp:column --><div class="wp-block-column"><!-- wp:group {"className":"is-style-marcia-card","layout":{"type":"constrained"}} --><div class="wp-block-group is-style-marcia-card"><!-- wp:heading {"level":3,"fontSize":"large"} --><h3 class="wp-block-heading has-large-font-size">Commerce-aware</h3><!-- /wp:heading --><!-- wp:paragraph --><p>WooCommerce keeps ownership of cart and checkout while Marcia handles presentation.</p><!-- /wp:paragraph --></div><!-- /wp:group --></div><!-- /wp:column -->
</div><!-- /wp:columns -->
</div><!-- /wp:group -->

<!-- wp:group {"align":"full","backgroundColor":"gray-50","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-gray-50-background-color has-background" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:columns --><div class="wp-block-columns"><!-- wp:column --><div class="wp-block-column"><!-- wp:heading {"textAlign":"center","fontSize":"x-large"} --><h2 class="wp-block-heading has-text-align-center has-x-large-font-size">6</h2><!-- /wp:heading --><!-- wp:paragraph {"align":"center"} --><p class="has-text-align-center">style variations</p><!-- /wp:paragraph --></div><!-- /wp:column --><!-- wp:column --><div class="wp-block-column"><!-- wp:heading {"textAlign":"center","fontSize":"x-large"} --><h2 class="wp-block-heading has-text-align-center has-x-large-font-size">100%</h2><!-- /wp:heading --><!-- wp:paragraph {"align":"center"} --><p class="has-text-align-center">block-theme workflow</p><!-- /wp:paragraph --></div><!-- /wp:column --><!-- wp:column --><div class="wp-block-column"><!-- wp:heading {"textAlign":"center","fontSize":"x-large"} --><h2 class="wp-block-heading has-text-align-center has-x-large-font-size">1</h2><!-- /wp:heading --><!-- wp:paragraph {"align":"center"} --><p class="has-text-align-center">canonical design system</p><!-- /wp:paragraph --></div><!-- /wp:column --></div><!-- /wp:columns --></div><!-- /wp:group -->
HTML;

$home_id = marcia_docs_upsert_page( 'Home', 'home', $home_content );
$shop_id = marcia_docs_upsert_page( 'Shop', 'shop', '<!-- wp:paragraph --><p>Browse the Marcia demo catalog.</p><!-- /wp:paragraph -->' );
$cart_id = marcia_docs_upsert_page( 'Cart', 'cart', '<!-- wp:woocommerce/cart /-->' );
$checkout_id = marcia_docs_upsert_page( 'Checkout', 'checkout', '<!-- wp:woocommerce/checkout /-->' );

update_option( 'show_on_front', 'page' );
update_option( 'page_on_front', $home_id );
update_option( 'woocommerce_shop_page_id', $shop_id );
update_option( 'woocommerce_cart_page_id', $cart_id );
update_option( 'woocommerce_checkout_page_id', $checkout_id );

require_once ABSPATH . 'wp-admin/includes/image.php';

/**
 * Generate a simple local PNG for a demo product and attach it to WordPress.
 */
function marcia_docs_product_image( int $index, string $name ): int {
	$uploads = wp_upload_dir();
	if ( ! empty( $uploads['error'] ) ) {
		throw new RuntimeException( (string) $uploads['error'] );
	}

	$width  = 1200;
	$height = 900;
	$image  = imagecreatetruecolor( $width, $height );
	$palettes = array(
		array( 0, 95, 143 ),
		array( 184, 74, 0 ),
		array( 29, 78, 216 ),
		array( 19, 115, 51 ),
		array( 55, 65, 81 ),
		array( 107, 39, 217 ),
	);
	$rgb = $palettes[ ( $index - 1 ) % count( $palettes ) ];
	$background = imagecolorallocate( $image, $rgb[0], $rgb[1], $rgb[2] );
	$light      = imagecolorallocate( $image, 255, 255, 255 );
	$soft       = imagecolorallocate( $image, 235, 239, 245 );
	imagefill( $image, 0, 0, $background );
	imagefilledellipse( $image, 890, 245, 420, 420, $soft );
	imagefilledrectangle( $image, 130, 180, 650, 700, $light );
	imagefilledrectangle( $image, 205, 255, 575, 625, $background );
	imageline( $image, 760, 620, 1050, 330, $light );
	imageline( $image, 790, 650, 1080, 360, $light );

	$filename = sanitize_file_name( 'marcia-demo-' . $index . '-' . $name . '.png' );
	$path     = trailingslashit( $uploads['path'] ) . $filename;
	imagepng( $image, $path );
	imagedestroy( $image );

	$attachment_id = wp_insert_attachment(
		array(
			'post_mime_type' => 'image/png',
			'post_title'     => $name,
			'post_status'    => 'inherit',
		),
		$path
	);
	if ( is_wp_error( $attachment_id ) ) {
		throw new RuntimeException( $attachment_id->get_error_message() );
	}

	$metadata = wp_generate_attachment_metadata( (int) $attachment_id, $path );
	wp_update_attachment_metadata( (int) $attachment_id, $metadata );
	return (int) $attachment_id;
}

$products = array(
	array( 'Arc Desk Lamp', '89.00' ),
	array( 'Studio Chair', '249.00' ),
	array( 'Transit Pack', '129.00' ),
	array( 'Ceramic Set', '74.00' ),
	array( 'Field Speaker', '159.00' ),
	array( 'Canvas Tote', '48.00' ),
);

$first_product_id = 0;
foreach ( $products as $index => $product_data ) {
	list( $name, $price ) = $product_data;
	$existing = get_page_by_title( $name, OBJECT, 'product' );
	$product  = $existing instanceof WP_Post ? wc_get_product( $existing->ID ) : new WC_Product_Simple();
	if ( ! $product instanceof WC_Product_Simple ) {
		$product = new WC_Product_Simple();
	}
	$product->set_name( $name );
	$product->set_status( 'publish' );
	$product->set_regular_price( $price );
	$product->set_price( $price );
	$product->set_catalog_visibility( 'visible' );
	$product->set_stock_status( 'instock' );
	$product->set_description( 'A deterministic WooCommerce fixture used to prove Marcia product, cart, and checkout presentation in documentation screenshots.' );
	$product->set_short_description( 'Clean geometry, practical details, and a storefront powered by real WooCommerce product data.' );
	$product_id = $product->save();
	$image_id   = marcia_docs_product_image( $index + 1, $name );
	set_post_thumbnail( $product_id, $image_id );
	if ( 0 === $first_product_id ) {
		$first_product_id = $product_id;
	}
}

file_put_contents( '/tmp/marcia-demo-product-id', (string) $first_product_id );
flush_rewrite_rules();
