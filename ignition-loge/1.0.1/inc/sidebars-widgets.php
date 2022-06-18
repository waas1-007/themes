<?php
/**
 * Sidebars and widgets related functions
 *
 * @since 1.0.0
 */

add_filter( 'ignition_all_widget_areas', 'ignition_loge_modify_widget_areas' );
/**
 * Manipulate widget areas.
 *
 * @param array $sidebars
 *
 * @return array
 */
function ignition_loge_modify_widget_areas( $sidebars ) {
	unset( $sidebars['sidebar-1'] );

	return $sidebars;
}
