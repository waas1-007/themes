<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

$show_page_title = apply_filters('arum/filter/show_page_title', true);
$show_breadcrumbs = apply_filters('arum/filter/show_breadcrumbs', true);

$layout = arum_get_page_header_layout();

if( is_singular() ){
    $_hide_breadcrumb = arum_get_post_meta(get_queried_object_id(), 'hide_breadcrumb');
    $_hide_page_title = arum_get_post_meta(get_queried_object_id(), 'hide_page_title');
	if(arum_string_to_bool($_hide_breadcrumb)){
		$show_breadcrumbs = false;
	}
	if(arum_string_to_bool($_hide_page_title)){
		$show_page_title = false;
	}
}

if ( is_tax() || is_category() || is_tag() ) {
    $_hide_breadcrumb = arum_get_term_meta(get_queried_object_id(), 'hide_breadcrumb');
    $_hide_page_title = arum_get_term_meta(get_queried_object_id(), 'hide_page_title');
	if(arum_string_to_bool($_hide_breadcrumb)){
		$show_breadcrumbs = false;
	}
	if(arum_string_to_bool($_hide_page_title)){
		$show_page_title = false;
	}
}

if ( is_home() && $page_for_posts = get_option( 'page_for_posts' ) ) {
	$p_id = $page_for_posts;
	$_hide_breadcrumb = arum_get_post_meta($p_id, 'hide_breadcrumb');
	$_hide_page_title = arum_get_post_meta($p_id, 'hide_page_title');
	if(arum_string_to_bool($_hide_breadcrumb)){
		$show_breadcrumbs = false;
	}
	if(arum_string_to_bool($_hide_page_title)){
		$show_page_title = false;
	}
}


$enable_custom_text = arum_get_theme_option_by_context('enable_page_title_subtext', 'no');
$custom_text = arum_get_theme_option_by_context('page_title_custom_subtext', '');

$title_tag = arum_get_option('page_title_bar_heading_tag', 'h1');

if($show_breadcrumbs || $show_page_title) :
    ?>
    <header id="section_page_header" class="section-page-header<?php if($enable_custom_text == 'yes' && !empty($custom_text)) { echo ' use-custom-text'; } ?>">
        <div class="container">
            <div class="page-header-inner">
                <?php
                if($show_page_title){
                    printf('<%1$s class="page-title" %3$s>%2$s</%1$s>', esc_attr($title_tag), arum_title(), arum_get_schema_markup('headline') );
                }
                if($enable_custom_text == 'yes' && !empty($custom_text)){
                    printf('<div class="site-breadcrumbs use-custom-text">%s</div>', esc_html($custom_text));
                }
                else{
                    if( $show_breadcrumbs && function_exists('arum_breadcrumb_trail')){
                        arum_breadcrumb_trail();
                    }
                }
                ?>
            </div>
        </div>
    </header>
    <!-- #page_header -->
<?php endif; ?>