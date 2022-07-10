<?php
	/**
	 * The template for displaying all single posts
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
	 *
	 * @package dello
	 */
	get_header();
?>
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<div class="container">
		<?php
		while ( have_posts() ) :
			the_post();
			the_content();
			?>
			<!-- post-navigation -->
			<div class="rt-portfolio-nav">
				<div class="nav-links">
					<?php
					$prev_post = get_previous_post();
					if ( is_a( $prev_post, 'WP_Post' ) ) {
						$nav_prev_title = get_the_title( $prev_post->ID );
						?>
						<div class="nav-previous">
							<a rel="prev" href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>" title="<?php echo esc_attr( get_the_title( $prev_post->ID ) ); ?>">
								<?php if ( has_post_thumbnail( $prev_post->ID ) ) { ?>
									<span class="left-arrow"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#676666" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left"><polyline points="15 18 9 12 15 6"></polyline></svg></span><span class="rt-nav-img">
										<?php echo get_the_post_thumbnail( $prev_post->ID, 'thumbnail' ); ?>
									</span>
									<?php
								} else {
									echo '<span class="ti-angle-left"></span>';}
								?>
								<span class="rt-nav-info">
									<span class="rt-nav-text"><?php echo esc_html__( 'Previous ', 'dello' ); ?></span>
									<span class="rt-nav-title"><?php echo implode( ' ', array_slice( str_word_count( $nav_prev_title, 2 ), 0, 5 ) ); ?></span>
								</span>
							</a>
						</div>
					<?php } ?>
					<?php
					$next_post = get_next_post();
					if ( is_a( $next_post, 'WP_Post' ) ) {
						$nav_next_title = get_the_title( $next_post->ID );
						?>
						<div class="nav-next">
							<a rel="next" href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" title="<?php echo esc_attr( get_the_title( $next_post->ID ) ); ?>">
								<?php if ( has_post_thumbnail( $next_post->ID ) ) { ?>
									<span class="right-arrow"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#676666" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg></span><span class="rt-nav-img">
										<?php echo get_the_post_thumbnail( $next_post->ID, 'thumbnail' ); ?>
									</span>
									<?php
								} else {
									echo '<span class="ti-angle-right"></span>';}
								?>
								<span class="rt-nav-info">
									<span class="rt-nav-text"><?php echo esc_html__( 'Next ', 'dello' ); ?></span>
									<span class="rt-nav-title"><?php echo implode( ' ', array_slice( str_word_count( $nav_next_title, 2 ), 0, 5 ) ); ?></span>
								</span>
							</a>
						</div>
					<?php } ?>
				</div>
			</div>
			<!-- post-navigation -->
			<?php
		endwhile; // End of the loop.
		?>
		</div>
	</main><!-- #main -->
</div><!-- #primary -->
<?php
get_footer();
