<?php

/**
 * Class boatrental_yatchtype_widget
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
Create yatchtype widget
=============================================================
*/


if (!class_exists('boatrental_yatchtype_widget')) {

    class boatrental_yatchtype_widget extends WP_Widget
    {
        public function __construct()
        {
            // Widget settings
            $widget_ops = array(
                'classname' => 'boatrental_yatchtype_widget',
                'description' => 'Boatrental yatchtype Widget',
            );
            parent::__construct('boatrental_yatchtype_widget', 'Boatrental yatchtype Widget', $widget_ops);
        }

        public function widget($args, $instance)
        {
            // Widget output
            $title =  $instance['title'];

            echo $args['before_widget'];

            if ($title) {
                echo $args['before_title'] . $title . $args['after_title'];
            }

            $uncategorized_term = get_term_by('slug', 'uncategorized', 'product_cat');
            $uncategorized_term_id = $uncategorized_term ? $uncategorized_term->term_id : 0;

            $yatchtype_terms = get_terms(array(
                'taxonomy' => 'product_cat', // Assuming 'product_cat' is the taxonomy for boat types
                'hide_empty' => false,
                'exclude' => array($uncategorized_term_id),
            ));

            ?>
            <div class="cat-siderbar dropdown-check">
                <div class="dropdown">
                    <?php
                    if ($yatchtype_terms && !is_wp_error($yatchtype_terms)) :
                        foreach ($yatchtype_terms as $term) :
                            $checked = isset($_GET['yachttype']) && (is_array($_GET['yachttype']) ? in_array($term->term_id, $_GET['yachttype']) : $_GET['yachttype'] == $term->term_id) ? 'checked' : '';
                            $input_tag = sprintf('<input type="checkbox" id="yatchtype" name="yachttype[]" value="%s" %s onclick="updateQueryString(\'yachttype\', this)">', $term->term_id, $checked);
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

function register_boatrental_yatchtype_widget()
{
    register_widget('boatrental_yatchtype_widget');
}
add_action('widgets_init', 'register_boatrental_yatchtype_widget');
