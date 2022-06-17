<?php
/**
 * Customizer options' and controls' parameters, and Ignition overrides
 *
 * @since 1.0.0
 */

add_filter( 'ignition_customizer_options', 'ignition_milos_filter_ignition_customizer_options' );
/**
 * Modifies the customizer's options parameters.
 *
 * @since 1.0.0
 *
 * @param array $options
 *
 * @return array
 */
function ignition_milos_filter_ignition_customizer_options( $options ) {
	$options['site_typo_secondary']['render_args']['breakpoints_css'] = '
		h1,h2,h3,h4,h5,h6,
		.site-logo,
		.mobile-nav-trigger,
		.wc-tabs a,
		.ci-item-filter,
		.ignition-slideshow .maxslider-btn,
		.onsale,
		li.wc-block-grid__product .wc-block-grid__product-title,
		li.wc-block-grid__product .wc-block-grid__product-onsale,
		.product_list_widget li > a,
		.product_list_widget .widget-product-content-wrap > a,
		.entry-list-meta-value,
		.wp-block-latest-posts > li > a,
		.wp-block-pullquote.is-style-solid-color,
		.wp-block-quote {
			%s
		}
	';

	return $options;
}
