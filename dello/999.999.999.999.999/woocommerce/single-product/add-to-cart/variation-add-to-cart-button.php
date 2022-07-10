<?php
/**
 * Single variation cart button
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */
defined( 'ABSPATH' ) || exit;
global $product;
$id = $product->get_id();
if ( ! class_exists( 'Redux' ) || ( is_404() ) || ( is_search() ) ) {
} else {
	$sizechart_id = esc_html( get_post_meta( $id, 'size_chart', true ) );
	if ( ! did_action( 'elementor/loaded' ) && $sizechart_id ) {
		wp_reset_query();
		$template = get_page_by_path( $sizechart_id, OBJECT, 'elementor_library' );
		echo "<div class='rt-size-chart'>";
		echo "<button type='button' class='btn btn-info btn-lg' data-toggle='modal' data-target='#rtsizechart'>Size Chart</button>";
		echo '</div>';
	} else {
	}
}
?>
<div class="woocommerce-variation-add-to-cart variations_button">
	<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
	<?php
	do_action( 'woocommerce_before_add_to_cart_quantity' );
	woocommerce_quantity_input(
		array(
			'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
			'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
			'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
		)
	);
	do_action( 'woocommerce_after_add_to_cart_quantity' );
	?>
	<button type="submit" class="single_add_to_cart_button button alt"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>
	<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
	<input type="hidden" name="add-to-cart" value="<?php echo absint( $product->get_id() ); ?>" />
	<input type="hidden" name="product_id" value="<?php echo absint( $product->get_id() ); ?>" />
	<input type="hidden" name="variation_id" class="variation_id" value="0" />
</div>
<!-- Modal -->
<?php if ( did_action( 'elementor/loaded' ) ) { ?>
	<div id="rtsizechart" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<?php echo Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $template->ID ); ?>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
<?php } ?>
