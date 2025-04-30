<!DOCTYPE html>
<html lang=" <?php language_attributes(); ?> ">

<head>
    <meta charset="UTF-8">
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <?php wp_head(); 
     if(!is_front_page()){
        ?>
        <style>
            .main {
                padding: 80px 0;
            }
        </style>
        <?php 
        }

    ?>
</head>

<body <?php body_class(); ?> id="<?php echo esc_attr(apply_filters('boatrental_blog_template', '') . '-mode');
                                    ?>">
    <?php
    if (function_exists('wp_body_open')) {
        wp_body_open();
    }

    ?>


    <div id="page" class="site body-wrapper">
        <?php

        do_action('boatrental_custom_header_style_callback');

        ?>
        <div id="content" class="site-content">