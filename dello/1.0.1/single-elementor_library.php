<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package dello
 */

get_header();
?>
<div id="primary" class="content-area">
	<main id="main" class="site-main">
		<!-- wraper_blog_main -->
		<section class="wraper_blog_main">
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="blog_single">
							<?php
							while ( have_posts() ) :
								the_post();
								the_content();
							endwhile; // End of the loop.
							?>
						</div>
					</div>
				</div>
			</div>
		</section>
	</main>
</div>
<?php
get_footer();
