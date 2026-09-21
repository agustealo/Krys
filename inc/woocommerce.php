<?php
/**
 * WooCommerce Integration
 *
 * Customize WooCommerce for Krys theme.
 *
 * @package Krys
 * @since 2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * WooCommerce setup.
 *
 * @since 2.0.0
 */
function krys_woocommerce_setup() {
	// Declare WooCommerce support.
	add_theme_support( 'woocommerce' );

	// Enable WooCommerce product gallery features.
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

	// Set image sizes.
	add_theme_support(
		'woocommerce',
		array(
			'thumbnail_image_width' => 300,
			'single_image_width'    => 600,
			'product_grid'          => array(
				'default_rows'    => 3,
				'min_rows'        => 1,
				'max_rows'        => 8,
				'default_columns' => 3,
				'min_columns'     => 1,
				'max_columns'     => 4,
			),
		)
	);
}
add_action( 'after_setup_theme', 'krys_woocommerce_setup' );

/**
 * Enqueue WooCommerce styles.
 *
 * @since 2.0.0
 */
function krys_woocommerce_styles() {
	$theme_version = wp_get_theme()->get( 'Version' );

	// Dequeue default WooCommerce styles.
	wp_dequeue_style( 'woocommerce-general' );
	wp_dequeue_style( 'woocommerce-layout' );
	wp_dequeue_style( 'woocommerce-smallscreen' );

	// Enqueue custom WooCommerce styles.
	wp_enqueue_style(
		'krys-woocommerce',
		get_template_directory_uri() . '/assets/css/blocks/woocommerce.css',
		array(),
		$theme_version
	);
}
add_action( 'wp_enqueue_scripts', 'krys_woocommerce_styles', 99 );

/**
 * Customize WooCommerce product columns.
 *
 * @since 2.0.0
 * @return int Number of columns.
 */
function krys_woocommerce_products_per_row() {
	return 3;
}
add_filter( 'loop_shop_columns', 'krys_woocommerce_products_per_row' );

/**
 * Customize products per page.
 *
 * @since 2.0.0
 * @return int Number of products.
 */
function krys_woocommerce_products_per_page() {
	return 12;
}
add_filter( 'loop_shop_per_page', 'krys_woocommerce_products_per_page' );

/**
 * Remove default WooCommerce wrappers.
 *
 * @since 2.0.0
 */
function krys_remove_woocommerce_wrappers() {
	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
}
add_action( 'init', 'krys_remove_woocommerce_wrappers' );

/**
 * Add custom WooCommerce wrappers.
 *
 * @since 2.0.0
 */
function krys_woocommerce_wrapper_start() {
	echo '<div class="wp-block-group alignfull" style="margin-top:0">';
	echo '<div class="wp-block-group__inner-container">';
}
add_action( 'woocommerce_before_main_content', 'krys_woocommerce_wrapper_start', 10 );

/**
 * Close custom WooCommerce wrappers.
 *
 * @since 2.0.0
 */
function krys_woocommerce_wrapper_end() {
	echo '</div>';
	echo '</div>';
}
add_action( 'woocommerce_after_main_content', 'krys_woocommerce_wrapper_end', 10 );

/**
 * Customize product thumbnail size.
 *
 * @since 2.0.0
 * @return array Image size.
 */
function krys_woocommerce_thumbnail_size() {
	return array(
		'width'  => 300,
		'height' => 300,
		'crop'   => 1,
	);
}
add_filter( 'woocommerce_get_image_size_thumbnail', 'krys_woocommerce_thumbnail_size' );

/**
 * Add cart icon to navigation.
 *
 * @since 2.0.0
 * @param string $items Menu items HTML.
 * @param object $args  Menu arguments.
 * @return string Modified menu items.
 */
function krys_add_cart_to_menu( $items, $args ) {
	// Only add to primary navigation.
	if ( 'primary' === $args->theme_location ) {
		$cart_count = WC()->cart->get_cart_contents_count();
		$cart_url   = wc_get_cart_url();

		$cart_item = sprintf(
			'<li class="menu-item menu-item-cart"><a href="%s" class="cart-icon">🛒 <span class="cart-count">%d</span></a></li>',
			esc_url( $cart_url ),
			esc_html( $cart_count )
		);

		$items .= $cart_item;
	}

	return $items;
}
add_filter( 'wp_nav_menu_items', 'krys_add_cart_to_menu', 10, 2 );

/**
 * AJAX update cart count.
 *
 * @since 2.0.0
 */
function krys_update_cart_count() {
	if ( class_exists( 'WooCommerce' ) ) {
		wp_send_json( array( 'count' => WC()->cart->get_cart_contents_count() ) );
	}
}
add_action( 'wp_ajax_krys_update_cart_count', 'krys_update_cart_count' );
add_action( 'wp_ajax_nopriv_krys_update_cart_count', 'krys_update_cart_count' );

/**
 * Customize breadcrumbs.
 *
 * @since 2.0.0
 * @param array $args Breadcrumb arguments.
 * @return array Modified arguments.
 */
function krys_woocommerce_breadcrumbs( $args ) {
	$args['delimiter']   = ' / ';
	$args['wrap_before'] = '<nav class="woocommerce-breadcrumb" aria-label="breadcrumb">';
	$args['wrap_after']  = '</nav>';
	$args['before']      = '<span>';
	$args['after']       = '</span>';
	$args['home']        = __( 'Home', 'krys' );

	return $args;
}
add_filter( 'woocommerce_breadcrumb_defaults', 'krys_woocommerce_breadcrumbs' );

/**
 * Optimize WooCommerce scripts.
 *
 * @since 2.0.0
 */
function krys_optimize_woocommerce_scripts() {
	// Remove WooCommerce scripts on non-shop pages.
	if ( ! is_woocommerce() && ! is_cart() && ! is_checkout() ) {
		wp_dequeue_style( 'woocommerce-layout' );
		wp_dequeue_style( 'woocommerce-general' );
		wp_dequeue_style( 'woocommerce-smallscreen' );
		wp_dequeue_script( 'wc-cart-fragments' );
		wp_dequeue_script( 'woocommerce' );
		wp_dequeue_script( 'wc-add-to-cart' );
	}
}
add_action( 'wp_enqueue_scripts', 'krys_optimize_woocommerce_scripts', 99 );
