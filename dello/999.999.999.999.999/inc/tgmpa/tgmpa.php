<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.4.1
 * @author     Thomas Griffin
 * @author     Gary Jones
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    //opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       //github.com/thomasgriffin/TGM-Plugin-Activation
 */

require_once get_template_directory() . '/inc/tgmpa/class-tgm-plugin-activation.php';

/**
 * Undocumented function
 */
function radiantthemes_register_required_plugins() {
	$plugins = array(
		// Redux Framework.
		array(
			'name'     => esc_html__( 'Redux Framework', 'dello' ),
			'slug'     => 'redux-framework',
			//	'source'   => 'https://dello.radiantthemes.com/plugins/redux-framework.zip',
			'required' => true,
		),
		// Elementor.
		array(
			'name'     => esc_html__( 'Elementor', 'dello' ),
			'slug'     => 'elementor',
			'required' => true,
		),
		
		// Contact Form 7.
		array(
			'name'     => esc_html__( 'Contact Form 7', 'dello' ),
			'slug'     => 'contact-form-7',
			'required' => true,
		),
		
		// RT Custom Post Type.
		array(
			'name'     => esc_html__( 'RadiantThemes Custom Post Type', 'dello' ),
			'slug'     => 'radiantthemes-custom-post-type',
			'source'   => 'https://dello.radiantthemes.com/plugins/radiantthemes-custom-post-type.zip',
			'required' => true,
			'version'  => '1.0.0',
		),
		// RadiantThemes Addons.
		array(
			'name'     => esc_html__( 'RadiantThemes Addons', 'dello' ),
			'slug'     => 'radiantthemes-addons',
			'source'   => 'https://dello.radiantthemes.com/plugins/radiantthemes-addons.zip',
			'required' => true,
			'version'  => '1.0.1',
		),
		
		// WooCommerce.
		array(
            'name'     => esc_html__( 'WooCommerce', 'dello' ),
            'slug'     => 'woocommerce',
           // 'source'   => 'https://dello.radiantthemes.com/plugins/woocommerce.zip',
            'required' => true,
        ),
		// TI WooCommerce Wishlist
		array(
			'name'     => esc_html__( 'TI WooCommerce Wishlist', 'dello' ),
			'slug'     => 'ti-woocommerce-wishlist',
			'required' => true,
		),
		// Variation Swatches for WooCommerce
		array(
			'name'     => esc_html__( 'Variation Swatches for WooCommerce', 'dello' ),
			'slug'     => 'woo-variation-swatches',
			'required' => true,
		),
		// YITH WooCommerce Quick View
		array(
			'name'     => esc_html__( 'YITH WooCommerce Quick View', 'dello' ),
			'slug'     => 'yith-woocommerce-quick-view',
			'required' => true,
		),
		// Advanced Custom Fields.
		array(
			'name'     => esc_html__( 'Advanced Custom Fields', 'dello' ),
			'slug'     => 'advanced-custom-fields',
			'required' => true,
		),
		// Advanced Custom Fields Typography.
		array(
			'name'     => esc_html__( 'Advanced Custom Fields: Typography Field', 'dello' ),
			'slug'     => 'acf-typography-field',
			//'source'   => 'https://dello.radiantthemes.com/plugins/acf-typography-field.zip',
			'required' => true,
		),
		
		
		
	);

	$config = array(
		'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => true,                    // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );

}
add_action( 'tgmpa_register', 'radiantthemes_register_required_plugins' );
