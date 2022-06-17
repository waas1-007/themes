<?php
/**
 * WooCommerce related hooks and functions
 *
 * @since 1.0.0
 */

if ( ! class_exists( 'WooCommerce' ) ) {
	return;
}

// Change aspect ratio of product gallery thumbnails. Widgets/minicart use the 'ignition_minicart_item' size.
add_filter( 'woocommerce_get_image_size_gallery_thumbnail', 'ignition_neto_woocommerce_gallery_thumb_size' );
/**
 * Forces the hooked WooCommerce image size to be proportional.
 *
 * @since 1.0.0
 *
 * @param array $size
 */
function ignition_neto_woocommerce_gallery_thumb_size( $size ) {
	$size['height'] = 0;
	$size['crop']   = 0;

	return $size;
}
