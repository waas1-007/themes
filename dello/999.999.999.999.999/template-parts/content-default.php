<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package dello
 */
?>
<div class="row">
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'style-default' ); ?>>
		<?php if ( has_post_thumbnail() ) { ?>
			<div class="post-thumbnail ">
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'full' ); ?></a>
				<?php if ( has_category() ) { ?>
					<div class="cat-tag-name">
						<?php
						$category_detail = get_the_category( get_the_id() );
						$result     = '';
						foreach ( $category_detail as $item ) :
							$category_link = get_category_link( $item->cat_ID );
							$result       .= '<a href = "' . esc_url( $category_link ) . '">' . $item->name . '</a>' . ' ';
						endforeach;
						echo wp_kses( $result, 'post' );
						?>
					</div>
					<?php } ?>
			</div><!-- .post-thumbnail -->
		<?php } ?>
		<div class="entry-blog-content">
			<div class="post-meta">
					<div class="entry-extra-item">
					<div class="rt-author"><?php //esc_attr_e( 'By', 'dello' ); ?> <?php the_author(); ?></div>
					<span class="date"><?php echo get_the_time( 'F d, Y' ); ?></span>
					<div class="comments-no">
					<?php
					if ( 0 === get_comments_number() || '0' === get_comments_number() ) {
						echo esc_html__( '0 Comments', 'dello' );
					} elseif ( 1 === get_comments_number() || '1' === get_comments_number() ) {
						echo esc_html__( '1 Comment', 'dello' );
					} else {
						echo get_comments_number() . ' ' . esc_html__( 'Comments', 'dello' );
					}
					?>
					</div>
			</div>
				<header class="entry-header">
			<?php the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>
		</header><!-- .entry-header -->
		</div>
		<div class="entry-main">
			<div class="entry-content">
				<?php echo substr( wp_strip_all_tags( get_the_excerpt() ), 0, 300 ) . '...'; ?>
				<div class="post-meta">
					<!-- .entry-content -->
					<div class="row entry-extra">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
							<div class="entry-extra-item text-left">
								<div class="post-read-more">
									<a class="btn" href="<?php the_permalink(); ?>" data-hover="<?php esc_attr_e( 'Read More', 'dello' ); ?>"><span><?php esc_html_e( 'Read More', 'dello' ); ?></span></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div><!-- .entry-main -->
			</div>
		<div class="clear"></div>
		</div>
	</article><!-- #post-## -->
</div>
