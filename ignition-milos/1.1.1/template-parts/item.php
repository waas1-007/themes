<?php
/**
 * Template part for GutenBee's "item" template (>=2 columns) specifically for posts
 *
 * @since 1.0.0
 */

/** @var array $args */
$args                   = isset( $args ) ? $args : array();
$image_size             = ! empty( $args['image-size'] ) ? $args['image-size'] : 'ignition_item';
$read_more_button_label = ! empty( $args['read-more-button-label'] ) ? $args['read-more-button-label'] : __( 'Learn More', 'ignition-milos' );
?>

<div id="entry-item-<?php the_ID(); ?>" <?php post_class( 'entry-item' ); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<figure class="entry-item-thumb">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( $image_size ); ?>
			</a>
		</figure>
	<?php endif; ?>

	<div class="entry-item-content">
		<?php ignition_the_archive_post_title( 'entry-item-title' ); ?>

		<?php if ( post_type_supports( get_post_type(), 'excerpt' ) && has_excerpt() ) : ?>
			<div class="entry-item-excerpt">
				<?php the_excerpt(); ?>
			</div>
		<?php endif; ?>

		<a href="<?php the_permalink(); ?>" class="btn btn-entry-more">
			<?php echo wp_kses_post( $read_more_button_label ); ?>
		</a>
	</div>
</div>
