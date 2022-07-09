<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$show_taxonomy_description = is_product_taxonomy() ? true : false;

$display_mode = famita_woocommerce_get_display_mode();
?> 

<?php
	// Page title
	printf( '<div id="apus-wp-title">%s</div>', wp_title( '&ndash;', false, 'right' ) );
?>


<div id="apus-shop-products-wrapper" class="apus-shop-products-wrapper">
<?php
	
	// Taxonomy description
	if ( $show_taxonomy_description ) {
		/**
		 * woocommerce_archive_description hook
		 *
		 * @hooked woocommerce_taxonomy_archive_description - 10
		 * @hooked woocommerce_product_archive_description - 10
		 */
		do_action( 'woocommerce_archive_description' );
	}
	
	if ( have_posts() ) {

		global $woocommerce_loop, $wp_query;
		?>
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
			<?php if ( !famita_get_config('product_archive_top_categories') && famita_get_config('product_archive_top_filter') ) { ?>
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
		<?php 
		woocommerce_product_loop_start();
            ?>
            <?php woocommerce_product_subcategories( array( 'before' => '<div class="row subcategories-wrapper">', 'after' => '</div>' ) ); ?>
            
            <?php $attr = 'class="products-wrapper-'.esc_attr($display_mode).'"'; ?>
			<div <?php echo trim($attr); ?>>
				<div class="row row-products-wrapper">
					<?php while ( have_posts() ) : the_post(); ?>
						<?php wc_get_template_part( 'content', 'product' ); ?>
					<?php endwhile; // end of the loop. ?>
				</div>
			</div>
            <?php
		woocommerce_product_loop_end();
		
		do_action( 'woocommerce_after_shop_loop' );
		do_action( 'woocommerce_after_main_content' );
		
	} elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) {

		wc_get_template( 'loop/no-products-found.php' );

	}
?>
</div>
