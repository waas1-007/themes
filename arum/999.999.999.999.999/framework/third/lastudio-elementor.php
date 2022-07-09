<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if(!function_exists('arum_override_elementor_resource')){
    function arum_override_elementor_resource( $path ){
        $path = get_theme_file_uri('assets/addon');
        return $path;
    }
}
add_filter('LaStudioElement/resource-base-url', 'arum_override_elementor_resource');

if(!function_exists('arum_add_icon_library_into_elementor')){
    function arum_add_icon_library_into_elementor( $tabs ) {
        $tabs['lastudioicon'] = [
            'name' => 'lastudioicon',
            'label' => esc_html__( 'LaStudio Icons', 'arum' ),
            'prefix' => 'lastudioicon-',
            'displayPrefix' => '',
            'labelIcon' => 'fas fa-star',
            'ver' => '1.0.0',
            'fetchJson' => get_theme_file_uri('assets/fonts/LaStudio_Icons/LaStudioIcons.json'),
            'native' => false
        ];
        return $tabs;
    }
}
add_filter('elementor/icons_manager/additional_tabs', 'arum_add_icon_library_into_elementor');

if(!function_exists('arum_add_banner_hover_effect')){
    function arum_add_banner_hover_effect( $effects ){
        return array_merge(array(
            'none'   => esc_html__( 'None', 'arum' ),
            'type-1' => esc_html__( 'Shadow', 'arum' )
        ), $effects);
    }
}
add_filter('LaStudioElement/banner/hover_effect', 'arum_add_banner_hover_effect');

if(!function_exists('arum_add_portfolio_preset')){
    function arum_add_portfolio_preset( ){
        return array(
            'type-1' => esc_html__( 'Type 1', 'arum' ),
            'type-2' => esc_html__( 'Type 2', 'arum' ),
            'type-3' => esc_html__( 'Type 3', 'arum' ),
            'type-4' => esc_html__( 'Type 4', 'arum' ),
            'type-5' => esc_html__( 'Type 5', 'arum' ),
            'type-6' => esc_html__( 'Type 6', 'arum' ),
        );
    }
}
add_filter('LaStudioElement/portfolio/control/preset', 'arum_add_portfolio_preset');

if(!function_exists('arum_add_portfolio_list_preset')){
    function arum_add_portfolio_list_preset( ){
        return array(
            'list-type-1' => esc_html__( 'Type 1', 'arum' ),
            'list-type-2' => esc_html__( 'Type 2', 'arum' )
        );
    }
}
add_filter('LaStudioElement/portfolio/control/preset_list', 'arum_add_portfolio_list_preset');

if(!function_exists('arum_add_team_member_preset')){
    function arum_add_team_member_preset( ){
        return array(
            'type-1' => esc_html__( 'Type 1', 'arum' ),
            'type-2' => esc_html__( 'Type 2', 'arum' ),
            'type-3' => esc_html__( 'Type 3', 'arum' ),
            'type-4' => esc_html__( 'Type 4', 'arum' ),
            'type-5' => esc_html__( 'Type 5', 'arum' ),
            'type-6' => esc_html__( 'Type 6', 'arum' ),
            'type-7' => esc_html__( 'Type 7', 'arum' ),
            'type-8' => esc_html__( 'Type 8', 'arum' )
        );
    }
}
add_filter('LaStudioElement/team-member/control/preset', 'arum_add_team_member_preset');

if(!function_exists('arum_add_posts_preset')){
    function arum_add_posts_preset( ){
        return array(
            'grid-1' => esc_html__( 'Grid 1', 'arum' ),
            'grid-2' => esc_html__( 'Grid 2', 'arum' ),
            'grid-3' => esc_html__( 'Grid 3', 'arum' ),
            'grid-4' => esc_html__( 'Grid 4', 'arum' ),
            'list-1' => esc_html__( 'List 1', 'arum' ),
            'list-2' => esc_html__( 'List 2', 'arum' ),
            'list-3' => esc_html__( 'List 3', 'arum' ),
            'list-4' => esc_html__( 'List 4', 'arum' ),
        );
    }
}
add_filter('LaStudioElement/posts/control/preset', 'arum_add_posts_preset');

if(!function_exists('arum_add_testimonials_preset')){
    function arum_add_testimonials_preset( ){
        return array(
	        'type-1' => esc_html__( 'Type 1', 'arum' ),
	        'type-2' => esc_html__( 'Type 2', 'arum' ),
	        'type-3' => esc_html__( 'Type 3', 'arum' ),
	        'type-4' => esc_html__( 'Type 4', 'arum' ),
	        'type-5' => esc_html__( 'Type 5', 'arum' ),
	        'type-6' => esc_html__( 'Type 6', 'arum' ),
	        'type-7' => esc_html__( 'Type 7', 'arum' )
        );
    }
}
add_filter('LaStudioElement/testimonials/control/preset', 'arum_add_testimonials_preset');

