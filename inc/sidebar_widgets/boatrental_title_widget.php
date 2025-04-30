<?php

/**
 * Class boatrental_title_widget
 * 
 * @category Rental_WordPress_Theme
 * 
 * @package Boatrental
 * 
 * @author Pankaj Sharma <pksharma5524@gmail.com>
 * 
 * @link https://icubes.org/
 * 
 * @requires PHP 7.0
 */



/*
@package boatrental
=============================================================
Create h5 title widget
=============================================================

*/


if (!class_exists('boatrental_title_widget')) {

    class boatrental_title_widget extends WP_Widget
    {
        public function __construct()
        {
            // Widget settings
            $widget_ops = array(
                'classname' => 'boatrental_title_widget',
                'description' => 'Boatrental title Widget',
            );
            parent::__construct('boatrental_title_widget', 'Boatrental title Widget', $widget_ops);
        }

        public function widget($args, $instance) {
            echo $args['before_widget'];
            echo '<div class="footer-column col-space">';
            // Display the title
            $title = ! empty( $instance['title'] ) ? $instance['title'] : '';
            if ( ! empty( $title ) ) {
                echo $args['before_title'] . esc_html( $title ) . $args['after_title'];
            }
            
            // Display the editor content
            $editor_content = ! empty( $instance['editor_content'] ) ? $instance['editor_content'] : '';
            echo wp_kses_post($editor_content);
            echo '</div>';
            echo $args['after_widget'];
        }
        
        public function form($instance) {
            // Widget form fields
            $title = isset($instance['title']) ? $instance['title'] : '';
            $editor_content = isset($instance['editor_content']) ? $instance['editor_content'] : '';
            
            echo '<p>';
            echo '<label for="' . $this->get_field_id('title') . '">Title:</label>';
            echo '<input class="widefat" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . esc_attr($title) . '">';
            echo '</p>';
            
            // Editor content
            echo '<p>';
            echo '<label for="' . $this->get_field_id('editor_content') . '">Editor Content:</label>';
            echo wp_editor($editor_content, $this->get_field_id('editor_content'));
            echo '</p>';
        }
    }

}

function register_boatrental_title_widget()
{
    register_widget('boatrental_title_widget');
}
add_action('widgets_init', 'register_boatrental_title_widget');
