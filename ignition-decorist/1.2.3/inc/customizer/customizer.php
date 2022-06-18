<?php
/**
 * Customizer Sections and Settings, and Ignition overrides
 *
 * @since 1.0.0
 */

add_action( 'customize_register', 'ignition_decorist_customize_register' );
/**
 * Registers Customizer panels, sections, and controls.
 *
 * @since 1.0.0
 *
 * @param WP_Customize_Manager $wp_customize Reference to the customizer's manager object.
 */
function ignition_decorist_customize_register( $wp_customize ) {
	//
	// Header Options
	//
	require_once get_theme_file_path( '/inc/customizer/sections/header/ajax-product-search.php' );
}

add_filter( 'ignition_customize_text_field_shortcodes_description', 'ignition_decorist_ignition_customize_text_field_shortcodes_description' );
/**
 * Filters the default text for customizer fields that accept text, HTML, and shortcodes.
 *
 * @since 1.0.0
 *
 * @param string $description
 *
 * @return string
 */
function ignition_decorist_ignition_customize_text_field_shortcodes_description( $description ) {
	$description = sprintf(
		/* translators: %s is a URL */
		__( 'You can add text, HTML, and shortcodes.<br/><a href="%s" target="_blank">Theme Shortcodes</a>', 'ignition-decorist' ),
		esc_url( ignition_decorist_get_theme_link_url( 'theme_shortcodes', 'utm_source=customizer&utm_medium=description-link&utm_campaign=ignition-decorist' ) )
	);

	return $description;
}

/**
 * Customizer defaults.
 */
require_once get_theme_file_path( '/inc/customizer/defaults.php' );

/**
 * Customizer options.
 */
require_once get_theme_file_path( '/inc/customizer/options.php' );
