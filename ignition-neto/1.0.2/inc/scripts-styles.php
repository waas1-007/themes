<?php
/**
 * Scripts and styles definitions and enqueues
 *
 * @since 1.0.0
 */

add_action( 'wp', 'ignition_neto_register_scripts' );
/**
 * Register scripts and styles unconditionally.
 *
 * @since 1.0.0
 */
function ignition_neto_register_scripts() {
	$suffix = ignition_neto_ignition_scripts_styles_suffix();

	$styles_before = array(); // Style handles to load before main stylesheet.
	$styles_after  = array(); // Style handles to load after main stylesheet.

	wp_register_style( 'ignition-neto-woocommerce', get_theme_file_uri( "/inc/assets/css/woocommerce{$suffix}.css" ), array(), ignition_neto_asset_version() );
	if ( class_exists( 'WooCommerce' ) ) {
		$styles_after = array_merge( $styles_after, array( 'ignition-neto-woocommerce' ) );
	}

	wp_register_style( 'ignition-neto-style-rtl', get_template_directory_uri() . "/rtl{$suffix}.css", array(), ignition_neto_asset_version() );
	if ( is_rtl() ) {
		$styles_after = array_merge( $styles_after, array( 'ignition-neto-style-rtl' ) );
	}

	if ( function_exists( 'ignition_get_all_customizer_css' ) ) {
		wp_register_style( 'ignition-neto-generated-styles', false, array(), ignition_neto_asset_version() );
		wp_add_inline_style( 'ignition-neto-generated-styles', ignition_get_all_customizer_css() );
		$styles_after = array_merge( $styles_after, array( 'ignition-neto-generated-styles' ) );
	}

	if ( is_child_theme() ) {
		wp_register_style( 'ignition-neto-style-child', get_stylesheet_uri(), array(), ignition_neto_asset_version() );
		$styles_after = array_merge( $styles_after, array( 'ignition-neto-style-child' ) );
	}

	/**
	 * Filters the list of style handles enqueued before the main stylesheet.
	 *
	 * @since 1.0.0
	 *
	 * @param string[] $styles_before
	 */
	wp_register_style( 'ignition-neto-main-before', false, apply_filters( 'ignition_neto_styles_before_main', $styles_before ), ignition_neto_asset_version() );

	/**
	 * Filters the list of style handles enqueued after the main stylesheet.
	 *
	 * @since 1.0.0
	 *
	 * @param string[] $styles_after
	 */
	wp_register_style( 'ignition-neto-main-after', false, apply_filters( 'ignition_neto_styles_after_main', $styles_after ), ignition_neto_asset_version() );

	wp_register_style( 'ignition-neto-style', get_template_directory_uri() . "/style{$suffix}.css", array(), ignition_neto_asset_version() );
}

add_action( 'wp_enqueue_scripts', 'ignition_neto_enqueue_scripts' );
/**
 * Enqueue scripts and styles.
 *
 * @since 1.0.0
 */
function ignition_neto_enqueue_scripts() {
	wp_enqueue_style( 'ignition-neto-main-before' );
	wp_enqueue_style( 'ignition-neto-style' );
	wp_enqueue_style( 'ignition-neto-main-after' );
}

add_filter( 'locale_stylesheet_uri', 'ignition_neto_remove_rtl_stylesheet', 10, 2 );
/**
 * Prohibits the parent theme's rtl.css from loading.
 *
 * It only handles the parent theme's rtl.css, as the theme enqueues it manually.
 * It also allows other stylesheets, such as $locale.css or other $text_direction.css
 *
 * Hooked on `locale_stylesheet_uri`
 *
 * @since 1.0.0
 *
 * @see get_locale_stylesheet_uri()
 *
 * @param string $stylesheet_uri
 * @param string $stylesheet_dir_uri
 *
 * @return string
 */
function ignition_neto_remove_rtl_stylesheet( $stylesheet_uri, $stylesheet_dir_uri ) {
	// Only remove the rtl.css file, and only if it's a parent theme, as we enqueue it manually along with the other styles.
	if ( ! is_child_theme() && untrailingslashit( $stylesheet_dir_uri ) . '/rtl.css' === $stylesheet_uri ) {
		$stylesheet_uri = '';
	}

	return $stylesheet_uri;
}
