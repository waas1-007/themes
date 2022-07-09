<?php

// Shop Archive settings
function famita_woo_redux_config($sections, $sidebars, $columns) {
    $categories = array();
    $attributes = array();
    if ( is_admin() ) {
        $categories = famita_woocommerce_get_categories(false);

        $attrs = wc_get_attribute_taxonomies();
        if ( $attrs ) {
            foreach ( $attrs as $tax ) {
                $attributes[wc_attribute_taxonomy_name( $tax->attribute_name )] = $tax->attribute_label;
            }
        }
    }
    $attributes = array();
    if ( is_admin() ) {
        $attrs = wc_get_attribute_taxonomies();
        if ( $attrs ) {
            foreach ( $attrs as $tax ) {
                $attributes[wc_attribute_taxonomy_name( $tax->attribute_name )] = $tax->attribute_label;
            }
        }
    }
    $sections[] = array(
        'icon' => 'el el-shopping-cart',
        'title' => esc_html__('Shop Settings', 'famita'),
        'fields' => array(
            array (
                'id' => 'products_general_total_setting',
                'icon' => true,
                'type' => 'info',
                'raw' => '<h3 style="margin: 0;"> '.esc_html__('General Setting', 'famita').'</h3>',
            ),
            array(
                'id' => 'enable_shop_catalog',
                'type' => 'switch',
                'title' => esc_html__('Enable Shop Catalog', 'famita'),
                'default' => 0
            ),
            array (
                'id' => 'products_watches_setting',
                'icon' => true,
                'type' => 'info',
                'raw' => '<h3 style="margin: 0;"> '.esc_html__('Swatches Variation Setting', 'famita').'</h3>',
            ),
            array(
                'id' => 'show_product_swatches_on_grid',
                'type' => 'switch',
                'title' => esc_html__('Show Swatches On Product Grid', 'famita'),
                'default' => 1
            ),
            array(
                'id' => 'product_swatches_attribute',
                'type' => 'select',
                'title' => esc_html__( 'Grid swatch attribute to display', 'famita' ),
                'subtitle' => esc_html__( 'Choose attribute that will be shown on products grid', 'famita' ),
                'options' => $attributes
            ),
            array(
                'id' => 'show_product_swatches_use_images',
                'type' => 'switch',
                'title' => esc_html__('Use images from product variations', 'famita'),
                'subtitle' => esc_html__( 'If enabled swatches buttons will be filled with images choosed for product variations and not with images uploaded to attribute terms.', 'famita' ),
                'default' => 1
            ),
            array (
                'id' => 'products_brand_setting',
                'icon' => true,
                'type' => 'info',
                'raw' => '<h3 style="margin: 0;"> '.esc_html__('Brands Setting', 'famita').'</h3>',
            ),
            array(
                'id' => 'product_brand_attribute',
                'type' => 'select',
                'title' => esc_html__( 'Brand Attribute', 'famita' ),
                'subtitle' => esc_html__( 'Choose a product attribute that will be used as brands', 'famita' ),
                'desc' => esc_html__( 'When you have choosed a brand attribute, you will be able to add brand image to the attributes', 'famita' ),
                'options' => $attributes
            ),
            array (
                'id' => 'products_breadcrumb_setting',
                'icon' => true,
                'type' => 'info',
                'raw' => '<h3 style="margin: 0;"> '.esc_html__('Breadcrumbs Setting', 'famita').'</h3>',
            ),
            array(
                'id' => 'show_product_breadcrumbs',
                'type' => 'switch',
                'title' => esc_html__('Breadcrumbs', 'famita'),
                'default' => 1
            ),
            array (
                'title' => esc_html__('Breadcrumbs Background Color', 'famita'),
                'subtitle' => '<em>'.esc_html__('The breadcrumbs background color of the site.', 'famita').'</em>',
                'id' => 'woo_breadcrumb_color',
                'type' => 'color',
                'transparent' => false,
            ),
            array(
                'id' => 'woo_breadcrumb_image',
                'type' => 'media',
                'title' => esc_html__('Breadcrumbs Background', 'famita'),
                'subtitle' => esc_html__('Upload a .jpg or .png image that will be your breadcrumbs.', 'famita'),
            ),
        )
    );
    // Archive settings
    $sections[] = array(
        'title' => esc_html__('Product Archives', 'famita'),
        'subsection' => true,
        'fields' => array(
            array (
                'id' => 'products_top_setting',
                'icon' => true,
                'type' => 'info',
                'raw' => '<h3 style="margin: 0;"> '.esc_html__('Top Content Setting', 'famita').'</h3>',
            ),
            array(
                'id' => 'product_archive_top_categories',
                'type' => 'switch',
                'title' => esc_html__('Enable Top Categories', 'famita'),
                'default' => 1
            ),
            array(
                'id' => 'product_archive_top_filter',
                'type' => 'switch',
                'title' => esc_html__('Enable Filter Top', 'famita'),
                'default' => 1
            ),
            array (
                'id' => 'products_general_setting',
                'icon' => true,
                'type' => 'info',
                'raw' => '<h3 style="margin: 0;"> '.esc_html__('General Setting', 'famita').'</h3>',
            ),
            array(
                'id' => 'product_display_mode',
                'type' => 'select',
                'title' => esc_html__('Products Layout', 'famita'),
                'subtitle' => esc_html__('Choose a default layout archive product.', 'famita'),
                'options' => array(
                    'grid' => esc_html__('Grid', 'famita'),
                    'list' => esc_html__('List', 'famita'),
                ),
                'default' => 'grid'
            ),
            array(
                'id' => 'product_columns',
                'type' => 'select',
                'title' => esc_html__('Product Columns', 'famita'),
                'options' => $columns,
                'default' => 4,
                'required' => array('product_display_mode', '=', array('grid'))
            ),
            array(
                'id' => 'number_products_per_page',
                'type' => 'text',
                'title' => esc_html__('Number of Products Per Page', 'famita'),
                'default' => 12,
                'min' => '1',
                'step' => '1',
                'max' => '100',
                'type' => 'slider'
            ),
            array(
                'id' => 'show_quickview',
                'type' => 'switch',
                'title' => esc_html__('Show Quick View', 'famita'),
                'default' => 1
            ),
            array(
                'id' => 'enable_swap_image',
                'type' => 'switch',
                'title' => esc_html__('Enable Swap Image', 'famita'),
                'default' => 1
            ),
            array(
                'id' => 'product_pagination',
                'type' => 'select',
                'title' => esc_html__('Pagination Type', 'famita'),
                'options' => array(
                    'default' => esc_html__('Default', 'famita'),
                    'loadmore' => esc_html__('Load More Button', 'famita'),
                    'infinite' => esc_html__('Infinite Scrolling', 'famita'),
                ),
                'default' => 'default'
            ),
            array (
                'id' => 'products_sidebar_setting',
                'icon' => true,
                'type' => 'info',
                'raw' => '<h3 style="margin: 0;"> '.esc_html__('Sidebar Setting', 'famita').'</h3>',
            ),
            array(
                'id' => 'product_archive_fullwidth',
                'type' => 'switch',
                'title' => esc_html__('Is Full Width?', 'famita'),
                'default' => false
            ),
            array(
                'id' => 'product_archive_layout',
                'type' => 'image_select',
                'compiler' => true,
                'title' => esc_html__('Archive Product Layout', 'famita'),
                'subtitle' => esc_html__('Select the layout you want to apply on your archive product page.', 'famita'),
                'options' => array(
                    'main' => array(
                        'title' => esc_html__('Main Content', 'famita'),
                        'alt' => esc_html__('Main Content', 'famita'),
                        'img' => get_template_directory_uri() . '/inc/assets/images/screen1.png'
                    ),
                    'left-main' => array(
                        'title' => esc_html__('Left Sidebar - Main Content', 'famita'),
                        'alt' => esc_html__('Left Sidebar - Main Content', 'famita'),
                        'img' => get_template_directory_uri() . '/inc/assets/images/screen2.png'
                    ),
                    'main-right' => array(
                        'title' => esc_html__('Main Content - Right Sidebar', 'famita'),
                        'alt' => esc_html__('Main Content - Right Sidebar', 'famita'),
                        'img' => get_template_directory_uri() . '/inc/assets/images/screen3.png'
                    ),
                ),
                'default' => 'left-main'
            ),
            array(
                'id' => 'product_archive_left_sidebar',
                'type' => 'select',
                'title' => esc_html__('Archive Left Sidebar', 'famita'),
                'subtitle' => esc_html__('Choose a sidebar for left sidebar.', 'famita'),
                'options' => $sidebars
            ),
            array(
                'id' => 'product_archive_right_sidebar',
                'type' => 'select',
                'title' => esc_html__('Archive Right Sidebar', 'famita'),
                'subtitle' => esc_html__('Choose a sidebar for right sidebar.', 'famita'),
                'options' => $sidebars
            ),
        )
    );
    
    
    // Product Page
    $sections[] = array(
        'title' => esc_html__('Single Product', 'famita'),
        'subsection' => true,
        'fields' => array(
            array (
                'id' => 'product_general_setting',
                'icon' => true,
                'type' => 'info',
                'raw' => '<h3 style="margin: 0;"> '.esc_html__('General Setting', 'famita').'</h3>',
            ),
            array(
                'id' => 'product_thumbs_position',
                'type' => 'select',
                'title' => esc_html__('Thumbnails Position', 'famita'),
                'options' => array(
                    'thumbnails-left' => esc_html__('Thumbnails Left', 'famita'),
                    'thumbnails-right' => esc_html__('Thumbnails Right', 'famita'),
                    'thumbnails-bottom' => esc_html__('Thumbnails Bottom', 'famita'),
                ),
                'default' => 'thumbnails-left',
            ),
            array(
                'id' => 'number_product_thumbs',
                'title' => esc_html__('Number Thumbnails Per Row', 'famita'),
                'default' => 4,
                'min' => '1',
                'step' => '1',
                'max' => '8',
                'type' => 'slider',
            ),
            array(
                'id' => 'product_shipping_info',
                'type' => 'editor',
                'title' => esc_html__('Shipping Information', 'famita'),
                'default' => '',
            ),
            array(
                'id' => 'show_product_countdown_timer',
                'type' => 'switch',
                'title' => esc_html__('Show Product CountDown Timer', 'famita'),
                'default' => 1
            ),
            array(
                'id' => 'show_product_social_share',
                'type' => 'switch',
                'title' => esc_html__('Show Social Share', 'famita'),
                'default' => 1
            ),

            array(
                'id' => 'show_product_review_tab',
                'type' => 'switch',
                'title' => esc_html__('Show Product Review Tab', 'famita'),
                'default' => 1
            ),
            array(
                'id' => 'hidden_product_additional_information_tab',
                'type' => 'switch',
                'title' => esc_html__('Hidden Product Additional Information Tab', 'famita'),
                'default' => 1
            ),

            array (
                'id' => 'product_sidebar_setting',
                'icon' => true,
                'type' => 'info',
                'raw' => '<h3 style="margin: 0;"> '.esc_html__('Sidebar Setting', 'famita').'</h3>',
            ),
            array(
                'id' => 'product_single_layout',
                'type' => 'image_select',
                'compiler' => true,
                'title' => esc_html__('Single Product Sidebar Layout', 'famita'),
                'subtitle' => esc_html__('Select the layout you want to apply on your Single Product Page.', 'famita'),
                'options' => array(
                    'main' => array(
                        'title' => esc_html__('Main Only', 'famita'),
                        'alt' => esc_html__('Main Only', 'famita'),
                        'img' => get_template_directory_uri() . '/inc/assets/images/screen1.png'
                    ),
                    'left-main' => array(
                        'title' => esc_html__('Left - Main Sidebar', 'famita'),
                        'alt' => esc_html__('Left - Main Sidebar', 'famita'),
                        'img' => get_template_directory_uri() . '/inc/assets/images/screen2.png'
                    ),
                    'main-right' => array(
                        'title' => esc_html__('Main - Right Sidebar', 'famita'),
                        'alt' => esc_html__('Main - Right Sidebar', 'famita'),
                        'img' => get_template_directory_uri() . '/inc/assets/images/screen3.png'
                    ),
                ),
                'default' => 'left-main'
            ),
            array(
                'id' => 'product_single_fullwidth',
                'type' => 'switch',
                'title' => esc_html__('Is Full Width?', 'famita'),
                'default' => false
            ),
            array(
                'id' => 'product_single_left_sidebar',
                'type' => 'select',
                'title' => esc_html__('Single Product Left Sidebar', 'famita'),
                'subtitle' => esc_html__('Choose a sidebar for left sidebar.', 'famita'),
                'options' => $sidebars
            ),
            array(
                'id' => 'product_single_right_sidebar',
                'type' => 'select',
                'title' => esc_html__('Single Product Right Sidebar', 'famita'),
                'subtitle' => esc_html__('Choose a sidebar for right sidebar.', 'famita'),
                'options' => $sidebars
            ),
            array (
                'id' => 'product_block_setting',
                'icon' => true,
                'type' => 'info',
                'raw' => '<h3 style="margin: 0;"> '.esc_html__('Product Block Setting', 'famita').'</h3>',
            ),
            array(
                'id' => 'show_product_releated',
                'type' => 'switch',
                'title' => esc_html__('Show Products Releated', 'famita'),
                'default' => 1
            ),
            array(
                'id' => 'show_product_upsells',
                'type' => 'switch',
                'title' => esc_html__('Show Products upsells', 'famita'),
                'default' => 1
            ),
            array(
                'id' => 'number_product_releated',
                'title' => esc_html__('Number of related/upsells products to show', 'famita'),
                'default' => 4,
                'min' => '1',
                'step' => '1',
                'max' => '20',
                'type' => 'slider'
            ),
            array(
                'id' => 'releated_product_columns',
                'type' => 'select',
                'title' => esc_html__('Releated Products Columns', 'famita'),
                'options' => $columns,
                'default' => 4
            ),
        )
    );
    
    return $sections;
}
add_filter( 'famita_redux_framwork_configs', 'famita_woo_redux_config', 10, 3 );