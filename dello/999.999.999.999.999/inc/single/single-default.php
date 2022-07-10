<?php
/**
 * Template for Single Default
 *
 * @package dello
 */

?>
<div id="primary" class="content-area">
	<main id="main" class="site-main">
		<!-- wraper_blog_main -->
		<section class="wraper_blog_main">
			<div class="container">
				<!-- row -->
				<div class="row">
						
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						
						<!-- blog_single -->
						<div class="blog_single">
							<?php
							while ( have_posts() ) :
								the_post();
								get_template_part( 'template-parts/content-single', get_post_format() );
								endwhile; // End of the loop.
							?><div class="tags-social">
							<?php
							$tags = get_the_tags( $post->ID );
							if ( ! empty( $tags ) ) {
								?>
						
							<!-- post-tags -->
							<div class="post-tags">
								<?php
								/* translators: used between list items, there is a space after the comma */
								$tags_list = get_the_tag_list( '', ' ' );
								if ( $tags_list ) {
									echo '<strong class="tags-title">' . esc_html__( 'Tags', 'dello' ) . ':</strong> ' . $tags_list;
								}
								?>
							</div>
							<!-- post-tags -->
							<?php } ?>
							<div class="pull-right">
				<div class="entry-extra-item">

					<?php if ( true == radiantthemes_global_var( 'display_social_sharing', '', false ) ) : ?>
						<?php echo do_shortcode( '[rt_social_links]' ); ?>
						<?php endif; ?>
				</div><!-- .entry-extra-item -->
			</div><!--pull-right-->
			</div>
								
								<!-- post-navigation -->
							<div class="navigation post-navigation">
								<div class="nav-links">
									<?php
									$prev_post = get_previous_post();
									if ( is_a( $prev_post, 'WP_Post' ) ) {
									    $nav_prev_title = get_the_title( $prev_post->ID );
										?>
										<div class="nav-previous">
											<a rel="prev" href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>" title="<?php echo esc_attr( get_the_title( $prev_post->ID ) ); ?>">
												<?php if ( has_post_thumbnail( $prev_post->ID ) ) { ?>
													<span class="left-arrow"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#676666" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left"><polyline points="15 18 9 12 15 6"></polyline></svg></span>
												<?php } else { echo '<span class="left-arrow"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#676666" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left"><polyline points="15 18 9 12 15 6"></polyline></svg></span>';}
												?>
												<span class="rt-nav-info">
													<span class="rt-nav-text"><?php echo esc_html__( 'Previous Post', 'dello' ); ?></span>
													<span class="rt-nav-title"><?php echo implode(' ', array_slice(str_word_count($nav_prev_title, 2), 0, 5)); ?></span>
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
													<span class="right-arrow"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#676666" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg></span>
												<?php } else { echo '<span class="right-arrow"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#676666" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg></span>';}
												?>
												<span class="rt-nav-info">
													<span class="rt-nav-text"><?php echo esc_html__( 'Next Post', 'dello' ); ?></span>
													<span class="rt-nav-title"><?php echo implode(' ', array_slice(str_word_count($nav_next_title, 2), 0, 5)); ?></span>
												</span>
											</a>
										</div>
									<?php } ?>
								</div>
							</div>
							<!-- post-navigation -->

							<!-- comments-area -->
							<?php if ( radiantthemes_global_var( 'blog-layout', '', false ) ) : ?>
								<?php if ( radiantthemes_global_var( 'blog_comment_display', '', false ) ) : ?>
									<?php if ( comments_open() || get_comments_number() ) : ?>
										<?php comments_template(); ?>
								<?php endif; ?>
							<?php endif; ?>
							<?php else : ?>
								<?php if ( comments_open() || get_comments_number() ) : ?>
									<?php comments_template(); ?>
								<?php endif; ?>
							<?php endif; ?>
							<!-- comments-area -->
						</div>
						<!-- blog_single -->
					</div>

					
				</div>
				<!-- row -->
			</div>
		</section>
		<!-- wraper_blog_main -->
	</main><!-- #main -->
</div><!-- #primary -->
