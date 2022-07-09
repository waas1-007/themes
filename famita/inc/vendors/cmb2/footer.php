<?php
if ( !function_exists( 'famita_footer_metaboxes' ) ) {
	function famita_footer_metaboxes(array $metaboxes) {
		$prefix = 'apus_footer_';
	    $fields = array(
			array(
				'name' => esc_html__( 'Footer Style', 'famita' ),
				'id'   => $prefix.'style_class',
				'type' => 'select',
				'options' => array(
					'container' => esc_html__('Boxed', 'famita'),
					'full container-fluid' => esc_html__('Full Large', 'famita'),
					'full-medium container-fluid' => esc_html__('Full Medium', 'famita'),
				)
			),
			array(
				'name' => esc_html__( 'Footer Background Color', 'famita' ),
				'id'   => $prefix.'background_class',
				'type' => 'select',
				'options' => array(
					'' => esc_html__('White', 'famita'),
					'dark' => esc_html__('Dark', 'famita'),
				)
			),
    	);
		
	    $metaboxes[$prefix . 'display_setting'] = array(
			'id'                        => $prefix . 'display_setting',
			'title'                     => esc_html__( 'Display Settings', 'famita' ),
			'object_types'              => array( 'apus_footer' ),
			'context'                   => 'normal',
			'priority'                  => 'high',
			'show_names'                => true,
			'fields'                    => $fields
		);

	    return $metaboxes;
	}
}
add_filter( 'cmb2_meta_boxes', 'famita_footer_metaboxes' );