<?php
/**
 * Outlet hooks
 *
 * @package outlet
 */

add_action( 'init', 'outlet_hooks' );

/**
 * Add and remove Outlet/Storefront functions.
 *
 * @return void
 */
function outlet_hooks() {
	add_action( 'storefront_page',      'outlet_homepage_navigation',                5 );
	add_action( 'storefront_page',      'outlet_homepage_content_wrapper',           6 );
	add_action( 'storefront_page',      'outlet_homepage_content_wrapper_close',     30 );
	add_action( 'storefront_homepage',  'outlet_homepage_navigation',                5 );
	add_action( 'storefront_homepage',  'outlet_homepage_content_wrapper',           6 );
	add_action( 'storefront_homepage',  'outlet_homepage_content_wrapper_close',     30 );
	remove_action( 'storefront_header', 'storefront_secondary_navigation',           30 );
	add_action( 'storefront_header',    'storefront_secondary_navigation',           5 );
	add_action( 'storefront_header',    'outlet_secondary_navigation_wrapper',       4 );
	add_action( 'storefront_header',    'outlet_secondary_navigation_wrapper_close', 6 );
	add_action( 'storefront_header',    'outlet_primary_navigation_wrapper', 		 45 );
	add_action( 'storefront_header',    'outlet_primary_navigation_wrapper_close',   65 );

	if ( storefront_is_woocommerce_activated() ) {
		remove_action( 'storefront_header', 'storefront_header_cart', 60 );
		add_action( 'storefront_header', 'storefront_header_cart', 40 );
	}
}
