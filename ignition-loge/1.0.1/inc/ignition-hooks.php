<?php
/**
 * Actions and filters that affect Ignition functionality
 *
 * @since 1.0.0
 */

add_filter( 'ignition_blog_layout_types', 'ignition_loge_filter_ignition_blog_layout_types' );
/**
 * Filters the blog's layout types.
 *
 * @since 1.0.0
 *
 * @param array $choices Array of 'value' => 'label' choices.
 *
 * @return array
 */
function ignition_loge_filter_ignition_blog_layout_types( $choices ) {
	unset( $choices['content_sidebar'] );
	unset( $choices['sidebar_content'] );

	return $choices;
}

add_filter( 'theme_templates', 'ignition_loge_deregister_page_templates', 20, 4 );
/**
 * Removes non-applicable plugin-provided page templates.
 *
 * @since 1.0.0
 *
 * @param $post_templates
 * @param $wp_theme
 * @param $post
 * @param $post_type
 *
 * @return array
 */
function ignition_loge_deregister_page_templates( $post_templates, $wp_theme, $post, $post_type ) {
	if ( 'post' === $post_type ) {
		unset( $post_templates['templates/template-content-sidebar.php'] );
		unset( $post_templates['templates/template-sidebar-content.php'] );
	}

	return $post_templates;
}
