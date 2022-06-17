<?php
$column_classes = 'col-lg-6 col-md-8 col-12 mx-auto';

if ( has_post_thumbnail() ) {
	$column_classes = 'col-lg-6 offset-lg-1 col-md-8 col-12 ml-auto';
}
?>
<div class="entry-featured">
	<div class="content-background-wrapper">
		<div class="container">
			<div class="row">
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="col-lg-5 col-md-4 col-12">
						<figure class="entry-thumb">
							<?php the_post_thumbnail( 'ignition_item_lg' ); ?>
						</figure>
					</div>
				<?php endif; ?>

				<div class="<?php echo esc_attr( $column_classes ); ?>">
					<div class="content-wrapper">
						<article id="entry-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?>>
							<?php ignition_the_post_header(); ?>

							<div class="entry-item-excerpt">
								<?php the_excerpt(); ?>
							</div>

							<a href="<?php the_permalink(); ?>" class="btn entry-more-btn"><?php esc_html_e( 'Read More', 'ignition-loge' ); ?></a>
						</article>
					</div>
				</div>
			</div>
		</div>
		<div class="background-provider"></div>
	</div>
</div>
