<?php
/**
 * Custom template tags and hooks
 *
 * @since 1.0.0
 */

remove_action( 'ignition_the_post_header', 'ignition_the_post_entry_title', 10 );
remove_action( 'ignition_the_post_header', 'ignition_the_post_entry_meta', 20 );
add_action( 'ignition_the_post_header', 'ignition_the_post_entry_meta', 10 );
add_action( 'ignition_the_post_header', 'ignition_the_post_entry_title', 20 );

remove_action( 'ignition_after_single_entry', 'ignition_the_social_sharing_icons', 5 );
remove_action( 'ignition_after_single_entry', 'ignition_the_post_author_box', 10 );
remove_action( 'ignition_after_single_entry', 'ignition_the_post_comments', 100 );
add_action( 'ignition_loge_content_wrapper_after', 'ignition_the_social_sharing_icons', 10 );
add_action( 'ignition_loge_content_wrapper_after', 'ignition_the_post_author_box', 20 );
add_action( 'ignition_loge_content_wrapper_after', 'ignition_the_post_comments', 100 );

remove_action( 'ignition_after_single_entry', 'ignition_the_post_related_posts', 20 );
add_action( 'ignition_main_after', 'ignition_the_post_related_posts', 50 );
add_action( 'ignition_before_related', 'ignition_loge_ignition_before_related', 10, 3 );
add_action( 'ignition_after_related', 'ignition_loge_ignition_after_related', 10, 3 );

add_action( 'wp', 'ignition_loge_hook_conditional_template_tags', 20 );
/**
 * Conditionally registers or unregisters hooks during the 'wp' action, for correct Customizer preview.
 *
 * get_theme_mod() doesn't return the correct preview value while in Customizer Preview Mode before the 'wp' action.
 *
 * @since 1.0.0
 */
function ignition_loge_hook_conditional_template_tags() {
	if ( is_singular( array( 'post', 'product' ) ) ) {
		add_action( 'ignition_main_before', 'ignition_loge_content_background_wrapper_open', 100 );
		add_action( 'ignition_main_after', 'ignition_loge_content_background_wrapper_close', 10 );
	}
}

/**
 * Opens the content background wrapper.
 *
 * @since 1.0.0
 */
function ignition_loge_content_background_wrapper_open() {
	$wrapper_class = '';

	if ( ! has_post_thumbnail() ) {
		$wrapper_class = 'without-thumbnail';
	}

	?>
	<div class="content-background-wrapper <?php echo esc_attr( $wrapper_class ); ?>">
	<?php
}

/**
 * Closes the content background wrapper.
 *
 * @since 1.0.0
 */
function ignition_loge_content_background_wrapper_close() {
	?>
		<div class="background-provider"></div>
	</div>
	<?php
}

/**
 * Opens the related posts' container wrapper.
 *
 * @since 1.0.0
 *
 * @param WP_Query $related
 * @param string   $post_type
 * @param string   $section_title
 */
function ignition_loge_ignition_before_related( $related, $post_type, $section_title ) {
	if ( $related->have_posts() ) {
		?><div class="container"><?php
	}
}

/**
 * Closes the related posts' container wrapper.
 *
 * @since 1.0.0
 *
 * @param WP_Query $related
 * @param string   $post_type
 * @param string   $section_title
 */
function ignition_loge_ignition_after_related( $related, $post_type, $section_title ) {
	if ( $related->have_posts() ) {
		?></div><?php
	}
}
