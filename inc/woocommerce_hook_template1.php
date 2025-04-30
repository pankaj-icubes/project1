<?php
/**
 * Woocommerce functions used in the boatrental theme.
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
 * 
 */

/*
=============================================================
Define woocommerce functions
=============================================================

*/

defined('ABSPATH') || exit;

/**
 * Single Product Hooks
 */

if (!function_exists('boatrental_wc_template_single_title')) {
    /**
     * Get product title and map.
     */
    function boatrental_wc_template_single_title()
    {

        global $product;

        $product = wc_get_product($product->get_id()); // Load the variable product

        if ($product && $product->is_type('variable') && $product && empty($product->get_price())) {
            remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
        }

        wc_get_template('single-product/loop/title.php');
    }
}



if (!function_exists('boatrental_wc_template_short_description')) {
    /**
     * Get product title and map.
     */
    function boatrental_wc_template_short_description()
    {
        wc_get_template('single-product/loop/short-description.php');
    }
}



if (!function_exists('boatrental_wc_template_single_price')) {
    /**
     * Get product price
     */
    function boatrental_wc_template_single_price()
    {
        wc_get_template('single-product/loop/price.php');
    }
}


if (!function_exists('boatrental_wc_template_product_images')) {
    /**
     * Get product image
     */
    function boatrental_wc_template_product_images()
    {
        wc_get_template('single-product/loop/product-image.php');
    }
}

if (!function_exists('boatrental_remove_product_images')) {
    function boatrental_remove_product_images()
    {
        remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);
        remove_action('woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20);
    }
}

if (!function_exists('baorental_wc_template_product_thumbnails')) {
    /**
     * Get product thumbnails
     */
    function boatrental_wc_template_product_thumbnails()
    {
        wc_get_template('single-product/loop/product-thumbnails.php');
    }
}

if (!function_exists('boatrental_wc_template_product_info')) {
    /**
     * Get product description
     */
    function boatrental_wc_template_product_info()
    {
        wc_get_template('single-product/loop/product-info.php');
    }
}


if (!function_exists('boatrental_wc_template_product_booking_form')) {
    /**
     * Get product booking form
     */
    function boatrental_wc_template_product_booking_form()
    {
        do_action('woocommerce_single_product_summary');
    }
}

if (!function_exists('boatrental_wc_template_wishlist')) {
    /**
     * Get product booking form
     */
    function boatrental_wc_template_wishlist()
    {
        wc_get_template('single-product/loop/wishlist.php');
    }
}

