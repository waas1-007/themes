<?php
/**
 * Shop Box Style Four Template
 *
 * @package dello
 */

?>
<!-- radiantthemes-shop-box style-four -->
<div <?php post_class( 'radiantthemes-shop-box matchHeight style-four' ); ?>>
	<div class="holder">
		<div class="pic">
			<div class="action-buttons">
				<div class="more-action">
					<?php
					if ( function_exists( 'tinv_array_merge' ) ) {
						echo do_shortcode( '[ti_wishlists_addtowishlist]' );
					}
					if ( function_exists( 'yit_maybe_plugin_fw_loader' ) ) {
						echo do_shortcode( '[yith_quick_view label="<span>Quick View</span>"]' );
					}
					?>
				</div>
				<?php
				if ( $product->is_type( 'variable' ) ) {
					echo '<a class="rt-add-to-cart" href="' . $product->add_to_cart_url() . '"><i class="lnr-cart"></i></a>';
				} elseif ( $product->is_type( 'grouped' ) || $product->is_type( 'external' ) ) {
					echo '<div class="rt-add-to-cart">';
					do_action( 'woocommerce_after_shop_loop_item' );
					echo '</div>';
				} else {
					echo '<div class="rt-add-to-cart">';
					do_action( 'radiantthemes_simple_add_to_cart' );
					echo '</div>';
				}
				?>
			</div>
			<a href="<?php echo get_permalink(); ?>">
				<img class="primary-img" src="<?php the_post_thumbnail_url( 'shop_single' ); ?>" alt="Product Image">
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

				do_action( 'woocommerce_after_shop_loop_item_title' );
				?>
				<div class="meta-wrapper">
					<?php radiantthemes_shop_color(); ?>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- radiantthemes-shop-box style-four -->
