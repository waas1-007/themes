<?php $thumbsize = !isset($thumbsize) ? famita_get_config( 'blog_item_thumbsize', 'full' ) : $thumbsize;?>
<article <?php post_class('post post-layout post-grid-v1'); ?>>
    <?php
        $thumb = famita_display_post_thumb($thumbsize);
        echo trim($thumb);
    ?>
    <?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
        <span class="post-sticky"><?php echo esc_html__('Featured','famita'); ?></span>
    <?php endif; ?>
    <?php if (get_the_title()) { ?>
        <h4 class="entry-title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h4>
    <?php } ?>
    <div class="bottom-info">
        <div class="name-author">
            <span class="suffix"><?php echo esc_html__('by','famita') ?></span>
            <a class="author" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
                <?php echo get_the_author(); ?>
            </a>
        </div>
        <div class="space">/</div>
        <div class="date-post"><a href="<?php the_permalink(); ?>"><?php the_time( get_option('date_format', 'd M, Y') ); ?></a></div>
        <div class="space">/</div>
        <div class="comments"><?php comments_number( esc_html__('0 Comments', 'famita'), esc_html__('1 Comment', 'famita'), esc_html__('% Comments', 'famita') ); ?></div>
    </div>
    <?php if(has_excerpt()){?>
        <div class="description"><?php echo famita_substring( get_the_excerpt(), 25, '...' ); ?></div>
    <?php } else{ ?>
        <div class="description"><?php echo famita_substring( get_the_content(), 25, '...' ); ?></div>
    <?php } ?>
</article>