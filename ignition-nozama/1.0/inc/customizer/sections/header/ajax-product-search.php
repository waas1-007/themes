<?php
/**
 * Customizer section options: Header - AJAX Product Search
 *
 * @since 1.0.0
 */

/** @var WP_Customize_Manager $wp_customize Reference to the customizer's manager object. */
$wp_customize->add_section( 'theme_ajax_product_search', array(
	'title'    => esc_html_x( 'AJAX Product Search', 'customizer section title', 'ignition-nozama' ),
	'panel'    => 'header',
	'priority' => 100,
) );

// This call is expensive, so make sure we don't call it unnecessarily.
$customizer_options = ignition_customizer_options( 'all' );

$args = $customizer_options['theme_ajax_product_search_ajax_is_enabled'];
$wp_customize->add_setting( 'theme_ajax_product_search_ajax_is_enabled', $args['setting_args'] );
$wp_customize->add_control( 'theme_ajax_product_search_ajax_is_enabled', $args['control_args'] );

$args = $customizer_options['theme_ajax_product_search_thumbnail_is_visible'];
$wp_customize->add_setting( 'theme_ajax_product_search_thumbnail_is_visible', $args['setting_args'] );
$wp_customize->add_control( 'theme_ajax_product_search_thumbnail_is_visible', $args['control_args'] );

$args = $customizer_options['theme_ajax_product_search_excerpt_is_visible'];
$wp_customize->add_setting( 'theme_ajax_product_search_excerpt_is_visible', $args['setting_args'] );
$wp_customize->add_control( 'theme_ajax_product_search_excerpt_is_visible', $args['control_args'] );

$args = $customizer_options['theme_ajax_product_search_price_is_visible'];
$wp_customize->add_setting( 'theme_ajax_product_search_price_is_visible', $args['setting_args'] );
$wp_customize->add_control( 'theme_ajax_product_search_price_is_visible', $args['control_args'] );
