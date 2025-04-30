<?php

/**
 * Class Boatrental_Type_Sidebar_Widget
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


/**
 * Class with register rental type widgets.
 */

if (!class_exists('Boatrental_Type_Sidebar_Widget')) {

    class Boatrental_Type_Sidebar_Widget extends WP_Widget
    {

        // Constructor
        public function __construct()
        {
            parent::__construct(
                'boatrental_type_widget',  // Widget ID
                'Rental type Filter',  // Widget name
                array('description' => 'Rental Type Filter widget ')  // Widget description
            );
        }

        // Widget Output
        public function widget($args, $instance)
        {
            $title = isset($instance['title']) ? $instance['title'] : 'Rental Type';

            echo $args['before_widget'];

            if (class_exists('WooCommerce')) {
?>
                <div class="widget-heading br-yacht-available">
                    <h3 class="widget-title"><?php echo $title; ?></h3>

                    <input type="radio" id="<?php echo esc_attr('day'); ?>" name="<?php echo esc_attr('rental_type'); ?>" value="<?php echo esc_attr('Day'); ?>" onclick="updateQueryString('<?php echo esc_js('rental_type'); ?>', this)" <?php echo (isset($_GET['rental_type']) && (is_array($_GET['rental_type']) ? in_array('Day', $_GET['rental_type']) : $_GET['rental_type'] == 'Day')) ? 'checked' : ''; ?> >
                    <label for="<?php echo esc_attr('day'); ?>"><?php echo esc_html('Day'); ?></label><br>

                    <input type="radio" id="<?php echo esc_attr('hour'); ?>" name="<?php echo esc_attr('rental_type'); ?>" value="<?php echo esc_attr('Hour'); ?>" onclick="updateQueryString('<?php echo esc_js('rental_type'); ?>', this)" <?php echo (isset($_GET['rental_type']) && (is_array($_GET['rental_type']) ? in_array('Hour', $_GET['rental_type']) : $_GET['rental_type'] == 'Hour')) ? 'checked' : ''; ?> >
                    <label for="<?php echo esc_attr('hour'); ?>"><?php echo esc_html('Hour'); ?></label><br>

                    <input type="radio" id="<?php echo esc_attr('both'); ?>" name="<?php echo esc_attr('rental_type'); ?>" value="<?php echo esc_attr('both'); ?>" onclick="updateQueryString('<?php echo esc_js('rental_type'); ?>', this)" <?php echo !isset($_GET['rental_type']) ? 'checked' : ''; ?> >
                    <label for="<?php echo esc_attr('Both'); ?>"><?php echo esc_html('Both'); ?></label><br>




                </div>

            <?php
            }

            echo $args['after_widget'];
        }

        // Widget Form
        public function form($instance)
        {
            $title = isset($instance['title']) ? $instance['title'] : 'Rental Type';

            ?>
            <p>
                <label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e('Title:', 'boatrental'); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
            </p>

<?php
        }

        // Widget Update
        public function update($new_instance, $old_instance)
        {
            $instance = array();
            $instance['title1'] = (!empty($new_instance['title1'])) ? strip_tags($new_instance['title1']) : '';

            return $instance;
        }
    }
}

// Register Custom Sidebar Widget
function rental_type_sidebar_widget()
{
    register_widget('Boatrental_Type_Sidebar_Widget');
}
add_action('widgets_init', 'rental_type_sidebar_widget');
