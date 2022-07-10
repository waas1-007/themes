<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package dello
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function radiantthemes_body_classes( $classes ) {
	$classes[] = 'radiantthemes';
	$classes[] = 'radiantthemes-' . get_template();

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	if ( ! is_user_logged_in() && ! empty( radiantthemes_global_var( 'coming_soon_switch', '', false ) ) ) {
		$classes[] = 'rt-coming-soon';
		if ( ! empty( radiantthemes_global_var( 'coming_soon_custom_background_style', '', false ) ) ) {
			$classes[] = 'coming-soon-' . radiantthemes_global_var( 'coming_soon_custom_background_style', '', false );
		}
	} elseif ( ! is_user_logged_in() && ! empty( radiantthemes_global_var( 'maintenance_mode_switch', '', false ) ) ) {
		$classes[] = 'rt-maintenance-mode';
	} elseif ( ! is_user_logged_in() && ! empty( radiantthemes_global_var( 'coming_soon_switch', '', false ) ) && ! empty( radiantthemes_global_var( 'maintenance_mode_switch', '', false ) ) ) {
		$classes[] = 'rt-coming-soon';
	}

	if ( is_404() && ! empty( radiantthemes_global_var( 'error_custom_background_style', '', false ) ) ) {
		$classes[] = 'error-404-' . radiantthemes_global_var( 'error_custom_background_style', '', false );
	}

	if ( ! empty( radiantthemes_global_var( 'scrollbar_switch', '', false ) ) ) {
		$classes[] = 'infinity-scroll';
	}

	return $classes;
}
add_filter( 'body_class', 'radiantthemes_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function radiantthemes_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'radiantthemes_pingback_header' );

function radiantthemes_woocommerce_review_display_gravatar( $comment ) {
		echo get_avatar( $comment, apply_filters( 'woocommerce_review_gravatar_size', '200' ), '' );
}
// Remove default size
remove_action( 'woocommerce_review_before', 'woocommerce_review_display_gravatar', 10 );

// Add the new one
add_action( 'woocommerce_review_before', 'radiantthemes_woocommerce_review_display_gravatar', 10 );

function radiantthemes_override_address_checkout_fields( $address_fields ) {
    $address_fields['first_name']['placeholder'] = 'First Name';
    $address_fields['last_name']['placeholder'] = 'Last Name';
	$address_fields['company']['placeholder'] = 'Company Name';
    $address_fields['address_1']['placeholder'] = 'Address';
    $address_fields['state']['placeholder'] = 'State';
    $address_fields['postcode']['placeholder'] = 'Postcode/Zip';
    $address_fields['city']['placeholder'] = 'City';
    return $address_fields;
}
add_filter('woocommerce_default_address_fields', 'radiantthemes_override_address_checkout_fields', 20, 1);

function radiantthemes_override_billing_checkout_fields( $fields ) {
    $fields['billing']['billing_phone']['placeholder'] = 'Phone';
    $fields['billing']['billing_email']['placeholder'] = 'Email Address';
    return $fields;
}
add_filter( 'woocommerce_checkout_fields' , 'radiantthemes_override_billing_checkout_fields', 20, 1 );

/**
 * Adjust the quantity input values
 */
function radiantthemes_woocommerce_quantity_input_args( $args, $product ) {
	$args['max_value'] = 100; // Maximum value.
	return $args;
}
add_filter( 'woocommerce_quantity_input_args', 'radiantthemes_woocommerce_quantity_input_args', 10, 2 ); // Simple products.

function radiantthemes_woocommerce_available_variation( $args ) {
	$args['max_qty'] = 100; // Maximum value (variations).
	return $args;
}
add_filter( 'woocommerce_available_variation', 'radiantthemes_woocommerce_available_variation' ); // Variations.
