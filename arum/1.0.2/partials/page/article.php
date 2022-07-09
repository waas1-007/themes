<?php
/**
 * Outputs page article
 *
 * @package Arum WordPress theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
} ?>

<div class="entry"<?php arum_schema_markup( 'entry_content' ); ?>>

    <?php do_action( 'arum/action/before_page_entry' ); ?>

	<?php the_content();

	wp_link_pages( array(
		'before' => '<div class="clearfix"></div><div class="page-links">' . esc_html__( 'Pages:', 'arum' ),
		'after'  => '</div>',
	) );
	?>
    <div class="clearfix"></div>

    <?php do_action( 'arum/action/after_page_entry' ); ?>

</div>