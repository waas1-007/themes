<?php
/**
 * Featured Articles related functions and definitions
 *
 * @since 1.0.0
 */

/**
 * Returns the featured post ID.
 *
 * Featured posts are posts marked as sticky. However, only one post can be featured at
 *
 * @since 1.0.0
 *
 * @return int|false
 */
function ignition_loge_get_featured_article_id() {
	$ids = get_option( 'sticky_posts' );

	if ( empty( $ids ) ) {
		return false;
	}

	return array_values( $ids )[0];
}

/**
 * Returns the featured post query.
 *
 * @since 1.0.0
 *
 * @return WP_Query|false
 */
function ignition_loge_get_featured_article() {
	$id = ignition_loge_get_featured_article_id();

	if ( empty( $id ) ) {
		return false;
	}

	return new WP_Query( array(
		'posts_per_page'      => -1,
		'p'                   => $id,
		'ignore_sticky_posts' => true,
		'orderby'             => 'post__in',
	) );
}

add_action( 'pre_get_posts', 'ignition_loge_exclude_featured_article' );
/**
 * Filters the featured post out of the blog main query.
 *
 * @since 1.0.0
 */
function ignition_loge_exclude_featured_article( $q ) {
	if ( is_admin() ) {
		return;
	}

	if ( $q->is_home() && $q->is_main_query() ) {

		$id = ignition_loge_get_featured_article_id();

		if ( ! empty( $id ) ) {
			$q->set( 'post__not_in', array_merge( (array) $q->get( 'post__not_int' ), array( $id ) ) );
		}
	}
}
