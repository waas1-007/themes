<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$args = array(
	'post_type' => 'apus_testimonial',
	'posts_per_page' => $number,
	'post_status' => 'publish',
);
$loop = new WP_Query($args);
?>
<div class="widget widget-testimonials <?php echo esc_attr($el_class); ?>">
	<?php if ($title!=''): ?>
        <h3 class="widget-title text-center">
            <span><?php echo esc_attr( $title ); ?></span>
        </h3>
    <?php endif; ?>
	<?php if ( $loop->have_posts() ): ?>
        <div class="owl-carousel-wrapper">
            <div class="slick-carousel" data-carousel="slick" data-items="<?php echo esc_attr($columns); ?>" data-smallmedium="2" data-extrasmall="1" data-pagination="false" data-nav="true">
                <?php while ( $loop->have_posts() ): $loop->the_post(); ?>
                <div class="item">
                    <?php get_template_part( 'template-parts/testimonial/testimonial', 'v1' ); ?>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
	<?php endif; ?>
</div>
<?php wp_reset_postdata(); ?>