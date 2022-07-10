<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package dello
 */

?>
<article id="post-<?php the_ID(); ?>" class="blog-item style-one post">
	<div class="holder">
		<?php if ( '' !== get_the_post_thumbnail() && ! is_single() ) : ?>
		<div class="pic">
			<a class="pic-main" href="<?php the_permalink(); ?>" >
			<img src="<?php esc_url( the_post_thumbnail_url( 'full' ) ); ?>">
			</a>
		</div>
	<?php endif; ?>
	<div class="data">
		
		<div class="post-meta">
			<span class="comments"><?php the_author(); ?> </span>
			<span class="date"><?php echo get_the_time( 'F d, Y' ); ?></span>
		</div>
		<h4 class="title">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h4>
		<div class="entry-content">
                    <p><?php echo substr( wp_strip_all_tags( get_the_excerpt() ), 0, 90 ) . '...'; ?></p>
                    <div class="entry-extra-item text-left">
                                    <div class="post-read-more">
                                        <a class="btn" href="<?php the_permalink(); ?>" data-hover="<?php esc_attr_e( 'Read More', 'dello' ); ?>"><?php esc_html_e( 'Read More', 'dello' ); ?></a>
                                    </div>
                                </div>
                </div>
	</div>
</div>
</article>
