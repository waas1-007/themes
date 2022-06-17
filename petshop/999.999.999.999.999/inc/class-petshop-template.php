<?php
/**
 * Petshop_Template Class
 *
 * @author   WooThemes
 * @since    1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Petshop_Template' ) ) {

class Petshop_Template {

	/**
	 * Setup class.
	 *
	 * @since 1.0
	 */
	public function __construct() {
		add_action( 'storefront_header', array( $this, 'primary_navigation_wrapper' ), 45 );
		add_action( 'storefront_header', array( $this, 'primary_navigation_wrapper_close' ), 65 );

		//Move Featured Products to beginning of homepage
		//add_action( 'homepage', 'storefront_featured_products', 15 );

		//Rearrange entry meta, add wrappers for styling
		remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
		remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

		add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 11 );
		add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 2 );
		add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 1 );

		add_action( 'woocommerce_before_shop_loop_item', array( $this, 'image_wrapper' ), 11 );
		add_action( 'woocommerce_before_shop_loop_item_title', array( $this, 'entry_meta_wrapper' ), 11 );
		add_action( 'woocommerce_after_shop_loop_item_title', array( $this, 'entry_meta_wrapper_close' ), 2 );
	}

	/**
	 * Primary navigation wrapper
	 * @return void
	 */
	public function primary_navigation_wrapper() {
		echo '<section class="petshop-primary-navigation">';
	}

	/**
	 * Primary navigation wrapper close
	 * @return void
	 */
	public function primary_navigation_wrapper_close() {
		echo '</section>';
	}

	/**
	 * Product Thumbnail wrapper
	 * @return void
	 */
	public function image_wrapper() {
		echo '<section class="petshop-product-image">';
	}

	/**
	 * Entry meta wrapper
	 * @return void
	 */
	public function entry_meta_wrapper() {
		echo '</section><section class="petshop-product-meta">';
	}

	/**
	 * Entry meta wrapper close
	 * @return void
	 */
	public function entry_meta_wrapper_close() {
		echo '</section>';
	}
}

}

return new Petshop_Template();