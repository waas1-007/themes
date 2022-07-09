<?php global $woocommerce; ?>
<div class="apus-topcart">
 	<div class="cart">
        <a class="dropdown-toggle mini-cart" href="<?php echo get_permalink( wc_get_page_id( 'cart' ) ); ?>" title="<?php esc_attr_e('View your shopping cart', 'famita'); ?>">
            <i class="icon_cart_alt"></i>
            <span class="count"><?php echo sprintf($woocommerce->cart->cart_contents_count); ?></span>
        </a>
    </div>
</div>