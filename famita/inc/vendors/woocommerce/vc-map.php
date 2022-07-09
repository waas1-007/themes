<?php
if ( function_exists('vc_map') && class_exists('WPBakeryShortCode') ) {
	
	if ( !function_exists('famita_vc_get_product_object')) {
		function famita_vc_get_product_object($term) {
			$vc_taxonomies_types = vc_taxonomies_types();

			return array(
				'label' => $term->post_title,
				'value' => $term->post_name,
				'group_id' => $term->post_name,
				'group' => isset( $vc_taxonomies_types[ $term->taxonomy ], $vc_taxonomies_types[ $term->taxonomy ]->labels, $vc_taxonomies_types[ $term->taxonomy ]->labels->name ) ? $vc_taxonomies_types[ $term->taxonomy ]->labels->name : esc_html__( 'Taxonomies', 'famita' ),
			);
		}
	}

	if ( !function_exists('famita_product_field_search')) {
		function famita_product_field_search( $search_string ) {
			$data = array();
			$loop = famita_get_products( array( 'product_type' => 'deals' ) );

			if ( !empty($loop->posts) ) {

				foreach ( $loop->posts as $t ) {
					if ( is_object( $t ) ) {
						$data[] = famita_vc_get_product_object( $t );
					}
				}
			}
			
			return $data;
		}
	}

	if ( !function_exists('famita_product_render')) {
		function famita_product_render( $query ) {
			$args = array(
			  'name'        => $query['value'],
			  'post_type'   => 'product',
			  'post_status' => 'publish',
			  'numberposts' => 1
			);
			$products = get_posts($args);
			if ( ! empty( $query ) && $products ) {
				$product = $products[0];
				$data = array();
				$data['value'] = $product->post_name;
				$data['label'] = $product->post_title;
				return ! empty( $data ) ? $data : false;
			}
			return false;
		}
	}
	add_filter( 'vc_autocomplete_apus_product_deal_product_slugs_callback', 'famita_product_field_search', 10, 1 );
	add_filter( 'vc_autocomplete_apus_product_deal_product_slugs_render', 'famita_product_render', 10, 1 );
	
	if ( !function_exists('famita_vc_get_term_object')) {
		function famita_vc_get_term_object($term) {
			$vc_taxonomies_types = vc_taxonomies_types();

			return array(
				'label' => $term->name,
				'value' => $term->slug,
				'group_id' => $term->taxonomy,
				'group' => isset( $vc_taxonomies_types[ $term->taxonomy ], $vc_taxonomies_types[ $term->taxonomy ]->labels, $vc_taxonomies_types[ $term->taxonomy ]->labels->name ) ? $vc_taxonomies_types[ $term->taxonomy ]->labels->name : esc_html__( 'Taxonomies', 'famita' ),
			);
		}
	}

	if ( !function_exists('famita_category_field_search')) {
		function famita_category_field_search( $search_string ) {
			$data = array();
			$vc_taxonomies_types = array('product_cat');
			$vc_taxonomies = get_terms( $vc_taxonomies_types, array(
				'hide_empty' => false,
				'search' => $search_string
			) );
			if ( is_array( $vc_taxonomies ) && ! empty( $vc_taxonomies ) ) {
				foreach ( $vc_taxonomies as $t ) {
					if ( is_object( $t ) ) {
						$data[] = famita_vc_get_term_object( $t );
					}
				}
			}
			return $data;
		}
	}

	if ( !function_exists('famita_category_render')) {
		function famita_category_render($query) {  
			$category = get_term_by('slug', $query['value'], 'product_cat');
			if ( ! empty( $query ) && !empty($category)) {
				$data = array();
				$data['value'] = $category->slug;
				$data['label'] = $category->name;
				return ! empty( $data ) ? $data : false;
			}
			return false;
		}
	}

	$bases = array( 'apus_products' );
	foreach( $bases as $base ){   
		add_filter( 'vc_autocomplete_'.$base .'_categories_callback', 'famita_category_field_search', 10, 1 );
	 	add_filter( 'vc_autocomplete_'.$base .'_categories_render', 'famita_category_render', 10, 1 );
	}

	function famita_load_woocommerce_element() {
		$categories = array();
		if ( is_admin() ) {
			$categories = famita_woocommerce_get_categories();
		}
		$types = array(
			esc_html__('Recent Products', 'famita' ) => 'recent_product',
			esc_html__('Best Selling', 'famita' ) => 'best_selling',
			esc_html__('Featured Products', 'famita' ) => 'featured_product',
			esc_html__('Top Rate', 'famita' ) => 'top_rate',
			esc_html__('On Sale', 'famita' ) => 'on_sale',
			esc_html__('Recent Review', 'famita' ) => 'recent_review'
		);

		vc_map( array(
			'name' => esc_html__( 'Apus Products', 'famita' ),
			'base' => 'apus_products',
			'icon' => 'icon-wpb-woocommerce',
			'category' => esc_html__( 'Apus Woocommerce', 'famita' ),
			'description' => esc_html__( 'Display products in frontend', 'famita' ),
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Title', 'famita' ),
					'param_name' => 'title',
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Get Products By", 'famita'),
					"param_name" => "type",
					"value" => $types,
				),
				array(
				    'type' => 'autocomplete',
				    'heading' => esc_html__( 'Get Products By Categories', 'famita' ),
				    'param_name' => 'categories',
				    'settings' => array(
				     	'multiple' => true,
				     	'unique_values' => true
				    ),
			   	),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Number Products', 'famita' ),
					'value' => 10,
					'param_name' => 'number',
					'description' => esc_html__( 'Number products per page to show', 'famita' ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Layout Type', 'famita' ),
					"param_name" => "layout_type",
					"value" => array(
						esc_html__( 'Grid', 'famita' ) => 'grid',
						esc_html__( 'Carousel', 'famita' ) => 'carousel',
					)
				),
				array(
	                "type" => "dropdown",
	                "heading" => esc_html__('Columns', 'famita'),
	                "param_name" => 'columns',
	                "value" => array(1,2,3,4,5,6),
	            ),
	            array(
	                "type" => "dropdown",
	                "heading" => esc_html__('Rows', 'famita'),
	                "param_name" => 'rows',
	                "value" => array(1,2,3,4,5),
	                'dependency' => array(
						'element' => 'layout_type',
						'value' => array('carousel'),
					),
	            ),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show Navigation', 'famita' ),
					'param_name' => 'show_nav',
					'value' => array( esc_html__( 'Yes, to show navigation', 'famita' ) => 'yes' ),
					'dependency' => array(
						'element' => 'layout_type',
						'value' => array('carousel'),
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show Pagination', 'famita' ),
					'param_name' => 'show_pagination',
					'value' => array( esc_html__( 'Yes, to show Pagination', 'famita' ) => 'yes' ),
					'dependency' => array(
						'element' => 'layout_type',
						'value' => array('carousel'),
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show Button All Items', 'famita' ),
					'param_name' => 'show_all',
					'value' => array( esc_html__( 'Yes, Show Button All Items', 'famita' ) => 'yes' ),
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Text Button', 'famita' ),
					'param_name' => 'text_button',
					'dependency' => array(
						'element' => 'show_all',
						'value' => 'yes',
					),
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Link Button', 'famita' ),
					'param_name' => 'link_button',
					'dependency' => array(
						'element' => 'show_all',
						'value' => 'yes',
					),
				),
	            array(
					"type" => "textfield",
					"heading" => esc_html__("Extra class name",'famita'),
					"param_name" => "el_class",
					"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.",'famita')
				)
			)
		) );

		vc_map( array(
			'name' => esc_html__( 'Apus Products Tabs', 'famita' ),
			'base' => 'apus_products_tabs',
			'icon' => 'icon-wpb-woocommerce',
			'category' => esc_html__( 'Apus Woocommerce', 'famita' ),
			'description' => esc_html__( 'Display products in Tabs', 'famita' ),
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Widget Title', 'famita' ),
					'param_name' => 'title',
				),
				array(
					'type' => 'param_group',
					'heading' => esc_html__( 'Product Tabs', 'famita' ),
					'param_name' => 'tabs',
					'params' => array(
						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Tab Title', 'famita' ),
							'param_name' => 'title',
						),
						array(
							"type" => "dropdown",
							"heading" => esc_html__("Get Products By",'famita'),
							"param_name" => "type",
							"value" => $types,
						),
						array(
							"type" => "dropdown",
							"heading" => esc_html__( 'Category', 'famita' ),
							"param_name" => "category",
							"value" => $categories
						),
					)
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Number Products', 'famita' ),
					'value' => 10,
					'param_name' => 'number',
					'description' => esc_html__( 'Number products per page to show', 'famita' ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Layout Type', 'famita' ),
					"param_name" => "layout_type",
					"value" => array(
						esc_html__( 'Grid', 'famita' ) => 'grid',
						esc_html__( 'Carousel', 'famita' ) => 'carousel',
					)
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Gutter', 'famita' ),
					"param_name" => "gutter",
					"value" => array(
						esc_html__( 'Normal', 'famita' ) => '',
						esc_html__( 'Small', 'famita' ) => ' st_small',
					)
				),
				array(
	                "type" => "dropdown",
	                "heading" => esc_html__('Columns', 'famita'),
	                "param_name" => 'columns',
	                "value" => array(1,2,3,4,5,6),
	            ),
	            array(
	                "type" => "dropdown",
	                "heading" => esc_html__('Rows', 'famita'),
	                "param_name" => 'rows',
	                "value" => array(1,2,3,4),
	                'dependency' => array(
						'element' => 'layout_type',
						'value' => array('carousel'),
					),
	            ),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show Navigation', 'famita' ),
					'param_name' => 'show_nav',
					'value' => array( esc_html__( 'Yes, to show navigation', 'famita' ) => 'yes' ),
					'dependency' => array(
						'element' => 'layout_type',
						'value' => array('carousel'),
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show Pagination', 'famita' ),
					'param_name' => 'show_pagination',
					'value' => array( esc_html__( 'Yes, to show Pagination', 'famita' ) => 'yes' ),
					'dependency' => array(
						'element' => 'layout_type',
						'value' => array('carousel'),
					),
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Link Button Readmore', 'famita' ),
					'param_name' => 'link_button',
				),
	            array(
					"type" => "textfield",
					"heading" => esc_html__("Extra class name",'famita'),
					"param_name" => "el_class",
					"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.",'famita')
				)
			)
		) );

		vc_map( array(
			'name' => esc_html__( 'Apus Products Deal', 'famita' ),
			'base' => 'apus_product_deal',
			'icon' => 'icon-wpb-woocommerce',
			'category' => esc_html__( 'Apus Woocommerce', 'famita' ),
			'description' => esc_html__( 'Display product deal', 'famita' ),
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Title', 'famita' ),
					'param_name' => 'title',
				),
				array(
				    'type' => 'autocomplete',
				    'heading' => esc_html__( 'Choose Products', 'famita' ),
				    'param_name' => 'product_slugs',
				    'settings' => array(
				     	'multiple' => true,
				     	'unique_values' => true
				    ),
			   	),
			   	array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Layout Type', 'famita' ),
					"param_name" => "layout_type",
					"value" => array(
						esc_html__( 'Grid', 'famita' ) => 'grid',
						esc_html__( 'Carousel', 'famita' ) => 'carousel',
					)
				),
				array(
	                "type" => "dropdown",
	                "heading" => esc_html__('Columns', 'famita'),
	                "param_name" => 'columns',
	                "value" => array(1,2,3,4,5,6),
	            ),
	            array(
	                "type" => "dropdown",
	                "heading" => esc_html__('Rows', 'famita'),
	                "param_name" => 'rows',
	                "value" => array(1,2,3,4),
	                'dependency' => array(
						'element' => 'layout_type',
						'value' => array('carousel'),
					),
	            ),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show Navigation', 'famita' ),
					'param_name' => 'show_nav',
					'value' => array( esc_html__( 'Yes, to show navigation', 'famita' ) => 'yes' ),
					'dependency' => array(
						'element' => 'layout_type',
						'value' => array('carousel'),
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show Pagination', 'famita' ),
					'param_name' => 'show_pagination',
					'value' => array( esc_html__( 'Yes, to show Pagination', 'famita' ) => 'yes' ),
					'dependency' => array(
						'element' => 'layout_type',
						'value' => array('carousel'),
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show 2 Item on Laptop', 'famita' ),
					'param_name' => 'show_smalldestop',
					'value' => array( esc_html__( 'Yes', 'famita' ) => 'yes' ),
					'dependency' => array(
						'element' => 'layout_type',
						'value' => array('carousel'),
					),
				),
	            array(
					"type" => "textfield",
					"heading" => esc_html__("Extra class name", 'famita'),
					"param_name" => "el_class",
					"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.",'famita')
				)
			)
		) );

		vc_map( array(
			'name' => esc_html__( 'Apus Category Banners', 'famita' ),
			'base' => 'apus_category_banner',
			'icon' => 'icon-wpb-woocommerce',
			'category' => esc_html__( 'Apus Woocommerce', 'famita' ),
			'description' => esc_html__( 'Display category banner', 'famita' ),
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Title', 'famita' ),
					'param_name' => 'title',
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Category', 'famita' ),
					"param_name" => "category",
					"value" => $categories
				),
				array(
					"type" => "attach_image",
					"heading" => esc_html__("Category Image", 'famita'),
					"param_name" => "image"
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Style", 'famita'),
					"param_name" => "style",
					'value' 	=> array(
						esc_html__('Style 1', 'famita') => 'style1',
						esc_html__('Style 2', 'famita') => 'style2',
					),
				),
	            array(
					"type" => "textfield",
					"heading" => esc_html__("Extra class name", 'famita'),
					"param_name" => "el_class",
					"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'famita')
				)
			)
		) );
	}
	add_action( 'vc_after_set_mode', 'famita_load_woocommerce_element', 99 );

	class WPBakeryShortCode_apus_products extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_products_tabs extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_product_deal extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_category_banner extends WPBakeryShortCode {}
}