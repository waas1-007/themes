<?php
/**
 * ReduxFramework Sample Config File
 * For full documentation, please visit: http://docs.reduxframework.com/
 */

if (!class_exists('Famita_Redux_Framework_Config')) {

    class Famita_Redux_Framework_Config
    {
        public $args = array();
        public $sections = array();
        public $theme;
        public $ReduxFramework;

        public function __construct()
        {
            if (!class_exists('ReduxFramework')) {
                return;
            }
            add_action('init', array($this, 'initSettings'), 10);
        }

        public function initSettings()
        {
            // Just for demo purposes. Not needed per say.
            $this->theme = wp_get_theme();

            // Set the default arguments
            $this->setArguments();

            // Create the sections and fields
            $this->setSections();

            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }

            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }

        public function setSections()
        {
            global $wp_registered_sidebars;
            $sidebars = array();

            if ( is_admin() && !empty($wp_registered_sidebars) ) {
                foreach ($wp_registered_sidebars as $sidebar) {
                    $sidebars[$sidebar['id']] = $sidebar['name'];
                }
            }
            $columns = array( '1' => esc_html__('1 Column', 'famita'),
                '2' => esc_html__('2 Columns', 'famita'),
                '3' => esc_html__('3 Columns', 'famita'),
                '4' => esc_html__('4 Columns', 'famita'),
                '5' => esc_html__('5 Columns', 'famita'),
                '6' => esc_html__('6 Columns', 'famita'),
                '7' => esc_html__('7 Columns', 'famita'),
                '8' => esc_html__('8 Columns', 'famita'),
            );
            
            $general_fields = array();
            if ( !function_exists( 'wp_site_icon' ) ) {
                $general_fields[] = array(
                    'id' => 'media-favicon',
                    'type' => 'media',
                    'title' => esc_html__('Favicon Upload', 'famita'),
                    'subtitle' => esc_html__('Upload a 16px x 16px .png or .gif image that will be your favicon.', 'famita'),
                );
            }
            $general_fields[] = array(
                'id' => 'preload',
                'type' => 'switch',
                'title' => esc_html__('Preload Website', 'famita'),
                'default' => true,
            );
            $general_fields[] = array(
                'id' => 'media-preload-icon',
                'type' => 'media',
                'title' => esc_html__('Preload Icon', 'famita'),
                'subtitle' => esc_html__('Upload a .png or .gif image that will be your preload icon.', 'famita'),
                'required' => array('preload', '=', true)
            );
            $general_fields[] = array(
                'id' => 'image_lazy_loading',
                'type' => 'switch',
                'title' => esc_html__('Image Lazy Loading', 'famita'),
                'default' => true,
            );
            $general_fields[] = array(
                'id' => 'enable_smooth_scroll',
                'type' => 'switch',
                'title' => esc_html__('Smooth Scroll', 'famita'),
                'default' => true,
            );
            $general_fields[] = array(
                'id' => 'google_map_api_key',
                'type' => 'text',
                'title' => esc_html__('Google Map API Key', 'famita'),
            );
            // General Settings Tab
            $this->sections[] = array(
                'icon' => 'el-icon-cogs',
                'title' => esc_html__('General', 'famita'),
                'fields' => $general_fields
            );
            // Header
            $this->sections[] = array(
                'icon' => 'el el-website',
                'title' => esc_html__('Header', 'famita'),
                'fields' => array(
                    array(
                        'id' => 'media-logo',
                        'type' => 'media',
                        'title' => esc_html__('Logo Upload', 'famita'),
                        'subtitle' => esc_html__('Upload a .png or .gif image that will be your logo.', 'famita'),
                    ),
                    array(
                        'id' => 'media-mobile-logo',
                        'type' => 'media',
                        'title' => esc_html__('Mobile Logo Upload', 'famita'),
                        'subtitle' => esc_html__('Upload a .png or .gif image that will be your logo.', 'famita'),
                    ),
                    array(
                        'id' => 'header_type',
                        'type' => 'select',
                        'title' => esc_html__('Header Layout Type', 'famita'),
                        'subtitle' => esc_html__('Choose a header for your website.', 'famita'),
                        'options' => famita_get_header_layouts()
                    ),
                    array(
                        'id' => 'keep_header',
                        'type' => 'switch',
                        'title' => esc_html__('Keep Header', 'famita'),
                        'default' => false
                    ),
                    array(
                        'id' => 'show_searchform',
                        'type' => 'switch',
                        'title' => esc_html__('Search Header', 'famita'),
                        'default' => false
                    ),
                    array(
                        'id' => 'enable_autocompleate_search',
                        'type' => 'switch',
                        'title' => esc_html__('Enable Autocompleate Search', 'famita'),
                        'default' => true,
                        'required' => array('show_searchform','=',true)
                    ),
                    array(
                        'id' => 'show_cartbtn',
                        'type' => 'switch',
                        'title' => esc_html__('Show Cart Button', 'famita'),
                        'default' => true
                    ),
                    array(
                        'id'         => 'header_social_links',
                        'type'       => 'repeater',
                        'title'      => esc_html__( 'Social Links', 'famita' ),
                        'fields'     => array(
                            array(
                                'id' => 'header_social_links_link',
                                'type' => 'text',
                                'title' => esc_html__('Link', 'famita'),
                            ),
                            array(
                                'id' => 'header_social_links_icon',
                                'type' => 'text',
                                'title' => esc_html__('Font Icon', 'famita'),
                            )
                        ),
                        'required' => array('header_type', '=', array('v1', 'v2', 'v3'))
                    ),
                    array(
                        'id' => 'header_tract_order',
                        'type' => 'editor',
                        'title' => esc_html__('Tract Your Order Text', 'famita'),
                        'required' => array('header_type', '=', array('v1', 'v2', 'v3'))
                    ),
                )
            );
            // Footer
            $custom_menus = array();
            if ( is_admin() ) {
                $menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
                if ( is_array( $menus ) && ! empty( $menus ) ) {
                    foreach ( $menus as $single_menu ) {
                        if ( is_object( $single_menu ) && isset( $single_menu->name, $single_menu->slug ) ) {
                            $custom_menus[ $single_menu->slug ] = $single_menu->name;
                        }
                    }
                }
            }
            $this->sections[] = array(
                'icon' => 'el el-website',
                'title' => esc_html__('Footer', 'famita'),
                'fields' => array(
                    array(
                        'id' => 'footer_type',
                        'type' => 'select',
                        'title' => esc_html__('Footer Layout Type', 'famita'),
                        'subtitle' => esc_html__('Choose a footer for your website.', 'famita'),
                        'options' => famita_get_footer_layouts()
                    ),
                    array(
                        'id' => 'back_to_top',
                        'type' => 'switch',
                        'title' => esc_html__('Back To Top Button', 'famita'),
                        'subtitle' => esc_html__('Toggle whether or not to enable a back to top button on your pages.', 'famita'),
                        'default' => true,
                    ),
                    array(
                        'title' => esc_html__('Show Footer Desktop On Mobile', 'famita'),
                        'subtitle' => '<em>'.esc_html__('Enable to show Footer Desktop on mobile.', 'famita').'</em>',
                        'id' => 'show_footer_desktop_mobile',
                        'type' => 'switch',
                        'default' => false,
                    ),
                    array(
                        'title' => esc_html__('Show Separate Footer On Mobile', 'famita'),
                        'subtitle' => '<em>'.esc_html__('Enable to show separate footer on mobile.', 'famita').'</em>',
                        'id' => 'show_footer_mobile',
                        'type' => 'switch',
                        'default' => true,
                    ),
                    array(
                        'title' => esc_html__('Show Search Button', 'famita'),
                        'id' => 'show_footer_search',
                        'type' => 'switch',
                        'default' => true,
                        'required' => array('show_footer_mobile', '=', true),
                        'subtitle' => '<em>'.esc_html__('Show search button on footer mobile.', 'famita').'</em>',
                    ),
                    array(
                        'title' => esc_html__('Show Cart Button', 'famita'),
                        'id' => 'show_footer_cartbtn',
                        'type' => 'switch',
                        'default' => true,
                        'required' => array('show_footer_mobile', '=', true),
                        'subtitle' => '<em>'.esc_html__('Show cart button on footer mobile.', 'famita').'</em>',
                    ),
                    array(
                        'title' => esc_html__('Show My Account', 'famita'),
                        'id' => 'show_footer_myaccount',
                        'type' => 'switch',
                        'default' => true,
                        'required' => array('show_footer_mobile', '=', true),
                        'subtitle' => '<em>'.esc_html__('Show My Account button on footer mobile.', 'famita').'</em>',
                    ),
                    array(
                        'title' => esc_html__('Show More Link', 'famita'),
                        'id' => 'show_footer_morelink',
                        'type' => 'switch',
                        'default' => true,
                        'required' => array('show_footer_mobile', '=', true),
                        'subtitle' => '<em>'.esc_html__('Show More Link button on footer mobile.', 'famita').'</em>',
                    ),
                    array(
                        'id' => 'morelink_menu',
                        'type' => 'select',
                        'title' => esc_html__('More Link Menu', 'famita'),
                        'options' => $custom_menus,
                        'required' => array('show_footer_mobile', '=', true),
                    )
                )
            );

            // Blog settings
            $this->sections[] = array(
                'icon' => 'el el-pencil',
                'title' => esc_html__('Blog', 'famita'),
                'fields' => array(
                    array(
                        'id' => 'show_blog_breadcrumbs',
                        'type' => 'switch',
                        'title' => esc_html__('Breadcrumbs', 'famita'),
                        'default' => 1
                    ),
                    array (
                        'title' => esc_html__('Breadcrumbs Background Color', 'famita'),
                        'subtitle' => '<em>'.esc_html__('The breadcrumbs background color of the site.', 'famita').'</em>',
                        'id' => 'blog_breadcrumb_color',
                        'type' => 'color',
                        'transparent' => false,
                    ),
                    array(
                        'id' => 'blog_breadcrumb_image',
                        'type' => 'media',
                        'title' => esc_html__('Breadcrumbs Background', 'famita'),
                        'subtitle' => esc_html__('Upload a .jpg or .png image that will be your breadcrumbs.', 'famita'),
                    ),
                )
            );
            // Archive Blogs settings
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Blog & Post Archives', 'famita'),
                'fields' => array(
                    array(
                        'id' => 'blog_archive_layout',
                        'type' => 'image_select',
                        'compiler' => true,
                        'title' => esc_html__('Layout', 'famita'),
                        'subtitle' => esc_html__('Select the variation you want to apply on your store.', 'famita'),
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
                        'id' => 'blog_archive_fullwidth',
                        'type' => 'switch',
                        'title' => esc_html__('Is Full Width?', 'famita'),
                        'default' => false
                    ),
                    array(
                        'id' => 'blog_archive_left_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Archive Left Sidebar', 'famita'),
                        'subtitle' => esc_html__('Choose a sidebar for left sidebar.', 'famita'),
                        'options' => $sidebars
                    ),
                    array(
                        'id' => 'blog_archive_right_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Archive Right Sidebar', 'famita'),
                        'subtitle' => esc_html__('Choose a sidebar for right sidebar.', 'famita'),
                        'options' => $sidebars
                        
                    ),
                    array(
                        'id' => 'blog_display_mode',
                        'type' => 'select',
                        'title' => esc_html__('Display Mode', 'famita'),
                        'options' => array(
                            'grid-v2' => esc_html__('Grid Layout', 'famita'),
                            'grid' => esc_html__('List Layout', 'famita'),
                        ),
                        'default' => 'grid'
                    ),
                    array(
                        'id' => 'blog_columns',
                        'type' => 'select',
                        'title' => esc_html__('Blog Columns', 'famita'),
                        'options' => $columns,
                        'default' => 1
                    ),
                    array(
                        'id' => 'blog_item_thumbsize',
                        'type' => 'text',
                        'title' => esc_html__('Thumbnail Size', 'famita'),
                        'subtitle' => esc_html__('This featured for the site is using Visual Composer.', 'famita'),
                        'desc' => esc_html__('Enter thumbnail size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height) .', 'famita'),
                    ),

                )
            );
            // Single Blogs settings
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Blog', 'famita'),
                'fields' => array(
                    
                    array(
                        'id' => 'blog_single_layout',
                        'type' => 'image_select',
                        'compiler' => true,
                        'title' => esc_html__('Archive Blog Layout', 'famita'),
                        'subtitle' => esc_html__('Select the variation you want to apply on your store.', 'famita'),
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
                        'id' => 'blog_single_fullwidth',
                        'type' => 'switch',
                        'title' => esc_html__('Is Full Width?', 'famita'),
                        'default' => false
                    ),
                    array(
                        'id' => 'blog_single_left_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Single Blog Left Sidebar', 'famita'),
                        'subtitle' => esc_html__('Choose a sidebar for left sidebar.', 'famita'),
                        'options' => $sidebars
                    ),
                    array(
                        'id' => 'blog_single_right_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Single Blog Right Sidebar', 'famita'),
                        'subtitle' => esc_html__('Choose a sidebar for right sidebar.', 'famita'),
                        'options' => $sidebars
                    ),
                    array(
                        'id' => 'show_blog_social_share',
                        'type' => 'switch',
                        'title' => esc_html__('Show Social Share', 'famita'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'show_blog_releated',
                        'type' => 'switch',
                        'title' => esc_html__('Show Releated Posts', 'famita'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'number_blog_releated',
                        'type' => 'text',
                        'title' => esc_html__('Number of related posts to show', 'famita'),
                        'required' => array('show_blog_releated', '=', '1'),
                        'default' => 3,
                        'min' => '1',
                        'step' => '1',
                        'max' => '20',
                        'type' => 'slider'
                    ),
                    array(
                        'id' => 'releated_blog_columns',
                        'type' => 'select',
                        'title' => esc_html__('Releated Blogs Columns', 'famita'),
                        'required' => array('show_blog_releated', '=', '1'),
                        'options' => $columns,
                        'default' => 3
                    ),

                )
            );
            
            $this->sections = apply_filters( 'famita_redux_framwork_configs', $this->sections, $sidebars, $columns );
            
            // 404 page
            $this->sections[] = array(
                'title' => esc_html__('404 Page', 'famita'),
                'fields' => array(
                    array (
                        'title' => esc_html__('Images Icon', 'famita'),
                        'subtitle' => '<em>'.esc_html__('Icon for 404 error.', 'famita').'</em>',
                        'id' => 'icon-img',
                        'type' => 'media',
                    ),
                    array(
                        'id' => '404_title',
                        'type' => 'text',
                        'title' => esc_html__('Title', 'famita'),
                        'default' => '404'
                    ),
                    array(
                        'id' => '404_description',
                        'type' => 'editor',
                        'title' => esc_html__('Description', 'famita'),
                        'default' => 'Sorry but the page you are looking for does not exist, have been removed, name changed or is temporarity unavailable.'
                    )
                )
            );
            
            // Style
            $this->sections[] = array(
                'icon' => 'el el-icon-css',
                'title' => esc_html__('Style', 'famita'),
                'fields' => array(
                    array (
                        'title' => esc_html__('Main Theme Color', 'famita'),
                        'subtitle' => '<em>'.esc_html__('The main color of the site.', 'famita').'</em>',
                        'id' => 'main_color',
                        'type' => 'color',
                        'transparent' => false,
                    ),
                    array (
                        'title' => esc_html__('Button Theme Color', 'famita'),
                        'subtitle' => '<em>'.esc_html__('Button color of the site.', 'famita').'</em>',
                        'id' => 'button_color',
                        'type' => 'color',
                        'transparent' => false,
                    ),
                    array (
                        'title' => esc_html__('Button Hover Theme Color', 'famita'),
                        'subtitle' => '<em>'.esc_html__('Button Hover color of the site.', 'famita').'</em>',
                        'id' => 'button_hover_color',
                        'type' => 'color',
                        'transparent' => false,
                    ),
                )
            );
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Typography', 'famita'),
                'fields' => array(
                    array(
                        'title'    => esc_html__('Font Source', 'famita'),
                        'subtitle' => '<em>'.esc_html__('Choose the Font Source', 'famita').'</em>',
                        'id'       => 'font_source',
                        'type'     => 'radio',
                        'options'  => array(
                            '1' => 'Standard + Google Webfonts',
                            '2' => 'Google Custom'
                        ),
                        'default' => '2'
                    ),
                    array(
                        'id'=>'font_google_code',
                        'type' => 'text',
                        'title' => esc_html__('Google Code', 'famita'), 
                        'subtitle' => '<em>'.esc_html__('Paste the provided Google Code', 'famita').'</em>',
                        'default' => 'Yantramanav|Poppins:400,700',
                        'required' => array('font_source','=','2')
                    ),
                    array (
                        'id' => 'main_font_info',
                        'icon' => true,
                        'type' => 'info',
                        'raw' => '<h3 style="margin: 0;"> '.esc_html__('Main Font', 'famita').'</h3>',
                    ),
                    // Standard + Google Webfonts
                    array (
                        'title' => esc_html__('Font Face', 'famita'),
                        'subtitle' => '<em>'.esc_html__('Pick the Main Font for your site.', 'famita').'</em>',
                        'id' => 'main_font',
                        'type' => 'typography',
                        'line-height' => false,
                        'text-align' => false,
                        'font-style' => false,
                        'font-weight' => false,
                        'all_styles'=> true,
                        'font-size' => false,
                        'color' => false,
                        'default' => array (
                            'font-family' => 'Montserrat',
                            'subsets' => '',
                        ),
                        'required' => array('font_source','=','1')
                    ),
                    
                    // Google Custom                        
                    array (
                        'title' => esc_html__('Google Font Face', 'famita'),
                        'subtitle' => '<em>'.esc_html__('Enter your Google Font Name for the theme\'s Main Typography', 'famita').'</em>',
                        'desc' => esc_html__('e.g.: open sans', 'famita'),
                        'id' => 'main_google_font_face',
                        'type' => 'text',
                        'default' => 'Poppins',
                        'required' => array('font_source','=','2')
                    ),

                    array (
                        'id' => 'secondary_font_info',
                        'icon' => true,
                        'type' => 'info',
                        'raw' => '<h3 style="margin: 0;"> '.esc_html__(' Secondary Font', 'famita').'</h3>',
                    ),
                    
                    // Standard + Google Webfonts
                    array (
                        'title' => esc_html__('Font Face', 'famita'),
                        'subtitle' => '<em>'.esc_html__('Pick the Secondary Font for your site.', 'famita').'</em>',
                        'id' => 'secondary_font',
                        'type' => 'typography',
                        'line-height' => false,
                        'text-align' => false,
                        'font-style' => false,
                        'font-weight' => false,
                        'all_styles'=> true,
                        'font-size' => false,
                        'color' => false,
                        'default' => array (
                            'font-family' => 'Pontano Sans',
                            'subsets' => '',
                        ),
                        'required' => array('font_source','=','1')
                    ),
                    
                    // Google Custom                        
                    array (
                        'title' => esc_html__('Google Font Face', 'famita'),
                        'subtitle' => '<em>'.esc_html__('Enter your Google Font Name for the theme\'s Secondary Typography', 'famita').'</em>',
                        'desc' => esc_html__('e.g.: open sans', 'famita'),
                        'id' => 'secondary_google_font_face',
                        'type' => 'text',
                        'default' => 'Yantramanav',
                        'required' => array('font_source','=','2')
                    ),
                )
            );
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Top Bar', 'famita'),
                'fields' => array(
                    array(
                        'id'=>'topbar_bg',
                        'type' => 'background',
                        'title' => esc_html__('Background', 'famita'),
                        'default' => array(
                            'background-color' => ''
                        )
                    ),
                    array(
                        'title' => esc_html__('Text Color', 'famita'),
                        'id' => 'topbar_text_color',
                        'type' => 'color',
                        'transparent' => false,
                        'default' => '',
                    ),
                    array(
                        'title' => esc_html__('Link Color', 'famita'),
                        'id' => 'topbar_link_color',
                        'type' => 'color',
                        'transparent' => false,
                        'default' => '',
                    ),
                    array(
                        'title' => esc_html__('Link Hover Color', 'famita'),
                        'id' => 'topbar_link_color_hover',
                        'type' => 'color',
                        'transparent' => false,
                        'default' => '',
                    ),
                )
            );
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Header', 'famita'),
                'fields' => array(
                    array(
                        'id'=>'header_bg',
                        'type' => 'background',
                        'title' => esc_html__('Background', 'famita'),
                        'default' => array(
                            'background-color' => ''
                        )
                    ),
                    array(
                        'title' => esc_html__('Text Color', 'famita'),
                        'id' => 'header_text_color',
                        'type' => 'color',
                        'transparent' => false,
                        'default' => '',
                    ),
                    array(
                        'title' => esc_html__('Link Color', 'famita'),
                        'id' => 'header_link_color',
                        'type' => 'color',
                        'transparent' => false,
                        'default' => '',
                    ),
                    array(
                        'title' => esc_html__('Link Color Active', 'famita'),
                        'id' => 'header_link_color_active',
                        'type' => 'color',
                        'transparent' => false,
                        'default' => '',
                    ),
                )
            );
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Main Menu', 'famita'),
                'fields' => array(
                    array(
                        'title' => esc_html__('Link Color', 'famita'),
                        'id' => 'main_menu_link_color',
                        'type' => 'color',
                        'transparent' => false,
                        'default' => '',
                    ),
                    array(
                        'title' => esc_html__('Link Color Active', 'famita'),
                        'id' => 'main_menu_link_color_active',
                        'type' => 'color',
                        'transparent' => false,
                        'default' => '',
                    ),
                )
            );
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Main Content', 'famita'),
                'fields' => array(
                    array(
                        'id'=>'main_content_bg',
                        'type' => 'background',
                        'title' => esc_html__('Background', 'famita'),
                        'default' => array(
                            'background-color' => ''
                        )
                    ),
                    array(
                        'title' => esc_html__('Text Color', 'famita'),
                        'id' => 'main_content_text_color',
                        'type' => 'color',
                        'transparent' => false,
                        'default' => '',
                    ),
                    array(
                        'title' => esc_html__('Border Color', 'famita'),
                        'id' => 'main_content_border_color',
                        'type' => 'color',
                        'transparent' => false,
                        'default' => '',
                    ),
                    array(
                        'title' => esc_html__('Link Color', 'famita'),
                        'id' => 'main_content_link_color',
                        'type' => 'color',
                        'transparent' => false,
                        'default' => '',
                    ),
                    array(
                        'title' => esc_html__('Link Color Hover', 'famita'),
                        'id' => 'main_content_link_color_hover',
                        'type' => 'color',
                        'transparent' => false,
                        'default' => '',
                    ),
                )
            );
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Footer', 'famita'),
                'fields' => array(
                    array(
                        'id'=>'footer_bg',
                        'type' => 'background',
                        'title' => esc_html__('Background', 'famita'),
                        'default' => array(
                            'background-color' => ''
                        )
                    ),
                    array(
                        'title' => esc_html__('Heading Color', 'famita'),
                        'id' => 'footer_heading_color',
                        'type' => 'color',
                        'transparent' => false,
                        'default' => '',
                    ),
                    array(
                        'title' => esc_html__('Text Color', 'famita'),
                        'id' => 'footer_text_color',
                        'type' => 'color',
                        'transparent' => false,
                        'default' => '',
                    ),
                    array(
                        'title' => esc_html__('Link Color', 'famita'),
                        'id' => 'footer_link_color',
                        'type' => 'color',
                        'transparent' => false,
                        'default' => '',
                    ),
                    array(
                        'title' => esc_html__('Link Color Hover', 'famita'),
                        'id' => 'footer_link_color_hover',
                        'type' => 'color',
                        'transparent' => false,
                        'default' => '',
                    ),
                )
            );
            
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Copyright', 'famita'),
                'fields' => array(
                    array(
                        'id'=>'copyright_bg',
                        'type' => 'background',
                        'title' => esc_html__('Background', 'famita'),
                        'default' => array(
                            'background-color' => ''
                        )
                    ),
                    array(
                        'title' => esc_html__('Text Color', 'famita'),
                        'id' => 'copyright_text_color',
                        'type' => 'color',
                        'transparent' => false,
                        'default' => '',
                    ),
                    array(
                        'title' => esc_html__('Link Color', 'famita'),
                        'id' => 'copyright_link_color',
                        'type' => 'color',
                        'transparent' => false,
                        'default' => '',
                    ),
                    array(
                        'title' => esc_html__('Link Color Hover', 'famita'),
                        'id' => 'copyright_link_color_hover',
                        'type' => 'color',
                        'transparent' => false,
                        'default' => '',
                    ),
                )
            );

            // Social Media
            $this->sections[] = array(
                'icon' => 'el el-file',
                'title' => esc_html__('Social Media', 'famita'),
                'fields' => array(
                    array(
                        'id' => 'facebook_share',
                        'type' => 'switch',
                        'title' => esc_html__('Enable Facebook Share', 'famita'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'twitter_share',
                        'type' => 'switch',
                        'title' => esc_html__('Enable twitter Share', 'famita'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'linkedin_share',
                        'type' => 'switch',
                        'title' => esc_html__('Enable linkedin Share', 'famita'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'tumblr_share',
                        'type' => 'switch',
                        'title' => esc_html__('Enable tumblr Share', 'famita'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'google_share',
                        'type' => 'switch',
                        'title' => esc_html__('Enable google plus Share', 'famita'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'pinterest_share',
                        'type' => 'switch',
                        'title' => esc_html__('Enable pinterest Share', 'famita'),
                        'default' => 1
                    )
                )
            );
            // Custom Code
            
            $this->sections[] = array(
                'title' => esc_html__('Import / Export', 'famita'),
                'desc' => esc_html__('Import and Export your Redux Framework settings from file, text or URL.', 'famita'),
                'icon' => 'el-icon-refresh',
                'fields' => array(
                    array(
                        'id' => 'opt-import-export',
                        'type' => 'import_export',
                        'title' => 'Import Export',
                        'subtitle' => 'Save and restore your Redux options',
                        'full_width' => false,
                    ),
                ),
            );

            $this->sections[] = array(
                'type' => 'divide',
            );


        }
        /**
         * All the possible arguments for Redux.
         * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
         * */
        public function setArguments()
        {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.
            
            $preset = famita_get_demo_preset();
            $this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name' => 'famita_theme_options'.$preset,
                // This is where your data is stored in the database and also becomes your global variable name.
                'display_name' => $theme->get('Name'),
                // Name that appears at the top of your panel
                'display_version' => $theme->get('Version'),
                // Version that appears at the top of your panel
                'menu_type' => 'menu',
                //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu' => true,
                // Show the sections below the admin menu item or not
                'menu_title' => esc_html__('Theme Options', 'famita'),
                'page_title' => esc_html__('Theme Options', 'famita'),

                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'google_api_key' => '',
                // Set it you want google fonts to update weekly. A google_api_key value is required.
                'google_update_weekly' => false,
                // Must be defined to add google fonts to the typography module
                'async_typography' => true,
                // Use a asynchronous font on the front end or font string
                //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
                'admin_bar' => true,
                // Show the panel pages on the admin bar
                'admin_bar_icon' => 'dashicons-portfolio',
                // Choose an icon for the admin bar menu
                'admin_bar_priority' => 50,
                // Choose an priority for the admin bar menu
                'global_variable' => 'apus_options',
                // Set a different name for your global variable other than the opt_name
                'dev_mode' => false,
                // Show the time the page took to load, etc
                'update_notice' => false,
                // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
                'customizer' => true,
                // Enable basic customizer support
                //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
                //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

                // OPTIONAL -> Give you extra features
                'page_priority' => null,
                // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent' => 'themes.php',
                // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                'page_permissions' => 'manage_options',
                // Permissions needed to access the options panel.
                'menu_icon' => '',
                // Specify a custom URL to an icon
                'last_tab' => '',
                // Force your panel to always open to a specific tab (by id)
                'page_icon' => 'icon-themes',
                // Icon displayed in the admin panel next to your menu_title
                'page_slug' => '_options',
                // Page slug used to denote the panel
                'save_defaults' => true,
                // On load save the defaults to DB before user clicks save or not
                'default_show' => false,
                // If true, shows the default value next to each field that is not the default value.
                'default_mark' => '',
                // What to print by the field's title if the value shown is default. Suggested: *
                'show_import_export' => true,
                // Shows the Import/Export panel when not used as a field.

                // CAREFUL -> These options are for advanced use only
                'transient_time' => 60 * MINUTE_IN_SECONDS,
                'output' => true,
                // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag' => true,
                // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database' => '',
                // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'system_info' => false,
                // REMOVE
                'use_cdn' => true
            );
            return $this->args;
        }

    }

    global $reduxConfig;
    $reduxConfig = new Famita_Redux_Framework_Config();
}

if ( function_exists('apus_framework_redux_register_custom_extension_loader') ) {
    $preset = famita_get_demo_preset();
    $opt_name = 'famita_theme_options'.$preset;
    add_action("redux/extensions/{$opt_name}/before", 'apus_framework_redux_register_custom_extension_loader', 0);
}


function famita_redux_remove_notice() {
    return 'bub';
}
$preset = famita_get_demo_preset();
$opt_name = 'famita_theme_options'.$preset;
add_action('redux/' . $opt_name . '/aNFM_filter', 'famita_redux_remove_notice');