<?php
/**
 * Theme functions and definitions
 *
 * @since 1.0.0
 */

if ( ! defined( 'IGNITION_CONVERT_NAME' ) ) {
	/**
	 * The theme's slug.
	 */
	define( 'IGNITION_CONVERT_NAME', 'ignition-convert' );
}

add_action( 'after_setup_theme', 'ignition_convert_setup' );
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function ignition_convert_setup() {
	// Default content width.
	$GLOBALS['content_width'] = 850;

	// Make theme available for translation.
	load_theme_textdomain( 'ignition-convert', get_template_directory() . '/languages' );

	// Image sizes
	set_post_thumbnail_size( 870, 580, true );
	add_image_size( 'ignition_item', 615, 410, true );
	add_image_size( 'ignition_item_lg', 1170, 780, true );
	add_image_size( 'ignition_article_media', 510, 510, true );
	add_image_size( 'ignition_minicart_item', 160, 160, true );

	add_theme_support( 'editor-styles' );

	$suffix = ignition_convert_ignition_scripts_styles_suffix();
	add_editor_style( "inc/assets/css/admin/editor-styles{$suffix}.css" );

	// Post types/modules.
	add_theme_support( 'ignition-gsection', array(
		'locations' => array(
			'header',
			'sidebar',
			'footer',
		),
	) );
//	add_theme_support( 'ignition-event' );
//	add_theme_support( 'ignition-portfolio' );
//	add_theme_support( 'ignition-service' );
//	add_theme_support( 'ignition-team' );

	// Typography.
	add_theme_support( 'ignition-typography-page-title' );
	add_theme_support( 'ignition-typography-navigation' );
	add_theme_support( 'ignition-typography-button' );

	// Colors.
	add_theme_support( 'ignition-site-colors-secondary' );

	add_theme_support( 'editor-color-palette', array(
		array(
			'name'  => __( 'Primary color', 'ignition-convert' ),
			'slug'  => 'theme-primary',
			'color' => '#173052',
		),
		array(
			'name'  => __( 'Secondary color', 'ignition-convert' ),
			'slug'  => 'theme-secondary',
			'color' => '#e3002a',
		),
		array(
			'name'  => __( 'Dark gray', 'ignition-convert' ),
			'slug'  => 'theme-dark-gray',
			'color' => '#212121',
		),
		array(
			'name'  => __( 'Medium gray', 'ignition-convert' ),
			'slug'  => 'theme-medium-gray',
			'color' => '#444444',
		),
		array(
			'name'  => __( 'Light gray', 'ignition-convert' ),
			'slug'  => 'theme-light-gray',
			'color' => '#dddddd',
		),
		array(
			'name'  => __( 'White', 'ignition-convert' ),
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