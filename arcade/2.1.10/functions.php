<?php
/**
 * Arcade engine room
 *
 * @package arcade
 */

 $theme             = wp_get_theme( 'arcade' );
 $arcade_version 	= $theme['Version'];

 /**
  * Load the individual classes required by this theme
  */
include_once( 'inc/class-arcade.php' );
include_once( 'inc/class-arcade-customizer.php' );
include_once( 'inc/class-arcade-structure.php' );
include_once( 'inc/class-arcade-integrations.php' );
include_once( 'inc/plugged.php' );
add_action( 'get_header', 'remove_storefront_sidebar' );
	if ( is_product() ) {
		remove_action( 'storefront_sidebar', 'storefront_get_sidebar',10 );
	}
add_filter( 'storefront_handheld_footer_bar_links', 'jk_add_home_link' );
function jk_add_home_link( $links ) {
	$new_links = array(
		'home' => array(
			'priority' => 10,
			'callback' => 'jk_home_link',
		),
	);

	$links = array_merge( $new_links, $links );

	return $links;
}

function jk_home_link() {
	echo '<a href="' . esc_url( home_url( '/' ) ) . '">' . __( 'Home' ) . '</a>';
}
/**
 * Do not add custom code / snippets here.
 * While Child Themes are generally recommended for customisations, in this case it is not
 * wise. Modifying this file means that your changes will be lost when an automatic update
 * of this theme is performed. Instead, add your customisations to a plugin such as
 * https://github.com/woothemes/theme-customisations
 */