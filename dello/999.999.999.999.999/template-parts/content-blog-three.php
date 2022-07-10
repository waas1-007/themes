<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package dello
 */

?>
<article id="post-<?php the_ID(); ?>" class="style-three post row">
	<div class="modern-post-box">
	<?php if ( has_post_thumbnail() ) { ?>
		<div class="modern-img-bx">
			<div class="post-thumbnail matchHeight">
				<?php if ( '' !== get_the_post_thumbnail() && ! is_single() ) : ?>
					<a href="<?php echo esc_url( get_permalink() ); ?>"><img src="<?php esc_url( the_post_thumbnail_url( 'full' ) ); ?>"></a>
				<?php endif; ?>
				<div class="tag-name">
					<?php
					$category_detail = get_the_category( get_the_id() );
					$result          = '';
					foreach ( $category_detail as $item ) :
						$category_link = get_category_link( $item->cat_ID );
						$result       .= '<a href = "' . esc_url( $category_link ) . '">' . $item->name . '</a>';
					endforeach;
					echo wp_kses( $result, 'post' );
					?>
				</div>
			</div><!-- .post-thumbnail -->
		</div>
	<?php } ?>
	<?php if ( has_post_thumbnail() ) { ?>
		<div class="modern-desc-bx">
	<?php } else { ?>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<?php } ?>
			<div class="entry-main matchHeight">
				<header class="entry-header">
					<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
					<?php the_title( '<h4 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' ); ?>
				</header><!-- .entry-header -->
				<div class="post-meta">
					<div class="entry-extra-item">
						<div class="author-box">
							<span class="author"><?php the_author(); ?></span>
						</div>
						<span class="date"><?php echo get_the_time( 'F d, Y' ); ?></span>
						<span class="comment">
						<?php
						if ( 0 === get_comments_number() || '0' === get_comments_number() ) {
							echo esc_html__( '0 Comment', 'dello' );
						} elseif ( 1 === get_comments_number() || '1' === get_comments_number() ) {
							echo esc_html__( '1 Comment', 'dello' );
						} else {
							echo get_comments_number() . ' ' . esc_html__( 'Comments', 'dello' );
						}
						?>
						</span>
					</div>
					<!-- .entry-header -->
				</div><!-- .post-meta -->
				<div class="entry-content">
					<p><?php echo substr( wp_strip_all_tags( get_the_excerpt() ), 0, 120 ) . '...'; ?></p>
					<div class="entry-extra-item text-left">
						<div class="post-read-more">
							<a class="btn" href="<?php the_permalink(); ?>" data-hover="<?php esc_attr_e( 'Read More', 'dello' ); ?>"><?php esc_html_e( 'Read More', 'dello' ); ?></a>
						</div>
					</div>
				</div><!-- .entry-content -->
			</div><!-- .entry-main -->
		</div>
	</div>
</article><!-- #post-## -->
