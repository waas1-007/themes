<?php
/**
 * Customizer Sections and Settings, and Ignition overrides
 *
 * @since 1.0.0
 */

add_filter( 'ignition_customize_text_field_shortcodes_description', 'ignition_loge_ignition_customize_text_field_shortcodes_description' );
/**
 * Filters the default text for customizer fields that accept text, HTML, and shortcodes.
 *
 * @since 1.0.0
 *
 * @param string $description
 *
 * @return string
 */
function ignition_loge_ignition_customize_text_field_shortcodes_description( $description ) {
	$description = sprintf(
		/* translators: %s is a URL */
		__( 'You can add text, HTML, and shortcodes.<br/><a href="%s" target="_blank">Theme Shortcodes</a>', 'ignition-loge' ),
		esc_url( ignition_loge_get_theme_link_url( 'theme_shortcodes', 'utm_source=customizer&utm_medium=description-link&utm_campaign=ignition-loge' ) )
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
