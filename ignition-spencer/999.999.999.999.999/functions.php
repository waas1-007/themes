<?php
/**
 * Theme functions and definitions
 *
 * @since 1.0.0
 */

if ( ! defined( 'IGNITION_SPENCER_NAME' ) ) {
	/**
	 * The theme's slug.
	 */
	define( 'IGNITION_SPENCER_NAME', 'ignition-spencer' );
}

add_action( 'after_setup_theme', 'ignition_spencer_setup' );
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function ignition_spencer_setup() {
	// Default content width.
	$GLOBALS['content_width'] = 850;

	// Make theme available for translation.
	load_theme_textdomain( 'ignition-spencer', get_template_directory() . '/languages' );

	// Image sizes
	set_post_thumbnail_size( 770, 513, true );
	add_image_size( 'ignition_item', 555, 755, true );
	add_image_size( 'ignition_item_lg', 1170, 780, true );
	add_image_size( 'ignition_article_media', 510, 510, true );
	add_image_size( 'ignition_minicart_item', 160, 160, true );

	add_theme_support( 'editor-styles' );

	$suffix = ignition_spencer_ignition_scripts_styles_suffix();
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

	add_theme_support( 'editor-color-palette', array(
		array(
			'name'  => __( 'Primary color', 'ignition-spencer' ),
			'slug'  => 'theme-primary',
			'color' => '#e42b64',
		),
		array(
			'name'  => __( 'Dark gray', 'ignition-spencer' ),
			'slug'  => 'theme-dark-gray',
			'color' => '#282828',
		),
		array(
			'name'  => __( 'Medium gray', 'ignition-spencer' ),
			'slug'  => 'theme-medium-gray',
			'color' => '#474747',
		),
		array(
			'name'  => __( 'Light gray', 'ignition-spencer' ),
			'slug'  => 'theme-light-gray',
			'color' => '#e1e1e1',
		),
		array(
			'name'  => __( 'White', 'ignition-spencer' ),
			'slug'  => 'white',
			'color' => '#ffffff',
		),
		array(
			'name'  => __( 'Black', 'ignition-spencer' ),
			'slug'  => 'black',
			'color' => '#000000',
		),
	) );

	// Make sure WooCommerce detects theme support properly. Do not remove this line.
	add_theme_support( 'woocommerce' );
}

/**
 * Theme includes.
 */
require_once get_theme_file_path( '/inc/inc.php' );
