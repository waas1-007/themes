<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 4.4.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' ); ?>

<!-- radiantthemes-cart -->
<div class="row radiantthemes-cart">
	<div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
		<!-- woocommerce-cart-form -->
		<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
			<?php do_action( 'woocommerce_before_cart_table' ); ?>

			<table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
				<thead>
					<tr>
						
						<th class="product-thumbnail">&nbsp;</th>
						<th class="product-name"><?php esc_html_e( 'Product', 'dello' ); ?></th>
						<th class="product-price"><?php esc_html_e( 'Price', 'dello' ); ?></th>
						<th class="product-quantity"><?php esc_html_e( 'Quantity', 'dello' ); ?></th>
						<th class="product-subtotal"><?php esc_html_e( 'Total', 'dello' ); ?></th>
						<th class="product-remove">&nbsp;</th>
					</tr>
				</thead>
				<h4><?php esc_attr_e( 'Cart Items', 'dello' ); ?></h4>
				<tbody>
					<?php do_action( 'woocommerce_before_cart_contents' ); ?>

					<?php
					foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
						$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
						$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

						if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
							$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
							?>
							<tr class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

							

								<td class="product-thumbnail">
								
									<?php
									$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

									if ( ! $product_permalink ) {
										echo wp_kses( $thumbnail, 'post' );
									} else {
										printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail );
									}
									?>
								</td>

								<td class="product-details" data-title="<?php esc_attr_e( 'Product Details', 'dello' ); ?>">
									<div class="row">
    <div class="col-md-6 col-sm-12 product-name" data-title="Product">
       <?php
									if ( ! $product_permalink ) {
										echo wp_kses( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;', 'post' );
									} else {
										echo wp_kses( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ), 'post' );
									}

									do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );
									?>
       
        <div class="product-price" data-title="Price">
         <?php
									echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
									?>
        </div>
        <?php echo wc_get_formatted_cart_item_data( $cart_item );
		if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
										echo wp_kses( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'dello' ) . '</p>', $product_id ), 'post' );
									}
		?>
        <div class="product-quantity" data-title="Quantity">
            
<?php
									if ( $_product->is_sold_individually() ) {
										$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
									} else {
										$product_quantity = woocommerce_quantity_input( array(
											'input_name'   => "cart[{$cart_item_key}][qty]",
											'input_value'  => $cart_item['quantity'],
											'max_value'    => $_product->get_max_purchase_quantity(),
											'min_value'    => '0',
											'product_name' => $_product->get_name(),
										), $_product, false );
									}

									echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
									?>

			
        </div>
    </div>
   
    <div class="product-subtotal col-md-6" data-title="Subtotal">
    <?php
									echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
									?>
    </div>
    <div class="product-remove ">
       <?php
										// @codingStandardsIgnoreLine
									echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
										'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s"><div class="button-content-wrapper"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg></div></a>',
										esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
										__( 'Remove this item', 'dello' ),
										esc_attr( $product_id ),
										esc_attr( $_product->get_sku() )
									), $cart_item_key );
									?>
    </div>
	
</div>


								</td>

								

								

								
							</tr>
							<?php
						}
					}
					?>

					<?php do_action( 'woocommerce_cart_contents' ); ?>

					<tr>
						<td colspan="6" class="actions">

							<?php if ( wc_coupons_enabled() ) { ?>
								<div class="coupon">
									<label for="coupon_code"><?php esc_html_e( 'Coupon:', 'dello' ); ?></label> <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'dello' ); ?>" /> <button type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'dello' ); ?>"><?php esc_attr_e( 'Apply coupon', 'dello' ); ?></button>
									<?php do_action( 'woocommerce_cart_coupon' ); ?>
								</div>
							<?php } ?>

							<button type="submit" class="button" name="update_cart" id="update_cart" enabled="" value="<?php esc_attr_e( 'Update cart', 'dello' ); ?>"><?php esc_html_e( 'Update cart', 'dello' ); ?></button>

							<?php do_action( 'woocommerce_cart_actions' ); ?>

							<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
						</td>
					</tr>

					<?php do_action( 'woocommerce_after_cart_contents' ); ?>
				</tbody>
			</table>
			<?php do_action( 'woocommerce_after_cart_table' ); ?>
		</form>
		<!-- woocommerce-cart-form -->
	</div>
	<!--<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
		<?php //woocommerce_cross_sell_display() ; ?>
		
	</div>-->
	<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">

		
		<!-- cart-collaterals -->
		<div class="cart-collaterals">
			<?php woocommerce_cart_totals(); ?>
		</div>
		<!-- cart-collaterals -->
	</div>
</div>
<!-- radiantthemes-cart -->

<?php do_action( 'woocommerce_after_cart' ); ?>
