<?php

/**
 * Class boatrental_location_widget
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
Create location widget
=============================================================

*/


if (!class_exists('boatrental_location_widget')) {

    class boatrental_location_widget extends WP_Widget
    {
        public function __construct()
        {
            // Widget settings
            $widget_ops = array(
                'classname' => 'boatrental_location_widget',
                'description' => 'Boatrental Location Widget',
            );
            parent::__construct('boatrental_location_widget', 'Boatrental Location Widget', $widget_ops);
        }

        public function widget($args, $instance)
        {
            // Widget output
            $title =  $instance['title'];

            echo $args['before_widget'];

            if ($title) {
                echo $args['before_title'] . $title . $args['after_title'];
            }

            $location_terms = get_terms(array(
                'taxonomy' => 'location',
                'hide_empty' => false,
            ));

    ?>
            <div class="cat-siderbar dropdown-check">
                <div class="dropdown">
                    <?php
                    if ($location_terms && !is_wp_error($location_terms)) :
                        foreach ($location_terms as $term) :
                            $checked = isset($_GET['pro_location']) && (is_array($_GET['pro_location']) ? in_array($term->term_id, $_GET['pro_location']) : $_GET['pro_location'] == $term->term_id) ? 'checked' : '';
                            $input_tag = sprintf('<input type="checkbox" id="location" name="pro_location[]" value="%s" %s onclick="updateQueryString(\'pro_location\', this)">', $term->term_id, $checked);
                    ?>
                            <label>
                                <?php echo $input_tag; ?>
                                <?php echo $term->name; ?>
                            </label>
                    <?php
                        endforeach;
                    endif;
                    ?>
                </div>
            </div>

    <?php

            echo $args['after_widget'];
        }

        public function form($instance)
        {
            // Widget form fields
            $title = isset($instance['title']) ? $instance['title'] : '';

            echo '<p>';
            echo '<label for="' . $this->get_field_id('title') . '">Title:</label>';
            echo '<input class="widefat" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . esc_attr($title) . '">';
            echo '</p>';
        }

        public function update($new_instance, $old_instance)
        {
            // Save widget settings
            $instance = array();
            $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
            return $instance;
        }
    }

}

function register_boatrental_location_widget()
{
    register_widget('boatrental_location_widget');
}
add_action('widgets_init', 'register_boatrental_location_widget');
