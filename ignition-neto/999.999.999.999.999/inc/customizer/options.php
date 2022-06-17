<?php
/**
 * Customizer options' and controls' parameters, and Ignition overrides
 *
 * @since 1.0.0
 */

add_filter( 'ignition_customizer_options', 'ignition_neto_filter_ignition_customizer_options' );
/**
 * Modifies the customizer's options parameters.
 *
 * @since 1.0.0
 *
 * @param array $options
 *
 * @return array
 */
function ignition_neto_filter_ignition_customizer_options( $options ) {
	$options['site_typo_secondary']['render_args']['breakpoints_css'] = '
		h1,h2,h3,h4,h5,h6,
		.site-logo,
		.widget-title,
		li.wc-block-grid__product .wc-block-grid__product-title,
		.product_list_widget li > a,
		.wp-block-latest-posts > li > a,
		li.wc-block-grid__product .wc-block-grid__product-onsale,
		.onsale,
		.wc-block-product-search__label {
			%s
		}
	';

	return $options;
}
