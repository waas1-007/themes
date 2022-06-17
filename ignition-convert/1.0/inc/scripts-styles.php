<?php
/**
 * Scripts and styles definitions and enqueues
 *
 * @since 1.0.0
 */

add_action( 'wp', 'ignition_convert_register_scripts' );
/**
 * Register scripts and styles unconditionally.
 *
 * @since 1.0.0
 */
function ignition_convert_register_scripts() {
	$suffix = ignition_convert_ignition_scripts_styles_suffix();

	$styles_before = array(); // Style handles to load before main stylesheet.
	$styles_after  = array(); // Style handles to load after main stylesheet.

	wp_register_style( 'ignition-convert-woocommerce', get_theme_file_uri( "/inc/assets/css/woocommerce{$suffix}.css" ), array(), ignition_convert_asset_version() );
	if ( class_exists( 'WooCommerce' ) ) {
		$styles_after = array_merge( $styles_after, array( 'ignition-convert-woocommerce' ) );
	}

	wp_register_style( 'ignition-convert-maxslider', get_theme_file_uri( "/inc/assets/css/maxslider{$suffix}.css" ), array(), ignition_convert_asset_version() );
	if ( class_exists( 'MaxSlider' ) ) {
		$styles_after = array_merge( $styles_after, array( 'ignition-convert-maxslider' ) );
	}

	wp_register_style( 'ignition-convert-elementor-styles', get_theme_file_uri( "/inc/assets/css/elementor{$suffix}.css" ), array(), ignition_convert_asset_version() );
	if ( defined( 'ELEMENTOR_VERSION' ) && class_exists( 'Ignition_Elementor_Widgets' ) ) {
		$styles_after = array_merge( $styles_after, array( 'ignition-convert-elementor-styles' ) );
	}

	wp_register_style( 'ignition-convert-style-rtl', get_template_directory_uri() . "/rtl{$suffix}.css", array(), ignition_convert_asset_version() );
	if ( is_rtl() ) {
		$styles_after = array_merge( $styles_after, array( 'ignition-convert-style-rtl' ) );
	}

	if ( function_exists( 'ignition_get_all_customizer_css' ) ) {
		wp_register_style( 'ignition-convert-generated-styles', false, array(), ignition_convert_asset_version() );
		wp_add_inline_style( 'ignition-convert-generated-styles', ignition_get_all_customizer_css() );
		$styles_after = array_merge( $styles_after, array( 'ignition-convert-generated-styles' ) );
	}

	if ( is_child_theme() ) {
		wp_register_style( 'ignition-convert-style-child', get_stylesheet_uri(), array(), ignition_convert_asset_version() );
		$styles_after = array_merge( $styles_after, array( 'ignition-convert-style-child' ) );
	}

	/**
	 * Filters the list of style handles enqueued before the main stylesheet.
	 *
	 * @since 1.0.0
	 *
	 * @param string[] $styles_before
	 */
	wp_register_style( 'ignition-convert-main-before', false, apply_filters( 'ignition_convert_styles_before_main', $styles_before ), ignition_convert_asset_version() );

	/**
	 * Filters the list of style handles enqueued after the main stylesheet.
	 *
	 * @since 1.0.0
	 *
	 * @param string[] $styles_after
	 */
	wp_register_style( 'ignition-convert-main-after', false, apply_filters( 'ignition_convert_styles_after_main', $styles_after ), ignition_convert_asset_version() );

	wp_register_style( 'ignition-convert-style', get_template_directory_uri() . "/style{$suffix}.css", array(), ignition_convert_asset_version() );
}

add_action( 'wp_enqueue_scripts', 'ignition_convert_enqueue_scripts' );
/**
 * Enqueue scripts and styles.
 *
 * @since 1.0.0
 */
function ignition_convert_enqueue_scripts() {
	wp_enqueue_style( 'ignition-convert-main-before' );
	wp_enqueue_style( 'ignition-convert-style' );
	wp_enqueue_style( 'ignition-convert-main-after' );
}

add_action( 'init', 'ignition_convert_register_block_editor_block_styles' );
/**
 * Registers custom block styles.
 *
 * @since 1.0.0
 */
function ignition_convert_register_block_editor_block_styles() {
	register_block_style( 'gutenbee/post-types', array(
		'name'  => 'ignition-convert-item-overlay',
		'label' => __( 'Overlay', 'ignition-convert' ),
	) );

	register_block_style( 'core/table', array(
		'name'  => 'ignition-convert-table',
		'label' => __( 'Convert', 'ignition-convert' ),
	) );
}

add_filter( 'locale_stylesheet_uri', 'ignition_convert_remove_rtl_stylesheet', 10, 2 );
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
function ignition_convert_remove_rtl_stylesheet( $stylesheet_uri, $stylesheet_dir_uri ) {
	// Only remove the rtl.css file, and only if it's a parent theme, as we enqueue it manually along with the other styles.
	if ( ! is_child_theme() && untrailingslashit( $stylesheet_dir_uri ) . '/rtl.css' === $stylesheet_uri ) {
		$stylesheet_uri = '';
	}

	return $stylesheet_uri;
}
