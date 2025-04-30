<?php

class Custom_Menu_Widget extends WP_Widget
{

    public function __construct()
    {
        parent::__construct(
            'custom_menu_widget',
            'Custom Menu Widget',
            array('description' => 'Boatrental A custom widget to display a menu in a dropdown.')
        );
    }

    public function widget($args, $instance)
    {
        // Get the selected menu term ID from widget settings
        $menu_term_id = !empty($instance['menu']) ? $instance['menu'] : 0;
        $title = !empty($instance['title']) ? $instance['title'] : 'title';
        echo $args['before_widget'];
        // echo $args['before_title'] . 'Custom Menu Widget' . $args['after_title'];

        if ($menu_term_id > 0) {
            $menu_items = wp_get_nav_menu_items($menu_term_id);
            if ($menu_items) {
                ?>
                                <h5><?php echo esc_html($title, 'boatrental'); ?></h5>
                                <ul>
                                <?php
                                foreach ($menu_items as $menu_item) {
                                    echo '<li><a href="' . esc_url($menu_item->url) . '">' . esc_html($menu_item->title) . '</a></li>';
                                }
                                ?>
                                </ul>
                        <?php
            }

        } else {
            echo 'No menu selected';
        }

        echo $args['after_widget'];
    }



    public function form($instance)
    {
        $menu = !empty($instance['menu']) ? $instance['menu'] : 'primary';
        $menus = wp_get_nav_menus(); // Retrieve the list of menus
        $title = !empty($instance['title']) ? $instance['title'] : ''; // Add this line
        ?>
                 <p>
                    <label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
                    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
                </p>
                <p>
                    <label for="<?php echo $this->get_field_id('menu'); ?>">Select Menu:</label>
                    <select name="<?php echo $this->get_field_name('menu'); ?>" id="<?php echo $this->get_field_id('menu'); ?>">
                        <option value="0">— Select a Menu —</option>
                        <?php
                        foreach ($menus as $menu_item) {
                            echo '<option value="' . $menu_item->term_id . '"';
                            if ($menu_item->term_id == $menu) {
                                echo ' selected="selected"';
                            } else {
                                if ($menu_item->term_id == 72) {
                                    echo ' selected="selected"';
                                }
                            }
                            echo '>' . esc_html($menu_item->name) . '</option>';
                        }
                        ?>
                    </select>
                </p>
                <?php
    }




    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['menu'] = sanitize_text_field($new_instance['menu']);
        $instance['title'] = sanitize_text_field($new_instance['title']);
        return $instance;
    }

}


function register_custom_menu_widget()
{
    register_widget('Custom_Menu_Widget');
}
add_action('widgets_init', 'register_custom_menu_widget');
