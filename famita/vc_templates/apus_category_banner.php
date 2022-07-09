<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

if (isset($category) && !empty($category)):
	$category = get_term_by( 'slug', $category, 'product_cat' );
	if ( ! empty( $category ) ):
		?>
		<div class="widget-categorybanner">
			<div class="grid-banner-category <?php echo esc_attr($el_class.' '.$style); ?>">
		        <div class="category-wrapper">
		        	<a class="link-action" href="<?php echo esc_url(get_term_link($category)); ?>">
		                <?php
			                if ( isset($image) && $image ) {
			                	echo trim(famita_get_attachment_thumbnail($image, 'full'));
			                }
		                ?>
		                <div class="info">
		                	<h2 class="title">
		                		<?php if ( !empty($title) ) { ?>
	                                <?php echo trim($title); ?>
	                            <?php } else { ?>
	                                <?php echo trim($category->name); ?>
	                            <?php } ?>
	                        </h2>
	                    </div>
	                </a>
		        </div>
	        </div>
		</div>
		<?php
	endif;
endif;