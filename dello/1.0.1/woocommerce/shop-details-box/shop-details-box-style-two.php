<?php
	/**
	 * Shop Details Box Style Two Template
	 *
	 * @package dello
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
						<?php
							do_action( 'woocommerce_before_single_product' );
						?>
						<div class="rt-product-gallery rt-left-side">

							<!-- START OF PRODUCT IMAGE / GALLERY -->
							<?php do_action( 'woocommerce_before_single_product_summary' ); ?>
							</div>
							<!-- END OF PRODUCT IMAGE / GALLERY -->
							<!-- START OF PRODUCT SUMMARY -->
							<div class="summary entry-summary rt-content-summary rt-right-side">
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
								<?php
								$tabs = apply_filters( 'woocommerce_product_tabs', array() );
								if ( ! empty( $tabs ) ) :
									?>
								<!-- shop_single_accordion -->
								<div class="shop_single_accordion">
									<?php
									$i = 0;
									foreach ( $tabs as $key => $tab ) :
										$i++;
										?>
									<!-- shop_single_accordion_item -->
									<div class="shop_single_accordion_item">
										<button class="btn" type="button" data-toggle="collapse" data-target="#accordion-<?php echo esc_attr( $key ); ?>" aria-expanded="
																																	<?php
																																	if ( 1 == $i ) {
																																		echo esc_attr( 'true' );
																																	} else {
																																		echo esc_attr( 'false' ); }
																																	?>
										">
											<?php echo esc_html( apply_filters( 'woocommerce_product_' . $key . '_tab_title', $tab['title'], $key ) ); ?>
										</button>
										<div class="collapse
										<?php
										if ( 1 == $i ) {
											echo esc_attr( 'in' ); }
										?>
										" id="accordion-<?php echo esc_attr( $key ); ?>">
											<?php
											if ( isset( $tab['callback'] ) ) {
												call_user_func( $tab['callback'], $key, $tab );
											}
											?>
										</div>
									</div>
									<!-- shop_single_accordion_item -->
									<?php endforeach; ?>
								</div>
								<!-- shop_single_accordion -->
								<?php endif; ?>
							</div>
							<!-- END OF PRODUCT SUMMARY -->
						</div>
						<!-- shop_single -->
						<div class="clearfix"></div>
						<?php woocommerce_output_related_products(); ?>
					<?php endwhile; ?>
					
					