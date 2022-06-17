<?php
/**
 * Petshop Functions
 *
 * @author   WooThemes
 * @since    1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Petshop' ) ) :

class Petshop {
	/**
	 * Setup class.
	 *
	 * @since 1.0
	 */
	public function __construct() {
		add_filter( 'body_class',                        array( $this, 'body_classes' ) );
		add_action( 'wp_enqueue_scripts',                array( $this, 'enqueue_styles' ) );
		add_action( 'wp_enqueue_scripts',                array( $this, 'enqueue_child_scripts' ), 99 );
		add_action( 'wp_head',                           array( $this, 'enqueue_css' ), 99 );
		add_action( 'after_setup_theme',                 array( $this, 'register_default_header_images' ) );

		add_filter( 'storefront_woocommerce_args',       array( $this, 'woocommerce_support' ) );

		add_filter( 'storefront_custom_background_args', array( $this, 'custom_background_setup' ) );
		add_filter( 'woocommerce_breadcrumb_defaults',   array( $this, 'change_breadcrumb_delimiter' ) );

		add_filter( 'storefront_recent_products_args',   array( $this, 'product_limits_args' ) );
		add_filter( 'storefront_featured_products_args', array( $this, 'product_limits_args' ) );
		add_filter( 'storefront_popular_products_args',  array( $this, 'product_limits_args' ) );
		add_filter( 'storefront_on_sale_products_args',  array( $this, 'product_limits_args' ) );

		add_filter( 'storefront_custom_header_args',     array( $this, 'custom_header_defaults' ) );

		add_filter( 'site_transient_update_themes',      array( $this, 'disable_update_notice' ) );
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
		$args['single_image_width']    = 416;
		$args['thumbnail_image_width'] = 324;

		return $args;
	}

	function change_breadcrumb_delimiter( $defaults ) {

		$defaults['delimiter'] = ' <span>/</span> ';

		return $defaults;
	}

	/**
	 * Enqueue Storefront Styles
	 * @return void
	 */
	public function enqueue_styles() {
		global $storefront_version;

		$fonts_url = '';

		$font_families = array();

		$font_families[] = 'Montserrat:400,700';
		$font_families[] = 'Lato:400,400italic,700,700italic';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );

		wp_enqueue_style( 'storefront-style', get_template_directory_uri() . '/style.css', $storefront_version );
		wp_enqueue_style( 'petshop-fonts', $fonts_url, array(), null );
	}

	/**
	 * Adjust Custom Background args
	 * @return array
	 */

	public function custom_background_setup( $args ) {

		$args = array(
			'default-color' => apply_filters( 'storefront_default_background_color', 'f7f3ef' ),
			'default-image' => esc_url( get_stylesheet_directory_uri() ) . '/assets/images/bg.png',
		);

		return $args;
	}

	/**
	 * Change default product columns and limit
	 * @return array
	 */
	public function product_limits_args( $args ) {
		$args['limit']   = 4;
		$args['columns'] = 2;

		return $args;
	}

	public function register_default_header_images() {

		register_default_headers( array(
			'wood' => array(
				'url'           => get_stylesheet_directory_uri() . '/assets/images/wood.png',
				'thumbnail_url' => get_stylesheet_directory_uri() . '/assets/images/wood-thumbnail.png',
				/* translators: header image description */
				'description'   => __( 'Wood Texture', 'petshop' ),
			),
		) );

	}

	/**
	 * Change default header image
	 * @return array
	 */

	public function custom_header_defaults( $args ) {
		$args['default-image'] = get_stylesheet_directory_uri() . '/assets/images/wood.png';
		$args['width']         = 1400;
		$args['height']        = 700;

		return $args;
	}

	/**
	 * Enqueue Petshop Styles
	 * @return void
	 */
	public function enqueue_child_scripts() {
		global $storefront_version, $petshop_version;

		wp_style_add_data( 'storefront-child-style', 'rtl', 'replace' );

		wp_enqueue_script( 'petshop', get_stylesheet_directory_uri() . '/assets/js/petshop.min.js', array( 'jquery' ), $petshop_version, true );
	}

	/**
	 * Add custom CSS based on settings in Storefront core
	 * @return void
	 */
	public function enqueue_css() {
		$header_text_color           = get_theme_mod( 'storefront_header_text_color',           '#9aa0a7' );
		$navigation_background_color = get_theme_mod( 'storefront_accent_color',                '#85a54e' );
		$dark_green_background_color = get_theme_mod( 'storefront_button_alt_background_color', '#738c44' );
		$tabs_background_color       = get_theme_mod( 'storefront_footer_background_color',     '#442929' );
		$cart_background_color       = get_theme_mod( 'storefront_default_background_color',    '#f7f3ef' );

?>
		<style type="text/css" id="petshop-custom-styles">
			.main-navigation ul li.smm-active li ul.products li.product h3 {
				color: <?php echo $header_text_color; ?>;
			}


			.sticky-wrapper,
			.sd-sticky-navigation,
			.sd-sticky-navigation:before,
			.sd-sticky-navigation:after {
				background-color: <?php echo $navigation_background_color; ?>;
			}

			.entry-title a {
				color: <?php echo $tabs_background_color; ?>;
			}

			.site-header-cart .widget_shopping_cart {
				background: <?php echo $cart_background_color; ?>;
				border-color: <?php echo $dark_green_background_color; ?>;
			}

			a.cart-contents,
			.site-header-cart .widget_shopping_cart a {
				color: <?php echo $dark_green_background_color; ?>;
			}

			.site-header-cart .widget_shopping_cart a:hover {
				color: <?php echo $dark_green_background_color; ?>;
			}

			.main-navigation ul li a:hover,
			.main-navigation ul li:hover > a,
			.site-title a:hover,
			.site-header-cart:hover > li > a {
				color: #fff;
				opacity: 0.7;
			}

			.onsale {
				background-color: <?php echo $navigation_background_color; ?>;
				border: 0;
				color: #fff;
			}

			ul.products li.product-category.product h3:before {
				background-color: <?php echo $tabs_background_color; ?>;
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
					background-color: <?php echo $navigation_background_color; ?>;
				}

				.main-navigation ul ul,
				.secondary-navigation ul ul,
				.main-navigation ul.menu > li.menu-item-has-children:after,
				.secondary-navigation ul.menu ul, .main-navigation ul.menu ul,
				.main-navigation ul.nav-menu ul {
					background-color: <?php echo $dark_green_background_color; ?>;
				}

				.page-template-template-homepage-php ul.tabs,
				.woocommerce-tabs ul.tabs {
					background-color: <?php echo $tabs_background_color; ?>;
				}

				.page-template-template-homepage-php ul.tabs li a.active,
				.woocommerce-tabs ul.tabs li a.active {
					background-color: <?php echo $navigation_background_color; ?>;
					color: white;
				}

				.site-header-cart .widget_shopping_cart,
				.site-header .product_list_widget li .quantity {
					color: #6a6a6a;
				}
				.site-header .smm-mega-menu .product_list_widget li .quantity {
					color: rgba(255,255,255,0.5);
				}
			}
		</style>
		<?php
	}

	/**
	 * Disable theme update notifications for petshop coming from .org.
	 *
	 * @since 1.1.0
	 */
	public function disable_update_notice( $value ) {
		if ( is_object( $value ) && isset( $value->response ) && isset( $value->response['petshop'] ) ) {
			unset( $value->response['petshop'] );
		}
		return $value;
	}
}

endif;

return new Petshop();
