<?php
/**
 * Actions and filters that affect Ignition functionality
 *
 * @since 1.0.0
 */

// Move categories before the post title.
remove_action( 'ignition_the_post_entry_meta', 'ignition_the_post_entry_categories', 30 );
add_action( 'ignition_the_post_header', 'ignition_the_post_entry_categories', 5 );
