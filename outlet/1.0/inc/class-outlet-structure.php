<?php
/**
 * Outlet_Structure Class
 *
 * @author   WooThemes
 * @since    2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Outlet_Structure' ) ) :

class Outlet_Structure {

	/**
	 * Setup class.
	 *
	 * @since 1.0
	 */
	public function __construct() {
		add_filter( 'storefront_default_layout', 	array( $this, 'switch_default_layout' ) );
	}

	/**
	 * Adjust the default Storefront layout
	 * Makes the sidebar appear on the left instead of the right.
	 */
	public function switch_default_layout( $layout ) {
		$layout = is_rtl() ? 'right' : 'left';
		return $layout;
	}
}

endif;

return new Outlet_Structure();