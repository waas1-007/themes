<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$items = (array) vc_param_group_parse_atts( $items );
if ( !empty($items) ):
?>
<div class="widget-banner <?php echo esc_attr($el_class); ?>">
    <div class="slick-carousel" data-carousel="slick" data-items="<?php echo esc_attr(count($items)); ?>" data-smallmedium="2" data-extrasmall="1" data-smallest="1" data-pagination="false" data-nav="true">
        <?php foreach ($items as $item): ?>
            <div class="item">
                <div class="widget-banner-item <?php echo esc_attr($item['style']); ?> <?php echo (!empty($item['noborder']))?'noborder':''; ?>">
                    <?php if ( $item['url'] ) { ?>
                        <a class="link-img" href="<?php echo esc_url($item['url']); ?>">
                    <?php } ?>
                        <?php echo trim(famita_get_attachment_thumbnail($item['image'], 'full')); ?>
                    <?php if ( $item['url'] ) { ?>
                        </a>
                    <?php } ?>
                    <div class="infor">
                        <?php if ($item['title']!=''): ?>
                            <h3 class="title">
                                <?php if ( $item['url'] ) { ?>
                                    <a href="<?php echo esc_url($item['url']); ?>">
                                <?php } ?>
                                <?php echo trim( $item['title'] ); ?>
                                <?php if ( $item['url'] ) { ?>
                                    </a>
                                <?php } ?>
                            </h3>
                        <?php endif; ?>
                        <?php if ( !empty($item['url'])) { ?>
                            <div class="more">
                              <a href="<?php echo esc_url($item['url']); ?>" class="btn-readmore">
                                <?php if($item['text_button']!=''){ ?>
                                    <?php echo trim( $item['text_button'] ); ?>
                                <?php }else{ ?>
                                    <?php echo esc_html__('Shop now','famita'); ?>
                                <?php } ?>
                              </a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php endif; ?>