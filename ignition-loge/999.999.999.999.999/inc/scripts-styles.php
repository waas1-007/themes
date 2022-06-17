<?php
/**
 * Scripts and styles definitions and enqueues
 *
 * @since 1.0.0
 */

add_action( 'wp', 'ignition_loge_register_scripts' );
/**
 * Register scripts and styles unconditionally.
 *
 * @since 1.0.0
 */
function ignition_loge_register_scripts() {
	$suffix = ignition_loge_ignition_scripts_styles_suffix();

	$styles_before = array(); // Style handles to load before main stylesheet.
	$styles_after  = array(); // Style handles to load after main stylesheet.

	wp_register_style( 'ignition-loge-woocommerce', get_theme_file_uri( "/inc/assets/css/woocommerce{$suffix}.css" ), array(), ignition_loge_asset_version() );
	if ( class_exists( 'WooCommerce' ) ) {
		$styles_after = array_merge( $styles_after, array( 'ignition-loge-woocommerce' ) );
	}

	wp_register_style( 'ignition-loge-maxslider', get_theme_file_uri( "/inc/assets/css/maxslider{$suffix}.css" ), array(), ignition_loge_asset_version() );
	if ( class_exists( 'MaxSlider' ) ) {
		$styles_after = array_merge( $styles_after, array( 'ignition-loge-maxslider' ) );
	}

	wp_register_style( 'ignition-loge-style-rtl', get_template_directory_uri() . "/rtl{$suffix}.css", array(), ignition_loge_asset_version() );
	if ( is_rtl() ) {
		$styles_after = array_merge( $styles_after, array( 'ignition-loge-style-rtl' ) );
	}

	if ( function_exists( 'ignition_get_all_customizer_css' ) ) {
		wp_register_style( 'ignition-loge-generated-styles', false, array(), ignition_loge_asset_version() );
		wp_add_inline_style( 'ignition-loge-generated-styles', ignition_get_all_customizer_css() );
		$styles_after = array_merge( $styles_after, array( 'ignition-loge-generated-styles' ) );
	}

	if ( is_child_theme() ) {
		wp_register_style( 'ignition-loge-style-child', get_stylesheet_uri(), array(), ignition_loge_asset_version() );
		$styles_after = array_merge( $styles_after, array( 'ignition-loge-style-child' ) );
	}

	/**
	 * Filters the list of style handles enqueued before the main stylesheet.
	 *
	 * @since 1.0.0
	 *
	 * @param string[] $styles_before
	 */
	wp_register_style( 'ignition-loge-main-before', false, apply_filters( 'ignition_loge_styles_before_main', $styles_before ), ignition_loge_asset_version() );

	/**
	 * Filters the list of style handles enqueued after the main stylesheet.
	 *
	 * @since 1.0.0
	 *
	 * @param string[] $styles_after
	 */
	wp_register_style( 'ignition-loge-main-after', false, apply_filters( 'ignition_loge_styles_after_main', $styles_after ), ignition_loge_asset_version() );

	wp_register_style( 'ignition-loge-style', get_template_directory_uri() . "/style{$suffix}.css", array(), ignition_loge_asset_version() );
}

add_action( 'wp_enqueue_scripts', 'ignition_loge_enqueue_scripts' );
/**
 * Enqueue scripts and styles.
 *
 * @since 1.0.0
 */
function ignition_loge_enqueue_scripts() {
	wp_enqueue_style( 'ignition-loge-main-before' );
	wp_enqueue_style( 'ignition-loge-style' );
	wp_enqueue_style( 'ignition-loge-main-after' );
}


add_action( 'init', 'ignition_loge_register_block_editor_block_styles' );
/**
 * Registers custom block styles.
 *
 * @since 1.0.0
 */
function ignition_loge_register_block_editor_block_styles() {
	// Underlined titles
	$blocks = array(
		'core/heading',
		'gutenbee/heading',
	);

	foreach ( $blocks as $block ) {
		register_block_style( $block, array(
			'name'  => 'ignition-loge-title',
			'label' => __( 'Theme Title', 'ignition-loge' ),
		) );
	}

	// Container background width limit
	register_block_style( 'gutenbee/container', array(
		'name'  => 'ignition-loge-container-background-limit-right',
		'label' => __( 'Background Right', 'ignition-loge' ),
	) );

	register_block_style( 'gutenbee/container', array(
		'name'  => 'ignition-loge-container-background-limit-left',
		'label' => __( 'Background Left', 'ignition-loge' ),
	) );

	// White background on products
	$woocommerce_blocks = array(
		'woocommerce/product-top-rated',
		'woocommerce/handpicked-products',
		'woocommerce/product-best-sellers',
		'woocommerce/product-category',
		'woocommerce/product-new',
		'woocommerce/product-on-sale',
		'woocommerce/all-products',
	);

	foreach ( $woocommerce_blocks as $block ) {
		register_block_style( $block, array(
			'name'  => 'ignition-loge-products-body-background',
			'label' => __( 'Body Background', 'ignition-loge' ),
		) );
	}
}

add_filter( 'locale_stylesheet_uri', 'ignition_loge_remove_rtl_stylesheet', 10, 2 );
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
function ignition_loge_remove_rtl_stylesheet( $stylesheet_uri, $stylesheet_dir_uri ) {
	// Only remove the rtl.css file, and only if it's a parent theme, as we enqueue it manually along with the other styles.
	if ( ! is_child_theme() && untrailingslashit( $stylesheet_dir_uri ) . '/rtl.css' === $stylesheet_uri ) {
		$stylesheet_uri = '';
	}

	return $stylesheet_uri;
}
