<?php
/**
 * Custom template tags and hooks
 *
 * @since 1.0.0
 */

/**
 * Displays the header AJAX search.
 *
 * @since 1.0.0
 */
function ignition_decorist_the_header_ajax_search() {
	if ( ! class_exists( 'WooCommerce' ) ) {
		return;
	}

	$ajax_class   = '';
	$autocomplete = 'on';
	$defaults     = ignition_decorist_ignition_customizer_defaults( 'all' );

	if ( get_theme_mod( 'theme_ajax_product_search_ajax_is_enabled', $defaults['theme_ajax_product_search_ajax_is_enabled'] ) ) {
		$ajax_class   = 'form-ajax-enabled';
		$autocomplete = 'off';
	}

	$show_thumb   = (bool) get_theme_mod( 'theme_ajax_product_search_thumbnail_is_visible', $defaults['theme_ajax_product_search_thumbnail_is_visible'] );
	$show_excerpt = (bool) get_theme_mod( 'theme_ajax_product_search_excerpt_is_visible', $defaults['theme_ajax_product_search_excerpt_is_visible'] );
	$show_price   = (bool) get_theme_mod( 'theme_ajax_product_search_price_is_visible', $defaults['theme_ajax_product_search_price_is_visible'] );
	?>
	<div class="head-search-form-wrap">
		<form class="category-search-form <?php echo esc_attr( $ajax_class ); ?>" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
			<label for="category-search-name" class="sr-only" >
				<?php esc_html_e( 'Category name', 'ignition-decorist' ); ?>
			</label>

			<?php
				wp_dropdown_categories( array(
					'taxonomy'          => 'product_cat',
					'show_option_none'  => esc_html__( 'Search all categories', 'ignition-decorist' ),
					'option_none_value' => '',
					'value_field'       => 'slug',
					'hide_empty'        => 1,
					'echo'              => 1,
					'hierarchical'      => 1,
					'name'              => 'product_cat',
					'id'                => 'category-search-name',
					'class'             => 'category-search-select',
				) );
			?>

			<div class="category-search-input-wrap">
				<label for="category-search-input" class="sr-only">
					<?php esc_html_e( 'Search products:', 'ignition-decorist' ); ?>
				</label>
				<input
					type="text"
					class="category-search-input"
					id="category-search-input"
					placeholder="<?php esc_attr_e( 'What are you looking for?', 'ignition-decorist' ); ?>"
					name="s"
					autocomplete="<?php echo esc_attr( $autocomplete ); ?>"
				/>

				<ul class="category-search-results">
					<li class="category-search-results-item">
						<a href="">
							<?php if ( $show_thumb ) : ?>
								<div class="category-search-results-item-thumb">
									<img src="<?php echo esc_url( wc_placeholder_img_src( ignition_decorist_woocommerce_get_ajax_search_products_thumbnail_size() ) ); ?>" alt="<?php esc_attr_e( 'Search result item thumbnail' ); ?>">
								</div>
							<?php endif; ?>

							<div class="category-search-results-item-content">
								<p class="category-search-results-item-title"></p>
								<?php if ( $show_price ) : ?>
									<p class="category-search-results-item-price"></p>
								<?php endif; ?>
								<?php if ( $show_excerpt ) : ?>
									<p class="category-search-results-item-excerpt"></p>
								<?php endif; ?>
							</div>
						</a>
					</li>
				</ul>
				<span class="category-search-spinner"></span>
				<input type="hidden" name="post_type" value="product" />
			</div>

			<button type="submit" class="category-search-btn">
				<span class="ignition-icons ignition-icons-search"></span><span class="sr-only"><?php echo esc_html_x( 'Search', 'submit button', 'ignition-decorist' ); ?></span>
			</button>
		</form>
	</div>
	<?php
}
