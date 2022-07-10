<?php
/**
 * Checkout coupon form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-coupon.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.4
 */

defined( 'ABSPATH' ) || exit;


if ( ! wc_coupons_enabled() ) { // @codingStandardsIgnoreLine.
	return;
}

?>
<div class="rt-login-coupon">
<?php 
if ( is_user_logged_in() ) { }
else { ?>
<div class="rt-login">
<div class="woocommerce-form-login-toggle">
	<?php wc_print_notice( apply_filters( 'woocommerce_checkout_login_message', esc_html__( 'Returning customer?', 'dello' ) ) . ' <a href="#" class="showlogin">' . esc_html__( 'Click here to login', 'dello' ) . '</a>', 'notice' ); ?>

</div>
<div class="rt-login-form">
<?php

woocommerce_login_form(
	array(
		'message'  => esc_html__( 'If you have shopped with us before, please enter your details below. If you are a new customer, please proceed to the Billing section.', 'dello' ),
		'redirect' => wc_get_checkout_url(),
		'hidden'   => true,
	)
);
?>
</div>
</div>
<?php }?>
<div class="rt-coupon">
<div class="woocommerce-form-coupon-toggle">
	<?php wc_print_notice( apply_filters( 'woocommerce_checkout_coupon_message', esc_html__( 'Have a coupon?', 'dello' ) . ' <a href="#" class="showcoupon">' . esc_html__( 'Click here to enter your code', 'dello' ) . '</a>' ), 'notice' ); ?>
</div>

<form class="checkout_coupon woocommerce-form-coupon" method="post" style="display:none">

	<p><?php esc_html_e( 'If you have a coupon code, please apply it below.', 'dello' ); ?></p>

	<p class="form-row form-row-first">
		<input type="text" name="coupon_code" class="input-text" placeholder="<?php esc_attr_e( 'Coupon code', 'dello' ); ?>" id="coupon_code" value="" />
	</p>

	<p class="form-row form-row-last">
		<button type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'dello' ); ?>"><?php esc_html_e( 'Apply coupon', 'dello' ); ?></button>
	</p>

	<div class="clear"></div>
</form>
</div>
</div>

