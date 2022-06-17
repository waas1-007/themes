<?php
/**
 * Customizer options' and controls' parameters, and Ignition overrides
 *
 * @since 1.0.0
 */

add_filter( 'ignition_customizer_options', 'ignition_spencer_filter_ignition_customizer_options' );
/**
 * Modifies the customizer's options parameters.
 *
 * @since 1.0.0
 *
 * @param array $options
 *
 * @return array
 */
function ignition_spencer_filter_ignition_customizer_options( $options ) {
	$options['site_typo_secondary']['render_args']['breakpoints_css'] = '
		.head-intro,
		h1,h2,h3,h4,h5,h6,
		.entry-comments-link,
		.entry-categories,
		.added_to_cart.wc-forward,
		form label,
		form .label,
		.footer-info,
		.widget_shopping_cart .total,
		input[type="text"],
		input[type="email"],
		input[type="number"],
		input[type="password"],
		input[type="date"],
		input[type="datetime"],
		input[type="time"],
		input[type="search"],
		input[type="url"],
		input[type="tel"],
		input[type="color"],
		textarea,
		select,
		.shop-filter-toggle,
		.wc-block-grid__product-title,
		.product_list_widget li .widget-product-content-wrap > a,
		.ignition-wc-search-results-item-title {
			%s
		}
	';

	return $options;
}
