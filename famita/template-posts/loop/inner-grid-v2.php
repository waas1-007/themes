<?php $thumbsize = !isset($thumbsize) ? famita_get_config( 'blog_item_thumbsize', 'full' ) : $thumbsize;?>
<article <?php post_class('post post-grid-v2'); ?>>
    <?php
        $thumb = famita_display_post_thumb($thumbsize);
        echo trim($thumb);
    ?>
    <div class="content">
        <?php if (get_the_title()) { ?>
            <h4 class="title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h4>
        <?php } ?>
        <div class="bottom-info">
            <div class="name-author">
                <span class="suffix"><?php echo esc_html__('by','famita') ?></span>
                <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
                    <?php echo get_the_author(); ?>
                </a>
            </div>
            <div class="date-post"><a href="<?php the_permalink(); ?>"><?php the_time( get_option('date_format', 'd M, Y') ); ?></a></div>
        </div>
    </div>
</article>