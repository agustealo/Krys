<?php
/**
 * WooCommerce presentation integration.
 *
 * WooCommerce remains the authority for cart, checkout, sessions, scripts,
 * page content and commerce behavior. This file only declares theme support
 * and adds Marcia presentation styles.
 *
 * @package Marcia
 * @since 2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Declare WooCommerce presentation support.
 */
function marcia_woocommerce_setup() {
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
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'marcia_woocommerce_setup' );

/**
 * Additive WooCommerce styling. Never dequeue or replace WooCommerce assets.
 */
function marcia_woocommerce_styles() {
	wp_enqueue_style(
		'marcia-woocommerce',
		get_theme_file_uri( 'assets/css/blocks/woocommerce.css' ),
		array(),
		wp_get_theme()->get( 'Version' )
	);
}
add_action( 'wp_enqueue_scripts', 'marcia_woocommerce_styles' );
