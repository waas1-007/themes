<?php
/**
 * Shop Box Style Three Template
 *
 * @package dello
 */
?>

<!-- radiantthemes-shop-box style-three -->
<div <?php post_class( 'radiantthemes-shop-box matchHeight style-three' ); ?>>
	<div class="holder">
		<div class="pic">
			<div class="action-buttons">
				<?php echo do_shortcode( '[ti_wishlists_addtowishlist]' ); ?>
				<?php echo do_shortcode( '[yith_quick_view label="<span>Quick View</span>"]' ); ?>
				<a class="rt-add-to-cart"  href="<?php echo esc_url( $product->add_to_cart_url() ); ?>"><i class="lnr-cart"></i></a>
			</div>
			<a href="<?php echo get_permalink( $product->get_id() ); ?>"><img class="primary-img" src="<?php the_post_thumbnail_url( 'woocommerce_thumbnail' ); ?>" alt="Product Image">
				<img class="primary-hover-img" src="
				<?php
				the_field( 'product_image_for_hover' );
				?>
				" alt="Product Image">
			</a>
		</div>
		<div class="product-description">
			<div class="product-description-inner ">
				<?php
				if ( $average = $product->get_average_rating() ) :
					echo '<div class="star-rating" title="' . sprintf( __( 'Rated %s out of 5', 'dello' ), $average ) . '"><span style="width:' . ( ( $average / 5 ) * 100 ) . '%"><strong itemprop="ratingValue" class="rating">' . $average . '</strong> ' . __( 'out of 5', 'dello' ) . '</span></div>';
				endif;
				?>
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
				<div class="meta-wrapper">
					<?php radiantthemes_shop_color(); ?>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- radiantthemes-shop-box style-three -->
