<?php

get_header();
$sidebar_configs = famita_get_woocommerce_layout_configs();

$display_mode = famita_woocommerce_get_display_mode();

?>

<?php do_action( 'famita_woo_template_main_before' ); ?>
<section id="main-container" class="page-shop <?php echo apply_filters('famita_woocommerce_content_class', 'container');?>">

	<?php do_action('famita_woocommerce_archive_description'); ?>
	
	<?php famita_before_content( $sidebar_configs ); ?>

	
	<div class="row">
		<?php famita_display_sidebar_left( $sidebar_configs ); ?>

		<div id="main-content" class="archive-shop col-xs-12 <?php echo esc_attr($sidebar_configs['main']['class']); ?>">

			<div id="primary" class="content-area">
				<div id="content" class="site-content" role="main">

					
					<div id="apus-shop-products-wrapper" class="apus-shop-products-wrapper">
						

                        <!-- product content -->
						<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
							<h1 class="page-title"><?php woocommerce_page_title(); ?></h1>
						<?php endif; ?>

						<?php do_action( 'woocommerce_archive_description' ); ?>

						<?php if ( have_posts() ) : ?>
							<div class="top-archive-shop">
								<?php if ( famita_get_config('product_archive_top_categories') && famita_get_config('product_archive_top_filter') ) : ?>
									<!-- header for full -->
									<?php
										wc_get_template_part( 'content', 'product_header' );
										
										remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
										remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
										remove_action( 'woocommerce_before_shop_loop', 'famita_filter_before' , 1 );
										remove_action( 'woocommerce_before_shop_loop', 'famita_filter_after' , 40 );
										remove_action( 'woocommerce_before_shop_loop', 'famita_woocommerce_display_modes' , 2 );

										do_action( 'woocommerce_before_shop_loop' );
									?>
								<?php endif; ?>

								<?php if ( !famita_get_config('product_archive_top_categories') ) { ?>
									<div class="before-shop-header-wrapper clearfix">
										<div class="before-shop-loop-fillter pull-left">
											<?php 
												remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering' , 30 );
											?>
											<?php do_action( 'woocommerce_before_shop_loop' ); ?>
										</div>
										<?php wc_get_template_part( 'content', 'product_header' ); ?>
									</div>
								<?php } ?>

								<?php
		                            // Results bar/button
									if ( famita_get_config('product_archive_top_filter') ) {
			                            wc_get_template_part( 'content', 'product_results_bar' );
									}
		                        ?>
	                        </div>
							<?php woocommerce_product_loop_start(); ?>
								
								<?php woocommerce_product_subcategories( array( 'before' => '<div class="row subcategories-wrapper">', 'after' => '</div>' ) ); ?>
								
								<?php $attr = 'class="products-wrapper-'.esc_attr($display_mode).'"'; ?>
								<div <?php echo trim($attr); ?>>
										<div class="row row-products-wrapper">
											<?php while ( have_posts() ) : the_post(); ?>
												<?php wc_get_template_part( 'content', 'product' ); ?>
											<?php endwhile; // end of the loop. ?>
										</div>
									
								</div>

							<?php woocommerce_product_loop_end(); ?>

							<?php do_action( 'woocommerce_after_shop_loop' ); ?>

						<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>
							<?php do_action( 'woocommerce_no_products_found' ); ?>
						<?php endif; ?>

					</div>
				</div><!-- #content -->
			</div><!-- #primary -->
		</div><!-- #main-content -->
		
		<?php famita_display_sidebar_right( $sidebar_configs ); ?>
		
	</div>
</section>
<?php

get_footer();
