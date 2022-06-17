<?php
/**
 * Theme functions and definitions
 *
 * @since 1.0.0
 */

if ( ! defined( 'IGNITION_LOGE_NAME' ) ) {
	/**
	 * The theme's slug.
	 */
	define( 'IGNITION_LOGE_NAME', 'ignition-loge' );
}

add_action( 'after_setup_theme', 'ignition_loge_setup' );
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function ignition_loge_setup() {
	// Default content width.
	$GLOBALS['content_width'] = 960;

	// Make theme available for translation.
	load_theme_textdomain( 'ignition-loge', get_template_directory() . '/languages' );

	// Image sizes
	set_post_thumbnail_size( 960, 640, true );
	add_image_size( 'ignition_item', 615, 410, true );
	add_image_size( 'ignition_item_lg', 1290, 860, true );
	add_image_size( 'ignition_article_media', 510, 510, true );
	add_image_size( 'ignition_minicart_item', 160, 160, true );

	add_theme_support( 'editor-styles' );

	$suffix = ignition_loge_ignition_scripts_styles_suffix();
	add_editor_style( "inc/assets/css/admin/editor-styles{$suffix}.css" );

	// Post types/modules.
	add_theme_support( 'ignition-gsection', array(
		'locations' => array(
			'header',
			'sidebar',
			'footer',
		),
	) );

	// Typography.
	add_theme_support( 'ignition-typography-page-title' );
	add_theme_support( 'ignition-typography-navigation' );
	add_theme_support( 'ignition-typography-button' );

	// Colors.
	add_theme_support( 'editor-color-palette', array(
		array(
			'name'  => __( 'Primary color', 'ignition-loge' ),
			'slug'  => 'theme-primary',
			'color' => '#d3b24d',
		),
		array(
			'name'  => __( 'Darker Grey', 'ignition-loge' ),
			'slug'  => 'theme-grey-darker',
			'color' => '#343434',
		),
		array(
			'name'  => __( 'Dark Grey', 'ignition-loge' ),
			'slug'  => 'theme-grey-dark',
			'color' => '#656565',
		),
		array(
			'name'  => __( 'Grey', 'ignition-loge' ),
			'slug'  => 'theme-grey',
			'color' => '#8c8c8c',
		),
		array(
			'name'  => __( 'Light Grey', 'ignition-loge' ),
			'slug'  => 'theme-grey-light',
			'color' => '#e3e3e3',
		),
		array(
			'name'  => __( 'Lighter Grey', 'ignition-loge' ),
			'slug'  => 'theme-grey-lighter',
			'color' => '#f9f9f9',
		),
		array(
			'name'  => __( 'White', 'ignition-loge' ),
			'slug'  => 'theme-white',
			'color' => '#ffffff',
		),
		array(
			'name'  => __( 'Black', 'ignition-loge' ),
			'slug'  => 'theme-black',
			'color' => '#000000',
		),
	) );

	// Make sure WooCommerce detects theme support properly. Do not remove this line.
	// add_theme_support( 'woocommerce' );
}

/**
 * Theme includes.
 */
require_once get_theme_file_path( '/inc/inc.php' );
