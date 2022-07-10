<?php
	/**
	 * The header for our theme
	 *
	 * This is the template that displays all of the <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"> section and everything up until <div id="content">
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
	 *
	 * @package dello
	 */

?>
<!doctype html>
<html <?php language_attributes(); ?> itemscope itemtype="http://schema.org/WebPage">

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta name="format-detection" content="telephone=no">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<?php if ( radiantthemes_global_var( 'preloader_switch', '', false ) ) { ?>
	<!-- preloader -->
		<div class="preloader" data-preloader-timeout="<?php echo esc_attr( radiantthemes_global_var( 'preloader_timeout', '', false ) ); ?>">
			<?php
			if ( ! empty( radiantthemes_global_var( 'preloader_style', '', false ) ) ) {
				include get_parent_theme_file_path( 'inc/preloader/' . radiantthemes_global_var( 'preloader_style', '', false ) . '.php' );
			}
			?>
		</div>
		<!-- preloader -->
		<?php
	}
	?>
	<!-- overlay -->
	<div class="overlay"></div>
	<!-- overlay -->

	<!-- scrollup -->
	<?php if ( radiantthemes_global_var( 'scroll_to_top_switch', '', false ) ) { ?>
		<?php if ( ! empty( radiantthemes_global_var( 'scroll_to_top_direction', '', false ) ) ) : ?>
			<div class="scrollup <?php echo esc_attr( radiantthemes_global_var( 'scroll_to_top_direction', '', false ) ); ?>">
		<?php else : ?>
			<div class="scrollup left">
				<?php endif; ?>
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-up"><polyline points="18 15 12 9 6 15"></polyline></svg>
			</div>
	<?php } ?>
	<!-- scrollup -->
	<?php if ( ! is_singular( 'elementor_library' ) ) { ?>
		<?php radiantthemes_website_layout(); ?>
		<?php radiantthemes_short_banner_selection(); ?>
	<?php } ?>
	<!-- #page -->
	<div id="page-content" class="site">
		<!-- #content -->
		<div id="content" class="site-content">
			<?php if ( radiantthemes_global_var( 'site_popup_switch', '', false ) ) { ?>
				<?php if ( is_front_page() ) { ?>
					<div id="welcome-user" class="modal fade" role="dialog">
						<div class="modal-dialog">
							<div class="modal-content welcome-box" style="background-image:url(<?php echo esc_url( radiantthemes_global_var( 'welcomepopup_background', 'url', true ) ); ?>)">
								<div class="modal-header bb-0">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
								</div>
								<div class="modal-body welcome-box-body">
									<div class="modal-title">
										<?php echo wp_kses_post( radiantthemes_global_var( 'welcomepopup_text', '', false ) ); ?>
									</div>
									<div class="main-content">
										<?php
										if ( radiantthemes_global_var( 'welcomepopup_contactform', '', false ) ) {
											echo do_shortcode( radiantthemes_global_var( 'welcomepopup_contactform', '', false ) );
										}
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>
			<?php } ?>
