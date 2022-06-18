<?php
/**
 * Scripts and styles definitions and enqueues
 *
 * @since 1.0.0
 */

add_action( 'wp', 'ignition_milos_register_scripts' );
/**
 * Register scripts and styles unconditionally.
 *
 * @since 1.0.0
 */
function ignition_milos_register_scripts() {
	$suffix = ignition_milos_ignition_scripts_styles_suffix();

	$styles_before  = array(); // Style handles to load before main stylesheet.
	$styles_after   = array(); // Style handles to load after main stylesheet.
	$scripts_before = array(); // Script handles to load before main script.
	$scripts_after  = array(); // Script handles to load after main script.

	wp_register_style( 'ignition-milos-woocommerce', get_theme_file_uri( "/inc/assets/css/woocommerce{$suffix}.css" ), array(), ignition_milos_asset_version() );
	if ( class_exists( 'WooCommerce' ) ) {
		$styles_after = array_merge( $styles_after, array( 'ignition-milos-woocommerce' ) );
	}

	if ( function_exists( 'ignition_get_all_customizer_css' ) ) {
		wp_register_style( 'ignition-milos-generated-styles', false, array(), ignition_milos_asset_version() );
		wp_add_inline_style( 'ignition-milos-generated-styles', ignition_get_all_customizer_css() );
		$styles_after = array_merge( $styles_after, array( 'ignition-milos-generated-styles' ) );
	}

	if ( is_child_theme() ) {
		wp_register_style( 'ignition-milos-style-child', get_stylesheet_uri(), array(), ignition_milos_asset_version() );
		$styles_after = array_merge( $styles_after, array( 'ignition-milos-style-child' ) );
	}

	/**
	 * Filters the list of style handles enqueued before the main stylesheet.
	 *
	 * @since 1.0.0
	 *
	 * @param string[] $styles_before
	 */
	wp_register_style( 'ignition-milos-main-before', false, apply_filters( 'ignition_milos_styles_before_main', $styles_before ), ignition_milos_asset_version() );

	/**
	 * Filters the list of style handles enqueued after the main stylesheet.
	 *
	 * @since 1.0.0
	 *
	 * @param string[] $styles_after
	 */
	wp_register_style( 'ignition-milos-main-after', false, apply_filters( 'ignition_milos_styles_after_main', $styles_after ), ignition_milos_asset_version() );

	/**
	 * Filters the list of script handles enqueued before the main script file.
	 *
	 * @since 1.0.0
	 *
	 * @param string[] $scripts_before
	 */
	wp_register_script( 'ignition-milos-main-before', false, apply_filters( 'ignition_milos_scripts_before_main', $scripts_before ), ignition_milos_asset_version(), true );

	/**
	 * Filters the list of script handles enqueued after the main script file.
	 *
	 * @since 1.0.0
	 *
	 * @param string[] $scripts_after
	 */
	wp_register_script( 'ignition-milos-main-after', false, apply_filters( 'ignition_milos_scripts_after_main', $scripts_after ), ignition_milos_asset_version(), true );

	wp_register_style( 'ignition-milos-style', get_template_directory_uri() . "/style{$suffix}.css", array(), ignition_milos_asset_version() );

	wp_register_script( 'ignition-milos-front-scripts', get_theme_file_uri( "/inc/assets/js/scripts{$suffix}.js" ), array(), ignition_milos_asset_version(), true );

}

add_action( 'wp_enqueue_scripts', 'ignition_milos_enqueue_scripts' );
/**
 * Enqueue scripts and styles.
 *
 * @since 1.0.0
 */
function ignition_milos_enqueue_scripts() {
	wp_enqueue_style( 'ignition-milos-main-before' );
	wp_enqueue_style( 'ignition-milos-style' );
	wp_enqueue_style( 'ignition-milos-main-after' );

	wp_enqueue_script( 'ignition-milos-main-before' );
	wp_enqueue_script( 'ignition-milos-front-scripts' );
	wp_enqueue_script( 'ignition-milos-main-after' );
}

add_action( 'init', 'ignition_milos_register_block_editor_block_styles' );
/**
 * Registers custom block styles.
 *
 * @since 1.0.0
 */
function ignition_milos_register_block_editor_block_styles() {
	$blocks = array(
		'core/image',
		'core/gallery',
		'core/media-text',
		'core/cover',
		'core/video',
		'gutenbee/image',
		'gutenbee/imagebox',
		'gutenbee/justified-gallery',
		'gutenbee/video',
		'gutenbee/slideshow',
		'gutenbee/google-maps',
		'woocommerce/featured-category',
		'woocommerce/featured-product',
	);

	foreach ( $blocks as $block ) {
		register_block_style( $block, array(
			'name'  => 'ignition-milos-border-image',
			'label' => __( 'Theme Border', 'ignition-milos' ),
		) );
	}

	register_block_style( 'gutenbee/post-types', array(
		'name'  => 'ignition-milos-item-overlay',
		'label' => __( 'Overlay', 'ignition-milos' ),
	) );

	register_block_style( 'core/table', array(
		'name'  => 'ignition-milos-table',
		'label' => __( 'Milos', 'ignition-milos' ),
	) );

	register_block_style( 'core/paragraph', array(
		'name'  => 'ignition-milos-letter-stylized',
		'label' => __( 'Stylized Drop Cap', 'ignition-milos' ),
	) );

	register_block_style( 'gutenbee/paragraph', array(
		'name'  => 'ignition-milos-letter-stylized',
		'label' => __( 'Stylized Drop Cap', 'ignition-milos' ),
	) );
}