if (!function_exists('boatrental_add_product_custom_tab')) {
    /**
     * Add product custom tab
     */

    function boatrental_add_product_custom_tab($tabs)
    {
        // Add custom tab
        $tab_title1 = Boatrental_Main::get_meta('tab_title1');
        $tab_title2 = Boatrental_Main::get_meta('tab_title2');
        $tab_check1 = Boatrental_Main::get_meta('tab_title1_enable');
        $tab_check2 = Boatrental_Main::get_meta('tab_title2_enable');

        if ($tab_check1 != 1) {
            $tabs['custom_tab1'] = array(
                'title' => esc_html(ucfirst($tab_title1), 'boatrental'),
                'priority' => 15,
                'callback' => 'boatrental_product_custom_tab_content',
                'icon' => '<i class="' . esc_attr(Boatrental_Main::get_meta('tab_title1_icon'), 'boatrental') . '"></i>',
            );
        }

        if ($tab_check2 != 1) {
            $tabs['custom_tab2'] = array(
                'title' => esc_html(ucfirst($tab_title2), 'boatrental'),
                'priority' => 16,
                'callback' => 'boatrental_product_custom_tab_content2',
                'icon' => '<i class="' . esc_attr(Boatrental_Main::get_meta('tab_title2_icon'), 'boatrental') . '"></i>',
            );
        }

        $tabs['description'] = array(
            'title' => empty(Boatrental_Main::get_meta('tab_description')) ? esc_html__('Description', 'boatrental') : Boatrental_Main::get_meta('tab_description'),
            'priority' => 10,
            'callback' => 'woocommerce_product_description_tab',
            'icon' => '<i class="' . Boatrental_Main::get_meta('tab_description_icon') . '"></i>',
        );

        // Remove the related products tab from the original position
        unset($tabs['related']);

        $tabs['technical_specification'] = array(
            'title' => esc_html(ucfirst('Technical Specification'), 'boatrental'),
            'title' => empty(Boatrental_Main::get_meta('technical_specification')) ? esc_html__('Technical Specification', 'boatrental') : Boatrental_Main::get_meta('technical_specification'),
            'priority' => 15,
            'callback' => 'boatrental_product_technical_specification_tab_content',
            'icon' => '<i class="' . Boatrental_Main::get_meta('technical_specification_icon') . '"></i>',
        );

        $tabs['reviews'] = array(
            'title' => empty(Boatrental_Main::get_meta('tab_reviews')) ? esc_html__('Reviews', 'woocommerce') : Boatrental_Main::get_meta('tab_reviews'),
            'priority' => 30,
            'callback' => 'comments_template',
            'icon' => '<i class="' . Boatrental_Main::get_meta('tab_reviews_icon') . '"></i>',
        );

        //Add the related products tab to a different tab
        $tabs['additional_information'] = array(
            'title' => empty(Boatrental_Main::get_meta('tab_additional_information')) ? esc_html__('Additional Information', 'boatrental') : Boatrental_Main::get_meta('tab_additional_information'),
            'priority' => 30,
            'callback' => 'woocommerce_product_additional_information_tab',
            'icon' => '<i class="' . Boatrental_Main::get_meta('tab_additional_information_icon') . '"></i>',
        );
        global $product;
        if ($product->is_type('rmw_rental')) {
            unset($tabs['additional_information']);
        }

        return $tabs;
    }
}

if (!function_exists('boatrental_product_technical_specification_tab_content')) {

    function boatrental_product_technical_specification_tab_content()
    {
        global $product;
        // Get the product attributes
        $attributes = $product->get_attributes();

        // Check if there are any attributes
        if ($attributes) { ?>

                                                <div class="tabs-prd-info">
                                                    <table class="table table-bordered">
                                                        <tbody>
                                                            <tr>
                                                                <?php foreach ($attributes as $attribute) {
                                                                    $attribute_label = wc_attribute_label($attribute->get_name()); // Get the attribute label
                                                                    $attribute_value = wc_clean($product->get_attribute($attribute->get_name())); // Clean the attribute value
                                                                    ?>
                                                                                <th><?php echo esc_html($attribute_label); ?></th>
                                                                <?php } ?>
                                                            </tr>
                                                            <tr>
                                                                <?php foreach ($attributes as $attribute) {
                                                                    $attribute_value = wc_clean($product->get_attribute($attribute->get_name())); // Clean the attribute value
                                                                    ?>
                                                                                <td><?php echo esc_html($attribute_value); ?></td>
                                                                <?php } ?>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>

                                <?php }
    }
}


if (!function_exists('boatrental_product_custom_tab_content')) {

    function boatrental_product_custom_tab_content()
    {
        global $post;
        $tab_des1 = get_post_meta($post->ID, 'tab_des1', true);
        echo wp_kses_post($tab_des1);
    }
}

if (!function_exists('boatrental_product_custom_tab_content2')) {

    function boatrental_product_custom_tab_content2()
    {
        global $post;
        $tab_des2 = get_post_meta($post->ID, 'tab_des2', true);

        // Display the value with formatting preserved
        echo wp_kses_post($tab_des2);
    }
}


