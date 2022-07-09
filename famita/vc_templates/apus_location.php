<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$items = (array) vc_param_group_parse_atts( $items );
if ( !empty($items) ):
$count = 0;
?>
	<div class="widget-location <?php echo esc_attr($el_class); ?>">
		<div class="row">
			<?php foreach ($items as $item): ?>
				<?php if ( isset($item['image']) && $item['image'] ) $image_bg = wp_get_attachment_image_src($item['image'],'full'); ?>
					<div class="col-xs-6 col-sm-<?php echo esc_attr(12/count($items)); ?>">
						<div class="location-inner">
							<div class="fbox-icon">
								<?php if(isset( $image_bg[0]) && $image_bg[0] ) { ?>
										<img class="img" src="<?php echo esc_url_raw($image_bg[0]); ?>" alt="<?php esc_attr_e('Image', 'famita'); ?>">
							    <?php } ?>
							</div>
						    <div class="location-content ">  
						    	<?php if (isset($item['title']) && trim($item['title'])!='') { ?>
						            <h3 class="title"><?php echo trim($item['title']); ?></h3>
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