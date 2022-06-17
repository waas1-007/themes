<?php
/**
 * Petshop_Integrations Class
 * Provides integrations with Storefront extensions by removing/changing incompatible controls/settings. Also adjusts default values
 * if they need to differ from the original setting.
 *
 * @author   WooThemes
 * @since    2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Petshop_Integrations' ) ) {

class Petshop_Integrations {

	/**
	 * Setup class.
	 *
	 * @since 1.0
	 */
	public function __construct() {
		add_action( 'wp',					array( $this, 'storefront_woocommerce_customiser' ) );
		add_action( 'customize_register', 	array( $this, 'edit_controls' ), 99 );
		add_action( 'customize_register', 	array( $this, 'set_extension_default_settings' ), 99 );
		add_action( 'after_switch_theme', 	array( $this, 'edit_theme_mods' ) );
		add_action( 'init',					array( $this, 'default_theme_mod_values' ) );
	}

	/**
	 * Returns an array of the desired Storefront extension settings
	 * @return array
	 */
	public function extension_defaults() {
		return apply_filters( 'storefront_default_extension_settings', $args = array(
			// Storefront Designer
			'sd_content_background_color'            => '#ffffff',

			//Brown
			'spt_header_background_color'            => '#442929',
			'sph_heading_color'                      => '#442929',
			'sph_hero_text_color'                    => '#442929',
			'sprh_heading_color'                     => '#442929',

			//Beige
			'sfb_text_color'                         => '#f7f3ef',

			//Dark Beige
			'spp_background_color'                   => '#e5e0da',
			'sph_background_color'                   => '#e5e0da',
			'sprh_background_color'                  => '#e5e0da',

			//Dark Green #738c44

			//Blue
			'sfb_background_color'                   => '#4e92a5',

			//Green
			'spt_header_highlight_background_color'  => '#85a54e',
			'sph_hero_link_color'                    => '#85a54e',
			'sprh_hero_link_color'                   => '#85a54e',

			//Dark Blue #427c8c

			// Storefront Woocommerce customizer defaults
			// Using 2 columns for each section since we have section tabs
			'swc_homepage_recent_products_columns'     => 2,
			'swc_homepage_recent_products_limit'       => 4,
			'swc_homepage_top_rated_products_columns'  => 2,
			'swc_homepage_top_rated_products_limit'    => 4,
			'swc_homepage_on_sale_products_columns'    => 2,
			'swc_homepage_on_sale_products_limit'      => 4,
			'swc_homepage_featured_products_columns'   => 2,
			'swc_homepage_featured_products_limit'     => 4,

			'sph_overlay_opacity'                     => '0%',
			'sprh_overlay_opacity'                    => '0%',
		) );
	}

	/**
	 * Set default settings for Storefront extensions to provide compatibility with Petshop.
	 * @uses extension_defaults()
	 * @return void
	 */
	public function set_extension_default_settings( $wp_customize ) {
		// Set default values for settings in customizer
		foreach ( Petshop_Integrations::extension_defaults() as $mod => $val ) {
			$setting = $wp_customize->get_setting( $mod );
			if ( is_object( $setting ) ) {
				$setting->default = $val;
			}
		}
	}

	/**
	 * Returns a default theme_mod value if there is none set.
	 * @uses extension_defaults()
	 * @return void
	 */
	public function default_theme_mod_values() {
		foreach ( Petshop_Integrations::extension_defaults() as $mod => $val ) {
			add_filter( 'theme_mod_' . $mod, function( $setting ) use ( $val ) {
				return $setting ? $setting : $val;
			});
		}
	}

	/**
	 * Remove unused/incompatible controls from the Customizer to avoid confusion
	 * @return void
	 */
	public function edit_controls( $wp_customize ) {
		$wp_customize->remove_control( 'sd_header_layout' );
		$wp_customize->remove_control( 'sd_button_flat' );
		$wp_customize->remove_control( 'sd_button_shadows' );
		$wp_customize->remove_control( 'sd_button_background_style' );
		$wp_customize->remove_control( 'sd_button_rounded' );
		$wp_customize->remove_control( 'sd_button_size' );
		$wp_customize->remove_control( 'sd_header_layout_divider_after' );
		$wp_customize->remove_control( 'sd_button_divider_1' );
		$wp_customize->remove_control( 'sd_button_divider_2' );
	}

	/**
	 * Remove any pre-existing theme mods for settings that are incompatible with Petshop.
	 * @return void
	 */
	public function edit_theme_mods() {
		remove_theme_mod( 'sd_header_layout' );
		remove_theme_mod( 'sd_button_flat' );
		remove_theme_mod( 'sd_button_shadows' );
		remove_theme_mod( 'sd_button_background_style' );
		remove_theme_mod( 'sd_button_rounded' );
		remove_theme_mod( 'sd_button_size' );
		remove_theme_mod( 'sd_header_layout_divider_after' );
		remove_theme_mod( 'sd_button_divider_1' );
		remove_theme_mod( 'sd_button_divider_2' );
	}

	/**
	 * Compatibility with the WooCommerce customiser extension
	 */
	public function storefront_woocommerce_customiser() {
		if ( class_exists( 'Storefront_WooCommerce_Customiser' ) ) {

			$rating      = get_theme_mod( 'swc_product_archive_rating',      true );
			$price       = get_theme_mod( 'swc_product_archive_price',       true );
			$add_to_cart = get_theme_mod( 'swc_product_archive_add_to_cart', true );

			if ( false == $rating ) {
				remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 2 );
			}

			if ( false == $price ) {
				remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 1 );
			}

			if ( false == $add_to_cart ) {
				remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 11 );
			}
		}
	}
}

}

return new Petshop_Integrations();