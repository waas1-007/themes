<?php
/**
 * Actions and filters that affect core WordPress functionality
 *
 * @since 1.0.0
 */

add_filter( 'stylesheet_uri', 'ignition_milos_stylesheet_uri', 10, 2 );
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
function ignition_milos_stylesheet_uri( $stylesheet_uri, $stylesheet_dir_uri ) {
	if ( ! is_child_theme() ) {
		$suffix         = ignition_milos_ignition_scripts_styles_suffix();
		$stylesheet_uri = preg_replace( '/\.css$/', "{$suffix}.css", $stylesheet_uri );
	}

	return $stylesheet_uri;
}

add_filter( 'image_size_names_choose', 'ignition_milos_additional_editor_image_sizes' );
/**
 * Appends additional image sizes in the list of user-selectable sizes in the editor.
 *
 * @since 1.0.0
 *
 * @param array $sizes
 *
 * @return array
 */
function ignition_milos_additional_editor_image_sizes( $sizes ) {
	return array_merge( $sizes, array(
		'ignition_item'      => _x( 'Theme - Item', 'image size name', 'ignition-milos' ),
		'ignition_item_tall' => _x( 'Theme - Item Tall', 'image size name', 'ignition-milos' ),
	) );
}
