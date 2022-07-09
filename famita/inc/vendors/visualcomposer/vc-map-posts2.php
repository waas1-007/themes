<?php

if ( function_exists('vc_map') && class_exists('WPBakeryShortCode') ) {

    function famita_get_post_categories() {
        $return = array( esc_html__(' --- Choose a Category --- ', 'famita') => '' );

        $args = array(
            'type' => 'post',
            'child_of' => 0,
            'orderby' => 'name',
            'order' => 'ASC',
            'hide_empty' => false,
            'hierarchical' => 1,
            'taxonomy' => 'category'
        );

        $categories = get_categories( $args );
        famita_get_post_category_childs( $categories, 0, 0, $return );

        return $return;
    }

    function famita_get_post_category_childs( $categories, $id_parent, $level, &$dropdown ) {
        foreach ( $categories as $key => $category ) {
            if ( $category->category_parent == $id_parent ) {
                $dropdown = array_merge( $dropdown, array( str_repeat( "- ", $level ) . $category->name => $category->slug ) );
                unset($categories[$key]);
                famita_get_post_category_childs( $categories, $category->term_id, $level + 1, $dropdown );
            }
        }
	}

	function famita_load_post2_element() {
		$layouts = array(
			esc_html__('Grid', 'famita') => 'grid',
			esc_html__('List', 'famita') => 'list',
			esc_html__('Carousel', 'famita') => 'carousel',
		);
		$columns = array(1,2,3,4,6);
		$categories = array();
		if ( is_admin() ) {
			$categories = famita_get_post_categories();
		}
		vc_map( array(
			'name' => esc_html__( 'Apus Grid Posts', 'famita' ),
			'base' => 'apus_gridposts',
			'icon' => 'icon-wpb-news-12',
			"category" => esc_html__('Apus Post', 'famita'),
			'description' => esc_html__( 'Create Post having blog styles', 'famita' ),
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Title', 'famita' ),
					'param_name' => 'title',
					'description' => esc_html__( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'famita' ),
					"admin_label" => true
				),
				array(
	                "type" => "dropdown",
	                "heading" => esc_html__('Category','famita'),
	                "param_name" => 'category',
	                "value" => $categories
	            ),
	            array(
	                "type" => "dropdown",
	                "heading" => esc_html__('Order By','famita'),
	                "param_name" => 'orderby',
	                "value" => array(
	                	esc_html__('Date', 'famita') => 'date',
	                	esc_html__('ID', 'famita') => 'ID',
	                	esc_html__('Author', 'famita') => 'author',
	                	esc_html__('Title', 'famita') => 'title',
	                	esc_html__('Modified', 'famita') => 'modified',
	                	esc_html__('Parent', 'famita') => 'parent',
	                	esc_html__('Comment count', 'famita') => 'comment_count',
	                	esc_html__('Menu order', 'famita') => 'menu_order',
	                	esc_html__('Random', 'famita') => 'rand',
	                )
	            ),
	            array(
	                "type" => "dropdown",
	                "heading" => esc_html__('Sort order','famita'),
	                "param_name" => 'order',
	                "value" => array(
	                	esc_html__('Descending', 'famita') => 'DESC',
	                	esc_html__('Ascending', 'famita') => 'ASC',
	                )
	            ),
	            array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Limit', 'famita' ),
					'param_name' => 'posts_per_page',
					'description' => esc_html__( 'Enter limit posts.', 'famita' ),
					'std' => 4,
					"admin_label" => true
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show Pagination?', 'famita' ),
					'param_name' => 'show_pagination',
					'description' => esc_html__( 'Enables to show paginations to next new page.', 'famita' ),
					'value' => array( esc_html__( 'Yes, to show pagination', 'famita' ) => 'yes' )
				),
				array(
	                "type" => "dropdown",
	                "heading" => esc_html__('Grid Columns','famita'),
	                "param_name" => 'grid_columns',
	                "value" => $columns
	            ),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Layout Type", 'famita'),
					"param_name" => "layout_type",
					"value" => $layouts
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Thumbnail size', 'famita' ),
					'param_name' => 'thumbsize',
					'description' => esc_html__( 'Enter thumbnail size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height) . ', 'famita' )
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'famita' ),
					'param_name' => 'el_class',
					'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'famita' )
				)
			)
		) );
	}

	add_action( 'vc_after_set_mode', 'famita_load_post2_element', 99 );

	class WPBakeryShortCode_apus_gridposts extends WPBakeryShortCode {}
}