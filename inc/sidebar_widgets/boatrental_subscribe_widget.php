<?php
/**
 * Class boatrental_subscribe_widget
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
Create newslatter widget
=============================================================

*/

if (!class_exists('boatrental_subscribe_widget')) {

    class boatrental_subscribe_widget extends WP_Widget
    {
        public function __construct()
        {
            // Widget settings
            $widget_ops = array(
                'classname' => 'boatrental_subscribe_widget',
                'description' => 'Boatrental Subscribe Widget',
            );
            parent::__construct('boatrental_subscribe_widget', 'Boatrental Subscribe Slider Widget', $widget_ops);
        }

        public function widget($args, $instance)
        {
            // Widget output
            $title = $instance['title'];
            $desc = $instance['desc'];
            $button_title = $instance['button_title'];

            echo $args['before_widget'];
            ?>
            <p><?php echo esc_html($desc, 'boatrental'); ?></p>
            <h4><?php echo esc_html($title, 'boatrental'); ?></h4>
            
                <form class="newsletter-form" action="#" method="POST" >
                    <div class="form-group">
                        <input type="email" id="email" name="email" placeholder="Your email address" required>
                        <?php if(!empty($button_title)){ ?>
                        <button type="submit"><?php echo esc_html($button_title, 'boatrental'); ?></button>
                        <?php } else{ ?>   
                        <button type="submit"><i class="fas fa-arrow-right" aria-hidden="true"></i></button> 
                        <?php } ?>
                    </div>
                </form>
            
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

            $button_title = isset($instance['button_title']) ? $instance['button_title'] : '';

            echo '<p>';
            echo '<label for="' . $this->get_field_id('button_title') . '"> Button title:</label>';
            echo '<input class="widefat" id="' . $this->get_field_id('button_title') . '" name="' . $this->get_field_name('button_title') . '" type="text" value="' . esc_attr($button_title) . '">';
            echo '</p>';

            $desc = isset($instance['desc']) ? $instance['desc'] : '';

            echo '<p>';
            echo '<label for="' . $this->get_field_id('desc') . '"> Description:</label>';
            echo '<input class="widefat" id="' . $this->get_field_id('desc') . '" name="' . $this->get_field_name('desc') . '" type="text" value="' . esc_attr($desc) . '">';
            echo '</p>';
            
        }

        public function update($new_instance, $old_instance)
        {
            // Save widget settings
            $instance = array();
            $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
            $instance['desc'] = (!empty($new_instance['desc'])) ? strip_tags($new_instance['desc']) : '';
            $instance['button_title'] = (!empty($new_instance['button_title'])) ? strip_tags($new_instance['button_title']) : '';
            return $instance;
        }
    }
}

function register_boatrental_subscribe_widget()
{
    register_widget('boatrental_subscribe_widget');
}
add_action('widgets_init', 'register_boatrental_subscribe_widget');
