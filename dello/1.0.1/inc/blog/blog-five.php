<?php
/**
 * Template for Blog Five
 *
 * @package dello
 */

?>
<!-- wraper_blog_main -->
<div class="wraper_blog_main style-five">
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
						<div class="blog_main blog-posts">
							<?php
							if ( have_posts() ) :
								/* Start the Loop */
								while ( have_posts() ) :
									the_post();
									get_template_part( 'template-parts/content-five', get_post_format() );
								endwhile;
							else :
								get_template_part( 'template-parts/content', 'none' );
							endif;
							?>
						</div>
						<!-- blog_main -->
						<?php radiantthemes_pagination(); ?>
					</div>
					<?php if ( 'nosidebar' === radiantthemes_global_var( 'blog-layout', '', false ) ) { ?>
				<?php } else { ?>
						<?php if ( 'leftsidebar' === radiantthemes_global_var( 'blog-layout', '', false ) ) { ?>
							<?php if ( 'three-grid' === radiantthemes_global_var( 'blog-layout-sidebar-width', '', false ) ) { ?>
							<div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 order-lg-1 order-sm-1">
						<?php } elseif ( 'four-grid' === radiantthemes_global_var( 'blog-layout-sidebar-width', '', false ) ) { ?>
							<div class="col-lg-4 col-md-5 col-sm-12 col-xs-12 order-lg-1 order-sm-1">
						<?php } elseif ( 'five-grid' === radiantthemes_global_var( 'blog-layout-sidebar-width', '', false ) ) { ?>
							<div class="col-lg-5 col-md-6 col-sm-12 col-xs-12 order-lg-1 order-sm-1">
						<?php } ?>
					<?php } elseif ( 'rightsidebar' === radiantthemes_global_var( 'blog-layout', '', false ) ) { ?>
							<?php if ( 'three-grid' === radiantthemes_global_var( 'blog-layout-sidebar-width', '', false ) ) { ?>
							<div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 order-lg-12 order-sm-12">
						<?php } elseif ( 'four-grid' === radiantthemes_global_var( 'blog-layout-sidebar-width', '', false ) ) { ?>
							<div class="col-lg-4 col-md-5 col-sm-12 col-xs-12 order-lg-12 order-sm-12">
						<?php } elseif ( 'five-grid' === radiantthemes_global_var( 'blog-layout-sidebar-width', '', false ) ) { ?>
							<div class="col-lg-5 col-md-6 col-sm-12 col-xs-12 order-lg-12 order-sm-12">
						<?php } ?>
					<?php } else { ?>
						<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
					<?php } ?>
						<?php get_sidebar(); ?>
					</div>
				<?php } ?>
			</div>
			<!-- row -->
		</div>
	</div>
	<!-- wraper_blog_main -->
