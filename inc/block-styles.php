<?php
/**
 * Block style registration and presentation assets.
 *
 * @package Marcia
 * @since 2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register named block styles and their block-scoped stylesheets.
 */
function marcia_register_block_styles() {
	$styles = array(
		'core/button' => array(
			array( 'name' => 'marcia-outline', 'label' => __( 'Outline', 'marcia' ) ),
			array( 'name' => 'marcia-ghost', 'label' => __( 'Ghost', 'marcia' ) ),
		),
		'core/list' => array(
			array( 'name' => 'marcia-checkmarks', 'label' => __( 'Checkmarks', 'marcia' ) ),
		),
		'core/group' => array(
			array( 'name' => 'marcia-card', 'label' => __( 'Card', 'marcia' ) ),
			array( 'name' => 'marcia-shadow', 'label' => __( 'Shadow', 'marcia' ) ),
		),
	);

	foreach ( $styles as $block_name => $block_styles ) {
		foreach ( $block_styles as $style ) {
			register_block_style( $block_name, $style );
		}
	}

	$version = wp_get_theme()->get( 'Version' );

	wp_enqueue_block_style(
		'core/button',
		array(
			'handle' => 'marcia-button',
			'src'    => get_theme_file_uri( 'assets/css/blocks/core-button.css' ),
			'path'   => get_theme_file_path( 'assets/css/blocks/core-button.css' ),
			'ver'    => $version,
		)
	);

	wp_enqueue_block_style(
		'core/navigation',
		array(
			'handle' => 'marcia-navigation',
			'src'    => get_theme_file_uri( 'assets/css/blocks/core-navigation.css' ),
			'path'   => get_theme_file_path( 'assets/css/blocks/core-navigation.css' ),
			'ver'    => $version,
		)
	);
}
add_action( 'init', 'marcia_register_block_styles' );

/**
 * Shared styles for Marcia list/group variations.
 */
function marcia_enqueue_variation_styles() {
	wp_enqueue_style(
		'marcia-block-styles',
		get_theme_file_uri( 'assets/css/block-styles.css' ),
		array(),
		wp_get_theme()->get( 'Version' )
	);
}
add_action( 'wp_enqueue_scripts', 'marcia_enqueue_variation_styles' );
add_action( 'enqueue_block_editor_assets', 'marcia_enqueue_variation_styles' );
