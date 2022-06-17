<?php
/**
 * WooCommerce related hooks and functions
 *
 * @since 1.0.0
 */

if ( ! class_exists( 'WooCommerce' ) ) {
	return;
}

add_action( 'after_setup_theme', 'ignition_spencer_woocommerce_activation' );
/**
 * Change WooCommerce default settings.
 *
 * @since 1.0.0
 */
function ignition_spencer_woocommerce_activation() {
	add_theme_support( 'woocommerce', array(
		'thumbnail_image_width'         => 555,
		'single_image_width'            => 555,
		'gallery_thumbnail_image_width' => 150,
		'product_grid'                  => array(
			'default_columns' => 3,
			'min_columns'     => 1,
			'max_columns'     => 4,
		),
	) );
}
