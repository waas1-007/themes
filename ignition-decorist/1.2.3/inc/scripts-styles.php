<?php
/**
 * Scripts and styles definitions and enqueues
 *
 * @since 1.0.0
 */

add_action( 'wp', 'ignition_decorist_register_scripts' );
/**
 * Register scripts and styles unconditionally.
 *
 * @since 1.0.0
 */
function ignition_decorist_register_scripts() {
	$suffix = ignition_decorist_ignition_scripts_styles_suffix();

	$styles_before  = array(); // Style handles to load before main stylesheet.
	$styles_after   = array(); // Style handles to load after main stylesheet.
	$scripts_before = array(); // Script handles to load before main script.
	$scripts_after  = array(); // Script handles to load after main script.

	wp_register_style( 'ignition-decorist-woocommerce', get_theme_file_uri( "/inc/assets/css/woocommerce{$suffix}.css" ), array(), ignition_decorist_asset_version() );
	if ( class_exists( 'WooCommerce' ) ) {
		$styles_after = array_merge( $styles_after, array( 'ignition-decorist-woocommerce' ) );
	}

	wp_register_style( 'ignition-decorist-maxslider', get_theme_file_uri( "/inc/assets/css/maxslider{$suffix}.css" ), array(), ignition_decorist_asset_version() );
	wp_register_script( 'ignition-decorist-maxslider', get_theme_file_uri( "/inc/assets/js/maxslider{$suffix}.js" ), array( 'jquery' ), ignition_decorist_asset_version(), true );
	if ( class_exists( 'MaxSlider' ) ) {
		$styles_after   = array_merge( $styles_after, array( 'ignition-decorist-maxslider' ) );
		$scripts_before = array_merge( $scripts_before, array( 'ignition-decorist-maxslider' ) );
	}

	wp_register_style( 'ignition-decorist-elementor-styles', get_theme_file_uri( "/inc/assets/css/elementor{$suffix}.css" ), array(), ignition_decorist_asset_version() );
	if ( defined( 'ELEMENTOR_VERSION' ) && class_exists( 'Ignition_Elementor_Widgets' ) ) {
		$styles_after = array_merge( $styles_after, array( 'ignition-decorist-elementor-styles' ) );
	}

	wp_register_script( 'ignition-decorist-ajax-product-search', get_theme_file_uri( "/inc/assets/js/ajax-product-search{$suffix}.js" ), array( 'jquery' ), ignition_decorist_asset_version(), true );
	if ( get_theme_mod( 'theme_ajax_product_search_ajax_is_enabled', ignition_decorist_ignition_customizer_defaults( 'theme_ajax_product_search_ajax_is_enabled' ) ) ) {
		$scripts_before = array_merge( $scripts_before, array( 'ignition-decorist-ajax-product-search' ) );
	}

	$sticky_type = get_theme_mod( 'header_layout_menu_sticky_type', ignition_customizer_defaults( 'header_layout_menu_sticky_type' ) );
	if ( 'permanent' === $sticky_type ) {
		$scripts_before = array_merge( $scripts_before, array( 'jquery-sticky' ) );
	} elseif ( 'shy' === $sticky_type ) {
		$scripts_before = array_merge( $scripts_before, array( 'jquery-shyheader' ) );
	}

	if ( is_singular() &&
		(
			strpos( get_the_content(), 'ignition-decorist-post-types-slideshow' )
			||
			( defined( 'ELEMENTOR_VERSION' ) && class_exists( 'Ignition_Elementor_Widgets' ) && strpos( get_post_meta( get_queried_object_id(), '_elementor_data', true ), 'ignition-decorist-post-types-slideshow' ) )
		)
	) {
		$styles_before  = array_merge( $styles_before, array( 'slick' ) );
		$scripts_before = array_merge( $scripts_before, array( 'slick' ) );
	}

	wp_register_style( 'ignition-decorist-style-rtl', get_template_directory_uri() . "/rtl{$suffix}.css", array(), ignition_decorist_asset_version() );
	if ( is_rtl() ) {
		$styles_after = array_merge( $styles_after, array( 'ignition-decorist-style-rtl' ) );
	}

	if ( function_exists( 'ignition_get_all_customizer_css' ) ) {
		wp_register_style( 'ignition-decorist-generated-styles', false, array(), ignition_decorist_asset_version() );
		wp_add_inline_style( 'ignition-decorist-generated-styles', ignition_get_all_customizer_css() );
		$styles_after = array_merge( $styles_after, array( 'ignition-decorist-generated-styles' ) );
	}

	if ( is_child_theme() ) {
		wp_register_style( 'ignition-decorist-style-child', get_stylesheet_uri(), array(), ignition_decorist_asset_version() );
		$styles_after = array_merge( $styles_after, array( 'ignition-decorist-style-child' ) );
	}

	/**
	 * Filters the list of style handles enqueued before the main stylesheet.
	 *
	 * @since 1.0.0
	 *
	 * @param string[] $styles_before
	 */
	wp_register_style( 'ignition-decorist-main-before', false, apply_filters( 'ignition_decorist_styles_before_main', $styles_before ), ignition_decorist_asset_version() );

	/**
	 * Filters the list of style handles enqueued after the main stylesheet.
	 *
	 * @since 1.0.0
	 *
	 * @param string[] $styles_after
	 */
	wp_register_style( 'ignition-decorist-main-after', false, apply_filters( 'ignition_decorist_styles_after_main', $styles_after ), ignition_decorist_asset_version() );

	/**
	 * Filters the list of script handles enqueued before the main script file.
	 *
	 * @since 1.0.0
	 *
	 * @param string[] $scripts_before
	 */
	wp_register_script( 'ignition-decorist-main-before', false, apply_filters( 'ignition_decorist_scripts_before_main', $scripts_before ), ignition_decorist_asset_version(), true );

	/**
	 * Filters the list of script handles enqueued after the main script file.
	 *
	 * @since 1.0.0
	 *
	 * @param string[] $scripts_after
	 */
	wp_register_script( 'ignition-decorist-main-after', false, apply_filters( 'ignition_decorist_scripts_after_main', $scripts_after ), ignition_decorist_asset_version(), true );

	wp_register_style( 'ignition-decorist-style', get_template_directory_uri() . "/style{$suffix}.css", array(), ignition_decorist_asset_version() );

	wp_register_script( 'ignition-decorist-front-scripts', get_theme_file_uri( "/inc/assets/js/scripts{$suffix}.js" ), array(), ignition_decorist_asset_version(), true );
	wp_localize_script( 'ignition-decorist-front-scripts', 'ignition_decorist_vars', array(
		'ajaxurl'            => admin_url( 'admin-ajax.php' ),
		'search_no_products' => __( 'No products match your query.', 'ignition-decorist' ),
	) );

}

