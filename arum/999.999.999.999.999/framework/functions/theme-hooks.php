<?php
/**
 * This file includes helper functions used throughout the theme.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

add_filter( 'body_class', 'arum_body_classes' );

/**
 * Head
 */
add_action('wp_head', 'arum_add_meta_into_head_tag', 100 );
add_action('arum/action/head', 'arum_add_extra_data_into_head');

add_action('arum/action/before_outer_wrap', 'arum_add_pageloader_icon', 1);

/**
 * Header
 */
add_action( 'arum/action/header', 'arum_render_header', 10 );


/**
 * Page Header
 */
add_action( 'arum/action/page_header', 'arum_render_page_header', 10 );


/**
 * Sidebar
 */


$site_layout = arum_get_site_layout();

if($site_layout == 'col-2cr' || $site_layout == 'col-2cr-l'){
    add_action( 'arum/action/after_primary', 'arum_render_sidebar', 10 );
}
else{
    add_action( 'arum/action/before_primary', 'arum_render_sidebar', 10 );
}


/**
 * Footer
 */
add_action( 'arum/action/footer', 'arum_render_footer', 10 );

add_action( 'arum/action/after_outer_wrap', 'arum_render_footer_searchform_overlay', 10 );
add_action( 'arum/action/after_outer_wrap', 'arum_render_footer_cartwidget_overlay', 15 );
add_action( 'arum/action/after_outer_wrap', 'arum_render_footer_newsletter_popup', 20 );
add_action( 'arum/action/after_outer_wrap', 'arum_render_footer_handheld', 25 );
add_action( 'wp_footer', 'arum_render_footer_custom_js', 100 );


add_action( 'arum/action/after_page_entry', 'arum_render_comment_for_page', 0);

/**
 * Related Posts
 */
add_action( 'arum/action/after_main', 'arum_render_related_posts' );

/**
 * FILTERS
 */
add_filter('arum/filter/get_theme_option_by_context', 'arum_override_page_title_bar_from_context', 10, 2);
add_filter('previous_post_link', 'arum_override_post_navigation_template', 10, 5);
add_filter('next_post_link', 'arum_override_post_navigation_template', 10, 5);

add_filter('arum/filter/sidebar_primary_name', 'arum_override_sidebar_name_from_context');
add_filter('wp_get_attachment_image_attributes', 'arum_add_lazyload_to_image_tag');
add_filter('excerpt_length', 'arum_change_excerpt_length');

add_filter('arum/filter/show_page_title', 'arum_filter_page_title', 10, 1);
add_filter('arum/filter/show_breadcrumbs', 'arum_filter_show_breadcrumbs', 10, 1);

add_filter('register_taxonomy_args', 'arum_override_portfolio_tax_type_args', 99, 2);
add_filter('register_post_type_args', 'arum_override_portfolio_content_type_args', 99, 2);

add_filter( 'pre_get_posts', 'arum_setup_post_per_page_for_portfolio');


add_action('wp_head', 'arum_render_custom_block');