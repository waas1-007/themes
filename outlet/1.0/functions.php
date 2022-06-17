<?php
/**
 * Outlet engine room
 *
 * @package outlet
 */

$theme          = wp_get_theme( 'outlet' );
$outlet_version = $theme['Version'];

/**
 * Load the individual classes required by this theme
 */
include_once( 'inc/class-outlet.php' );
include_once( 'inc/class-outlet-customizer.php' );
include_once( 'inc/class-outlet-structure.php' );
include_once( 'inc/class-outlet-integrations.php' );
include_once( 'inc/plugged.php' );
include_once( 'inc/outlet-template-functions.php' );
include_once( 'inc/outlet-template-hooks.php' );

/**
 * Do not add custom code / snippets here.
 * While Child Themes are generally recommended for customisations, in this case it is not
 * wise. Modifying this file means that your changes will be lost when an automatic update
 * of this theme is performed. Instead, add your customisations to a plugin such as
 * https://github.com/woothemes/theme-customisations
 */
