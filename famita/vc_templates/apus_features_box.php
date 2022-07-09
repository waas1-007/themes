<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$items = (array) vc_param_group_parse_atts( $items );
if ( !empty($items) ):
$count = 0;
?>
	<div class="widget-features-box <?php echo esc_attr($el_class); ?> <?php echo esc_attr($style); ?>">
		<?php if ($title!=''): ?>
        <h3 class="widget-title">
            <span><?php echo esc_attr( $title ); ?></span>
	    </h3>
	    <?php endif; ?>
		<div class="slick-carousel" data-carousel="slick" data-items="<?php echo esc_attr(count($items)); ?>" data-smallmedium="3" data-extrasmall="2" data-smallest="1" data-pagination="false" data-nav="true">
			<?php foreach ($items as $item): ?>
				<?php if ( isset($item['image']) && $item['image'] ) $image_bg = wp_get_attachment_image_src($item['image'],'full'); ?>
					<div class="inner">
						<div class="feature-box-inner clearfix">
							<div class="fbox-icon">
								<?php if(isset( $image_bg[0]) && $image_bg[0] ) { ?>
										<img class="img" src="<?php echo esc_url_raw($image_bg[0]); ?>" alt="<?php esc_attr_e('Image', 'famita'); ?>">
								<?php }elseif (isset($item['icon']) && $item['icon']) { ?>
							           	<i class="<?php echo esc_attr($item['icon']); ?>"></i>
							    <?php } ?>
							</div>
						    <div class="fbox-content ">  
						    	<?php if (isset($item['title']) && trim($item['title'])!='') { ?>
						            <h3 class="ourservice-heading"><?php echo trim($item['title']); ?></h3>
						        <?php } ?>
						         <?php if (isset($item['description']) && trim($item['description'])!='') { ?>
						            <div class="description"><?php echo trim( $item['description'] );?></div>  
						        <?php } ?>
						    </div> 
					    </div>
				    </div>
			<?php endforeach; ?>
		</div>
	</div>
<?php endif; ?>