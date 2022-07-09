<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "site-content" div and all content after.
 *
 * @package WordPress
 * @subpackage Famita
 * @since Famita 1.0
 */
$footer = apply_filters( 'famita_get_footer_layout', 'default' );
$show_footer_desktop_mobile = famita_get_config('show_footer_desktop_mobile', false);
$show_footer_mobile = famita_get_config('show_footer_mobile', true);
?>
	</div><!-- .site-content -->
	<?php if ( !empty($footer) ): ?>
		<?php famita_display_footer_builder($footer); ?>
	<?php else: ?>
		<footer id="apus-footer" class="apus-footer <?php echo esc_attr(!$show_footer_desktop_mobile ? 'hidden-xs hidden-sm' : ''); ?>" role="contentinfo">
			<div class="footer-default">
				<div class="apus-footer-inner">
					<div class="apus-copyright">
						<div class="container">
							<div class="copyright-content clearfix">
								<div class="text-copyright pull-right">
									<?php
										
										$allowed_html_array = array( 'a' => array('href' => array()) );
										echo wp_kses(__('&copy; 2018 - Famita. All Rights Reserved. <br/> Powered by <a href="//apusthemes.com">ApusThemes</a>', 'famita'), $allowed_html_array);
									?>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</footer><!-- .site-footer -->
	<?php endif; ?>
	<?php
	if ( famita_get_config('back_to_top') ) { ?>
		<a href="#" id="back-to-top" class="add-fix-top">
			<i class="fa fa-angle-up" aria-hidden="true"></i>
		</a>
	<?php
	}
	?>

	<?php if ( is_active_sidebar( 'popup-newsletter' ) ): ?>
		<?php dynamic_sidebar( 'popup-newsletter' ); ?>
	<?php endif; ?>
	
	<?php
		if ( $show_footer_mobile ) {
			get_template_part( 'footer-mobile' );
		}
	?>
</div><!-- .site -->
<?php wp_footer(); ?>
</body>
</html>