if (!function_exists('boatrental_add_product_custom_meta_boxes')) {

    /**
     * Add product custom meta box
     */

    function boatrental_add_product_custom_meta_boxes()
    {

        $tab_check1 = Boatrental_Main::get_meta('tab_title1_enable');
        $tab_check2 = Boatrental_Main::get_meta('tab_title2_enable');
        $tab_title1 = wp_kses_post(Boatrental_Main::get_meta('tab_title1'));
        $tab_title2 = wp_kses_post(Boatrental_Main::get_meta('tab_title2'));

        if ($tab_check1 != 1) {
            add_meta_box(
                'custom_meta_box1',
                esc_html($tab_title1, 'boatrental'),
                'boatrental_render_product_custom_meta_box',
                'product',
                'normal',
                'default'
            );
        }

        if ($tab_check2 != 1) {
            add_meta_box(
                'custom_meta_box2',
                esc_html($tab_title2, 'boatrental'),
                'boatrental_render_product_custom_meta_box2',
                'product',
                'normal',
                'default'
            );
        }

        // ======= product details fields =======//
        ?>
        
                                <?php
                                add_meta_box(
                                    'custom_product_fields',
                                    'Custom Product Fields',
                                    function ($post) {
                                        $fields = array(
                                            '_beds' => 'Beds',
                                            '_bathroom' => 'Bathroom',
                                        );
                                        echo '<div class="custom-fields-wrapper">';
                                        foreach ($fields as $field_key => $field_label) {
                                            $field_value = get_post_meta($post->ID, $field_key, true);
                                            echo '<div class="form-group">';
                                            echo '<label for="' . $field_key . '">' . $field_label . ':</label>';
                                            echo '<input type="text" class="form-control" id="' . $field_key . '" name="' . $field_key . '" value="' . esc_attr($field_value) . '">';
                                            echo '</div>';
                                        }
                                        echo '</div>';
                                    },
                                    'product',
                                    'normal',
                                    'high'
                                );

    }
}

if (!function_exists('boatrental_save_product_custom_meta_box')) {
    function boatrental_save_product_custom_meta_box($post_id)
    {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            return;

        $fields = array(
            '_beds',
            '_bathroom',
            'tab_des1',
            'tab_des2',
        );

        foreach ($fields as $field) {
            if (isset($_POST[$field])) {
                update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
            }
        }

    }
}


if (!function_exists('boatrental_render_product_custom_meta_box')) {

    function boatrental_render_product_custom_meta_box($post)
    {
        // Get existing meta values
        $tab_des1 = get_post_meta($post->ID, 'tab_des1', true);
        $tab_check1 = Boatrental_Main::get_meta('tab_title1_enable');


        if ($tab_check1 != 1) {
            $editor_settings1 = array(
                'textarea_rows' => 10,
                'teeny' => true,
                'media_buttons' => false,
                'tinymce' => array(
                    'toolbar1' => 'bold italic underline bullist numlist alignleft aligncenter alignright link',
                    'toolbar2' => '',
                    'toolbar3' => '',
                ),
            );

            wp_editor($tab_des1, 'tab_des1', $editor_settings1);
        }
    }
}


if (!function_exists('boatrental_render_product_custom_meta_box2')) {

    function boatrental_render_product_custom_meta_box2($post)
    {
        // Get existing meta values
        $tab_des2 = get_post_meta($post->ID, 'tab_des2', true);
        $tab_check2 = Boatrental_Main::get_meta('tab_title2_enable');

        if ($tab_check2 != 1) {
            $editor_settings2 = array(
                'textarea_rows' => 10,
                'teeny' => true,
                'media_buttons' => true, // Enable image upload functionality
                'tinymce' => array(
                    'toolbar1' => 'bold italic underline bullist numlist alignleft aligncenter alignright link',
                    'toolbar2' => '',
                    'toolbar3' => '',
                ),
            );

            wp_editor($tab_des2, 'tab_des2', $editor_settings2);
        }
    }
}


if (!function_exists('boatrental_remove_related_products')) {
    /**
     * Remove related products
     */
    function boatrental_remove_related_products()
    {
        remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
    }
}


if (!function_exists('boatrental_booking_form')) {
    /**
     * Get product booking form
     */
    function boatrental_booking_form()
    {
        wc_get_template('single-product/booking-form.php');
    }
}

if (!function_exists('boatrental_remove_summary_elements')) {
    /*
     * Remove the product title, rating, and price
     */
    function boatrental_remove_summary_elements()
    {
        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
    }
}

