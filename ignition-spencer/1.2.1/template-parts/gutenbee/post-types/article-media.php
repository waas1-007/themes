<?php
/**
 * Default template part for GutenBee's horizontal "media" template (1 column)
 *
 * @since 1.0.0
 */

/** @var array $args */
$args = isset( $args ) ? $args : array();

if ( isset( $args['classes'] ) && in_array( 'is-style-ignition-spencer-item-alt', $args['classes'], true ) ) {
	ignition_get_template_part( 'template-parts/article', get_post_type(), $args );
} else {
	ignition_get_template_part( 'template-parts/article-media', get_post_type(), $args );
}
