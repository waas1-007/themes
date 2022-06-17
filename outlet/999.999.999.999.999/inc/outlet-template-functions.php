<?php
/**
 * Outlet template functions.
 *
 * @package outlet
 */

/**
 * Displays the product categories widget before the homepage content
 */
function outlet_homepage_navigation() {
	if ( is_page_template( 'template-homepage.php' ) ) {
		$menu_object = Outlet::get_menu_name( 'homepage' );
		$menu_name   = __( 'Homepage Menu', 'storefront' );

		if ( ! is_wp_error( $menu_object ) && false !== $menu_object ) {
			$menu_name	= $menu_object->name;
		}

		echo '<div class="o-homepage-menu">';

		echo '<h3 class="title">' . esc_attr( $menu_name ) . '</h3>';

		wp_nav_menu(
			array(
				'theme_location'	=> 'homepage',
				'container_class'	=> 'homepage-navigation',
				'fallback_cb'		=> '',
				)
		);

		echo '</div>';
	}
}

/**
 * Homepage content wrapper
 */
function outlet_homepage_content_wrapper() {
	if ( is_page_template( 'template-homepage.php' ) ) {
		echo '<section class="o-homepage-content">';
	}
}

/**
 * Homepage content wrapper close
 */
function outlet_homepage_content_wrapper_close() {
	if ( is_page_template( 'template-homepage.php' ) ) {
		echo '</section>';
	}
}

/**
 * Secondary navigation wrapper
 *
 * @return void
 */
function outlet_secondary_navigation_wrapper() {
	echo '<section class="o-secondary-navigation">';
}

/**
 * Secondary navigation wrapper close
 *
 * @return void
 */
function outlet_secondary_navigation_wrapper_close() {
	echo '</section>';
}

/**
 * Primary navigation wrapper
 *
 * @return void
 */
function outlet_primary_navigation_wrapper() {
	echo '<section class="o-primary-navigation">';
}

/**
 * Primary navigation wrapper close
 *
 * @return void
 */
function outlet_primary_navigation_wrapper_close() {
	echo '</section>';
}