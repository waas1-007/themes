<?php 
$thumbsize = !isset($thumbsize) ? famita_get_config( 'blog_item_thumbsize', 'full' ) : $thumbsize;
$thumb = famita_display_post_thumb($thumbsize);
?>
<article <?php post_class('post post-layout post-list-item'); ?>>
    <div class="list-inner ">
        <div class="row flex-middle">
            <?php
                if ( !empty($thumb) ) {
                    ?>
                    <div class="image col-xs-6">
                        <?php echo trim($thumb); ?>
                    </div>
                    <?php
                }
            ?>
            <div class="content <?php echo (!empty($thumb))?'col-xs-6':'col-xs-12'; ?>">
                <div class="top-info">
                    <div class="date-post"><a href="<?php the_permalink(); ?>"><?php the_time( get_option('date_format', 'd M, Y') ); ?></a></div>
                    <div class="categories"><?php echo esc_html__('in ','famita') ?><?php famita_post_categories($post); ?></div>
                </div>
                <?php if (get_the_title()) { ?>
                    <h4 class="entry-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h4>
                <?php } ?>
                <a class="btn btn-primary btn-outline" href="<?php the_permalink(); ?>"><?php esc_html_e('Read More', 'famita'); ?></a>
            </div>
        </div>
    </div>
</article>