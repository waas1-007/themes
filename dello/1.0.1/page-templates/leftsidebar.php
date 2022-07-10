<?php
/**
 * Template Name: Left Sidebar
 *
 * @package WordPress
 * @subpackage dello
 * @since dello 1.0
 */

get_header();

while ( have_posts() ) :
	the_post();
	the_content();
endwhile; // End of the loop.

get_footer();
