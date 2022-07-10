<?php
/**
 * Template Name: Blog Style Grid
 *
 * @package dello
 */
get_header();
?>
<!-- wraper_blog_main -->
<div class="wraper_blog_main style-one clasic-box-layout">
	<div class="container">
<div class="row">
		<!-- row -->
		<div class="col-lg-9 col-md-12 col-sm-12 col-xs-12 order-lg-1 order-sm-1">
					<div class="blog_main">
								<div class="row blog-posts blog-grid-style">
						<?php
						$wp_query = new WP_Query(
							array(
								'post_type'      => 'post',
								'order'          => 'asc',
								'posts_per_page' => 10,
								// name of post type.
								'paged'          => get_query_var( 'paged' ) ?: 1,
							)
						);
						$count    = 1;
						while ( $wp_query->have_posts() ) :
							$wp_query->the_post();
							$count++;
							echo '<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">';
							get_template_part( 'template-parts/content-blog-one', get_post_format() );
							echo '</div>';
							?>
						  <?php endwhile; ?>
						</div></div>
					<?php
						radiantthemes_pagination();
					?>
					</div>
	<div class="col-lg-3 col-md-12 col-sm-12 col-xs-12 order-lg-12 order-sm-12 right-sidebar">
					<?php get_sidebar(); ?>
				</div>
				</div>
			</div>
			<!-- row -->
		</div>
	<!-- wraper_blog_main -->
<?php
get_footer();
