<?php
/**
 * Arcade Class
 *
 * @author   WooThemes
 * @package  Arcade
 * @since    2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Arcade' ) ) :

	/**
	 * The main Arcade class.
	 */
	class Arcade {

		/**
		 * Setup class.
		 *
		 * @since 1.0
		 */
		public function __construct() {
			add_action( 'after_setup_theme', array( $this, 'setup' ), 20 );
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_child_styles' ), 99 );
			add_filter( 'storefront_woocommerce_args', array( $this, 'woocommerce_support' ) );
			add_filter( 'body_class', array( $this, 'body_classes' ) );
		}

		/**
		 * Sets up theme defaults and registers support for various WordPress features.
		 *
		 * Note that this function is hooked into the after_setup_theme hook, which
		 * runs before the init hook. The init hook is too late for some features, such
		 * as indicating support for post thumbnails.
		 */
		public function setup() {
			/**
			 * Remove support for full and wide align images.
			 */
			remove_theme_support( 'align-wide' );
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
			$args['single_image_width']    = 445;
			$args['thumbnail_image_width'] = 346;

			return $args;
		}

		/**
		 * Enqueue Storefront Styles
		 *
		 * @return void
		 */
		public function enqueue_styles() {
			global $storefront_version;

			wp_enqueue_style( 'storefront-style', get_template_directory_uri() . '/style.css', $storefront_version );
		}

		/**
		 * Enqueue Storechild Styles
		 *
		 * @return void
		 */
		public function enqueue_child_styles() {
			global $storefront_version, $arcade_version;

			wp_style_add_data( 'storefront-child-style', 'rtl', 'replace' );

			wp_enqueue_style( 'montserrat', '//fonts.googleapis.com/css?family=Montserrat:400,700', array( 'storefront-child-style' ) );
			wp_enqueue_style( 'arimo', '//fonts.googleapis.com/css?family=Arimo:400,400italic,700', array( 'storefront-child-style' ) );

			if ( is_page_template( 'template-homepage.php' ) ) {
				wp_enqueue_script( 'arcade', get_stylesheet_directory_uri() . '/assets/js/arcade.min.js', array( 'jquery' ), $arcade_version );
			}
		}
	}
endif;

return new Arcade();
