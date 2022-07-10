<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package dello
 */

get_header(); ?>
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<?php if ( radiantthemes_global_var( '404_error_one_content', '', false ) ) { ?>
			<!-- wraper_error_main -->
			<div class="wraper_error_main style-one">
				<!-- START OF 404 STYLE ONE CONTENT -->
				<div class="container">
						<!-- row -->
						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<!-- error_main -->
								<div class="error_main">
									<?php
									if ( radiantthemes_global_var( '404_error_one_lottie', '', false ) != '' ) {
										echo radiantthemes_global_var( '404_error_one_lottie', '', false );
									}
									echo wp_kses( radiantthemes_global_var( '404_error_one_content', '', false ), 'rt-content' );
									?>
									<?php if ( radiantthemes_global_var( '404_error_one_button_link', '', false ) != '' ) { ?>
										<a class="btn" href="<?php echo esc_url( radiantthemes_global_var( '404_error_one_button_link', '', false ) ); ?>"> <?php echo esc_html( radiantthemes_global_var( '404_error_one_button_text', '', false ) ); ?></a>
									<?php } ?>
								</div>
								<!-- error_main -->
							</div>
						</div>
						<!-- row -->
					</div>
					<!-- END OF 404 STYLE ONE CONTENT -->
			</div>
			<!-- wraper_error_main -->
		<?php } else { ?>
			<!-- wraper_error_main -->
			<div class="wraper_error_main style-one">
				<!-- START OF 404 STYLE ONE CONTENT -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<!-- error_main -->
							<div class="error_main">
								<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/page-not-found.svg' ); ?>" alt="Page Not Found" />
								<h4><?php echo esc_html__( 'Oops! It could be you or us, there is no page here. It might have been moved or deleted.', 'dello' ); ?></h4>
								<a class="btn" href="<?php echo esc_url( home_url( '/' ) ); ?>"> <?php echo esc_html__( 'Back To Home', 'dello' ); ?></a>
							</div>
							<!-- error_main -->
						</div>
					</div>
					<!-- row -->
				</div>
				<!-- END OF 404 STYLE ONE CONTENT -->
			</div>
			<!-- wraper_error_main -->
		<?php } ?>
	</main><!-- #main -->
</div><!-- #primary -->
<?php
get_footer();
