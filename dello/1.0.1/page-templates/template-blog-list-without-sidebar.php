<?php
/**
 * Template Name: Blog Style List no side bar(style3)
 *
 * @package dello
 */
get_header();
?>
<!-- wraper_blog_main -->
<div class="wraper_blog_main style-default">
	<div class="container">
		<!-- row -->
		<div class="row">
		<!-- row -->
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 blog-withoutsidebar">
				<!-- blog_main -->
				<div class="blog_main">
					<?php
					$wp_query = new WP_Query(
						array(
							'post_type' => 'post',
							'order'     => 'asc',       // name of post type.
							'paged'     => get_query_var( 'paged' ) ?: 1,
						)
					);
					while ( $wp_query->have_posts() ) :
						$wp_query->the_post();
						get_template_part( 'template-parts/content-default', get_post_format() );
						?>
					<?php endwhile; ?>
					<?php radiantthemes_pagination(); ?>
				</div>
				<!-- blog_main -->
			</div>
		</div>
		<!-- row -->
	</div>
</div>
<!-- wraper_blog_main -->
	<?php
	get_footer();
