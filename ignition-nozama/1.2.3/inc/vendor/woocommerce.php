<?php
/**
 * WooCommerce related hooks and functions
 *
 * @since 1.0.0
 */

add_action( 'woocommerce_before_shop_loop_item', 'ignition_nozama_woocommerce_shop_loop_item_wrapper_start', 5 );
/**
 * Starts a wrapper on the shop loop item
 *
 * @since 1.0.0
 */
function ignition_nozama_woocommerce_shop_loop_item_wrapper_start() {
	?><div class="entry-item entry-item-product"><?php
}

add_action( 'woocommerce_after_shop_loop_item', 'ignition_nozama_woocommerce_shop_loop_item_wrapper_end', 50 );
/**
 * Ends the shop loop item wrapper
 *
 * @since 1.0.0
 */
function ignition_nozama_woocommerce_shop_loop_item_wrapper_end() {
	?></div><?php
}

/**
 * Returns the image size name that should be used by the AJAX products search.
 *
 * @since 1.0.0
 *
 * @return string
 */
function ignition_nozama_woocommerce_get_ajax_search_products_thumbnail_size() {
	/**
	 * Filters the image size name to be used by the AJAX products search.
	 *
	 * @since 1.0.0
	 *
	 * @param string
	 */
	return apply_filters( 'ignition_nozama_woocommerce_ajax_search_products_thumbnail_size', 'thumbnail' );
}

add_filter( 'woocommerce_product_data_store_cpt_get_products_query', 'ignition_nozama_woocommerce_product_query_custom_query_var', 10, 2 );
/**
 * Handle a custom search 's' query var to search products.
 *
 * @since 1.0.0
 *
 * @param array $query      Args for WP_Query.
 * @param array $query_vars Query vars from WC_Product_Query.
 *
 * @return array Modified $query
 */
function ignition_nozama_woocommerce_product_query_custom_query_var( $query, $query_vars ) {
	if ( ! empty( $query_vars['s'] ) ) {
		$query['s'] = $query_vars['s'];
	}

	return $query;
}

add_action( 'wp_ajax_ignition_nozama_search_products', 'ignition_nozama_woocommerce_ajax_products_search' );
add_action( 'wp_ajax_nopriv_ignition_nozama_search_products', 'ignition_nozama_woocommerce_ajax_products_search' );
/**
 * Ajax handler that searches and returns products.
 *
 * @since 1.0.0
 */
function ignition_nozama_woocommerce_ajax_products_search() {
	$s   = isset( $_REQUEST['s'] ) ? sanitize_text_field( wp_unslash( $_REQUEST['s'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification
	$cat = isset( $_REQUEST['product_cat'] ) ? sanitize_title_for_query( wp_unslash( $_REQUEST['product_cat'] ) ) : false; // phpcs:ignore WordPress.Security.NonceVerification

	/**
	 * Filters the maximum number of results returned by the AJAX products search.
	 *
	 * @since 1.0.0
	 *
	 * @param int
	 */
	$max_results = apply_filters( 'ignition_nozama_ajax_products_search_max_results', 5 );

	/**
	 * Filters the minimum amount of characters needed to trigger an AJAX products search.
	 *
	 * @since 1.0.0
	 *
	 * @param int
	 */
	$min_characters = apply_filters( 'ignition_nozama_ajax_products_search_min_chars', 3 );

	/**
	 * Filters the excerpt size (in words) returned for each result by the AJAX products search.
	 *
	 * @since 1.0.0
	 *
	 * @param int
	 */
	$excerpt_length = apply_filters( 'ignition_nozama_ajax_products_search_excerpt_length', 22 );

	if ( mb_strlen( $s ) < $min_characters ) {
		$response = array(
			'error'  => true,
			'errors' => array( __( 'Search term too short', 'ignition-nozama' ) ),
			'data'   => array(),
		);

		wp_send_json( $response );
	}

	$sku_match = wc_get_products( array(
		'limit'  => $max_results,
		'return' => 'ids',
		'sku'    => $s,
	) );

	$p_args = array(
		'limit'        => $max_results - count( $sku_match ),
		'status'       => 'publish',
		'stock_status' => 'instock',
		'return'       => 'ids',
		// This requires the ignition_nozama_woocommerce_product_query_custom_query_var() filter above.
		's'            => $s,
	);

	if ( ! empty( $cat ) ) {
		$p_args['category'] = $cat;
	}

	$p = wc_get_products( $p_args );

	$p = array_merge( $sku_match, $p );
	$p = array_unique( $p );

	if ( empty( $p ) ) {
		$response = array(
			'error'  => true,
			'errors' => array( __( 'No products matches the search term', 'ignition-nozama' ) ),
			'data'   => array(),
		);

		wp_send_json( $response );
	}

	$q_args = array(
		'post__in'            => $p,
		'post_type'           => 'product',
		'posts_per_page'      => $max_results,
		'ignore_sticky_posts' => true,
	);

	$q = new WP_Query( $q_args );

	$response = array(
		'error'  => false,
		'errors' => array(),
		'data'   => array(),
	);

	while ( $q->have_posts() ) {
		$q->the_post();

		$product = wc_get_product( get_the_ID() );

		$result = array(
			'title'   => html_entity_decode( get_the_title() ),
			'url'     => get_permalink(),
			'image'   => $product->get_image( ignition_nozama_woocommerce_get_ajax_search_products_thumbnail_size() ),
			'price'   => html_entity_decode( $product->get_price_html() ),
			'excerpt' => html_entity_decode( wp_trim_words( get_the_excerpt(), $excerpt_length ) ),
		);

		$response['data'][] = $result;
	}
	wp_reset_postdata();

	wp_send_json( $response );
}
