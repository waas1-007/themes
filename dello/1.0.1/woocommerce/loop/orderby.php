<?php
/**
 * Show options for ordering
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/orderby.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<form class="woocommerce-ordering" method="get">
	<select name="orderby" class="orderby" aria-label="<?php esc_attr_e( 'Shop order', 'dello' ); ?>">
		<?php foreach ( $catalog_orderby_options as $id => $name ) : ?>
			<option value="<?php echo esc_attr( $id ); ?>" <?php selected( $orderby, $id ); ?>><?php echo esc_html( $name ); ?></option>
		<?php endforeach; ?>
	</select>
	<input type="hidden" name="paged" value="1" />
	<?php wc_query_string_form_fields( null, array( 'orderby', 'submit', 'paged', 'product-page' ) ); ?>
	<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><g fill="none"><path d="M0 0h24v24H0z" opacity="0.05"></path><path fill="currentColor" d="M7.445 7.48V5.672L5.665 7.48h1.78zm1.09-4.42c.304.12.465.39.465.706v16.437a.784.784 0 01-.783.797.762.762 0 01-.772-.781V8.982H4.003a.832.832 0 01-.765-.204.759.759 0 01.002-1.105L7.652 3.23a.832.832 0 01.882-.17zm8.02 15.269l1.78-1.81h-1.78v1.81zm4.207-3.107a.76.76 0 01-.002 1.106l-4.412 4.442a.832.832 0 01-.882.17c-.305-.12-.466-.39-.466-.706V3.797c0-.432.332-.797.783-.797.45 0 .772.35.772.781v11.237h3.442a.833.833 0 01.765.204z"></path></g></svg>
</form>
<div class="rt-display-view">
	<button  id="rt-shop-display-grid" class="rt-shop-display-grid <?php if ( 'shop-style-four-column' === radiantthemes_global_var( 'shop-style', '', false ) || ! class_exists( 'Redux' ) ) { echo "active" ;}?>">
		<svg width="24" height="24" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
		<rect x="0.4" y="0.4" width="6.2" height="6.2" fill="white" stroke="black" stroke-width="0.8"/>
		<rect x="9.4" y="0.4" width="6.2" height="6.2" fill="white" stroke="black" stroke-width="0.8"/>
		<rect x="0.4" y="9.4" width="6.2" height="6.2" fill="white" stroke="black" stroke-width="0.8"/>
		<rect x="9.4" y="9.4" width="6.2" height="6.2" fill="white" stroke="black" stroke-width="0.8"/>
		</svg>
	</button>
	<button  id="rt-shop-display-small-grid" class="rt-shop-display-small-grid <?php if ( 'shop-style-five-column' === radiantthemes_global_var( 'shop-style', '', false ) ) { echo "active" ;}?>">
		<svg width="24" height="24" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
		<rect x="0.4" y="0.4" width="5.2" height="5.2" fill="white" stroke="black" stroke-width="0.8"/>
		<rect x="0.4" y="5.4" width="5.2" height="5.2" fill="white" stroke="black" stroke-width="0.8"/>
		<rect x="0.4" y="10.4" width="5.2" height="5.2" fill="white" stroke="black" stroke-width="0.8"/>
		<rect x="5.4" y="0.4" width="5.2" height="5.2" fill="white" stroke="black" stroke-width="0.8"/>
		<rect x="5.4" y="5.4" width="5.2" height="5.2" fill="white" stroke="black" stroke-width="0.8"/>
		<rect x="5.4" y="10.4" width="5.2" height="5.2" fill="white" stroke="black" stroke-width="0.8"/>
		<rect x="10.4" y="0.4" width="5.2" height="5.2" fill="white" stroke="black" stroke-width="0.8"/>
		<rect x="10.4" y="5.4" width="5.2" height="5.2" fill="white" stroke="black" stroke-width="0.8"/>
		<rect x="10.4" y="10.4" width="5.2" height="5.2" fill="white" stroke="black" stroke-width="0.8"/>
		</svg>
	</button>
	<?php if ( 'shop-topsidebar' === radiantthemes_global_var( 'shop-sidebar', '', false )  ){ ?>
		<button  id="rt-shop-display-verysmall-grid" class="rt-shop-display-vertsmall-grid <?php if ( 'shop-style-six-column' === radiantthemes_global_var( 'shop-style', '', false ) ) { echo "active" ;}?>">
			<svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" >
			<g transform="matrix(1.09896,0,0,1.09896,-2.28125,-0.09375)">
				<rect x="2.842" y="0.947" width="5.053" height="5.053" style="fill:white;stroke:black;stroke-width:0.63px;"/>
			</g>
			<g transform="matrix(1.09896,0,0,1.09896,-2.28125,-0.09375)">
				<rect x="7.895" y="0.947" width="5.053" height="5.053" style="fill:white;stroke:black;stroke-width:0.63px;"/>
			</g>
			<g transform="matrix(1.09896,0,0,1.09896,-2.28125,-0.09375)">
				<rect x="2.842" y="6" width="5.053" height="5.053" style="fill:white;stroke:black;stroke-width:0.63px;"/>
			</g>
			<g transform="matrix(1.09896,0,0,1.09896,-2.28125,-0.09375)">
				<rect x="7.895" y="6" width="5.053" height="5.053" style="fill:white;stroke:black;stroke-width:0.63px;"/>
			</g>
			<g transform="matrix(1.09896,0,0,1.09896,-2.28125,-0.09375)">
				<rect x="2.842" y="11.053" width="5.053" height="5.053" style="fill:white;stroke:black;stroke-width:0.63px;"/>
			</g>
			<g transform="matrix(1.09896,0,0,1.09896,-2.28125,-0.09375)">
				<rect x="7.895" y="11.053" width="5.053" height="5.053" style="fill:white;stroke:black;stroke-width:0.63px;"/>
			</g>
			<g transform="matrix(1.09896,0,0,1.09896,-2.28125,-0.09375)">
				<rect x="2.842" y="16.105" width="5.053" height="5.053" style="fill:white;stroke:black;stroke-width:0.63px;"/>
			</g>
			<g transform="matrix(1.09896,0,0,1.09896,-2.28125,-0.09375)">
				<rect x="7.895" y="16.105" width="5.053" height="5.053" style="fill:white;stroke:black;stroke-width:0.63px;"/>
			</g>
			<g transform="matrix(1.09896,0,0,1.09896,-2.28125,-0.09375)">
				<rect x="12.947" y="0.947" width="5.053" height="5.053" style="fill:white;stroke:black;stroke-width:0.63px;"/>
			</g>
			<g transform="matrix(1.09896,0,0,1.09896,-2.28125,-0.09375)">
				<rect x="18" y="0.947" width="5.053" height="5.053" style="fill:white;stroke:black;stroke-width:0.63px;"/>
			</g>
			<g transform="matrix(1.09896,0,0,1.09896,-2.28125,-0.09375)">
				<rect x="12.947" y="6" width="5.053" height="5.053" style="fill:white;stroke:black;stroke-width:0.63px;"/>
			</g>
			<g transform="matrix(1.09896,0,0,1.09896,-2.28125,-0.09375)">
				<rect x="18" y="6" width="5.053" height="5.053" style="fill:white;stroke:black;stroke-width:0.63px;"/>
			</g>
			<g transform="matrix(1.09896,0,0,1.09896,-2.28125,-0.09375)">
				<rect x="12.947" y="11.053" width="5.053" height="5.053" style="fill:white;stroke:black;stroke-width:0.63px;"/>
			</g>
			<g transform="matrix(1.09896,0,0,1.09896,-2.28125,-0.09375)">
				<rect x="18" y="11.053" width="5.053" height="5.053" style="fill:white;stroke:black;stroke-width:0.63px;"/>
			</g>
			<g transform="matrix(1.09896,0,0,1.09896,-2.28125,-0.09375)">
				<rect x="12.947" y="16.105" width="5.053" height="5.053" style="fill:white;stroke:black;stroke-width:0.63px;"/>
			</g>
			<g transform="matrix(1.09896,0,0,1.09896,-2.28125,-0.09375)">
				<rect x="18" y="16.105" width="5.053" height="5.053" style="fill:white;stroke:black;stroke-width:0.63px;"/>
			</g>
		</svg>
		</button>
	<?php } ?>
</div>
</div>
</div>
</div>