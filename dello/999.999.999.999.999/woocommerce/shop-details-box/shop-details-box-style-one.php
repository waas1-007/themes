<?php
/**
 * Shop Details Box Style One Template
 *
 * @package
 */

if ( ! defined( 'ABSPATH' ) ) {
		exit; // Exit if accessed directly.
} ?>

<?php
while ( have_posts() ) :
	the_post();
	?>
	<!-- shop_single -->
	<div id="product-<?php the_ID(); ?>" <?php post_class( 'shop_single' ); ?>>
		<?php do_action( 'woocommerce_before_single_product' ); ?>
		<div class="rt-product-gallery">
			<!-- START OF PRODUCT IMAGE / GALLERY -->
			<?php do_action( 'woocommerce_before_single_product_summary' ); ?>
			<!-- END OF PRODUCT IMAGE / GALLERY -->
		</div>
		<!-- START OF PRODUCT SUMMARY -->
		<div class="summary entry-summary">
			<div class="rt-single-product-breadcrumb">
				<?php radiantthemes_breadcrumbs(); ?>
			</div>
			<?php
			$terms = get_the_terms( $post->ID, 'brand' );
			if ( $terms && ! is_wp_error( $terms ) ) :
				//only displayed if the product has at least one category
				$cat_links = array();
				foreach ( $terms as $term ) {
					$cat_links[] = $term->name;
				}
				$on_cat = join( ' ', $cat_links );
				echo '<p class="product-brand">' . $on_cat . '</p>';
			endif;
			?>
			<?php do_action( 'woocommerce_single_product_summary' ); ?>
		</div>
		<!-- END OF PRODUCT SUMMARY -->
		<div class="clearfix"></div>
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
							<a class="<?php echo esc_attr( $key ); ?> nav-link <?php if ( 1 == $i ) { echo esc_html( 'active' ); } ?>" data-toggle="tab" href="#tab-<?php echo esc_attr( $key ); ?>" role="tab" aria-controls="tab-<?php echo esc_attr( $key ); ?>" aria-selected="true">
								<p>
									<?php echo esc_html( apply_filters( 'woocommerce_product_' . $key . '_tab_title', $tab['title'], $key ) ); ?>
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
						<div class="<?php echo esc_attr( $key ); ?> tab-pane fade <?php if ( 1 == $i ) { echo esc_attr( ' active show' ); } ?>" id="tab-<?php echo esc_attr( $key ); ?>" role="tabpanel">
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
	</div>
	<!-- shop_single -->
	<?php woocommerce_output_related_products(); ?>
<?php endwhile; ?>
