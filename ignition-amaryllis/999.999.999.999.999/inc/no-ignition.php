<?php
/**
 * Handling for installations where the Ignition plugin is not active.
 *
 * @since 1.0.0
 */

if ( ! is_admin() && ( ! wp_doing_ajax() ) ) {
	add_filter( 'template_include', 'ignition_amaryllis_template_include_no_ignition' );
}
/**
 * Returns the "no-ignition" template.
 *
 * @since 1.0.0
 *
 * @param string $template
 *
 * @return string
 */
function ignition_amaryllis_template_include_no_ignition( $template ) {
	return get_theme_file_path( 'template-no-ignition-index.php' );
}

add_action( 'wp_enqueue_scripts', 'ignition_amaryllis_no_ignition_enqueue_scripts' );
/**
 * Enqueue scripts and styles.
 *
 * @since 1.0.0
 */
function ignition_amaryllis_no_ignition_enqueue_scripts() {
	$suffix = ignition_amaryllis_ignition_scripts_styles_suffix();

	wp_enqueue_style( 'ignition-amaryllis-no-ignition', get_theme_file_uri( "/inc/assets/css/no-ignition{$suffix}.css" ), array(), ignition_amaryllis_asset_version() );
}
