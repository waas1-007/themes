<?php
/**
 * The Header for our theme.
 *
 * @package Arum WordPress theme
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
?><!DOCTYPE html>
<html <?php language_attributes(); ?><?php arum_schema_markup( 'html' ); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <link rel="profile" href="//gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php if(function_exists('wp_body_open')) { wp_body_open(); } ?>

<?php do_action('arum/action/before_outer_wrap'); ?>

<div id="outer-wrap" class="site">

    <?php do_action('arum/action/before_wrap'); ?>

    <div id="wrap">
        <?php

            do_action('arum/action/before_header');

            if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'header' ) ) {
                do_action('arum/action/header');
            }

            do_action('arum/action/after_header');

        ?>

        <?php do_action('arum/action/before_main'); ?>

        <main id="main" class="site-main"<?php arum_schema_markup('main') ?>>
            <?php

                do_action('arum/action/before_page_header');

                do_action('arum/action/page_header');

                do_action('arum/action/after_page_header');