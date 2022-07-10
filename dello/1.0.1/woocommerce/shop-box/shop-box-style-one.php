<?php
/**
 * Shop Box Style One Template
 *
 * @package dello
 */
?>
<!-- radiantthemes-shop-box style-one -->
<div <?php post_class( 'radiantthemes-shop-box matchHeight style-one' ); ?>>
	<div class="holder">
		<?php if ( $product->is_on_sale() ) { ?>
			<?php echo apply_filters( 'woocommerce_sale_flash', '<span class="onsale">' . esc_html__( 'Sale!', 'dello' ) . '</span>', $post, $product ); ?>
		<?php } ?>
		<div class="pic">
			<a href="<?php the_permalink(); ?> "><img src="<?php the_post_thumbnail_url( 'woocommerce_thumbnail' ); ?>" alt="No Image Found"></a>
		</div>
		<div class="product-description">
			<div class="product-description-inner">
				<div class="action-buttons">
					<?php echo do_shortcode( '[ti_wishlists_addtowishlist]' ); ?>
					<?php echo do_shortcode( '[yith_quick_view label="<span>Quick View</span>"]' ); ?>
				</div>
				<?php
				/**
				 * Woocommerce Before Shop Loop Item hook.
				 * woocommerce_before_shop_loop_item hook.
				 *
				 * @hooked woocommerce_template_loop_product_link_open - 10
				 */
				do_action( 'woocommerce_before_shop_loop_item' );
				?>
				<?php
				if ( $average = $product->get_average_rating() ) :
					echo '<div class="star-rating" title="' . sprintf( __( 'Rated %s out of 5', 'dello' ), $average ) . '"><span style="width:' . ( ( $average / 5 ) * 100 ) . '%"><strong itemprop="ratingValue" class="rating">' . $average . '</strong> ' . __( 'out of 5', 'dello' ) . '</span></div>';
				endif;
				?>
				<a href="<?php echo get_permalink(); ?>">
					<?php
					/**
					 * Woocommerce Shop Loop Item Title hook.
					 * woocommerce_shop_loop_item_title hook.
					 *
					 * @hooked woocommerce_template_loop_product_title - 10
					 */
					do_action( 'woocommerce_shop_loop_item_title' );
					?>
				</a>
				<?php do_action( 'woocommerce_after_shop_loop_item_title' ); ?>
				<div class="meta-wrapper">
					<?php radiantthemes_shop_color(); ?>
				</div>
				<?php
				if ( $product->is_type( 'variable' ) ) {
					?>
					<div class="add-bag"><a href="<?php echo esc_url( $product->add_to_cart_url() ); ?>"><?php echo esc_html__( 'Select Options', 'dello' ); ?></a></div>
				<?php } else { ?>
					<div class="add-bag"><a href="<?php echo esc_url( $product->add_to_cart_url() ); ?>"><?php echo esc_html__( 'Add to Cart', 'dello' ); ?></a></div>
					<?php
				}
				?>
			</div>
		</div>
	</div>
</div>
<!-- radiantthemes-shop-box style-one -->
