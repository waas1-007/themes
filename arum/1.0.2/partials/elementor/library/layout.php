<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
} ?>
<article class="single-library-article">

    <div class="entry"<?php arum_schema_markup( 'entry_content' ); ?>>
        <?php the_content(); ?>
    </div>

</article>