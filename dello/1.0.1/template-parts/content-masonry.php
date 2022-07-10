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
		<img src="<?php esc_url( the_post_thumbnail_url( 'full' ) ); ?>">
	</div>
	<div class="radiant_lifestyle_section_two-col">
		<p><?php echo esc_html__( 'By ', 'dello' ); ?><?php the_author(); ?>  |  <?php the_time( ' F jS, Y' ); ?></p>
		<h3><a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo the_title(); ?></a></h3>
		<div class="radiant-masonory-date"></div><!--radiant-masonory-date-->
	</div><!--radiant_lifestyle_section_two-col-->
</div>
