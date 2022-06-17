<?php
/**
 * Theme functions and definitions
 *
 * @since 1.0.0
 */

if ( ! defined( 'IGNITION_NETO_NAME' ) ) {
	/**
	 * The theme's slug.
	 */
	define( 'IGNITION_NETO_NAME', 'ignition-neto' );
}

add_action( 'after_setup_theme', 'ignition_neto_setup' );
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function ignition_neto_setup() {
	// Default content width.
	$GLOBALS['content_width'] = 960;

	// Make theme available for translation.
	load_theme_textdomain( 'ignition-neto', get_template_directory() . '/languages' );

	// Image sizes
	set_post_thumbnail_size( 960, 640, true );
	add_image_size( 'ignition_item', 615, 410, true );
	add_image_size( 'ignition_item_lg', 1290, 860, true );
	add_image_size( 'ignition_article_media', 510, 510, true );
	add_image_size( 'ignition_minicart_item', 160, 0, false );

	add_theme_support( 'editor-styles' );

	$suffix = ignition_neto_ignition_scripts_styles_suffix();
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
			'name'  => __( 'Primary color', 'ignition-neto' ),
			'slug'  => 'theme-primary',
			'color' => '#e27c7c',
		),
		array(
			'name'  => __( 'Secondary color', 'ignition-neto' ),
			'slug'  => 'theme-secondary',
			'color' => '#0e253f',
		),
		array(
			'name'  => __( 'Dark gray', 'ignition-neto' ),
			'slug'  => 'theme-dark-gray',
			'color' => '#373737',
		),
		array(
			'name'  => __( 'Medium gray', 'ignition-neto' ),
			'slug'  => 'theme-medium-gray',
			'color' => '#686868',
		),
		array(
			'name'  => __( 'Light gray', 'ignition-neto' ),
			'slug'  => 'theme-light-gray',
			'color' => '#c4c4c4',
		),
		array(
			'name'  => __( 'White', 'ignition-neto' ),
			'slug'  => 'theme-white',
			'color' => '#ffffff',
		),
		array(
			'name'  => __( 'Black', 'ignition-neto' ),
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