add_filter( 'ignition_scripts_before_main', 'ignition_decorist_filter_ignition_scripts_before_main' );
/**
 * Modifies the list of scripts enqueued before Ignition's main frontend script file.
 *
 * @since 1.0.0
 *
 * @param string[] $scripts_before
 */
function ignition_decorist_filter_ignition_scripts_before_main( $scripts_before ) {
	if ( get_theme_mod( 'header_layout_menu_sticky_type', ignition_decorist_ignition_customizer_defaults( 'header_layout_menu_sticky_type' ) ) !== 'off' ) {
		$key = array_search( 'ignition-sticky-header-init', $scripts_before, true );
		if ( false !== $key ) {
			unset( $scripts_before[ $key ] );
		}
	}

	return $scripts_before;
}

add_action( 'wp_enqueue_scripts', 'ignition_decorist_enqueue_scripts' );
/**
 * Enqueue scripts and styles.
 *
 * @since 1.0.0
 */
function ignition_decorist_enqueue_scripts() {
	wp_enqueue_style( 'ignition-decorist-main-before' );
	wp_enqueue_style( 'ignition-decorist-style' );
	wp_enqueue_style( 'ignition-decorist-main-after' );

	wp_enqueue_script( 'ignition-decorist-main-before' );
	wp_enqueue_script( 'ignition-decorist-front-scripts' );
	wp_enqueue_script( 'ignition-decorist-main-after' );
}

add_action( 'init', 'ignition_decorist_register_block_editor_block_styles' );
/**
 * Registers custom block styles.
 *
 * @since 1.0.0
 */
function ignition_decorist_register_block_editor_block_styles() {
	$blocks = array(
		'gutenbee/post-types',
		'woocommerce/product-category',
		'woocommerce/product-on-sale',
		'woocommerce/product-top-rated',
		'woocommerce/product-new',
		'woocommerce/product-best-sellers',
		'woocommerce/handpicked-products',
		'woocommerce/product-tag',
		'woocommerce/products-by-attribute',
	);

	foreach ( $blocks as $block ) {
		register_block_style( $block, array(
			'name'  => 'ignition-decorist-post-types-slideshow',
			'label' => __( 'Slideshow', 'ignition-decorist' ),
		) );
	}
}

add_filter( 'locale_stylesheet_uri', 'ignition_decorist_remove_rtl_stylesheet', 10, 2 );
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
function ignition_decorist_remove_rtl_stylesheet( $stylesheet_uri, $stylesheet_dir_uri ) {
	// Only remove the rtl.css file, and only if it's a parent theme, as we enqueue it manually along with the other styles.
	if ( ! is_child_theme() && untrailingslashit( $stylesheet_dir_uri ) . '/rtl.css' === $stylesheet_uri ) {
		$stylesheet_uri = '';
	}

	return $stylesheet_uri;
}