if(!function_exists('arum_testimoninal_add_svg_as_star')){
    function arum_testimoninal_add_svg_as_star(){
        echo '<svg width="19" height="16" viewBox="0 0 19 16" xmlns="http://www.w3.org/2000/svg"><path d="M4.203 16c2.034 0 3.594-1.7 3.594-3.752 0-2.124-1.356-3.61-3.255-3.61-.339 0-.813.07-.881.07C3.864 6.442 5.831 3.611 8 2.124L5.492 0C2.372 2.336 0 6.3 0 10.62 0 14.087 1.966 16 4.203 16zm11 0c2.034 0 3.661-1.7 3.661-3.752 0-2.124-1.423-3.61-3.322-3.61-.339 0-.813.07-.881.07.271-2.266 2.17-5.097 4.339-6.584L16.492 0C13.372 2.336 11 6.3 11 10.62c0 3.468 1.966 5.38 4.203 5.38z" fill="currentColor" fill-rule="nonzero"/></svg>';
    }
}
add_action('LaStudioElement/testimonials/output/star_rating', 'arum_testimoninal_add_svg_as_star');

if(!function_exists('arum_add_weather_api')){
    function arum_add_weather_api( $key ){
        return arum_get_option('weather_api_key', $key);
    }
}
add_filter('LaStudioElement/weather/api', 'arum_add_weather_api');

if(!function_exists('arum_add_google_maps_api')){
    function arum_add_google_maps_api( $key ){
        return arum_get_option('google_key', $key);
    }
}
add_filter('LaStudioElement/advanced-map/api', 'arum_add_google_maps_api');

if(!function_exists('arum_add_mailchimp_access_token_api')){
    function arum_add_mailchimp_access_token_api( $key ){
        return arum_get_option('mailchimp_api_key', $key);
    }
}
add_filter('LaStudioElement/mailchimp/api', 'arum_add_mailchimp_access_token_api');

if(!function_exists('arum_add_mailchimp_list_id')){
    function arum_add_mailchimp_list_id( $key ){
        return arum_get_option('mailchimp_list_id', $key);
    }
}
add_filter('LaStudioElement/mailchimp/list_id', 'arum_add_mailchimp_list_id');

if(!function_exists('arum_add_mailchimp_double_opt_in')){
    function arum_add_mailchimp_double_opt_in( $key ){
        return arum_get_option('mailchimp_double_opt_in', $key);
    }
}
add_filter('LaStudioElement/mailchimp/double_opt_in', 'arum_add_mailchimp_double_opt_in');

if(!function_exists('arum_add_instagram_token')){
    function arum_add_instagram_token( $key ){
        return arum_get_option('instagram_token', $key);
    }
}
add_filter('LaStudioElement/instagram-gallery/api', 'arum_add_instagram_token');

if(!function_exists('arum_render_breadcrumbs_in_widget')){
    function arum_render_breadcrumbs_in_widget( $args ) {

        $html_tag = 'nav';
        if(!empty($args['container'])){
            $html_tag = esc_attr($args['container']);
        }

        if ( function_exists( 'yoast_breadcrumb' ) ) {
            $classes = 'site-breadcrumbs';
            return yoast_breadcrumb( '<'.$html_tag.' class="'. esc_attr($classes) .'">', '</'.$html_tag.'>' );
        }

        $breadcrumb = apply_filters( 'breadcrumb_trail_object', null, $args );

        if ( !is_object( $breadcrumb ) ){
            $breadcrumb = new Arum_Breadcrumb_Trail( $args );
        }

        return $breadcrumb->trail();

    }
}
add_action('LaStudioElement/render_breadcrumbs_output', 'arum_render_breadcrumbs_in_widget');

if(!function_exists('arum_turnoff_default_style_of_gallery')){
    function arum_turnoff_default_style_of_gallery( $base ){
        if( 'image-gallery' === $base->get_name() ) {
            add_filter('use_default_gallery_style', '__return_false');
        }
    }
}
add_action('elementor/widget/before_render_content', 'arum_turnoff_default_style_of_gallery');

add_filter('elementor/divider/styles/additional_styles', 'arum_divider_styles_additional_styles');

if(!function_exists('arum_divider_styles_additional_styles')){
    function arum_divider_styles_additional_styles( $styles ){
        $styles['rectangles2'] = [
            'label' => _x( 'Rectangles 2', 'shapes', 'arum' ),
            'shape' => '<g fill-rule="evenodd"><path d="M98 0h88v2H98zM0 0h88v2H0zM196 0h88v2h-88z"/></g>',
            'preserve_aspect_ratio' => false,
            'supports_amount' => false,
            'round' => false,
            'group' => 'line',
            'view_box' => '0 0 284 2',
        ];
        return $styles;
    }
}

add_action('elementor/frontend/after_enqueue_scripts', function (){
    $stretched_section_container = '#outer-wrap > #wrap';
    wp_add_inline_script( 'elementor-frontend', 'try{elementorFrontendConfig.kit.stretched_section_container="'.$stretched_section_container.'";}catch(e){}', 'before' );
});

if(!function_exists('arum_add_image_layout_preset')){
    function arum_add_image_layout_preset( $preset ) {
        $preset = [
            'default' => esc_html__( 'Default', 'arum' ),
            'type-1' => esc_html__( 'Type 1', 'arum' ),
            'type-2' => esc_html__( 'Type 2', 'arum' ),
            'type-3' => esc_html__( 'Type 3', 'arum' ),
        ];
        return $preset;
    }
}
add_filter('LaStudioElement/images-layout/preset', 'arum_add_image_layout_preset');

add_filter('LaStudioElement/posts/thumbnail_height_selector', function (){
    return array(
        '{{WRAPPER}} .blog_item--thumbnail' => 'padding-bottom: {{SIZE}}{{UNIT}};'
    );
});