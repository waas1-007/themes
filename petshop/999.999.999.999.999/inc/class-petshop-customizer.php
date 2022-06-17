<?php
/**
 * Petshop_Customizer Class
 * Makes adjustments to Storefront cores Customizer implementation.
 *
 * @author   WooThemes
 * @since    1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! class_exists( 'Petshop_Customizer' ) ) {
class Petshop_Customizer {
	/**
	 * Setup class.
	 *
	 * @since 1.0
	 */
	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'add_customizer_css' ),    1000 );
		add_action( 'customize_register', array( $this, 'edit_default_controls' ), 99 );
		add_action( 'init',               array( $this, 'default_theme_settings' ) );
		add_filter( 'storefront_setting_default_values', array( $this, 'get_defaults' ) );

		/**
		 * The following can be removed when Storefront 2.1 lands
		 */
		add_action( 'customize_register', array( $this, 'edit_default_customizer_settings' ), 99 );
		add_action( 'init',               array( $this, 'default_theme_mod_values' ) );
	}
	/**
	 * Returns an array of the desired default Storefront options
	 * @return array
	 */
	public function get_defaults( $defaults = array() ) {
		// Brown
		$defaults['storefront_header_background_color']     = '#442929';
		$defaults['storefront_text_color']                  = '#442929';
		$defaults['storefront_heading_color']               = '#442929';
		$defaults['storefront_footer_background_color']     = '#442929';

		// Beige
		$defaults['background_color']                       = 'f7f3ef';
		$defaults['storefront_header_text_color']           = '#f7f3ef';
		$defaults['storefront_header_link_color']           = '#f7f3ef';
		$defaults['storefront_footer_text_color']           = '#f7f3ef';
		$defaults['storefront_footer_heading_color']        = '#f7f3ef';

		// Dark Green
		$defaults['storefront_button_alt_background_color'] = '#738c44';

		// Blue
		$defaults['storefront_button_background_color']     = '#4e92a5';

		// Green
		$defaults['storefront_footer_link_color']           = '#85a54e';
		$defaults['storefront_accent_color']                = '#85a54e';

		// White
		$defaults['storefront_button_text_color']           = '#ffffff';

		return apply_filters( 'petshop_default_settings', $defaults );
	}
	/**
	 * Set default Customizer settings based on Petshop design.
	 * @uses get_defaults()
	 * @return void
	 */
	public function edit_default_customizer_settings( $wp_customize ) {
		foreach ( self::get_defaults() as $mod => $val ) {
			$setting = $wp_customize->get_setting( $mod );
			if ( is_object( $setting ) ) {
				$setting->default = $val;
			}
		}
	}

	/**
	 * Returns a default theme_mod value if there is none set.
	 * @uses get_defaults()
	 * @return void
	 */
	public function default_theme_mod_values() {
		foreach ( self::get_defaults() as $mod => $val ) {
			add_filter( 'theme_mod_' . $mod, function( $setting ) use ( $val ) {
				return $setting ? $setting : $val;
			}, 0 );
		}
	}

	/**
	 * Sets default theme color filters for Storefront color values.
	 *
	 * @uses get_defaults()
	 * @return void
	 */
	public function default_theme_settings() {
		$prefix_regex = '/^storefront_/';
		foreach ( self::get_defaults() as $mod => $val ) {
			if ( preg_match( $prefix_regex, $mod ) ) {
				$filter = preg_replace( $prefix_regex, 'storefront_default_', $mod );
				add_filter( $filter, function( $setting ) use ( $val ) {
					return $val;
				}, 99 );
			}
		}
	}

	/**
	 * Modify the default controls
	 * @return void
	 */
	public function edit_default_controls( $wp_customize ) {
		$wp_customize->get_setting( 'storefront_header_text_color' )->transport = 'refresh';
	}
	/**
	 * Add CSS using settings obtained from the theme options.
	 * @return void
	 */
	public function add_customizer_css() {
		$header_text_color           = get_theme_mod( 'storefront_header_text_color' );
		$navigation_background_color = get_theme_mod( 'storefront_accent_color' );
		$dark_green_background_color = get_theme_mod( 'storefront_button_alt_background_color' );
		$tabs_background_color       = get_theme_mod( 'storefront_footer_background_color' );
		$cart_background_color       = get_theme_mod( 'storefront_default_background_color' );

		$style = '
			.sticky-wrapper,
			.sd-sticky-navigation,
			.sd-sticky-navigation:before,
			.sd-sticky-navigation:after {
				background-color: ' . $navigation_background_color . ';
			}

			.site-header-cart .widget_shopping_cart {
				background: ' . $cart_background_color . ';
				border-color: ' . $dark_green_background_color . ';
			}

			.main-navigation ul li a:hover,
			.main-navigation ul li:hover > a,
			.site-title a:hover,
			.site-header-cart:hover > li > a {
				color: #fff;
				opacity: 0.7;
			}

			.entry-title a {
				color: ' . $tabs_background_color . ';
			}

			a.cart-contents,
			.site-header-cart .widget_shopping_cart a {
				color:  ' . $dark_green_background_color . ';
			}

			.site-header-cart .widget_shopping_cart a:hover {
				color:  ' . $dark_green_background_color . ';
			}

			.onsale {
				background-color: ' . $navigation_background_color . ';
				border: 0;
				color: #fff;
			}

			ul.products li.product-category.product h3:before {
				background-color: ' . $tabs_background_color . ';
			}

			.main-navigation ul ul {
				background-color: transparent;
			}

			@media screen and ( min-width: 768px ) {
				.page-template-template-homepage-php ul.tabs li a,
				.woocommerce-tabs ul.tabs li a {
					color: white;
				}

				.site-header .petshop-primary-navigation {
					background-color: ' . $navigation_background_color . ';
				}

				.main-navigation ul ul,
				.secondary-navigation ul ul,
				.main-navigation ul.menu > li.menu-item-has-children:after,
				.secondary-navigation ul.menu ul, .main-navigation ul.menu ul,
				.main-navigation ul.nav-menu ul,
				.main-navigation ul.menu ul.sub-menu {
					background-color: ' . $dark_green_background_color . ';
				}

				.page-template-template-homepage-php ul.tabs,
				.woocommerce-tabs ul.tabs {
					background-color: ' . $tabs_background_color . ';
					color: white;
				}

				.woocommerce-tabs ul.tabs li a.active,
				.page-template-template-homepage-php ul.tabs li a.active {
					background-color: ' . $navigation_background_color . ';
					color: white;
				}

				.site-header-cart .widget_shopping_cart,
				.site-header .product_list_widget li .quantity {
					color: #6a6a6a;
				}
				.site-header .smm-mega-menu .product_list_widget li .quantity,
				.site-header .smm-mega-menu ul.products li.product .price,
				.main-navigation ul li.smm-active li ul.products li.product h3 {
					color: rgba(255,255,255,0.5) !important;
				}
			}';

		wp_add_inline_style( 'storefront-child-style', $style );
	}
}
}
return new Petshop_Customizer();