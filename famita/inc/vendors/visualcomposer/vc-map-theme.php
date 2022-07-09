<?php

if ( function_exists('vc_map') && class_exists('WPBakeryShortCode') ) {
	
	if ( !function_exists('famita_load_load_theme_element')) {
		function famita_load_load_theme_element() {
			$columns = array(1,2,3,4,6);
			// Heading Text Block
			vc_map( array(
				'name'        => esc_html__( 'Apus Widget Heading','famita'),
				'base'        => 'apus_title_heading',
				"class"       => "",
				"category" => esc_html__('Apus Elements', 'famita'),
				'description' => esc_html__( 'Create title for one Widget', 'famita' ),
				"params"      => array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Widget title', 'famita' ),
						'param_name' => 'title',
						'description' => esc_html__( 'Enter heading title.', 'famita' ),
						"admin_label" => true,
					),
					array(
						"type" => "textarea",
						'heading' => esc_html__( 'Description', 'famita' ),
						"param_name" => "des",
						"value" => '',
						'description' => esc_html__( 'Enter description for title.', 'famita' )
				    ),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Style", 'famita'),
						"param_name" => "style",
						'value' 	=> array(
							esc_html__('Default Center', 'famita') => 'center', 
						),
						'std' => ''
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'famita' ),
						'param_name' => 'el_class',
						'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'famita' )
					)
				),
			));
			
			// calltoaction
			vc_map( array(
				'name'        => esc_html__( 'Apus Call To Action','famita'),
				'base'        => 'apus_call_action',
				"category" => esc_html__('Apus Elements', 'famita'),
				'description' => esc_html__( 'Create title for one Widget', 'famita' ),
				"params"      => array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Sub title', 'famita' ),
						'param_name' => 'sub_title',
						'value'       => esc_html__( 'Title', 'famita' ),
						'description' => esc_html__( 'Enter Sub heading title.', 'famita' ),
						"admin_label" => true
					),
					array(
						"type" => "textarea_html",
						'heading' => esc_html__( 'Widget title', 'famita' ),
						"param_name" => "content",
						"value" => '',
						'description' => esc_html__( 'Enter Widget title.', 'famita' )
				    ),

				    array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Text Button', 'famita' ),
						'param_name' => 'textbutton1',
						'description' => esc_html__( 'Text Button', 'famita' ),
						"admin_label" => true
					),

					array(
						'type' => 'textfield',
						'heading' => esc_html__( ' Link Button', 'famita' ),
						'param_name' => 'linkbutton1',
						'description' => esc_html__( 'Link Button', 'famita' ),
						"admin_label" => true
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Button Style", 'famita'),
						"param_name" => "buttons1",
						'value' 	=> array(
							esc_html__('Default ', 'famita') => 'btn-default ', 
							esc_html__('Primary ', 'famita') => 'btn-primary ', 
							esc_html__('Success ', 'famita') => 'btn-success radius-0 ', 
							esc_html__('Info ', 'famita') => 'btn-info ', 
							esc_html__('Warning ', 'famita') => 'btn-warning ', 
							esc_html__('Theme Color ', 'famita') => 'btn-theme',
							esc_html__('Theme Gradient Color ', 'famita') => 'btn-theme btn-gradient',
							esc_html__('Second Color ', 'famita') => 'btn-theme-second',
							esc_html__('Danger ', 'famita') => 'btn-danger ', 
							esc_html__('Pink ', 'famita') => 'btn-pink ', 
							esc_html__('White Gradient ', 'famita') => 'btn-white btn-gradient', 
							esc_html__('Primary Outline', 'famita') => 'btn-primary btn-outline', 
							esc_html__('White ', 'famita') => 'btn-white',
							esc_html__('Theme Outline ', 'famita') => 'btn-theme btn-outline ',
						),
						'std' => ''
					),
					
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Style", 'famita'),
						"param_name" => "style",
						'value' 	=> array(
							esc_html__('Default', 'famita') => 'default',
						),
						'std' => ''
					),

					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'famita' ),
						'param_name' => 'el_class',
						'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'famita' )
					)
				),
			));
			// Our Team
			vc_map( array(
	            "name" => esc_html__("Apus Our Team",'famita'),
	            "base" => "apus_ourteam",
	            'description'=> esc_html__('Display Our Team In FrontEnd', 'famita'),
	            "class" => "",
	            "category" => esc_html__('Apus Elements', 'famita'),
	            "params" => array(
	              	array(
						"type" => "textfield",
						"heading" => esc_html__("Title", 'famita'),
						"param_name" => "title",
						"admin_label" => true,
						"value" => '',
					),
	              	array(
						'type' => 'param_group',
						'heading' => esc_html__('Members Settings', 'famita' ),
						'param_name' => 'members',
						'description' => '',
						'value' => '',
						'params' => array(
							array(
				                "type" => "textfield",
				                "class" => "",
				                "heading" => esc_html__('Name','famita'),
				                "param_name" => "name",
				            ),
				            array(
				                "type" => "textfield",
				                "class" => "",
				                "heading" => esc_html__('Job','famita'),
				                "param_name" => "job",
				            ),
							array(
								"type" => "attach_image",
								"heading" => esc_html__("Image", 'famita'),
								"param_name" => "image"
							),
				            array(
				                "type" => "textfield",
				                "class" => "",
				                "heading" => esc_html__('Facebook','famita'),
				                "param_name" => "facebook",
				            ),

				            array(
				                "type" => "textfield",
				                "class" => "",
				                "heading" => esc_html__('Twitter Link','famita'),
				                "param_name" => "twitter",
				            ),

				            array(
				                "type" => "textfield",
				                "class" => "",
				                "heading" => esc_html__('Google plus Link','famita'),
				                "param_name" => "google",
				            ),

				            array(
				                "type" => "textfield",
				                "class" => "",
				                "heading" => esc_html__('Linkin Link','famita'),
				                "param_name" => "linkin",
				            ),

						),
					),
					array(
		                "type" => "dropdown",
		                "heading" => esc_html__('Columns','famita'),
		                "param_name" => 'columns',
		                "value" => array(1,2,3,4,5,6),
		            ),
		            array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'famita'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'famita')
					)
	            )
	        ));
			// Apus Counter
			vc_map( array(
			    "name" => esc_html__("Apus Counter",'famita'),
			    "base" => "apus_counter",
			    "class" => "",
			    "description"=> esc_html__('Counting number with your term', 'famita'),
			    "category" => esc_html__('Apus Elements', 'famita'),
			    "params" => array(
			    	array(
						"type" => "textfield",
						"heading" => esc_html__("Title", 'famita'),
						"param_name" => "title",
						"value" => '',
						"admin_label"	=> true
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Number", 'famita'),
						"param_name" => "number",
						"value" => ''
					),
					array(
						"type" => "colorpicker",
						"heading" => esc_html__("Color Number", 'famita'),
						"param_name" => "text_color",
						'value' 	=> '',
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'famita'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'famita')
					)
			   	)
			));
			// Banner CountDown
			vc_map( array(
				'name'        => esc_html__( 'Apus Banner CountDown','famita'),
				'base'        => 'apus_banner_countdown',
				"category" => esc_html__('Apus Elements', 'famita'),
				'description' => esc_html__( 'Show CountDown with banner', 'famita' ),
				"params"      => array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Sub Title', 'famita' ),
						'param_name' => 'subtitle',
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Widget Title', 'famita' ),
						'param_name' => 'title',
					),
					array(
					    'type' => 'textfield',
					    'heading' => esc_html__( 'Date Expired', 'famita' ),
					    'param_name' => 'input_datetime'
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Button Url', 'famita' ),
						'param_name' => 'btn_url',
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Button Text', 'famita' ),
						'param_name' => 'btn_text',
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Button Style", 'famita'),
						"param_name" => "buttons",
						'value' 	=> array(
							esc_html__('Theme Outline ', 'famita') => 'btn-theme btn-outline', 
							esc_html__('Theme ', 'famita') => 'btn-theme', 
							esc_html__('Primary ', 'famita') => 'btn-primary ', 
							esc_html__('Success ', 'famita') => 'btn-success', 
							esc_html__('Info ', 'famita') => 'btn-info ', 
							esc_html__('Warning ', 'famita') => 'btn-warning ',
						),
						'std' => ''
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Style", 'famita'),
						"param_name" => "style_widget",
						'value' 	=> array(
							esc_html__('Default', 'famita') => '',
							esc_html__('Center', 'famita') => 'st_center',
						),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'famita' ),
						'param_name' => 'el_class',
						'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'famita' )
					),
				),
			));
			// Banner
			vc_map( array(
				'name'        => esc_html__( 'Apus Banner','famita'),
				'base'        => 'apus_banner',
				"category" => esc_html__('Apus Elements', 'famita'),
				'description' => esc_html__( 'Show banner in FrontEnd', 'famita' ),
				"params"      => array(
					array(
						'type' => 'param_group',
						'heading' => esc_html__('Items', 'famita'),
						'param_name' => 'items',
						'params' => array(
							array(
								'type' => 'textarea',
								'heading' => esc_html__( 'Widget Title', 'famita' ),
								'param_name' => 'title',
							),
						    array(
								"type" => "attach_image",
								"heading" => esc_html__("Banner Image", 'famita'),
								"param_name" => "image"
							),
							array(
								'type' => 'textfield',
								'heading' => esc_html__( 'Url', 'famita' ),
								'param_name' => 'url',
							),
							array(
								'type' => 'textfield',
								'heading' => esc_html__( 'Text Button', 'famita' ),
								'param_name' => 'text_button',
							),
							array(
				                "type" => "dropdown",
				                "heading" => esc_html__('Style','famita'),
				                "param_name" => 'style',
				                'value' 	=> array(
									esc_html__('Left ', 'famita') => 'st_left', 
									esc_html__('Right ', 'famita') => 'st_right', 
									esc_html__('Center ', 'famita') => 'st_center', 
									esc_html__('Left Center', 'famita') => 'st_left s_center', 
									esc_html__('Right Center', 'famita') => 'st_right s_center',
									esc_html__('Bottom', 'famita') => 'st_bottom',
								),
								'std' => ''
				            ),
				            array(
								'type' => 'checkbox',
								'heading' => esc_html__( 'No Border?', 'famita' ),
								'param_name' => 'noborder',
								'description' => esc_html__( 'No Border for Widget.', 'famita' ),
								'value' => array( esc_html__( 'No', 'famita' ) => 'yes' )
							),
						),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'famita' ),
						'param_name' => 'el_class',
						'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'famita' )
					),
				),
			));
			// Apus Brands
			vc_map( array(
			    "name" => esc_html__("Apus Brands",'famita'),
			    "base" => "apus_brands",
			    "class" => "",
			    "description"=> esc_html__('Display brands on front end', 'famita'),
			    "category" => esc_html__('Apus Elements', 'famita'),
			    "params" => array(
			    	array(
						"type" => "textfield",
						"heading" => esc_html__("Title", 'famita'),
						"param_name" => "title",
						"value" => '',
						"admin_label"	=> true
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Number", 'famita'),
						"param_name" => "number",
						"value" => ''
					),
				 	array(
						"type" => "dropdown",
						"heading" => esc_html__("Layout Type", 'famita'),
						"param_name" => "layout_type",
						'value' 	=> array(
							esc_html__('Carousel', 'famita') => 'carousel', 
							esc_html__('Grid', 'famita') => 'grid'
						),
						'std' => ''
					),
					array(
		                "type" => "dropdown",
		                "heading" => esc_html__('Columns','famita'),
		                "param_name" => 'columns',
		                "value" => array(1,2,3,4,5,6,8),
		            ),
		            array(
		                "type" => "dropdown",
		                "heading" => esc_html__('Style','famita'),
		                "param_name" => 'style',
		                'value' 	=> array(
							esc_html__('Default ', 'famita') => '', 
						),
						'std' => ''
		            ),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'famita'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'famita')
					)
			   	)
			));
			
			vc_map( array(
			    "name" => esc_html__("Apus Socials link",'famita'),
			    "base" => "apus_socials_link",
			    "description"=> esc_html__('Show socials link', 'famita'),
			    "category" => esc_html__('Apus Elements', 'famita'),
			    "params" => array(
			    	array(
						"type" => "textfield",
						"heading" => esc_html__("Title", 'famita'),
						"param_name" => "title",
						"value" => '',
						"admin_label"	=> true
					),
					array(
						"type" => "textarea",
						"heading" => esc_html__("Description", 'famita'),
						"param_name" => "description",
						"value" => '',
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Facebook Page URL", 'famita'),
						"param_name" => "facebook_url",
						"value" => '',
						"admin_label"	=> true
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Twitter Page URL", 'famita'),
						"param_name" => "twitter_url",
						"value" => '',
						"admin_label"	=> true
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Youtube Page URL", 'famita'),
						"param_name" => "youtube_url",
						"value" => '',
						"admin_label"	=> true
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Pinterest Page URL", 'famita'),
						"param_name" => "pinterest_url",
						"value" => '',
						"admin_label"	=> true
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Google Plus Page URL", 'famita'),
						"param_name" => "google-plus_url",
						"value" => '',
						"admin_label"	=> true
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Instagram Page URL", 'famita'),
						"param_name" => "instagram_url",
						"value" => '',
						"admin_label"	=> true
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Align", 'famita'),
						"param_name" => "align",
						'value' 	=> array(
							esc_html__('Left', 'famita') => 'left', 
							esc_html__('Right', 'famita') => 'right',
							esc_html__('Center', 'famita') => 'center'
						),
						'std' => ''
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Style", 'famita'),
						"param_name" => "style",
						'value' 	=> array(
							esc_html__('Default', 'famita') => '', 
						),
						'std' => ''
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'famita'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'famita')
					)
			   	)
			));
			// newsletter
			vc_map( array(
			    "name" => esc_html__("Apus Newsletter",'famita'),
			    "base" => "apus_newsletter",
			    "class" => "",
			    "description"=> esc_html__('Show newsletter form', 'famita'),
			    "category" => esc_html__('Apus Elements', 'famita'),
			    "params" => array(
			    	array(
						"type" => "textfield",
						"heading" => esc_html__("Title", 'famita'),
						"param_name" => "title",
						"value" => '',
						"admin_label"	=> true
					),
					array(
						"type" => "textarea",
						"heading" => esc_html__("Description", 'famita'),
						"param_name" => "description",
						"value" => '',
					),
					array(
		                "type" => "dropdown",
		                "heading" => esc_html__('Layout','famita'),
		                "param_name" => 'style',
		                'value' 	=> array(
							esc_html__('Style 1 ', 'famita') => 'style1',
							esc_html__('Style 2 ', 'famita') => 'style2',
						),
						'std' => ''
		            ),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'famita'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'famita')
					)
			   	)
			));
			
			// google map
			$map_styles = array( esc_html__('Choose a map style', 'famita') => '' );
			if ( is_admin() && class_exists('Famita_Google_Maps_Styles') ) {
				$styles = Famita_Google_Maps_Styles::styles();
				foreach ($styles as $style) {
					$map_styles[$style['title']] = $style['slug'];
				}
			}
			vc_map( array(
			    "name" => esc_html__("Apus Google Map",'famita'),
			    "base" => "apus_googlemap",
			    "description" => esc_html__('Diplay Google Map', 'famita'),
			    "category" => esc_html__('Apus Elements', 'famita'),
			    "params" => array(
			    	array(
						"type" => "textfield",
						"heading" => esc_html__("Title", 'famita'),
						"param_name" => "title",
						"admin_label" => true,
						"value" => '',
					),
					array(
		                "type" => "textarea",
		                "class" => "",
		                "heading" => esc_html__('Description','famita'),
		                "param_name" => "des",
		            ),
		            array(
		                'type' => 'googlemap',
		                'heading' => esc_html__( 'Location', 'famita' ),
		                'param_name' => 'location',
		                'value' => ''
		            ),
		            array(
		                'type' => 'hidden',
		                'heading' => esc_html__( 'Latitude Longitude', 'famita' ),
		                'param_name' => 'lat_lng',
		                'value' => '21.0173222,105.78405279999993'
		            ),
		            array(
						"type" => "textfield",
						"heading" => esc_html__("Map height", 'famita'),
						"param_name" => "height",
						"value" => '',
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Map Zoom", 'famita'),
						"param_name" => "zoom",
						"value" => '13',
					),
		            array(
		                'type' => 'dropdown',
		                'heading' => esc_html__( 'Map Type', 'famita' ),
		                'param_name' => 'type',
		                'value' => array(
		                    esc_html__( 'roadmap', 'famita' ) 		=> 'ROADMAP',
		                    esc_html__( 'hybrid', 'famita' ) 	=> 'HYBRID',
		                    esc_html__( 'satellite', 'famita' ) 	=> 'SATELLITE',
		                    esc_html__( 'terrain', 'famita' ) 	=> 'TERRAIN',
		                )
		            ),
		            array(
						"type" => "attach_image",
						"heading" => esc_html__("Custom Marker Icon", 'famita'),
						"param_name" => "marker_icon"
					),
					array(
		                'type' => 'dropdown',
		                'heading' => esc_html__( 'Custom Map Style', 'famita' ),
		                'param_name' => 'map_style',
		                'value' => $map_styles
		            ),
		            
					array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'famita'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'famita')
					)
			   	)
			));
			// Testimonial
			vc_map( array(
	            "name" => esc_html__("Apus Testimonials",'famita'),
	            "base" => "apus_testimonials",
	            'description'=> esc_html__('Display Testimonials In FrontEnd', 'famita'),
	            "class" => "",
	            "category" => esc_html__('Apus Elements', 'famita'),
	            "params" => array(
	              	array(
						"type" => "textfield",
						"heading" => esc_html__("Title", 'famita'),
						"param_name" => "title",
						"admin_label" => true,
						"value" => '',
					),
	              	array(
		              	"type" => "textfield",
		              	"heading" => esc_html__("Number", 'famita'),
		              	"param_name" => "number",
		              	"value" => '4',
		            ),
		            array(
		                "type" => "dropdown",
		                "heading" => esc_html__('Columns','famita'),
		                "param_name" => 'columns',
		                "value" => array(1,2,3,4,5,6),
		            ),
		            array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'famita'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'famita')
					)
	            )
	        ));
	        
	        // Gallery Images
			vc_map( array(
	            "name" => esc_html__("Apus Gallery",'famita'),
	            "base" => "apus_gallery",
	            'description'=> esc_html__('Display Gallery In FrontEnd', 'famita'),
	            "class" => "",
	            "category" => esc_html__('Apus Elements', 'famita'),
	            "params" => array(
	              	array(
						"type" => "textfield",
						"heading" => esc_html__("Title", 'famita'),
						"param_name" => "title",
						"admin_label" => true,
						"value" => '',
					),
					array(
						'type' => 'param_group',
						'heading' => esc_html__('Images', 'famita'),
						'param_name' => 'images',
						'params' => array(
							array(
								"type" => "attach_image",
								"param_name" => "image",
								'heading'	=> esc_html__('Image', 'famita')
							),
							array(
				                "type" => "textfield",
				                "heading" => esc_html__('Title','famita'),
				                "param_name" => "title",
				            ),
				            array(
				                "type" => "textarea",
				                "heading" => esc_html__('Description','famita'),
				                "param_name" => "description",
				            ),
						),
					),
					array(
		                "type" => "dropdown",
		                "heading" => esc_html__('Columns','famita'),
		                "param_name" => 'columns',
		                "value" => $columns,
		            ),
		            array(
		                "type" => "dropdown",
		                "heading" => esc_html__('Layout Type','famita'),
		                "param_name" => 'layout_type',
		                'value' 	=> array(
							esc_html__('Grid', 'famita') => 'grid', 
							esc_html__('Mansory 1', 'famita') => 'mansory',
							esc_html__('Mansory 2', 'famita') => 'mansory2',
						),
						'std' => 'grid'
		            ),
		            array(
		                "type" => "dropdown",
		                "heading" => esc_html__('Gutter Elements','famita'),
		                "param_name" => 'gutter',
		                'value' 	=> array(
							esc_html__('Default ', 'famita') => '', 
							esc_html__('Gutter 30', 'famita') => 'gutter30',
						),
						'std' => ''
		            ),
		            array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'famita'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'famita')
					)
	            )
	        ));
	        // Gallery Video
			vc_map( array(
	            "name" => esc_html__("Apus Video",'famita'),
	            "base" => "apus_video",
	            'description'=> esc_html__('Display Video In FrontEnd', 'famita'),
	            "class" => "",
	            "category" => esc_html__('Apus Elements', 'famita'),
	            "params" => array(
	              	array(
						"type" => "textfield",
						"heading" => esc_html__("Title", 'famita'),
						"param_name" => "title",
						"admin_label" => true,
						"value" => '',
					),
					array(
						"type" => "textarea_html",
						'heading' => esc_html__( 'Description', 'famita' ),
						"param_name" => "content",
						"value" => '',
						'description' => esc_html__( 'Enter description for title.', 'famita' )
				    ),
	              	array(
						"type" => "attach_image",
						"heading" => esc_html__("Background Play Image", 'famita'),
						"param_name" => "image"
					),
					array(
		                "type" => "textfield",
		                "heading" => esc_html__('Youtube Video Link','famita'),
		                "param_name" => 'video_link'
		            ),
		            array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'famita'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'famita')
					)
	            )
	        ));
	        // Features Box
			vc_map( array(
	            "name" => esc_html__("Apus Features Box",'famita'),
	            "base" => "apus_features_box",
	            'description'=> esc_html__('Display Features In FrontEnd', 'famita'),
	            "class" => "",
	            "category" => esc_html__('Apus Elements', 'famita'),
	            "params" => array(
	            	array(
						"type" => "textfield",
						"heading" => esc_html__("Title", 'famita'),
						"param_name" => "title",
						"admin_label" => true,
						"value" => '',
					),
					array(
						'type' => 'param_group',
						'heading' => esc_html__('Members Settings', 'famita' ),
						'param_name' => 'items',
						'description' => '',
						'value' => '',
						'params' => array(
							array(
								"type" => "attach_image",
								"description" => esc_html__("Image for box.", 'famita'),
								"param_name" => "image",
								"value" => '',
								'heading'	=> esc_html__('Image', 'famita' )
							),
							array(
				                "type" => "textfield",
				                "class" => "",
				                "heading" => esc_html__('Title','famita'),
				                "param_name" => "title",
				            ),
				            array(
				                "type" => "textarea",
				                "class" => "",
				                "heading" => esc_html__('Description','famita'),
				                "param_name" => "description",
				            ),
							array(
								"type" => "textfield",
								"heading" => esc_html__("Material Design Icon and Awesome Icon", 'famita'),
								"param_name" => "icon",
								"value" => '',
								'description' => esc_html__( 'This support display icon from Material Design and Awesome Icon, Please click', 'famita' )
												. '<a href="' . ( is_ssl()  ? 'https' : 'http') . '://zavoloklom.github.io/material-design-iconic-font/icons.html" target="_blank">'
												. esc_html__( 'here to see the list', 'famita' ) . '</a>'
							),
						),
					),
		           	array(
		                "type" => "dropdown",
		                "heading" => esc_html__('Style Layout','famita'),
		                "param_name" => 'style',
		                'value' 	=> array(
							esc_html__('Default', 'famita') => '', 
						),
						'std' => ''
		            ),
		            array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'famita'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'famita')
					)
	            )
	        ));
	        // Location
			vc_map( array(
	            "name" => esc_html__("Apus Location",'famita'),
	            "base" => "apus_location",
	            'description'=> esc_html__('Display Features In FrontEnd', 'famita'),
	            "class" => "",
	            "category" => esc_html__('Apus Elements', 'famita'),
	            "params" => array(
					array(
						'type' => 'param_group',
						'heading' => esc_html__('Members Settings', 'famita' ),
						'param_name' => 'items',
						'description' => '',
						'value' => '',
						'params' => array(
							array(
								"type" => "attach_image",
								"description" => esc_html__("Image for box.", 'famita'),
								"param_name" => "image",
								"value" => '',
								'heading'	=> esc_html__('Image', 'famita' )
							),
							array(
				                "type" => "textfield",
				                "class" => "",
				                "heading" => esc_html__('Title','famita'),
				                "param_name" => "title",
				            ),
				            array(
				                "type" => "textarea",
				                "class" => "",
				                "heading" => esc_html__('Description','famita'),
				                "param_name" => "description",
				            ),
						),
					),
		            array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'famita'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'famita')
					)
	            )
	        ));

			$custom_menus = array();
			if ( is_admin() ) {
				$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
				if ( is_array( $menus ) && ! empty( $menus ) ) {
					foreach ( $menus as $single_menu ) {
						if ( is_object( $single_menu ) && isset( $single_menu->name, $single_menu->slug ) ) {
							$custom_menus[ $single_menu->name ] = $single_menu->slug;
						}
					}
				}
			}
			// Menu
			vc_map( array(
			    "name" => esc_html__("Apus Custom Menu",'famita'),
			    "base" => "apus_custom_menu",
			    "class" => "",
			    "description"=> esc_html__('Show Custom Menu', 'famita'),
			    "category" => esc_html__('Apus Elements', 'famita'),
			    "params" => array(
			    	array(
						"type" => "textfield",
						"heading" => esc_html__("Title", 'famita'),
						"param_name" => "title",
						"value" => '',
						"admin_label"	=> true
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Menu', 'famita' ),
						'param_name' => 'nav_menu',
						'value' => $custom_menus,
						'description' => empty( $custom_menus ) ? esc_html__( 'Custom menus not found. Please visit Appearance > Menus page to create new menu.', 'famita' ) : esc_html__( 'Select menu to display.', 'famita' ),
						'admin_label' => true,
						'save_always' => true,
					),
					array(
		                "type" => "dropdown",
		                "heading" => esc_html__('Align','famita'),
		                "param_name" => 'align',
		                'value' 	=> array(
							esc_html__('Inherit', 'famita') => '', 
							esc_html__('Left', 'famita') => 'left', 
							esc_html__('Right', 'famita') => 'right', 
							esc_html__('Center', 'famita') => 'center', 
							esc_html__('Inline', 'famita') => 'inline', 
						),
						'std' => ''
		            ),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'famita'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'famita')
					)
			   	)
			));

			vc_map( array(
	            "name" => esc_html__("Apus Instagram",'famita'),
	            "base" => "apus_instagram",
	            'description'=> esc_html__('Display Instagram In FrontEnd', 'famita'),
	            "class" => "",
	            "category" => esc_html__('Apus Elements', 'famita'),
	            "params" => array(
	            	array(
						"type" => "textfield",
						"heading" => esc_html__("Title", 'famita'),
						"param_name" => "title",
						"admin_label" => true,
						"value" => '',
					),
					array(
		              	"type" => "textfield",
		              	"heading" => esc_html__("Instagram Username", 'famita'),
		              	"param_name" => "username",
		            ),
					array(
		              	"type" => "textfield",
		              	"heading" => esc_html__("Number", 'famita'),
		              	"param_name" => "number",
		              	'value' => '1',
		            ),
	             	array(
		              	"type" => "textfield",
		              	"heading" => esc_html__("Number Columns", 'famita'),
		              	"param_name" => "columns",
		              	'value' => '1',
		            ),
		           	array(
		                "type" => "dropdown",
		                "heading" => esc_html__('Layout Type','famita'),
		                "param_name" => 'layout_type',
		                'value' 	=> array(
							esc_html__('Grid', 'famita') => 'grid', 
							esc_html__('Carousel', 'famita') => 'carousel', 
						)
		            ),
		            array(
		                "type" => "dropdown",
		                "heading" => esc_html__('Photo size','famita'),
		                "param_name" => 'size',
		                'value' 	=> array(
							esc_html__('Thumbnail', 'famita') => 'thumbnail', 
							esc_html__('Small', 'famita') => 'small', 
							esc_html__('Large', 'famita') => 'large', 
							esc_html__('Original', 'famita') => 'original', 
						)
		            ),
		            array(
		                "type" => "dropdown",
		                "heading" => esc_html__('Open links in','famita'),
		                "param_name" => 'target',
		                'value' 	=> array(
							esc_html__('Current window (_self)', 'famita') => '_self', 
							esc_html__('New window (_blank)', 'famita') => '_blank',
						)
		            ),
		            array(
		                "type" => "dropdown",
		                "heading" => esc_html__('Layout For Widget','famita'),
		                "param_name" => 'layout_widget',
		                'value' 	=> array(
							esc_html__('Style 1', 'famita') => '', 
							esc_html__('Style 2', 'famita') => 'style2', 
						)
		            ),
		            array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'famita'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'famita')
					)
	            )
	        ));
		}
	}
	add_action( 'vc_after_set_mode', 'famita_load_load_theme_element', 99 );

	class WPBakeryShortCode_apus_title_heading extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_call_action extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_brands extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_socials_link extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_newsletter extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_googlemap extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_testimonials extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_banner_countdown extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_banner extends WPBakeryShortCode {}

	class WPBakeryShortCode_apus_counter extends WPBakeryShortCode {
		public function __construct( $settings ) {
			parent::__construct( $settings );
			$this->load_scripts();
		}

		public function load_scripts() {
			wp_register_script('jquery-counterup', get_template_directory_uri().'/js/jquery.counterup.min.js', array('jquery'), false, true);
		}
	}
	class WPBakeryShortCode_apus_gallery extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_video extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_features_box extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_custom_menu extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_instagram extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_ourteam extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_location extends WPBakeryShortCode {}
}