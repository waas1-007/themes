<?php
/**
 * Shop Box Style Six Template
 *
 * @package dello
 */

?>

<!-- radiantthemes-shop-box style-six -->
<div <?php post_class( 'radiantthemes-shop-box matchHeight style-six' ); ?>>
	<div class="holder">
		<div class="pic">
			<div class="action-buttons">
				<div class="button-area"><?php echo do_shortcode( '[ti_wishlists_addtowishlist]' ); ?></div>
				<div class="button-area quick-view"><?php echo do_shortcode( '[yith_quick_view label="<span>Quick View</span>"]' ); ?><span class="extraquickview"><?php echo esc_html__( 'Quick view', 'dello' ); ?></span></div>
				<div class="button-area">
					<a href="<?php echo esc_url( $product->add_to_cart_url() ); ?>" class="rt-add-to-cart">
						<span>
						<?php
						if ( $product->is_type( 'variable' ) ) {
							echo esc_html__( 'Select Options', 'dello' );
						} else {
							echo esc_html__( 'Add to Cart', 'dello' );
						}
						?>
						</span>
					</a>
				</div>
			</div>
			<?php
			if ( $product->is_on_sale() && ! is_admin() && ! $product->is_type( 'variable' ) ) {
				// Get product prices
				$regular_price = (float) $product->get_regular_price(); // Regular price
				$sale_price    = (float) $product->get_price(); // Active price (the "Sale price" when on-sale)

				// "Saving price" calculation and formatting
				$saving_price  = $regular_price - $sale_price;
				$saving_price1 = ( $saving_price * 100 ) / $regular_price;
				$saving_price1 = round( $saving_price1 );
				echo '<div class="offer">' . $saving_price1 . ' % Off</div>';
			}
			?>
			<a href="<?php echo get_permalink( $product->get_id() ); ?>">
				<img class="primary-img" src="<?php the_post_thumbnail_url( 'woocommerce_thumbnail' ); ?>" alt="No Image Found">
				<img class="primary-hover-img" src="<?php the_field( 'product_image_for_hover' ); ?>" alt="Product Image">
			</a>
		</div>
		<div class="product-description">
			<div class="product-description-inner ">
				<?php
				/**
				 * Woocommerce Shop Loop Item Title hook.
				 * woocommerce_shop_loop_item_title hook.
				 *
				 * @hooked woocommerce_template_loop_product_title - 10
				 */
				do_action( 'woocommerce_shop_loop_item_title' );
				?>
				<?php do_action( 'woocommerce_after_shop_loop_item_title' ); ?>
				<?php
				if ( $average = $product->get_average_rating() ) :
					echo '<div class="star-rating" title="' . sprintf( __( 'Rated %s out of 5', 'dello' ), $average ) . '"><span style="width:' . ( ( $average / 5 ) * 100 ) . '%"><strong itemprop="ratingValue" class="rating">' . $average . '</strong> ' . __( 'out of 5', 'dello' ) . '</span></div>';
				endif;
				?>
				<div class="meta-wrapper">
					<?php radiantthemes_shop_color(); ?>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- radiantthemes-shop-box style-six -->
