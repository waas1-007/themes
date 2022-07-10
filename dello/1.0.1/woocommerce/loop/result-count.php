<?php
/**
 * Result Count
 *
 * Shows text: Showing x - x of x results.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/result-count.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     3.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="row">
<div class="col-md-6">
<p class="woocommerce-result-count">
	<?php
	// phpcs:disable WordPress.Security
	if ( 1 === intval( $total ) ) {
		_e( 'Showing the single result', 'dello' );
	} elseif ( $total <= $per_page || -1 === $per_page ) {
		/* translators: %d: total results */
		printf( _n( 'Showing all %d result', 'Showing all %d results', $total, 'dello' ), $total );
	} else {
		$first = ( $per_page * $current ) - $per_page + 1;
		$last  = min( $total, $per_page * $current );
		/* translators: 1: first result 2: last result 3: total results */
		printf( _nx( 'Showing %1$d&ndash;%2$d of %3$d result', 'Showing %1$d&ndash;%2$d of %3$d results', $total, 'with first and last result', 'dello' ), $first, $last, $total );
	}
	// phpcs:enable WordPress.Security
	?>
</p>
</div>
<div class="col-md-6">
<div class="rt-shop-filters rt-sticky-filters">
<?php if ( 'shop-topsidebar' === radiantthemes_global_var( 'shop-sidebar', '', false )  ){ ?>
<div class="rt-top-filter">
<button class="rt-show-filter"> Filters <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" class="result-icon"><g fill="none" fill-rule="evenodd"><path d="M0 0h24v24H0z" opacity="0.05"></path><path fill="currentColor" d="M3.749 7.508a.75.75 0 010-1.5h3.138a2.247 2.247 0 014.243 0h9.121a.75.75 0 010 1.5h-9.126a2.248 2.248 0 01-4.232 0H3.749zm13.373 9h3.129a.75.75 0 010 1.5h-3.135a2.247 2.247 0 01-4.231 0H3.749a.75.75 0 010-1.5h9.13a2.248 2.248 0 014.243 0z"></path></g></svg></button>
<button class="rt-hide-filter"> Filters <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" class="result-icon"><g fill="none" fill-rule="evenodd"><path d="M0 0h24v24H0z" opacity="0.05"></path><path fill="currentColor" d="M3.749 7.508a.75.75 0 010-1.5h3.138a2.247 2.247 0 014.243 0h9.121a.75.75 0 010 1.5h-9.126a2.248 2.248 0 01-4.232 0H3.749zm13.373 9h3.129a.75.75 0 010 1.5h-3.135a2.247 2.247 0 01-4.231 0H3.749a.75.75 0 010-1.5h9.13a2.248 2.248 0 014.243 0z"></path></g></svg></button>
</div>
<?php } elseif ( 'shop-leftsidebar' === radiantthemes_global_var( 'shop-sidebar', '', false ) || 'shop-rightsidebar' === radiantthemes_global_var( 'shop-sidebar', '', false )){?>
<div class="rt-side-filter">
<button class="rt-fly-filter"> Filters <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" class="result-icon"><g fill="none" fill-rule="evenodd"><path d="M0 0h24v24H0z" opacity="0.05"></path><path fill="currentColor" d="M3.749 7.508a.75.75 0 010-1.5h3.138a2.247 2.247 0 014.243 0h9.121a.75.75 0 010 1.5h-9.126a2.248 2.248 0 01-4.232 0H3.749zm13.373 9h3.129a.75.75 0 010 1.5h-3.135a2.247 2.247 0 01-4.231 0H3.749a.75.75 0 010-1.5h9.13a2.248 2.248 0 014.243 0z"></path></g></svg></button>
<button class="rt-fly-hide-filter"> Filters <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" class="result-icon"><g fill="none" fill-rule="evenodd"><path d="M0 0h24v24H0z" opacity="0.05"></path><path fill="currentColor" d="M3.749 7.508a.75.75 0 010-1.5h3.138a2.247 2.247 0 014.243 0h9.121a.75.75 0 010 1.5h-9.126a2.248 2.248 0 01-4.232 0H3.749zm13.373 9h3.129a.75.75 0 010 1.5h-3.135a2.247 2.247 0 01-4.231 0H3.749a.75.75 0 010-1.5h9.13a2.248 2.248 0 014.243 0z"></path></g></svg></button>
</div>
<?php }?>