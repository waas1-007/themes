<?php
/**
 * Outlet Class
 *
 * @author   WooThemes
 * @since    2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Outlet' ) ) :

class Outlet {

	/**
	 * Setup class.
	 *
	 * @since 1.0
	 */
	public function __construct() {
		add_filter( 'body_class',                    array( $this, 'body_classes' ) );
		add_filter( 'storefront_woocommerce_args',   array( $this, 'woocommerce_support' ) );
		add_action( 'wp_enqueue_scripts',            array( $this, 'enqueue_styles' ) );
		add_action( 'wp_enqueue_scripts',            array( $this, 'enqueue_child_styles' ), 99 );
		add_filter( 'storefront_custom_header_args', array( $this, 'return_custom_header_args' ) );
		add_action( 'after_setup_theme',             array( $this, 'setup_menus' ) );
	}

	/**
	 * Adds custom classes to the array of body classes.
	 *
	 * @param array $classes Classes for the body element.
	 * @return array
	 */
	public function body_classes( $classes ) {
		global $storefront_version;

		if ( version_compare( $storefront_version, '2.3.0', '>=' ) ) {
			$classes[] = 'storefront-2-3';
		}

		return $classes;
	}

	/**
	 * Override Storefront default theme settings for WooCommerce.
	 * @return array the modified arguments
	 */
	public function woocommerce_support( $args ) {
		$args['single_image_width']    = 462;
		$args['thumbnail_image_width'] = 358;

		return $args;
	}

	/**
	 * Enqueue Storefront Styles
	 * @return void
	 */
	public function enqueue_styles() {
		global $storefront_version;

		wp_enqueue_style( 'storefront-style', get_template_directory_uri() . '/style.css', $storefront_version );
	}

	/**
	 * Enqueue Storechild Styles
	 * @return void
	 */
	public function enqueue_child_styles() {
		global $storefront_version, $outlet_version;

		wp_style_add_data( 'storefront-child-style', 'rtl', 'replace' );

		wp_enqueue_style( 'roboto', '//fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic,700,700italic,500,500italic', array( 'storefront-child-style' ) );
	    wp_enqueue_style( 'montserrat', '//fonts.googleapis.com/css?family=Montserrat:400,700', array( 'storefront-child-style' ) );

		wp_enqueue_script( 'outlet', get_stylesheet_directory_uri() . '/assets/js/outlet.min.js', array( 'jquery' ), $outlet_version );
	}

	/**
	 * Sets the default header image
	 */
	public function return_custom_header_args( $args ) {
	    $args['default-image']  = get_stylesheet_directory_uri() . '/assets/images/header.jpg';
	    $args['height']         = 1000;

		return $args;
	}

	/**
	 * Registers the menu locations
	 */
	public function setup_menus() {
	    register_nav_menus( array(
	        'homepage'      => __( 'Homepage Menu', 'storefront' ),
	    ) );
	}

	/**
	 * Get a menus name based on location
	 * @param  string $location the menu location slug
	 * @return array the menu detailed assigned to an array
	 */
	public static function get_menu_name( $location ) {
	    if ( empty( $location ) ) {
	        return false;
	    }

	    $locations = get_nav_menu_locations();

	    if ( ! isset( $locations[$location] ) ) {
	        return false;
	    }

	    $menu_obj = get_term( $locations[$location], 'nav_menu' );

	    return $menu_obj;
	}
}

endif;

return new Outlet();