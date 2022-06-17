<?php
/**
 * Default template part for displaying posts in article format
 *
 * @since 1.0.0
 */

global $product;
?>

<?php
/**
 * Hook: ignition_before_entry.
 *
 * @since 1.0.0
 */
do_action( 'ignition_before_entry', 'listing', get_the_ID() );
?>

<article id="entry-<?php the_ID(); ?>" <?php post_class( 'entry-item entry-item-product' ); ?>>
	<header class="entry-header">
		<?php echo wc_get_product_category_list( $product->get_id(), ', ', '<span class="entry-meta-item entry-categories">', '</span>' ); ?>

		<?php
			woocommerce_template_loop_product_link_open();
			woocommerce_template_loop_product_title();
			woocommerce_template_loop_product_link_close();
		?>

		<?php woocommerce_template_loop_rating(); ?>
	</header>

	<?php
		woocommerce_template_loop_product_link_open();
		woocommerce_show_product_loop_sale_flash();
		woocommerce_template_loop_product_thumbnail();
		woocommerce_template_loop_product_link_close();
	?>

	<div class="entry-item-content-wrap">
		<?php woocommerce_template_loop_price(); ?>
		<div class="entry-more-wrap">
			<?php woocommerce_template_loop_add_to_cart(); ?>
		</div>
	</div>
</article>

<?php
/**
 * Hook: ignition_after_entry.
 *
 * @since 1.0.0
 */
do_action( 'ignition_after_entry', 'listing', get_the_ID() );
