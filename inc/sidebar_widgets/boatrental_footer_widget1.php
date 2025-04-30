<?php

class Custom_Footer_Widget_1 extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'custom_Footer_widget_1',
            'Custom Footer Widget',
            array('description' => 'Boatrental theme options settings.')
        );
    }

    public function widget($args, $instance) {
        $title = !empty($instance['title']) ? $instance['title'] : '';
    
        echo $args['before_widget'];
        
       ?>
       <h5><?php echo esc_html($title, 'boatrental'); ?></h5>

       <?php if (!empty(Boatrental_Main::get_meta('footer_address'))) : ?>
        <p><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo Boatrental_Main::get_meta('footer_address'); ?></p>
        <?php endif; ?>

        <?php if (!empty(Boatrental_Main::get_meta('footer_email'))) : ?>
        <p><i class="fa fa-envelope-o" aria-hidden="true"></i> <a href="mailto:<?php echo esc_html(Boatrental_Main::get_meta('footer_email')); ?>"><?php echo esc_html(Boatrental_Main::get_meta('footer_email')); ?></a></p>
        <?php endif; ?>

        <?php if (!empty(Boatrental_Main::get_meta('footer_phone_number'))) : ?>
        <p><i class="fa fa-phone" aria-hidden="true"></i> <a href="tel:<?php echo esc_attr(Boatrental_Main::get_meta('footer_phone_number')); ?>"><?php echo esc_html(Boatrental_Main::get_meta('footer_phone_number')); ?></a></p>
        <?php endif; ?>
       
       
       <?php
    
        echo $args['after_widget'];
    }
    
    

    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : ''; // Add this line
        ?>
         <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        
        <?php
    }
    
    
    

    public function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = sanitize_text_field($new_instance['title']);
        return $instance;
    }
    
}


function register_custom_Footer_widget() {
    register_widget('Custom_Footer_Widget_1');
}
add_action('widgets_init', 'register_custom_Footer_widget');