if (!function_exists('boatrental_remove_out_of_stock_message')) {
    /*
     * Remove the out of stock message
     */

    function boatrental_remove_out_of_stock_message($availability_html, $product)
    {

        return $availability_html = '';
    }
}

if (!function_exists('boatrental_remove_add_to_wishlist')) {
    /*
     * Remove wishlist
     */

    function boatrental_remove_add_to_wishlist()
    {
        // Check if the YITH Wishlist plugin is active
        if (class_exists('YITH_WCWL')) {

            $jquery = '
            jQuery(function($){   
                var elementsToHide = $(".br_v1_wrap").find(".yith-wcwl-add-button"); 
                elementsToRemove.remove();
            })';

            wp_add_inline_script('jquery-yith-wcwl', $jquery);
            wp_add_inline_script('jquery-yith-wcwl-user', $jquery);
        }
    }
}

if (!function_exists('boatrental_template_single_rating')) {
    /*
     * Remove wishlist
     */

    function boatrental_template_single_rating()
    { ?>

                                <div class="br-review-detail">

                                    <?php

                                    if (boatrental_rating_fun() > 0) {
                                        ?>
                                                    <span><i class="fas fa-star" aria-hidden="true"></i>
                                                        <?php echo boatrental_rating_fun(); ?>
                                                    </span>
                                    <?php } ?>

                                    <?php
                                    $location_names = get_product_location(get_the_ID());
                                    if ($location_names !== 0) { ?>
                                                    <span class="location"><i class="fas fa-map-marker-alt"></i>
                                                        <?php
                                                        echo $location_names;
                                                        ?>
                                                        </b></span>
                                                <?php
                                    }
                                    ?>

                                </div>


            <?php }
}

if (!function_exists('boatrental_breadcrumb')) {
    /*
     * Remove wishlist
     */
    function boatrental_breadcrumb()
    {
        if (is_home()) {
            $class = "br-breadcrumb-overlap";
        } elseif (is_category()) {
            $class = "br-breadcrumb-overlap";
        } elseif (is_page('tour-destination')) {
            $class = "br-breadcrumb-overlap";
        } elseif (is_page('tour-destination-dark')) {
            $class = "br-breadcrumb-overlap";
        } elseif (is_page('home-v2')) {
            $class = "br-breadcrumb-overlap";
        } elseif (is_tag()) {
            $class = "br-breadcrumb-overlap";
        } elseif (is_front_page()) {
            $class = "br-breadcrumb-overlap";
        } elseif (is_archive()) {
            $class = "br-breadcrumb-overlap";
        } elseif (is_single()) {
            if (!is_product()) {
                $class = "br-breadcrumb-overlap";
            } else {
                $class = "br-breadcrumb-default";
            }
        } else {
            $class = "br-breadcrumb-default";
        }


        $product = wc_get_product();

        if ($product->is_type('rmw_rental')) {
            if (Boatrental_Main::get_meta('product_layout') !== 'layout_3' && !isset($_GET['style'])) {
                echo '<div class="breadcrumb-wrapper ' . $class . '"><div class="container">';
                woocommerce_breadcrumb();
                echo '</div></div>';
            }
        } else {
            echo '<div class="breadcrumb-wrapper ' . $class . '"><div class="container">';
            woocommerce_breadcrumb();
            echo '</div></div>';
        }

    }
}



if (!function_exists('boatrental_get_extra_class')) {
    /*
     * Add Extra Class
     */
    function boatrental_get_extra_class()
    {
        $class = "";

        if (is_home()) {
            $class = "br-header-overlap";
        } elseif (is_category()) {
            $class = "br-header-overlap";
        } elseif (is_page('tour-destination')) {
            $class = "br-header-overlap";
        } elseif (is_page('tour-destination-dark')) {
            $class = "br-header-overlap";
        } elseif (is_page('home-v1-dark')) {
            $class = "br-header-overlap";
        } elseif (is_tag()) {
            $class = "br-header-overlap";
        } elseif (is_front_page()) {
            $class = "br-header-overlap";
        } elseif (is_archive()) {
            $class = "br-header-overlap";
        } elseif (is_single()) {
            if (!is_product()) {
                if (Boatrental_Main::get_meta('single_blog_layout') == 'version_2') {
                    $class = "br-header-default";
                } else {
                    $class = "br-header-overlap";
                }
            } else {
                $class = "br-header-default";
            }
        } else {
            $class = "br-header-default";
        }


        return $class;
    }
}



