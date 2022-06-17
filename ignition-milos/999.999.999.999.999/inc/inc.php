<?php
/**
 * Theme includes
 *
 * @since 1.0.0
 */

/*
 * Required files, even if Ignition is disabled.
 */

/**
 * Ignition plugin compatibility functions.
 */
require_once get_theme_file_path( '/inc/ignition-functions.php' );

/**
 * User onboarding.
 */
require_once get_theme_file_path( '/inc/onboarding.php' );

/**
 * Various helper functions.
 */
require_once get_theme_file_path( '/inc/helpers.php' );

if ( ! function_exists( 'ignition_setup' ) ) {
	/**
	 * Handling for installations without the Ignition plugin.
	 */
	require_once get_theme_file_path( '/inc/no-ignition.php' );

	return;
}

/*
 * Theme includes, only when Ignition is enabled.
 */

/**
 * Customizer.
 */
require_once get_theme_file_path( '/inc/customizer/customizer.php' );

/**
 * Data upgrade.
 */
require_once get_theme_file_path( '/inc/upgrade.php' );

/**
 * Scripts and styles.
 */
require_once get_theme_file_path( '/inc/scripts-styles.php' );

/**
 * Hooks.
 */
require_once get_theme_file_path( '/inc/default-hooks.php' );

/**
 * GutenBee plugin overrides.
 */
require_once get_theme_file_path( '/inc/vendor/gutenbee.php' );
