<?php
/**
 * Shop Box Style Seven Template
 *
 * @package dello
 */

?>

<!-- radiantthemes-shop-box style-seven -->
<div <?php post_class( 'radiantthemes-shop-box matchHeight style-seven ' ); ?>>
	<div class="holder">
		<div class="pic">
			<div class="product-image" style="background-image:url(<?php the_post_thumbnail_url( 'woocommerce_thumbnail' ); ?>)"></div>
			<a class="overlay" href="<?php the_permalink(); ?>"></a>
		</div>
		<div class="data">
			<a href="<?php the_permalink(); ?>"><h5><?php the_title();?></h5></a>
			<div class="price-box-holder">
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
			/**
			 * Woocommerce After Shop Loop Item Title hook.
			 * woocommerce_after_shop_loop_item_title hook.
			 *
			 * @hooked woocommerce_template_loop_rating - 5
			 * @hooked woocommerce_template_loop_price - 10
			 */
			do_action( 'woocommerce_after_shop_loop_item_title' );
			?>
				<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
			</div>
		</div>
	</div>
</div>
<!-- radiantthemes-shop-box style-seven -->