if (!function_exists('boatrental_display_product_price')) {

    function boatrental_display_product_price()
    {
        global $product;


        boatrental_wc_template_single_price();
    }
}

if (!function_exists('boatrental_display_media_thumbnail')) {
    /*
     * Display thumbnail
     */
    function boatrental_display_media_thumbnail()
    {
        get_template_part('template-parts/media/thumbnail');
    }
}

if (!function_exists('boatrental_shop_loop_item_title')) {
    /*
     * Display Title
     */
    function boatrental_shop_loop_item_title()
    {
        get_template_part('template-parts/media/title');
    }
}

if (!function_exists('boatrental_shop_loop_item_meta')) {
    /*
     * Display Title
     */
    function boatrental_shop_loop_item_meta()
    {
        get_template_part('template-parts/media/meta');
    }
}

if (!function_exists('boatrental_shop_loop_item_location')) {
    /*
     * Display Title
     */
    function boatrental_shop_loop_item_location()
    {
        $location_names = get_product_location(get_the_ID());
        if ($location_names !== 0) { ?>
                                                <div class="br-product-location"><i class="fas fa-map-marker-alt"></i>
                                                <?php
                                                echo $location_names;
                                                ?>
                                                </div>
                                                <?php
        }
    }
}

if (!function_exists('boatrental_add_wishlist_menu_item')) {
    /*
     * Add wishlist menu item in my account page
     */
    function boatrental_add_wishlist_menu_item($items)
    {
        $new_item = array('wishlist' => __('Wishlist', 'boatrental'));
        $position = array_search('customer-logout', array_keys($items));

        if ($position !== false) {
            $first_items = array_slice($items, 0, $position, true);
            $last_items = array_slice($items, $position, null, true);
            $items = $first_items + $new_item + $last_items;
        } else {
            $items += $new_item;
        }

        return $items;
    }

}

if (!function_exists('change_attributes_tab_label')) {
    /*
     * Change the attributes label 
     */
    function change_attributes_tab_label($tabs)
    {
        $tabs['attribute']['label'] = 'Booking Attributes';
        return $tabs;
    }

}

if (!function_exists('boatrental_remove_woo_thumbnail')) {
    /*
     * Remove thumbnail hook
     */
    function boatrental_remove_woo_thumbnail()
    {

        remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
        remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
        remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
        remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);

    }

}


if (!function_exists('boatrental_shop_loop_item_price')) {
    /*
     * Remove Price
     */
    function boatrental_shop_loop_item_price()
    {
        ?>
                                <div class="br-product-detail">
                                    <div class="br-product-price">
                                        <span><?php do_action('woocommerce_boatrental_price'); ?></span>
                                    </div>
            
                                </div>
                                <?php
    }

}

if (!function_exists('woocommerce_product_meta_mobile')) {
    /*
     * add booking form for mobile
     */
    function woocommerce_product_meta_mobile()
    {
        ?>
                                <div class="br-prod-booking">
                                    <div class="br-booking">
                                        <div class="title">If you're looking to book, just ping us</div>
                                        <div class="subtitle">A professional skipper will navigate the boat for you</div>
                                        <div class="booking-btn filter-m">
                                            <div id="mySideBooking" class="sideBooking">
                                                <div class="sideBooking_wrap_m">
                                                    <a href="javascript:void(0)" class="closebtn" onclick="closeBooking()">&times;</a>
                                                    Booking Form 
                                                    <?php
                                                    if (wp_is_mobile()) {
                                                        do_action('woocommerce_product_meta_end');
                                                    }
                                                    ?> 
                                                </div>
                                            </div>
                                            <span class="openbtn filter-icon booking_button" onclick="openMobileBookingcat()">Request for booking</span>
                                        </div>
                                    </div>
                                </div>
                                <?php
    }

}

?>



