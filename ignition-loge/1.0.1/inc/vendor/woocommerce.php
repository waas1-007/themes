<?php
/**
 * WooCommerce related hooks and functions
 *
 * @since 1.0.0
 */

if ( ! class_exists( 'WooCommerce' ) ) {
	return;
}

remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
add_action( 'ignition_main_after', 'ignition_loge_woocommerce_upsell_display', 50 );
add_action( 'ignition_main_after', 'ignition_loge_woocommerce_output_related_products', 60 );

remove_action( 'woocommerce_before_single_product', 'woocommerce_output_all_notices', 10 );
add_action( 'ignition_main_before', 'ignition_loge_woocommerce_output_all_notices_single', 20 );
/**
 * Outputs all queued notices on WC pages.
 *
 * @since 1.0.0
 */
function ignition_loge_woocommerce_output_all_notices_single() {
	if ( ! is_product() ) {
		return;
	}

	?>
	<div class="container">
		<div class="row <?php ignition_the_main_width_row_classes(); ?>">
			<div class="<?php ignition_the_main_width_classes(); ?>">
				<?php woocommerce_output_all_notices(); ?>
			</div>
		</div>
	</div>
	<?php
}

add_action( 'woocommerce_before_template_part', 'ignition_loge_woocommerce_before_template_part', 10, 4 );
/**
 * Open a container wrapper before related/up-sell products.
 *
 * @since 1.0.0
 */
function ignition_loge_woocommerce_before_template_part( $template_name, $template_path, $located, $args ) {
	if ( ! in_array( $template_name, array( 'single-product/related.php', 'single-product/up-sells.php' ), true ) ) {
		return;
	}

	if ( ! empty( $args['related_products'] ) || ! empty( $args['upsells'] ) ) {
		?><div class="container"><?php
	}
}

add_action( 'woocommerce_after_template_part', 'ignition_loge_woocommerce_after_template_part', 10, 4 );
/**
 * Close the container wrapper after related/up-sell products.
 *
 * @since 1.0.0
 */
function ignition_loge_woocommerce_after_template_part( $template_name, $template_path, $located, $args ) {
	if ( ! in_array( $template_name, array( 'single-product/related.php', 'single-product/up-sells.php' ), true ) ) {
		return;
	}

	if ( ! empty( $args['related_products'] ) || ! empty( $args['upsells'] ) ) {
		?></div><?php
	}
}

/**
 * Output product up sells.
 *
 * @since 1.0.1
 */
function ignition_loge_woocommerce_upsell_display() {
	if ( ! is_product() ) {
		return;
	}

	woocommerce_upsell_display();
}

/**
 * Output the related products.
 *
 * @since 1.0.1
 */
function ignition_loge_woocommerce_output_related_products() {
	if ( ! is_product() ) {
		return;
	}

	woocommerce_output_related_products();
}
