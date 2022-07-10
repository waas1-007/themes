<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package dello
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?>>
	<div class="entry-content">
		<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
		<?php
		the_content();
		wp_link_pages(
			array(
				'before' => '<div class="clearfix"></div><div class="page-links">' . esc_html__( 'Pages:', 'dello' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
