<?php
/**
 * Default template part for displaying posts in article format
 *
 * @since 1.0.0
 */

/** @var array $args */
$args                   = isset( $args ) ? $args : array();
$read_more_button_label = ! empty( $args['read-more-button-label'] ) ? $args['read-more-button-label'] : __( 'Read More', 'ignition-milos' );
?>

<?php
/**
 * Hook: ignition_before_entry.
 *
 * @since 1.0.0
 */
do_action( 'ignition_before_entry', 'listing', get_the_ID() );
?>

<article id="entry-<?php the_ID(); ?>" <?php post_class( 'entry-item entry-item-post' ); ?>>
	<?php ignition_the_post_header(); ?>

	<?php ignition_the_post_entry_thumbnail(); ?>

	<div class="entry-item-content-wrap">
		<div class="entry-item-excerpt">
			<?php the_excerpt(); ?>
		</div>

		<a href="<?php the_permalink(); ?>" class="btn entry-more-btn">
			<?php echo wp_kses_post( $read_more_button_label ); ?>
		</a>
	</div>
</article>

<?php
/**
 * Hook: ignition_after_entry.
 *
 * @since 1.0.0
 */
do_action( 'ignition_after_entry', 'listing', get_the_ID() );