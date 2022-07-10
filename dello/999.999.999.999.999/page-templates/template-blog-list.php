<?php

/**

 * Template Name: Blog Style List(style3)

 *

 * @package dello

 */

get_header();



?>

<!-- wraper_blog_main -->

<div class="wraper_blog_main style-three morden-box-layout">

	<div class="container">

<div class="row">

		<!-- row -->

		<div class="col-lg-9 col-md-12 col-sm-12 col-xs-12 pull-left">



					<div class="blog_main blog element-one blog-modern">

						<div class="blog-posts rt-modern">

						<?php

$wp_query = new WP_Query( array(

    'post_type' => 'post',

    'order'=> 'asc','posts_per_page'=>9,

    // name of post type.

    'paged' => get_query_var('paged') ?: 1,



) );



$count = 1;

while ( $wp_query->have_posts() ) : $wp_query->the_post();

$count++;

get_template_part( 'template-parts/content-blog-three', get_post_format() );

?>

  <?php endwhile;  ?>



						</div></div>





					<?php



						radiantthemes_pagination();



						?>

					</div>





					<div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">



						<?php get_sidebar(); ?>

					</div>

					</div>





			</div>

			<!-- row -->

		</div>

	</div>

	<!-- wraper_blog_main -->



	<?php



get_footer();