<?php
/**
 * Shop Details Box Style Four Template
 *
 * @package dello
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<?php
while ( have_posts() ) :
	the_post();
	?>
	<!-- shop_single -->
	<div id="product-<?php the_ID(); ?>" <?php post_class( 'shop_single' ); ?>>
		<?php do_action( 'woocommerce_before_single_product' ); ?>
		<div class="rt-product-gallery rt-left-side">
			<!-- START OF PRODUCT IMAGE / GALLERY -->
			<?php do_action( 'woocommerce_before_single_product_summary' ); ?>
			<!-- END OF PRODUCT IMAGE / GALLERY -->
		</div>
		<!-- START OF PRODUCT SUMMARY -->
		<div class="summary entry-summary rt-right-side">
			<div class="rt-single-product-breadcrumb">
				<?php woocommerce_breadcrumb(); ?>
			</div>
			<?php do_action( 'woocommerce_single_product_summary' ); ?>
		</div>
		<!-- END OF PRODUCT SUMMARY -->
		<div class="clearfix"></div>
	</div>
	<!-- shop_single -->
	<?php
	$tabs = apply_filters( 'woocommerce_product_tabs', array() );
	if ( ! empty( $tabs ) ) :
		?>
		<!-- shop_single_tabs -->
		<div class="shop_single_tabs">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<?php
				$i = 0;
				foreach ( $tabs as $key => $tab ) :
					$i++;
					?>
					<li class="nav-item waves-effect waves-light">
						<a class="<?php echo esc_attr( $key ); ?> nav-link
											<?php
											if ( 1 == $i ) {
												echo esc_html( 'active' ); }
											?>
						" data-toggle="tab" href="#tab-<?php echo esc_attr( $key ); ?>" role="tab" aria-controls="tab-<?php echo esc_attr( $key ); ?>" aria-selected="true">
							<p>
								<?php
								echo esc_html( apply_filters( 'woocommerce_product_' . $key . '_tab_title', $tab['title'], $key ) );
								?>
							</p>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
			<div class="tab-content" id="myTabContent">
				<?php
				$i = 0;
				foreach ( $tabs as $key => $tab ) :
					$i++;
					?>
					<div class="<?php echo esc_attr( $key ); ?> tab-pane fade
						<?php
						if ( 1 == $i ) {
							echo esc_attr( ' active show' ); }
						?>
						" id="tab-<?php echo esc_attr( $key ); ?>" role="tabpanel">
						<?php
						if ( isset( $tab['callback'] ) ) {
							call_user_func( $tab['callback'], $key, $tab ); }
						?>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
		<!-- shop_single_tabs -->
	<?php endif; ?>
	<?php woocommerce_output_related_products(); ?>
<?php endwhile; ?>
