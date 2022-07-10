<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package dello
 */

?>
<div class="rt-grid">
	<div class="rt-image-box">
		<a href="<?php echo esc_url( get_permalink() ); ?>"><img src="<?php esc_url( the_post_thumbnail_url( 'full' ) ); ?>"></a>
	</div>
	<div class="rt-masonry-detail-box">
		<span class="rt-masonry-detail-author"><?php echo esc_html__( 'By ', 'dello' ); ?><?php the_author(); ?> </span><span class="rt-masonry-detail-date">  <?php the_time( ' F jS, Y' ); ?></span>
		<h3 class="rt-masonry-detail-title"><a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo the_title(); ?></a></h3>
	</div>
</div>
