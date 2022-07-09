<?php

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

if ( !empty($categories) ) {
    $categories = explode(',', $categories);
} else {
	$categories = array();
}
$args = array(
    'categories' => $categories,
    'product_type' => $type,
    'post_per_page' => $number,
);
$product_style = !empty($product_style) ? $product_style : 'inner';
$style_item_product = $product_style == 'inner' ? ' item-grid' : ' '.$product_style ;
$loop = famita_get_products( $args );
if ( $loop->have_posts() ) {
?>
    <div class="widget widget-products no-margin <?php echo esc_attr($el_class); ?>">
        <?php if ($title!=''): ?>
            <h3 class="widget-title">
                <?php echo esc_attr( $title ); ?>
            </h3>
        <?php endif; ?>
        <div class="widget-content woocommerce <?php echo esc_attr($layout_type.$style_item_product); ?>">
            <?php wc_get_template( 'layout-products/'.$layout_type.'.php' , array(
                'loop' => $loop,
                'columns' => $columns,
                'product_item' => $product_style,
                'show_nav' => $show_nav,
                'show_pagination' => $show_pagination,
                'rows' => $rows,
            ) ); ?>
        </div>
        <?php if ($text_button!=''): ?>
            <div class="show-all text-center">
                <a class="btn btn-primary" href="<?php echo esc_url_raw($link_button); ?>"><?php echo esc_attr( $text_button ); ?></a>
            </div>
        <?php endif; ?>
    </div>
<?php } ?>