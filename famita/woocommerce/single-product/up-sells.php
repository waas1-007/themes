<?php
/**
 * Single Product Up-Sells
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$show_product_upsells = famita_get_config('show_product_upsells', true);
if ( !$show_product_upsells ) {
    return;
}

global $product, $woocommerce_loop;

$per_page = famita_get_config('number_product_releated', 4);

$upsells = $product->get_upsell_ids();

if ( sizeof( $upsells ) == 0 ) {
	return;
}

$args = array(
	'post_type'           => 'product',
	'ignore_sticky_posts' => 1,
	'no_found_rows'       => 1,
	'posts_per_page'      => $per_page,
	'post__in'            => $upsells
);

$products = new WP_Query( $args );

$woocommerce_loop['columns'] = famita_get_config('releated_product_columns', 3);

if ( $products->have_posts() ) : ?>

	<div class="related products widget ">
		<div class="woocommerce">
			<h2 class="widget-title"><?php esc_html_e( 'You may also like&hellip;', 'famita' ) ?></h2>
			<?php wc_get_template( 'layout-products/carousel.php',array( 'loop'=>$products,'columns'=> $woocommerce_loop['columns'], 'posts_per_page'=> $products->post_count ) ); ?>
		</div>
	</div>
<?php endif;

wp_reset_postdata();