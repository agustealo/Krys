<?php
/**
 * Marcia theme bootstrap.
 *
 * @package Marcia
 * @since 2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Configure theme-owned WordPress features.
 */
function marcia_setup() {
	load_theme_textdomain( 'marcia', get_template_directory() . '/languages' );

	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'editor-styles' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'appearance-tools' );
	add_editor_style( array( 'assets/css/base.css', 'assets/css/editor.css', 'assets/css/block-styles.css' ) );
}
add_action( 'after_setup_theme', 'marcia_setup' );

/**
 * Load the small theme-wide stylesheet.
 */
function marcia_enqueue_assets() {
	wp_enqueue_style(
		'marcia-base',
		get_theme_file_uri( 'assets/css/base.css' ),
		array(),
		wp_get_theme()->get( 'Version' )
	);
}
add_action( 'wp_enqueue_scripts', 'marcia_enqueue_assets' );

/**
 * Register Marcia pattern categories. Pattern discovery itself is owned by
 * WordPress core through the /patterns directory (WordPress 6.8+).
 */
function marcia_register_pattern_categories() {
	$categories = array(
		'marcia-hero'         => __( 'Hero Sections', 'marcia' ),
		'marcia-features'     => __( 'Features', 'marcia' ),
		'marcia-testimonials' => __( 'Testimonials', 'marcia' ),
		'marcia-pricing'      => __( 'Pricing', 'marcia' ),
		'marcia-blog'         => __( 'Blog', 'marcia' ),
		'marcia-shop'         => __( 'Shop', 'marcia' ),
		'marcia-team'         => __( 'Team', 'marcia' ),
		'marcia-cta'          => __( 'Call to Action', 'marcia' ),
		'marcia-content'      => __( 'Content', 'marcia' ),
		'marcia-contact'      => __( 'Contact', 'marcia' ),
		'marcia-gallery'      => __( 'Gallery', 'marcia' ),
		'marcia-stats'        => __( 'Statistics', 'marcia' ),
	);

	foreach ( $categories as $slug => $label ) {
		register_block_pattern_category( $slug, array( 'label' => $label ) );
	}
}
add_action( 'init', 'marcia_register_pattern_categories' );

require_once get_theme_file_path( 'inc/block-styles.php' );

if ( class_exists( 'WooCommerce' ) ) {
	require_once get_theme_file_path( 'inc/woocommerce.php' );
}
