<?php
/**
 * Actions and filters that affect core WordPress functionality
 *
 * @since 1.0.0
 */

add_filter( 'stylesheet_uri', 'ignition_amaryllis_stylesheet_uri', 10, 2 );
/**
 * Modifies the stylesheet path if needed (non-debug modes).
 *
 * @since 1.0.0
 *
 * @param string $stylesheet_uri
 * @param string $stylesheet_dir_uri
 *
 * @return string
 */
function ignition_amaryllis_stylesheet_uri( $stylesheet_uri, $stylesheet_dir_uri ) {
	if ( ! is_child_theme() ) {
		$suffix         = ignition_amaryllis_ignition_scripts_styles_suffix();
		$stylesheet_uri = preg_replace( '/\.css$/', "{$suffix}.css", $stylesheet_uri );
	}

	return $stylesheet_uri;
}
