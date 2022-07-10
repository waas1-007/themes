<?php
	/**
	 * Shop Details Box Style Six Template
	 *
	 * @package
	 */

if ( ! defined( 'ABSPATH' ) ) {
		exit; // Exit if accessed directly.
} ?>


					<?php
					while ( have_posts() ) :
						the_post();
						?>
						<!-- shop_single -->
						<div id="product-<?php the_ID(); ?>" <?php post_class( 'shop_single' ); ?>>
						<div class="container">
						<!-- row -->
						<div class="row">

							<?php
							do_action( 'woocommerce_before_single_product' );
							?>
							
							<!-- START OF PRODUCT SUMMARY -->
							<div class="summary entry-summary">
							<div class="rt-single-product-breadcrumb">
							<?php radiantthemes_breadcrumbs(); ?>
							</div>
							<?php 
							$terms = get_the_terms( $post->ID, 'brand' );
								if ( $terms && ! is_wp_error( $terms ) ) :
								//only displayed if the product has at least one category
								$cat_links = array();
								foreach ( $terms as $term ) {
								$cat_links[] = $term->name;
								}
								$on_cat = join( " ", $cat_links );
                           echo '<p class="product-brand">'.$on_cat.'</p>';
						   endif;
						   ?>
						  
								<?php do_action( 'woocommerce_single_product_summary' ); ?>
							</div>
							<!-- END OF PRODUCT SUMMARY -->
							<div class="rt-product-gallery">
							<div class="product-gallery-container">
							<?php if( $product->is_on_sale() && ! is_admin() && ! $product->is_type('variable')){
						// Get product prices
						$regular_price = (float) $product->get_regular_price(); // Regular price
						$sale_price = (float) $product->get_price(); // Active price (the "Sale price" when on-sale)

						// "Saving price" calculation and formatting
						$saving_price =  $regular_price - $sale_price ;
						$saving_price1= ($saving_price * 100)/ $regular_price;
						$saving_price1=round($saving_price1);
					echo '<div class="offer">'.$saving_price1.'% Off</div>';


						}?>
							<div class="swiper-container rt-gallery-main">
							<div class="swiper-wrapper">
							
							<?php
							global $product;
							$attachment_ids = $product->get_gallery_image_ids();
							foreach( $attachment_ids as $attachment_id ) { ?>
							<?php
							$image_link = wp_get_attachment_url( $attachment_id );
							?>
							
							<div class="swiper-slide">
							
							<img src="<?php echo esc_url( $image_link);?>" alt="<?php echo esc_html__( 'woo-gallery', 'dello' ); ?>">
							</div>
							<?php } ?>

							</div>

							<div class="swiper-pagination"></div>
							<div class="swiper-button-next"></div>
							<div class="swiper-button-prev"></div>
							</div>
							</div>
							
							
							
							
							
							<!-- START OF PRODUCT IMAGE / GALLERY -->
							<?php //do_action( 'woocommerce_before_single_product_summary' ); ?>
							<!-- END OF PRODUCT IMAGE / GALLERY -->
							</div>
							</div>
							<!-- row -->
							</div>
							
						</div>
						<!-- shop_single -->
						<?php
							$tabs = apply_filters( 'woocommerce_product_tabs', array() );
							if ( ! empty( $tabs ) ) :
								?>
								<!-- shop_single_tabs -->
								<div class="shop_single_tabs">
								<div class="container">
						        <div class="row">
									<ul class="nav nav-tabs" id="myTab" role="tablist">
										<?php
										$i = 0;
										foreach ( $tabs as $key => $tab ) :
											$i++;
											?>
											<li class="nav-item waves-effect waves-light">
												<a class="<?php echo esc_attr( $key ); ?> nav-link
												<?php
												if ( 1 == $i ) {
													echo esc_html( 'active' ); }
												?>
											" data-toggle="tab" href="#tab-<?php echo esc_attr( $key ); ?>" role="tab"
				  aria-controls="tab-<?php echo esc_attr( $key ); ?>" aria-selected="true"><p>
													<?php echo esc_html( apply_filters( 'woocommerce_product_' . $key . '_tab_title', $tab['title'], $key ) ); ?></p></a>

											</li>
										<?php endforeach; ?>
									</ul>
									<div class="tab-content" id="myTabContent">
										<?php
										$i = 0;
										foreach ( $tabs as $key => $tab ) :
											$i++;
											?>
											<div class="<?php echo esc_attr( $key ); ?> "  role="tabpanel">

												<?php
												if ( isset( $tab['callback'] ) ) {
													call_user_func( $tab['callback'], $key, $tab ); }
												?>
											</div>
										<?php endforeach; ?>
									</div>
								</div>
								</div>
								</div>
								
								<!-- shop_single_tabs -->
							<?php endif; ?>
							<div class="container">
						<?php 
						
						woocommerce_output_related_products(); ?>
						</div>
					<?php endwhile;

 				?>
                   