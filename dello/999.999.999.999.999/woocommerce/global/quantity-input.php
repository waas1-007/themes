<?php
/**
 * Product quantity inputs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/quantity-input.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.0.0
 */

defined( 'ABSPATH' ) || exit;

if ( $max_value && $min_value === $max_value ) {
	?>
	<input type="hidden" name="<?php echo esc_attr( $input_name ); ?>" value="<?php echo esc_attr( $min_value ); ?>" />
	<?php
} else {
	?>
	<div class="quantity">
		<div class="minus"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus"><line x1="5" y1="12" x2="19" y2="12"></line></svg></div>
		<input type="number" step="<?php echo esc_attr( $step ); ?>" min="<?php echo esc_attr( $min_value ); ?>" max="<?php echo esc_attr( 0 < $max_value ? $max_value : '' ); ?>" name="<?php echo esc_attr( $input_name ); ?>" value="<?php echo esc_attr( $input_value ); ?>" title="<?php echo esc_attr_x( 'Qty', 'Product quantity input tooltip', 'dello' ) ?>" class="input-text qty text" inputmode="<?php echo esc_attr( $inputmode ); ?>" />
		<div class="plus"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg></div>

	</div>
	<?php
}
