<?php
/**
 * Scripts and styles definitions and enqueues
 *
 * @since 1.0.0
 */

add_action( 'wp', 'ignition_amaryllis_register_scripts' );
/**
 * Register scripts and styles unconditionally.
 *
 * @since 1.0.0
 */
function ignition_amaryllis_register_scripts() {
	$suffix = ignition_amaryllis_ignition_scripts_styles_suffix();

	$styles_before = array(); // Style handles to load before main stylesheet.
	$styles_after  = array(); // Style handles to load after main stylesheet.

	wp_register_style( 'ignition-amaryllis-woocommerce', get_theme_file_uri( "/inc/assets/css/woocommerce{$suffix}.css" ), array(), ignition_amaryllis_asset_version() );
	if ( class_exists( 'WooCommerce' ) ) {
		$styles_after = array_merge( $styles_after, array( 'ignition-amaryllis-woocommerce' ) );
	}

	if ( function_exists( 'ignition_get_all_customizer_css' ) ) {
		wp_register_style( 'ignition-amaryllis-generated-styles', false, array(), ignition_amaryllis_asset_version() );
		wp_add_inline_style( 'ignition-amaryllis-generated-styles', ignition_get_all_customizer_css() );
		$styles_after = array_merge( $styles_after, array( 'ignition-amaryllis-generated-styles' ) );
	}

	if ( is_child_theme() ) {
		wp_register_style( 'ignition-amaryllis-style-child', get_stylesheet_uri(), array(), ignition_amaryllis_asset_version() );
		$styles_after = array_merge( $styles_after, array( 'ignition-amaryllis-style-child' ) );
	}

	/**
	 * Filters the list of style handles enqueued before the main stylesheet.
	 *
	 * @since 1.0.0
	 *
	 * @param string[] $styles_before
	 */
	wp_register_style( 'ignition-amaryllis-main-before', false, apply_filters( 'ignition_amaryllis_styles_before_main', $styles_before ), ignition_amaryllis_asset_version() );

	/**
	 * Filters the list of style handles enqueued after the main stylesheet.
	 *
	 * @since 1.0.0
	 *
	 * @param string[] $styles_after
	 */
	wp_register_style( 'ignition-amaryllis-main-after', false, apply_filters( 'ignition_amaryllis_styles_after_main', $styles_after ), ignition_amaryllis_asset_version() );

	wp_register_style( 'ignition-amaryllis-style', get_template_directory_uri() . "/style{$suffix}.css", array(), ignition_amaryllis_asset_version() );
}

add_action( 'wp_enqueue_scripts', 'ignition_amaryllis_enqueue_scripts' );
/**
 * Enqueue scripts and styles.
 *
 * @since 1.0.0
 */
function ignition_amaryllis_enqueue_scripts() {
	wp_enqueue_style( 'ignition-amaryllis-main-before' );
	wp_enqueue_style( 'ignition-amaryllis-style' );
	wp_enqueue_style( 'ignition-amaryllis-main-after' );
}
