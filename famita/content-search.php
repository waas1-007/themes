<?php
/**
 * The template part for displaying results in search pages
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package WordPress
 * @subpackage Famita
 * @since Famita 1.0
 */
?>
<article <?php post_class('post post-layout post-grid-v1'); ?>>
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
        <div class="date-post"><?php the_time( get_option('date_format', 'd M, Y') ); ?></div>
    </div>
</article>