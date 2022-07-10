<?php
/**
 * Template for Blog Two
 *
 * @package dello
 */

?>
<!-- wraper_blog_main -->
<div class="wraper_blog_main style-two masonry-layout">
	<div class="container">
		<!-- row -->
		<div class="row">
			<?php if ( 'nosidebar' === radiantthemes_global_var( 'blog-layout', '', false ) ) { ?>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<?php } else { ?>
				<?php if ( 'leftsidebar' === radiantthemes_global_var( 'blog-layout', '', false ) ) { ?>
					<?php if ( 'three-grid' === radiantthemes_global_var( 'blog-layout-sidebar-width', '', false ) ) { ?>
						<div class="col-lg-9 col-md-8 col-sm-12 col-xs-12 order-lg-12 order-sm-12">
					<?php } elseif ( 'four-grid' === radiantthemes_global_var( 'blog-layout-sidebar-width', '', false ) ) { ?>
						<div class="col-lg-8 col-md-7 col-sm-12 col-xs-12 order-lg-12 order-sm-12">
					<?php } elseif ( 'five-grid' === radiantthemes_global_var( 'blog-layout-sidebar-width', '', false ) ) { ?>
						<div class="col-lg-7 col-md-6 col-sm-12 col-xs-12 order-lg-12 order-sm-12">
					<?php } ?>
				<?php } elseif ( 'rightsidebar' === radiantthemes_global_var( 'blog-layout', '', false ) ) { ?>
					<?php if ( 'three-grid' === radiantthemes_global_var( 'blog-layout-sidebar-width', '', false ) ) { ?>
						<div class="col-lg-9 col-md-8 col-sm-12 col-xs-12 order-lg-1 order-sm-1">
					<?php } elseif ( 'four-grid' === radiantthemes_global_var( 'blog-layout-sidebar-width', '', false ) ) { ?>
						<div class="col-lg-8 col-md-7 col-sm-12 col-xs-12 order-lg-1 order-sm-1">
					<?php } elseif ( 'five-grid' === radiantthemes_global_var( 'blog-layout-sidebar-width', '', false ) ) { ?>
						<div class="col-lg-7 col-md-6 col-sm-12 col-xs-12 order-lg-1 order-sm-1">
					<?php } ?>
				<?php } else { ?>
						<div class="col-lg-9 col-md-8 col-sm-12 col-xs-12">
				<?php } ?>
			<?php } ?>
				<!-- blog_main -->
							<div class="blog_main">
								<div class="rt-masonry blog-posts">
									<?php
									$args       = array(
										'post_type'   => 'post',
										'post_status' => 'publish',
										'paged'       => 1,
									);
									$blog_posts = new WP_Query( $args );

									if ( $blog_posts->have_posts() ) :
										/* Start the Loop */
										while ( $blog_posts->have_posts() ) :
											$blog_posts->the_post();
											the_post();
											
											get_template_part( 'template-parts/content-blog-two', get_post_format() );
											
										endwhile;
									else :
										get_template_part( 'template-parts/content', 'none' );
									endif;
									?>
								</div>
								<?php radiantthemes_pagination(); ?>
							</div>
						</div>
				<?php if ( 'nosidebar' === radiantthemes_global_var( 'blog-layout', '', false ) ) { ?>
				<?php } else { ?>
					<?php if ( 'leftsidebar' === radiantthemes_global_var( 'blog-layout', '', false ) ) { ?>
						<?php if ( 'three-grid' === radiantthemes_global_var( 'blog-layout-sidebar-width', '', false ) ) { ?>
							<div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 order-lg-1 order-sm-1 right-sidebar">
						<?php } elseif ( 'four-grid' === radiantthemes_global_var( 'blog-layout-sidebar-width', '', false ) ) { ?>
							<div class="col-lg-4 col-md-5 col-sm-12 col-xs-12 order-lg-1 order-sm-1 right-sidebar">
						<?php } elseif ( 'five-grid' === radiantthemes_global_var( 'blog-layout-sidebar-width', '', false ) ) { ?>
							<div class="col-lg-5 col-md-6 col-sm-12 col-xs-12 order-lg-1 order-sm-1 right-sidebar">
						<?php } ?>
					<?php } elseif ( 'rightsidebar' === radiantthemes_global_var( 'blog-layout', '', false ) ) { ?>
						<?php if ( 'three-grid' === radiantthemes_global_var( 'blog-layout-sidebar-width', '', false ) ) { ?>
							<div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 order-lg-12 order-sm-12 right-sidebar">
						<?php } elseif ( 'four-grid' === radiantthemes_global_var( 'blog-layout-sidebar-width', '', false ) ) { ?>
							<div class="col-lg-4 col-md-5 col-sm-12 col-xs-12 order-lg-12 order-sm-12 right-sidebar">
						<?php } elseif ( 'five-grid' === radiantthemes_global_var( 'blog-layout-sidebar-width', '', false ) ) { ?>
							<div class="col-lg-5 col-md-6 col-sm-12 col-xs-12 order-lg-12 order-sm-12 right-sidebar">
						<?php } ?>
					<?php } else { ?>
							<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 right-sidebar">
					<?php } ?>
								<?php get_sidebar(); ?>
							</div>
				<?php } ?>
			</div>
			<!-- row -->
		</div>
	</div>
	<!-- wraper_blog_main -->



