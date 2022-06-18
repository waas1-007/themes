<?php
/**
 * Default template part for Ignition Widgets for Elementor's "item" template (>=2 columns)
 *
 * @since 1.0.0
 */

/** @var array $args */
$args = isset( $args ) ? $args : array();

if ( isset( $args['classes'] ) && in_array( 'is-style-ignition-spencer-item-alt', $args['classes'], true ) ) {
	ignition_get_template_part( 'template-parts/article', get_post_type(), $args );
} else {
	ignition_get_template_part( 'template-parts/item', get_post_type(), $args );
}
