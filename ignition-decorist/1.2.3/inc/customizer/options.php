<?php
/**
 * Customizer options' and controls' parameters, and Ignition overrides
 *
 * @since 1.0.0
 */

add_filter( 'ignition_customizer_options', 'ignition_decorist_filter_ignition_customizer_options' );
/**
 * Modifies the customizer's options parameters.
 *
 * @since 1.0.0
 *
 * @param array $options
 *
 * @return array
 */
function ignition_decorist_filter_ignition_customizer_options( $options ) {
	$defaults = ignition_customizer_defaults( 'all' );

	//
	// AJAX Product Search
	//
	$section = 'theme_ajax_product_search';
	/** This filter is documented in ignition/inc/customizer/options.php */
	$options = array_merge( $options, apply_filters( "ignition_customizer_{$section}_options", array(
		'theme_ajax_product_search_ajax_is_enabled'      => array(
			'setting_args' => array(
				'default'           => $defaults['theme_ajax_product_search_ajax_is_enabled'],
				'sanitize_callback' => 'absint',
			),
			'control_args' => array(
				'section'     => $section,
				'type'        => 'checkbox',
				'label'       => esc_html__( 'Enable AJAX functionality', 'ignition-decorist' ),
				'description' => esc_html__( 'When disabled, the search form will still be visible, however no search results will be suggested while typing.', 'ignition-decorist' ),
			),
		),
		'theme_ajax_product_search_thumbnail_is_visible' => array(
			'setting_args' => array(
				'default'           => $defaults['theme_ajax_product_search_thumbnail_is_visible'],
				'sanitize_callback' => 'absint',
			),
			'control_args' => array(
				'section' => $section,
				'type'    => 'checkbox',
				'label'   => esc_html__( 'Show thumbnails', 'ignition-decorist' ),
			),
		),
		'theme_ajax_product_search_excerpt_is_visible'   => array(
			'setting_args' => array(
				'default'           => $defaults['theme_ajax_product_search_excerpt_is_visible'],
				'sanitize_callback' => 'absint',
			),
			'control_args' => array(
				'section' => $section,
				'type'    => 'checkbox',
				'label'   => esc_html__( 'Show excerpts', 'ignition-decorist' ),
			),
		),
		'theme_ajax_product_search_price_is_visible'     => array(
			'setting_args' => array(
				'default'           => $defaults['theme_ajax_product_search_price_is_visible'],
				'sanitize_callback' => 'absint',
			),
			'control_args' => array(
				'section' => $section,
				'type'    => 'checkbox',
				'label'   => esc_html__( 'Show prices', 'ignition-decorist' ),
			),
		),
	) ) );

	//
	// Secondary Typography
	//
	$options['site_typo_secondary']['render_args']['breakpoints_css'] = '
		h1, h2, h3, h4, h5, h6,
		.ignition-slideshow .maxslider-slide-title,
		.maxslider-slide-title {
			%s
		}
	';

	$options['site_typo_navigation']['render_args']['breakpoints_css'] = '
		.navigation-main {
			%s
		}
	';

	//
	// Header mobile breakpoint
	//
	$options['header_layout_menu_mobile_breakpoint']['render_args']['css'] = '
		@media (max-width: %spx) {
			#mobilemenu {
				display: block;
			}

			.head-content-slot-mobile-nav {
				display: inline-block;
			}

			.nav {
				display: none;
			}

			.head-mast-inner {
				flex-wrap: wrap;
				margin: 0;
				padding: 15px 0;
			}

			.head-mast-inner .head-content-slot {
				margin: 0;
			}

			.head-mast-inner .head-content-slot-end {
				margin-left: auto;
			}

			.rtl .head-mast-inner .head-content-slot-end {
				margin-left: 0;
				margin-right: auto;
			}

			.head-mast-inner .head-content-slot-end .head-content-slot-item {
				margin-left: 5px;
			}

			.rtl .head-mast-inner .head-content-slot-end .head-content-slot-item {
				margin-left: 0;
				margin-right: 5px;
			}

			.site-branding {
				margin: 0 15px 0 0;
				width: auto;
				max-width: 140px;
				flex: none;
			}

			.rtl .site-branding {
				margin: 0 0 0 15px;
			}

			.site-logo {
				font-size: 26px;
			}

			.site-tagline {
				display: none;
			}

			.head-mast-inner .head-content-slot-search-bar {
				width: 100%;
				flex: none;
				order: 10;
				margin-top: 10px;
			}

			.head-mast-inner .head-content-slot-item {
				margin: 0;
			}

			.header-mini-cart-trigger .amount  {
				display: none;
			}

			.head-mast-navigation-sticky-container {
				display: none;
			}
		}
	';
	return $options;
}
