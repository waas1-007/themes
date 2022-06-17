<?php
/**
 * Child theme functions
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development
 * and http://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions would be used.
 *
 * Text Domain: oceanwp
 * @link http://codex.wordpress.org/Plugin_API
 *
 */

/**
 * Load the parent style.css file
 *
 * @link http://codex.wordpress.org/Child_Themes
 */
function oceanwp_child_enqueue_parent_style() {
	// Dynamically get version number of the parent stylesheet (lets browsers re-cache your stylesheet when you update your theme)
	$theme   = wp_get_theme( 'OceanWP' );
	$version = $theme->get( 'Version' );
	// Load the stylesheet
	wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'oceanwp-style' ), $version );
	
}
add_action( 'wp_enqueue_scripts', 'oceanwp_child_enqueue_parent_style' );
//adddress field checkout
add_filter('woocommerce_checkout_fields', 'cs_checkout_fields_class_attribute_value', 9999, 1);
function cs_checkout_fields_class_attribute_value( $fields ){
   
	$fields['billing']['billing_address_1']['class'][1] = '';
    return $fields;
}

//phone number field in user list
function new_modify_user_table( $column ) {
    $column['mobile'] = 'Mobile';
    return $column;
}
add_filter( 'manage_users_columns', 'new_modify_user_table', 99, 1 );
function new_modify_user_table_row( $val, $column_name, $user_id ) {
    switch ($column_name) {
        case 'mobile' :
			return get_the_author_meta( 'Mobile', $user_id );
        default:
    }
    return $val;
}