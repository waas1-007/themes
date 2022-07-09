<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Famita
 * @since Famita 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php
	if ( !function_exists( 'wp_site_icon' ) ) {
		$favicon = famita_get_config('media-favicon');
		if ( (isset($favicon['url'])) && (trim($favicon['url']) != "" ) ) {
	        if (is_ssl()) {
	            $favicon_image_img = str_replace("http://", "https://", $favicon['url']);		
	        } else {
	            $favicon_image_img = $favicon['url'];
	        }
		?>
	    	<link rel="shortcut icon" href="<?php echo esc_url($favicon_image_img); ?>" />
	    <?php } ?>
    <?php } ?>

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php if ( famita_get_config('preload', true) ) {
	$preload_icon = famita_get_config('media-preload-icon');
	$preload_icon_image_img = '';
	if ( (isset($preload_icon['url'])) && (trim($preload_icon['url']) != "" ) ) {
        if (is_ssl()) {
            $preload_icon_image_img = str_replace("http://", "https://", $preload_icon['url']);		
        } else {
            $preload_icon_image_img = $preload_icon['url'];
        }
    }
?>
	<div class="apus-page-loading">
        <div class="apus-loader-inner" style="<?php echo esc_attr($preload_icon_image_img ? 'background-image: url(\''.$preload_icon_image_img.'\')' : ''); ?>"></div>
    </div>
<?php } ?>
<div id="wrapper-container" class="wrapper-container">

	<?php get_template_part( 'headers/mobile/offcanvas-menu' ); ?>
	<?php get_template_part( 'headers/mobile/header-mobile' ); ?>

	<?php
		if( famita_is_woocommerce_activated() && famita_get_config('show_cartbtn') && !famita_get_config( 'enable_shop_catalog' ) ) {
			get_template_part( 'woocommerce/cart/mini-cart-content' );
		}
	?>
	
	<?php $header = apply_filters( 'famita_get_header_layout', famita_get_config('header_type') );
		if ( empty($header) ) {
			$header = 'v8';
		}

		if ( $header == 'v5' ) {
			get_template_part( 'template-parts/offcanvas-main-menu' );
		}
	?>
	<?php get_template_part( 'headers/'.$header ); ?>
	<div id="apus-main-content">