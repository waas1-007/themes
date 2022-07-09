<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
?>
<header id="lastudio-header-builder" class="<?php echo arum_header_classes(); ?>"<?php arum_schema_markup( 'header' ); ?>>
    <?php
    if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'header' ) ) {
        $value = arum_get_header_layout();

        if(class_exists('LAHB', false) && ( $value != 'default' || ( isset($_GET['lastudio_header_builder']) && $_GET['lastudio_header_builder'] == 'inline_mode' ) )){
            do_action('lastudio/header-builder/render-output');
        }
        else{
            get_template_part('partials/header/content', $value);
        }
    }
    ?>
</header>