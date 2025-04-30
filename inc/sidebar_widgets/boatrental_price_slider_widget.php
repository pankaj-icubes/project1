<?php


/**
 * Class boatrental_PriceSlider_widget
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
Create price slider widget
=============================================================

*/

if (!class_exists('boatrental_PriceSlider_widget')) {

    class boatrental_PriceSlider_widget extends WP_Widget
    {
        public function __construct()
        {
            // Widget settings
            $widget_ops = array(
                'classname' => 'boatrental_PriceSlider_widget',
                'description' => 'Boatrental Price Widget',
            );
            parent::__construct('boatrental_PriceSlider_widget', 'Boatrental Price Slider Widget', $widget_ops);
        }

        public function widget($args, $instance)
        {
            // Widget output
            $title =  $instance['title'];

            echo $args['before_widget'];

            if ($title) {
                echo $args['before_title'] . $title . $args['after_title'];
            }

            $product_query = new WC_Product_Query(array(
                'limit' => 1,  // Retrieve only one product
                'orderby' => 'meta_value_num',
                'order' => 'DESC',
                'meta_key' => '_price',
            ));
            
            // Get the products
            $products = $product_query->get_products();
            
            // Check if products are found
            if (!empty($products)) {
                $highest_price_product = reset($products);  // Get the first product (highest price)
                $highest_price = $highest_price_product->get_price();
            } else {
                // No products found, set a default value
                $highest_price = 100000;
            }
            

    ?>
            <div class="price-range-slider">
                <p class="range-value">
                    <input type="hidden" id="amount" readonly>
                    <input type="hidden" id="min_price" class="min_price" name="br_min_price" readonly>
                    <input type="hidden" id="max_price" class="max_price" name="br_max_price" data-product_high_price="<?php echo esc_attr($highest_price); ?>" readonly>
                    <input id="search-input" type="hidden" placeholder="<?php echo esc_attr_x('Search &hellip;', 'placeholder', 'boatrental'); ?>" value="<?php echo esc_attr(get_search_query()); ?>" name="s">
                </p>
                
                <div id="slider-range" class="range-bar"></div>
                <div class="range-section">
                    <span class="rental-min-price"></span>
                    <span class="rental-max-price right-section"></span>
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

function register_boatrental_PriceSlider_widget()
{
    register_widget('boatrental_PriceSlider_widget');
}
add_action('widgets_init', 'register_boatrental_PriceSlider_widget');
