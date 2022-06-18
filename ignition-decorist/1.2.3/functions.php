<?php
/**
 * Theme functions and definitions
 *
 * @since 1.0.0
 */

if ( ! defined( 'IGNITION_DECORIST_NAME' ) ) {
	/**
	 * The theme's slug.
	 */
	define( 'IGNITION_DECORIST_NAME', 'ignition-decorist' );
}

add_action( 'after_setup_theme', 'ignition_decorist_setup' );
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function ignition_decorist_setup() {
	// Default content width.
	$GLOBALS['content_width'] = 960;

	// Make theme available for translation.
	load_theme_textdomain( 'ignition-decorist', get_template_directory() . '/languages' );

	// Image sizes
	set_post_thumbnail_size( 960, 640, true );
	add_image_size( 'ignition_item', 615, 410, true );
	add_image_size( 'ignition_item_lg', 1290, 860, true );
	add_image_size( 'ignition_article_media', 510, 510, true );
	add_image_size( 'ignition_minicart_item', 160, 160, true );

	add_theme_support( 'editor-styles' );

	$suffix = ignition_decorist_ignition_scripts_styles_suffix();
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

	// Editor palette.
	add_theme_support( 'editor-color-palette', array(
		array(
			'name'  => __( 'Primary Color', 'ignition-decorist' ),
			'slug'  => 'theme-primary',
			'color' => '#ea2c2c',
		),
		array(
			'name'  => __( 'Dark gray', 'ignition-decorist' ),
			'slug'  => 'theme-dark-gray',
			'color' => '#4A4A4A',
		),
		array(
			'name'  => __( 'Medium gray', 'ignition-decorist' ),
			'slug'  => 'theme-medium-gray',
			'color' => '#8E8E8E',
		),
		array(
			'name'  => __( 'Light gray', 'ignition-decorist' ),
			'slug'  => 'theme-light-gray',
			'color' => '#DDDDDD',
		),
		array(
			'name'  => __( 'White', 'ignition-decorist' ),
			'slug'  => 'white',
			'color' => '#ffffff',
		),
	) );

	// Make sure WooCommerce detects theme support properly. Do not remove this line.
	// add_theme_support( 'woocommerce' );
}

/**
 * Theme includes.
 */
require_once get_theme_file_path( '/inc/inc.php' );
