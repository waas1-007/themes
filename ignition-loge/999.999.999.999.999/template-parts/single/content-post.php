<?php
/**
 * Default template part for displaying the main content of posts
 *
 * @since 1.0.0
 */

$column_classes = 'col-lg-6 col-md-8 col-12 mx-auto';

if ( has_post_thumbnail() ) {
	$column_classes = 'col-lg-6 offset-lg-1 col-md-8 col-12 ml-auto';
}
?>

<?php
/**
 * Hook: ignition_before_single_entry.
 *
 * @since 1.0.0
 */
do_action( 'ignition_before_single_entry' );
?>

<div class="row">

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="col-lg-5 col-md-4 col-12">
			<?php ignition_the_post_thumbnail(); ?>
		</div>
	<?php endif; ?>

	<div class="<?php echo esc_attr( $column_classes ); ?>">
		<div class="content-wrapper">

			<?php
			/**
			 * Hook: ignition_loge_content_wrapper_before.
			 *
			 * @since 1.0.0
			 */
			do_action( 'ignition_loge_content_wrapper_before' );
			?>

			<article id="entry-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?>>

				<?php ignition_the_post_header(); ?>

				<div class="entry-content">
					<?php the_content(); ?>

					<?php wp_link_pages(); ?>
				</div>

				<?php ignition_the_post_tags(); ?>

			</article>

			<?php
			/**
			 * Hook: ignition_loge_content_wrapper_after.
			 *
			 * @since 1.0.0
			 *
			 * @hooked ignition_the_social_sharing_icons - 10 // Added by theme.
			 * @hooked ignition_the_post_author_box - 20 // Added by theme.
			 * @hooked ignition_the_post_comments - 100 // Added by theme.
			 */
			do_action( 'ignition_loge_content_wrapper_after' );
			?>

		</div>
	</div>

</div>

<?php
/**
 * Hook: ignition_after_single_entry.
 *
 * @since 1.0.0
 *
 * @hooked ignition_the_social_sharing_icons - 5 // Removed by theme.
 * @hooked ignition_the_post_author_box - 10  // Removed by theme.
 * @hooked ignition_the_post_related_posts - 20 // Removed by theme.
 * @hooked ignition_the_post_comments - 100  // Removed by theme.
 */
do_action( 'ignition_after_single_entry' );
