<?php
/**
 * Fall-back template for when the Ignition plugin is not enabled
 *
 * @since 1.0.0
 */

get_header(); ?>

<div class="ignition-spencer-ignition-null">
	<div class="ignition-spencer-ignition-null-container">
		<?php if ( is_user_logged_in() && current_user_can( 'activate_plugins' ) ) : ?>
			<div class="ignition-spencer-ignition-null-logo">
				<a href="https://cssigniter.com" target="_blank" rel="noopener noreferrer">
					<img src="<?php echo esc_url( get_theme_file_uri( '/inc/onboarding/assets/images/cssigniter_logo.svg' ) ); ?>" alt="<?php esc_attr_e( 'CSSIgniter logo', 'ignition-spencer' ); ?>">
				</a>
			</div>

			<h3><?php esc_html_e( 'Oops. One more thing.', 'ignition-spencer' ); ?></h3>

			<p>
				<?php esc_html_e( 'This theme requires the Ignition Framework plugin to be installed. If you have already installed it simply visit your WordPress dashboard > Plugins and activate it. Otherwise just visit our download area to get it.', 'ignition-spencer' ); ?>
			</p>

			<a href="<?php echo esc_url( ignition_spencer_get_theme_link_url( 'ignition_download' ) ); ?>" class="ignition-spencer-ignition-null-button"  target="_blank" rel="noopener noreferrer">
				<?php esc_html_e( 'Download Ignition Framework', 'ignition-spencer' ); ?>
			</a>
		<?php else : ?>
			<h3><?php bloginfo( 'name' ); ?></h3>

			<p>
				<?php esc_html_e( 'Our administrators are doing some maintenance, and we will be back with you shortly.', 'ignition-spencer' ); ?>
			</p>
		<?php endif; ?>
	</div>
</div>

<?php get_footer();
