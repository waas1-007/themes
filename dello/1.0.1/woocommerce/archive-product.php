<?php
/**
 * Template Archive Product
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
if ( empty( $_REQUEST['sidebar'] ) ) {
	$_REQUEST['sidebar'] = 0;
}
get_header( 'shop' ); ?>
<?php if ( ! class_exists( 'ReduxFrameworkPlugin' ) ) { ?>
	<div class="wraper_shop_main">
		<div class="container">
			<!-- row -->
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<?php if ( have_posts() ) : ?>
						<?php
							/**
							 * Woocommerce Before Shop Loop hook.
							 * woocommerce_before_shop_loop hook.
							 *
							 * @hooked wc_print_notices - 10
							 * @hooked woocommerce_result_count - 20
							 * @hooked woocommerce_catalog_ordering - 30
							 */
							do_action( 'woocommerce_before_shop_loop' );
						?>
						<?php woocommerce_product_loop_start(); ?>
						<?php woocommerce_product_subcategories(); ?>
						<?php
							while ( have_posts() ) :
								the_post();
								?>
									<?php
									/**
									 * Woocommerce Shop Loop hook.
									 * woocommerce_shop_loop hook.
									 *
									 * @hooked WC_Structured_Data::generate_product_data() - 10
									 */
									do_action( 'woocommerce_shop_loop' );
									?>
									<?php
									/**
									 * The template for displaying product content within loops
									 *
									 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
									 *
									 * HOWEVER, on occasion WooCommerce will need to update template files and you
									 * (the theme developer) will need to copy the new files to your theme to
									 * maintain compatibility. We try to do this as little as possible, but it does
									 * happen. When this occurs the version of the template file will be bumped and
									 * the readme will list any important changes.
									 *
									 * @see     https://docs.woocommerce.com/document/template-structure/
									 * @author  WooThemes
									 * @package WooCommerce/Templates
									 * @version 3.0.0
									 */
									if ( ! defined( 'ABSPATH' ) ) {
										exit; // Exit if accessed directly.
									}
									global $product;
									// Ensure visibility.
									if ( empty( $product ) || ! $product->is_visible() ) {
										return;
									}
									wc_get_template_part( 'content', 'product' );
							endwhile; // end of the loop.
						?>
						<?php woocommerce_product_loop_end(); ?>
						<?php
							/**
							 * Woocommerce After Shop Loop hook.
							 * woocommerce_after_shop_loop hook.
							 *
							 * @hooked woocommerce_pagination - 10
							 */
							do_action( 'woocommerce_after_shop_loop' );
						?>
						<?php
							elseif ( ! woocommerce_product_subcategories(
								array(
									'before' => woocommerce_product_loop_start( false ),
									'after'  => woocommerce_product_loop_end( false ),
								)
							) ) :
						?>
						<?php
							/**
							 * Woocommerce No Products Found hook.
							 * woocommerce_no_products_found hook.
							 *
							 * @hooked wc_no_products_found - 10
							 */
							do_action( 'woocommerce_no_products_found' );
						?>
					<?php endif; ?>
					<?php
						/**
						 * Woocommerce After Main Content hook.
						 * woocommerce_after_main_content hook.
						 *
						 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
						 */
						do_action( 'woocommerce_after_main_content' );
					?>
				</div>
			</div>
			<!-- row -->
		</div>
	</div>
	<!-- wraper_shop_main -->
	<?php } else { ?>
		<!-- wraper_shop_main -->
		<div class="wraper_shop_main <?php echo radiantthemes_global_var( 'shop-sidebar', '', false ); ?> shop-<?php echo esc_attr( radiantthemes_global_var( 'shop_box_style', '', false ) ); ?>">
			<div class="container">
				<div class="rt-shop-product-breadcrumb">
					<?php woocommerce_breadcrumb(); ?>
					<?php if ( is_search() ) { ?>
						<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
							<h4 class="woocommerce-products-search__title "><?php woocommerce_page_title(); ?></h4>
						<?php endif; ?>
					<?php } ?>
				</div>
				<!-- row -->
				<div class="row">
					<?php if ( 'shop-nosidebar' === radiantthemes_global_var( 'shop-sidebar', '', false ) && ! $_REQUEST['sidebar'] || 'shop-topsidebar' === radiantthemes_global_var( 'shop-sidebar', '', false ) ) { ?>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<?php } else { ?>
						<?php if ( 'shop-leftsidebar' === radiantthemes_global_var( 'shop-sidebar', '', false ) || $_REQUEST['sidebar'] == 'left' ) { ?>
							<div class="col-lg-9 col-md-12 col-sm-12 col-xs-12 order-lg-12 order-sm-12 rt-right-side">
						<?php } elseif ( 'shop-rightsidebar' === radiantthemes_global_var( 'shop-sidebar', '', false ) || $_REQUEST['sidebar'] == 'right' ) { ?>
							<div class="col-lg-9 col-md-12 col-sm-12 col-xs-12 order-lg-1 order-sm-1">
						<?php } else { ?>
							<div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
						<?php } ?>
					<?php } ?>
						<header class="woocommerce-products-header">
							<?php
							/**
							 * Woocommerce Archive Description hook.
							 * woocommerce_archive_description hook.
							 *
							 * @hooked woocommerce_taxonomy_archive_description - 10
							 * @hooked woocommerce_product_archive_description - 10
							 */
							do_action( 'woocommerce_archive_description' );
							?>
						</header>
						<?php if ( have_posts() ) : ?>
							<?php
								/**
								 * Woocommerce Before Shop Loop hook.
								 * woocommerce_before_shop_loop hook.
								 *
								 * @hooked wc_print_notices - 10
								 * @hooked woocommerce_result_count - 20
								 * @hooked woocommerce_catalog_ordering - 30
								 */
								do_action( 'woocommerce_before_shop_loop' );
							?>
							<?php if ( 'shop-topsidebar' === radiantthemes_global_var( 'shop-sidebar', '', false )  ) { ?>
								<div id="topsidebar" class="topsidebar">
									<?php dynamic_sidebar( 'radiantthemes-product-sidebar' ); ?>
								</div>
							<?php } ?>
							<?php
							$shoplisting="";
							if ( 'shop-gridview' === radiantthemes_global_var( 'shop-listing-view', '', false )  ) {
								$shoplisting="rt-grid-view";
							} else {
								$shoplisting="rt-list-view";
							}
							?>
							<div class="<?php echo esc_attr( $shoplisting ); ?>">
								<?php woocommerce_product_loop_start(); ?>

								<?php woocommerce_product_subcategories(); ?>

								<?php
									while ( have_posts() ) :
										the_post();
										?>

										<?php
											/**
											 * Woocommerce Shop Loop hook.
											 * woocommerce_shop_loop hook.
											 *
											 * @hooked WC_Structured_Data::generate_product_data() - 10
											 */
											do_action( 'woocommerce_shop_loop' );
										?>

										<?php
										/**
										 * The template for displaying product content within loops
										 *
										 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
										 *
										 * HOWEVER, on occasion WooCommerce will need to update template files and you
										 * (the theme developer) will need to copy the new files to your theme to
										 * maintain compatibility. We try to do this as little as possible, but it does
										 * happen. When this occurs the version of the template file will be bumped and
										 * the readme will list any important changes.
										 *
										 * @see     https://docs.woocommerce.com/document/template-structure/
										 * @author  WooThemes
										 * @package WooCommerce/Templates
										 * @version 3.0.0
										 */

										if ( ! defined( 'ABSPATH' ) ) {
											exit; // Exit if accessed directly.
										}

										global $product;

										// Ensure visibility.
										if ( empty( $product ) || ! $product->is_visible() ) {
											return;
										}
										wc_get_template_part( 'content', 'product' );
									endwhile; // end of the loop.
									?>
								<?php woocommerce_product_loop_end(); ?>
                            </div>
							<section>
								<?php
									/**
									 * Woocommerce After Shop Loop hook.
									 * woocommerce_after_shop_loop hook.
									 *
									 * @hooked woocommerce_pagination - 10
									 */
									do_action( 'woocommerce_after_shop_loop' );
								?>
								<?php
									elseif ( ! woocommerce_product_subcategories(
										array(
											'before' => woocommerce_product_loop_start( false ),
											'after'  => woocommerce_product_loop_end( false ),
										)
									) ) :
								?>
								<?php
									/**
									 * Woocommerce No Products Found hook.
									 * woocommerce_no_products_found hook.
									 *
									 * @hooked wc_no_products_found - 10
									 */
									do_action( 'woocommerce_no_products_found' );
								?>
							<?php endif; ?>
						<?php
							/**
							 * Woocommerce After Main Content hook.
							 * woocommerce_after_main_content hook.
							 *
							 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
							 */
							do_action( 'woocommerce_after_main_content' );
						?>
					</div>
					<?php if ( 'shop-nosidebar' === radiantthemes_global_var( 'shop-sidebar', '', false ) && ! $_REQUEST['sidebar'] || 'shop-topsidebar' === radiantthemes_global_var( 'shop-sidebar', '', false ) ) { ?>
					<?php } else { ?>
						<?php if ( 'shop-leftsidebar' === radiantthemes_global_var( 'shop-sidebar', '', false ) || $_REQUEST['sidebar'] == 'left' ) { ?>
							<div class="col-lg-3 col-md-12 order-lg-1  order-sm-1 rt-left-side widget-left">
						<?php } elseif ( 'shop-rightsidebar' === radiantthemes_global_var( 'shop-sidebar', '', false ) || $_REQUEST['sidebar'] == 'right' ) { ?>
							<div class="col-lg-3 col-md-12 col-sm-12 col-xs-12 order-lg-12 order-sm-12 widget-right">
						<?php } else { ?>
							<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
						<?php } ?>
							<aside id="secondary" class="widget-area">
							<?php
								/**
								 * Sidebar
								 */
								dynamic_sidebar( 'radiantthemes-product-sidebar' );
							?>
							</aside>
						</div>
					<?php } ?>
				</div>
				<!-- row -->
			</div>
		</div>
		<!-- wraper_shop_main -->
	<?php } ?>
<?php
get_footer( 'shop' );