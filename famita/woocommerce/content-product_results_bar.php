<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $wp_query;
$btn_text = '';

if ( is_product_taxonomy() ) {
    $term = $wp_query->get_queried_object();
    if ( is_product_category() ) {
        $btn_text = sprintf( esc_html__( 'Showing &ldquo;%s&rdquo;', 'famita' ), '<span>' . esc_html( $term->name ) . '</span>' );
    } else {
        $btn_text = sprintf( esc_html__( 'Products tagged &ldquo;%s&rdquo;', 'famita' ), '<span>' . esc_html( $term->name ) . '</span>' );
    }
} elseif ( !empty($_REQUEST['s']) ) {
    $btn_text = sprintf( esc_html__( 'Search results for &ldquo;%s&rdquo;', 'famita' ), '<span>' . esc_html( $_REQUEST['s'] ) . '</span>' );
}

$shop_page_url = get_permalink( wc_get_page_id( 'shop' ) );

$filters = famita_count_filtered();

if ( is_product_taxonomy() || !empty($_REQUEST['s']) ) {
?>
    <div class="apus-results">
        <a href="<?php echo esc_url( $shop_page_url ); ?>" class="apus-results-reset">
            <i class="ti-close"></i>
            <?php echo trim($btn_text); ?>
        </a>
    </div>
<?php } elseif ( $filters ) { ?>
    <div class="apus-results">
        <a href="<?php echo esc_url( $shop_page_url ); ?>" class="apus-results-reset">
            <i class="ti-close"></i>
            <?php printf(__('Clear Filters (%s)', 'famita'), $filters); ?>
        </a>
    </div>
<?php }