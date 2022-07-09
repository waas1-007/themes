<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
?>
<div class="clearfix widget-action <?php echo esc_attr($el_class.' '.$style); ?>">
    <?php if($sub_title!=''): ?>
        <div class="sub_title" >
           <?php echo esc_attr( $sub_title ); ?>
        </div>
    <?php endif; ?>
    <?php if(wpb_js_remove_wpautop( $content, true )){ ?>
        <h3 class="title" >
            <?php echo wpb_js_remove_wpautop( $content, true ); ?>
        </h3>
    <?php } ?>
    <?php if(trim($linkbutton1)!='' || trim($linkbutton2)!='' ){ ?>
        <div class="action">
            <?php if(trim($linkbutton1)!=''){ ?>
            <a class="btn <?php echo esc_attr( $buttons1 ); ?>" href="<?php echo esc_attr( $linkbutton1 ); ?>"> <span><?php echo trim( $textbutton1 ); ?></span> <i class="fa fa-angle-right"></i> </a>
            <?php } ?>
        </div>
    <?php } ?>
</div>