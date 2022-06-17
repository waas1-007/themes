<?php
/**
 * Outlet_Customizer Class
 *
 * @author   WooThemes
 * @since    2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Outlet_Customizer' ) ) :

class Outlet_Customizer {

	/**
	 * Setup class.
	 *
	 * @since 1.0
	 */
	public function __construct() {
		$theme 					= wp_get_theme( 'storefront' );
		$storefront_version 	= $theme['Version'];

		add_action( 'wp_enqueue_scripts', 								array( $this, 'load_customiser_css' ), 	1000 );
		add_action( 'customize_register', 								array( $this, 'customize_register' ), 	99 );
		add_filter( 'storefront_setting_default_values',                array( $this, 'outlet_defaults' ) );

		/**
		 * The following can be removed when Storefront 2.1 lands
		 */
		add_action( 'customize_register', 								array( $this, 'edit_defaults' ), 		99 );
		add_action( 'init',												array( $this, 'default_theme_mod_values' ) );
		if ( version_compare( $storefront_version, '2.0.0', '<' ) ) {
			add_action( 'init',											array( $this, 'default_theme_settings' ) );
		}
	}

	/**
	 * Returns an array with default storefront and extension options
	 * @return array
	 */
	public function outlet_defaults( $defaults = array() ) {
		$defaults['background_color']                       = 'ffffff';
		$defaults['storefront_heading_color']               = '#333333';
		$defaults['storefront_footer_heading_color']        = '#ffffff';
		$defaults['storefront_header_background_color']     = '#333333';
		$defaults['storefront_footer_background_color']     = '#222222';
		$defaults['storefront_header_link_color']           = '#ffffff';
		$defaults['storefront_header_text_color']           = '#ffffff';
		$defaults['storefront_footer_link_color']           = '#ffffff';
		$defaults['storefront_text_color']                  = '#888888';
		$defaults['storefront_footer_text_color']           = '#e8e8e8';
		$defaults['storefront_accent_color']                = '#EF4C47';
		$defaults['storefront_button_background_color']     = '#ffffff';
		$defaults['storefront_button_text_color']           = '#333333';
		$defaults['storefront_button_alt_background_color'] = '#333333';
		$defaults['storefront_button_alt_text_color']       = '#ffffff';

		return $defaults;
	}

	/**
	 * Set Customizer settings.
	 * @return void
	 */
	public function edit_defaults( $wp_customize ) {
		// Set default values for settings in customizer
		foreach ( Outlet_Customizer::outlet_defaults() as $mod => $val ) {
			$setting = $wp_customize->get_setting( $mod );

			if ( is_object( $setting ) ) {
				$setting->default = $val;
			}
		}
	}

	/**
	 * Returns a default theme_mod value if there is none set.
	 * @uses arcade_defaults()
	 * @return void
	 */
	public function default_theme_mod_values() {
		foreach ( Outlet_Customizer::outlet_defaults() as $mod => $val ) {
			add_filter( 'theme_mod_' . $mod, function( $setting ) use ( $val ) {
				return $setting ? $setting : $val;
			});
		}
	}

	/**
	 * Sets default theme color filters for storefront color values.
	 * This function is required for Storefront < 2.0.0 support
	 * @uses outlet_defaults()
	 * @return void
	 */
	public function default_theme_settings() {
		$prefix_regex = '/^storefront_/';
		foreach ( self::outlet_defaults() as $mod => $val) {
			if ( preg_match( $prefix_regex, $mod ) ) {
				$filter = preg_replace( $prefix_regex, 'storefront_default_', $mod );
				add_filter( $filter, function( $_ ) use ( $val ) {
					return $val;
				}, 99 );
			}
		}
	}

	/**
	 * Add custom CSS based on settings in Storefront core
	 * @return void
	 */
	public function load_customiser_css() {
		$text_color 					= get_theme_mod( 'storefront_text_color', '#888888' );
		$primary_nav_color 				= get_theme_mod( 'outlet_navigation_color', '#ffffff' );
		$header_link_color 				= get_theme_mod( 'storefront_header_link_color', apply_filters( 'storefront_default_header_link_color', '#ffffff' ) );
		$header_background_color 		= get_theme_mod( 'storefront_header_background_color', apply_filters( 'storefront_default_header_background_color', '#2c2d33' ) );
		$accent_color 			 		= get_theme_mod( 'storefront_accent_color', apply_filters( 'outlet_default_accent_color', '#EF4C47' ) );
		$content_bg_color				= get_theme_mod( 'sd_content_background_color' );
		$content_frame 					= get_theme_mod( 'sd_fixed_width' );
		$footer_background_color 		= get_theme_mod( 'storefront_footer_background_color', apply_filters( 'o_default_footer_background_color', '#222222' ) );
		$footer_link_color 				= get_theme_mod( 'storefront_footer_link_color', apply_filters( 'o_default_footer_link_color', '#ffffff' ) );
		$footer_heading_color 			= get_theme_mod( 'storefront_footer_heading_color', apply_filters( 'o_default_footer_heading_color', '#ffffff' ) );
		$footer_text_color 				= get_theme_mod( 'storefront_footer_text_color', apply_filters( 'o_default_footer_text_color', '#e8e8e8' ) );

		$bg_color						= storefront_get_content_background_color();

		$button_background_color 		= get_theme_mod( 'storefront_button_background_color', apply_filters( 'outlet_default_button_background_color', '#ffffff' ) );
		$button_text_color 				= get_theme_mod( 'storefront_button_text_color', apply_filters( 'outlet_default_button_text_color', '#333333' ) );

		$button_alt_background_color 	= get_theme_mod( 'storefront_button_alt_background_color', apply_filters( 'outlet_default_button_alt_background_color', '#333333' ) );
		$button_alt_text_color 			= get_theme_mod( 'storefront_button_alt_text_color', apply_filters( 'outlet_default_button_alt_text_color', '#ffffff' ) );

		$style = '
			.main-navigation ul li a {
				color: ' . $primary_nav_color .';
			}

			.widget a.button.checkout,
			.widget a.button.checkout:hover {
				color: ' . $button_text_color . ';
			}

			.main-navigation ul,
			.smm-menu {
				background-color: ' . $header_background_color . ';
			}

			ul.products li.product .price,
			.woocommerce-breadcrumb a,
			.widget-area .widget a,
			.page-template-template-homepage-php ul.tabs li a,
			.page-template-template-homepage-php .hentry.page .o-homepage-menu li a {
				color: ' . storefront_adjust_color_brightness( $text_color, -75 ) . ';
			}

			.page-template-template-homepage-php .hentry.page .o-homepage-menu li a:after {
				color: ' . $text_color . ';
			}

			.main-navigation li.current-menu-item > a,
			.main-navigation ul li a:hover,
			.main-navigation ul li:hover > a {
				color: ' . storefront_adjust_color_brightness( $primary_nav_color, -100 ) . ' !important;
			}

			#payment .payment_methods li,
			#payment .payment_methods li:hover {
				background-color: ' . storefront_adjust_color_brightness( $bg_color, -10 ) . ';
			}

			#payment .payment_methods li .payment_box {
				background-color: ' . storefront_adjust_color_brightness( $bg_color, -15 ) . ';
			}

			button, input[type="button"], input[type="reset"], input[type="submit"], .button, .added_to_cart {
				background: -moz-linear-gradient(top,  ' . $button_background_color . ' 0%, ' . storefront_adjust_color_brightness( $button_background_color, -25 ) . ' 100%); /* FF3.6+ */
				background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,' . $button_background_color . '), color-stop(100%,' . storefront_adjust_color_brightness( $button_background_color, -25 ) . ')); /* Chrome,Safari4+ */
				background: -webkit-linear-gradient(top,  ' . $button_background_color . ' 0%,' . storefront_adjust_color_brightness( $button_background_color, -25 ) . ' 100%); /* Chrome10+,Safari5.1+ */
				background: -o-linear-gradient(top,  ' . $button_background_color . ' 0%,' . storefront_adjust_color_brightness( $button_background_color, -25 ) . ' 100%); /* Opera 11.10+ */
				background: -ms-linear-gradient(top,  ' . $button_background_color . ' 0%,' . storefront_adjust_color_brightness( $button_background_color, -25 ) . ' 100%); /* IE10+ */
				background: linear-gradient(to bottom,  ' . $button_background_color . ' 0%,' . storefront_adjust_color_brightness( $button_background_color, -25 ) . ' 100%); /* W3C */
			}

			button:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover, .button:hover, .added_to_cart:hover {
				background: -moz-linear-gradient(top,  ' . $button_background_color . ' 0%, ' . storefront_adjust_color_brightness( $button_background_color, -35 ) . ' 100%); /* FF3.6+ */
				background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,' . $button_background_color . '), color-stop(100%,' . storefront_adjust_color_brightness( $button_background_color, -35 ) . ')); /* Chrome,Safari4+ */
				background: -webkit-linear-gradient(top,  ' . $button_background_color . ' 0%,' . storefront_adjust_color_brightness( $button_background_color, -35 ) . ' 100%); /* Chrome10+,Safari5.1+ */
				background: -o-linear-gradient(top,  ' . $button_background_color . ' 0%,' . storefront_adjust_color_brightness( $button_background_color, -35 ) . ' 100%); /* Opera 11.10+ */
				background: -ms-linear-gradient(top,  ' . $button_background_color . ' 0%,' . storefront_adjust_color_brightness( $button_background_color, -35 ) . ' 100%); /* IE10+ */
				background: linear-gradient(to bottom,  ' . $button_background_color . ' 0%,' . storefront_adjust_color_brightness( $button_background_color, -35 ) . ' 100%); /* W3C */
			}

			button.alt,
			input[type="button"].alt,
			input[type="reset"].alt,
			input[type="submit"].alt,
			.button.alt,
			.added_to_cart.alt,
			.widget-area .widget a.button.alt,
			.added_to_cart,
			.pagination .page-numbers li .page-numbers.current,
			.woocommerce-pagination .page-numbers li .page-numbers.current,
			.wc-block-components-checkout-place-order-button,
			.widget-area .widget_shopping_cart .buttons .button {
				background: -moz-linear-gradient(top,  ' . storefront_adjust_color_brightness( $button_alt_background_color, 25 ) . ' 0%, ' . storefront_adjust_color_brightness( $button_alt_background_color, -25 ) . ' 100%); /* FF3.6+ */
				background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,' . storefront_adjust_color_brightness( $button_alt_background_color, 25 ) . '), color-stop(100%,' . storefront_adjust_color_brightness( $button_alt_background_color, -25 ) . ')); /* Chrome,Safari4+ */
				background: -webkit-linear-gradient(top,  ' . storefront_adjust_color_brightness( $button_alt_background_color, 25 ) . ' 0%,' . storefront_adjust_color_brightness( $button_alt_background_color, -25 ) . ' 100%); /* Chrome10+,Safari5.1+ */
				background: -o-linear-gradient(top,  ' . storefront_adjust_color_brightness( $button_alt_background_color, 25 ) . ' 0%,' . storefront_adjust_color_brightness( $button_alt_background_color, -25 ) . ' 100%); /* Opera 11.10+ */
				background: -ms-linear-gradient(top,  ' . storefront_adjust_color_brightness( $button_alt_background_color, 25 ) . ' 0%,' . storefront_adjust_color_brightness( $button_alt_background_color, -25 ) . ' 100%); /* IE10+ */
				background: linear-gradient(to bottom,  ' . storefront_adjust_color_brightness( $button_alt_background_color, 25 ) . ' 0%,' . storefront_adjust_color_brightness( $button_alt_background_color, -25 ) . ' 100%); /* W3C */
			}

			button.alt:hover,
			input[type="button"].alt:hover,
			input[type="reset"].alt:hover,
			input[type="submit"].alt:hover,
			.button.alt:hover,
			.added_to_cart.alt:hover,
			.widget-area .widget a.button.alt:hover,
			.added_to_cart:hover,
			.pagination .page-numbers li .page-numbers.current:hover,
			.woocommerce-pagination .page-numbers li .page-numbers.current:hover,
			.wc-block-components-checkout-place-order-button:hover,
			.widget-area .widget_shopping_cart .buttons .button:hover {
				background: -moz-linear-gradient(top,  ' . storefront_adjust_color_brightness( $button_alt_background_color, 45 ) . ' 0%, ' . storefront_adjust_color_brightness( $button_alt_background_color, -25 ) . ' 100%); /* FF3.6+ */
				background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,' . storefront_adjust_color_brightness( $button_alt_background_color, 45 ) . '), color-stop(100%,' . storefront_adjust_color_brightness( $button_alt_background_color, -25 ) . ')); /* Chrome,Safari4+ */
				background: -webkit-linear-gradient(top,  ' . storefront_adjust_color_brightness( $button_alt_background_color, 45 ) . ' 0%,' . storefront_adjust_color_brightness( $button_alt_background_color, -25 ) . ' 100%); /* Chrome10+,Safari5.1+ */
				background: -o-linear-gradient(top,  ' . storefront_adjust_color_brightness( $button_alt_background_color, 45 ) . ' 0%,' . storefront_adjust_color_brightness( $button_alt_background_color, -25 ) . ' 100%); /* Opera 11.10+ */
				background: -ms-linear-gradient(top,  ' . storefront_adjust_color_brightness( $button_alt_background_color, 45 ) . ' 0%,' . storefront_adjust_color_brightness( $button_alt_background_color, -25 ) . ' 100%); /* IE10+ */
				background: linear-gradient(to bottom,  ' . storefront_adjust_color_brightness( $button_alt_background_color, 45 ) . ' 0%,' . storefront_adjust_color_brightness( $button_alt_background_color, -25 ) . ' 100%); /* W3C */
			}

			.widget-area .widget,
			ul.products li.product,
			.main-navigation ul li.smm-active .widget ul.products li,
			.main-navigation ul li.smm-active .widget ul.products li:hover,
			#respond {
				background-color: ' . storefront_adjust_color_brightness( $bg_color, -7 ) . ';
			}

			ul.products li.product {
				border-color: ' . storefront_adjust_color_brightness( $bg_color, -7 ) . ';
			}

			.storefront-product-section,
			.page-template-template-homepage-php .storefront-product-categories ul.products li.product h3 {
				background-color: ' . storefront_adjust_color_brightness( $bg_color, -5 ) . ';
			}

			.storefront-product-section ul.products li.product {
				background-color: ' . storefront_adjust_color_brightness( $bg_color, -14 ) . ';
			}

			.page-template-template-homepage-php .hentry.page .o-homepage-menu .title {
				color: ' . $bg_color . ';
			}

			.widget-area .widget .widget-title:after,
			.page-template-template-homepage-php ul.tabs {
				background-color: ' . $bg_color . ';
			}

			.widget-area .widget .product_list_widget li {
				border-bottom-color: ' . storefront_adjust_color_brightness( $bg_color, 25 ) . ';
			}

			.widget-area .widget.widget_shopping_cart .product_list_widget li,
			.widget-area .widget.widget_shopping_cart p.total {
				border-bottom-color: ' . storefront_adjust_color_brightness( $footer_background_color, 25 ) . ';
			}

			.widget-area .widget_shopping_cart .widget-title:after {
				background-color: ' . storefront_adjust_color_brightness( $footer_background_color, 25 ) . ';
			}

			.page-template-template-homepage-php ul.tabs li a.active:after {
				border-top-color: ' . $accent_color . ';
			}

			.page-template-template-homepage-php ul.tabs li a.active {
				box-shadow: 0 2px 0 0 ' . $accent_color . ';
			}

			input[type="text"], input[type="email"], input[type="url"], input[type="password"], input[type="search"], textarea, .input-text {
				background-color: ' . storefront_adjust_color_brightness( $bg_color, 15 ) . ';
			}

			.woocommerce-active .site-header .site-search .widget_product_search form:before,
			.page-template-template-homepage-php ul.tabs li a.active,
			.page-template-template-homepage-php ul.tabs li a:hover,
			.page-template-template-homepage-php .hentry.page .o-homepage-menu li a:hover,
			.page-template-template-homepage-php .hentry.page .o-homepage-menu li:hover > a {
				color: ' . $accent_color . ';
			}

			.storefront-product-section .section-title:after,
			.page-template-template-homepage-php .hentry.page .o-homepage-menu .title {
				background-color: ' . $accent_color . ';
			}

			.widget-area .widget_shopping_cart {
				background-color: ' . $footer_background_color . ';
				color: ' . $footer_text_color . ';
			}

			.widget-area .widget_shopping_cart .widget-title {
				color: ' . $footer_heading_color . ';
			}

			.widget-area .widget_shopping_cart a, .widget-area .widget_shopping_cart a:hover, .widget-area .widget_shopping_cart .buttons .button, .widget-area .widget_shopping_cart .buttons .button:hover {
				color: ' . $footer_link_color . ';
			}

			@media screen and (min-width: 768px) {
				.woocommerce-active .site-header .site-header-cart a.cart-contents:after,
				.main-navigation ul.menu li.current-menu-item > a:before,
				.main-navigation ul.nav-menu li.current-menu-item > a:before,
				.site-header-cart .cart-contents,
				.site-header .cart-contents .total:before {
					background-color: ' . $accent_color . ';
				}

				.page-template-template-homepage-php .hentry.page .o-homepage-menu ul.menu li ul {
					background-color: ' . $bg_color . ';
				}

				.site-header .cart-contents:hover,
				.site-header-cart:hover > li > a,
				.site-title a:hover {
					color: ' . $header_link_color . ';
				}

				.site-header .cart-contents:hover .total:before,
				.site-header .cart-contents:hover .total:after {
					border-color: ' . storefront_adjust_color_brightness( $accent_color, -50 ) . ';
				}

				.site-header-cart .cart-contents .count {
					background-color: ' . storefront_adjust_color_brightness( $accent_color, -15 ) . ';
				}
			}
			';

		wp_add_inline_style( 'storefront-child-style', $style );
	}

	/**
	 * Set up outlet customizer controls/settings
	 */
	public function customize_register( $wp_customize ) {
		$wp_customize->get_setting( 'background_color' )->transport 					= 'refresh';
		$wp_customize->get_setting( 'storefront_header_background_color' )->transport 	= 'refresh';

		/**
		 * Primary navigation color
		 */
		$wp_customize->add_setting( 'outlet_navigation_color', array(
			'default'           => apply_filters( 'outlet_default_navigation_color', '#ffffff' ),
			'sanitize_callback' => 'sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'outlet_navigation_color', array(
			'label'	   => __( 'Primary navigation link color', 'storefront' ),
			'section'  => 'header_image',
			'settings' => 'outlet_navigation_color',
			'priority' => 40,
		) ) );
	}
}

endif;

return new Outlet_Customizer();