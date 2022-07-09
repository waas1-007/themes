<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$show_page_title = apply_filters('arum/filter/show_page_title', true);

$blog_post_title = arum_get_option('blog_post_title', 'below');
$blog_pn_nav = arum_get_option('blog_pn_nav', 'off');
$featured_images_single = arum_get_option('featured_images_single', 'off');
$blog_social_sharing_box = arum_get_option('blog_social_sharing_box', 'off');
$blog_comments = arum_get_option('blog_comments', 'off');
$single_post_thumbnail_size = arum_get_option('single_post_thumbnail_size', 'full');

$page_header_layout = arum_get_page_header_layout();

$title_tag = 'h1';
if($show_page_title){
    $title_tag = 'h2';
}
if($page_header_layout == 'hide'){
    $title_tag = 'h1';
}
?>
<article class="single-content-article single-room-article">

    <?php
    if($blog_post_title == 'above'){
        the_title( sprintf('<header class="entry-header"><%s class="entry-title entry-title-single" %s>', $title_tag, arum_get_schema_markup('headline')), sprintf('</%s></header>', $title_tag));
    }

    if(arum_string_to_bool($featured_images_single)){
        arum_single_post_thumbnail($single_post_thumbnail_size, false);
    }

    if($blog_post_title == 'below'){
        the_title( sprintf('<header class="entry-header"><%s class="entry-title entry-title-single" %s>', $title_tag, arum_get_schema_markup('headline')), sprintf('</%s></header>', $title_tag));
    }

    ?>

    <div class="entry"<?php arum_schema_markup( 'entry_content' ); ?>>

        <?php do_action( 'arum/action/before_single_entry' ); ?>
        <?php the_content();
        wp_link_pages( array(
            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'arum' ),
            'after'  => '</div>',
        ) );

        edit_post_link( null, '<span class="edit-link hidden">', '</span>' );

        ?>
        <?php do_action( 'arum/action/after_single_entry' ); ?>
    </div>

    <footer class="entry-footer"><?php
        if(arum_string_to_bool($blog_social_sharing_box)){
            echo '<div class="la-sharing-single-posts">';
            echo sprintf('<span class="title-share">%s</span>', esc_html_x('Share with', 'front-view', 'arum') );
            arum_social_sharing(get_the_permalink(), get_the_title(), (has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'full') : ''));
            echo '</div>';
        }

    ?></footer>

    <?php
    if(arum_string_to_bool($blog_pn_nav)){
        the_post_navigation( array(
            'next_text' => '<span class="blog_pn_nav-text">'. esc_html__('Next', 'arum') .'</span><span class="blog_pn_nav blog_pn_nav-left">%image</span><span class="blog_pn_nav blog_pn_nav-right"><span class="blog_pn_nav-title">%title</span</span>',
            'prev_text' => '<span class="blog_pn_nav-text">'. esc_html__('Prev', 'arum') .'</span><span class="blog_pn_nav blog_pn_nav-left">%image</span><span class="blog_pn_nav blog_pn_nav-right"><span class="blog_pn_nav-title">%title</span></span>'
        ) );
    }

    // Display comments
    if ( (comments_open() || get_comments_number()) && arum_string_to_bool($blog_comments)) {
        comments_template();
    }

    ?>

</article>