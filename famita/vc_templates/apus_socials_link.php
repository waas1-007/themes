<?php

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$socials = array('facebook' => esc_html__('Facebook', 'famita'), 'twitter' => esc_html__('Twitter', 'famita'),
	'youtube' => esc_html__('Youtube', 'famita'), 'pinterest' => esc_html__('Pinterest', 'famita'),
	'google-plus' => esc_html__('Google Plus', 'famita'), 'instagram' => esc_html__('Instagram', 'famita'));
?>
<div class="widget widget-social <?php echo esc_attr($el_class.' '.$align.' '.$style); ?>">
    <?php if ($title!=''): ?>
        <h3 class="title">
            <?php echo esc_attr( $title ); ?>
        </h3>
    <?php endif; ?>
    <div class="widget-content">
    	<?php if ($description != ''): ?>
	        <?php echo trim($description); ?>
	    <?php endif; ?>
		<ul class="social">
		    <?php foreach( $socials as $key=>$social):
		            if( isset($atts[$key.'_url']) && !empty($atts[$key.'_url']) ): ?>
		                <li>
		                    <a href="<?php echo esc_url($atts[$key.'_url']);?>" class="<?php echo esc_attr($key); ?>">
		                        <i class="fa fa-<?php echo esc_attr($key); ?> "></i>
		                    </a>
		                </li>
		    <?php
		            endif;
		        endforeach;
		    ?>
		</ul>
	</div>
</div>