<?php

/**
 * Woocommerce hook used in the boatrental theme.
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
define woocommerce hook
=============================================================

*/



defined( 'ABSPATH' ) || exit;


remove_action('woocommerce_after_shop_loop', 'woocommerce_pagination');

function boatrental_woocommerce_pagination()
{
?>
    <div class="br-cat-pagination">
        <div class="cat-pagination">
            <ul>
                <?php
                global $wp_query;
                $current_page = max(1, get_query_var('paged'));

                // Previous page link
                if ($current_page > 1) {
                    echo '<li><a href="' . esc_url(get_pagenum_link($current_page - 1)) . '"><i class="fas fa-chevron-left"></i></a></li>';
                }

                // Page numbers
                $total_pages = $wp_query->max_num_pages;
                if ($total_pages > 1) {
                    for ($i = 1; $i <= $total_pages; $i++) {
                        echo '<li><a href="' . esc_url(get_pagenum_link($i)) . '"';
                        if ($current_page === $i) {
                            echo ' class="active"';
                        }
                        echo '>' . $i . '</a></li>';
                    }
                }

                // Next page link
                if ($current_page < $total_pages) {
                    echo '<li><a href="' . esc_url(get_pagenum_link($current_page + 1)) . '"><i class="fas fa-chevron-right"></i></a></li>';
                }
                
                ?>
            </ul>
        </div>
    </div>
<?php
}
add_action('woocommerce_after_shop_loop', 'boatrental_woocommerce_pagination', 10);



function custom_product_ordering()
{
    ob_start();
?>
    <div class="br-product-ordering">
            
            <?php do_action('woocommerce_before_shop_loop'); ?>
       
    </div>
<?php
    $content = ob_get_clean();
    echo $content;
}


add_action('custom_product_ordering', 'custom_product_ordering');


function boatrental_get_category_base()
{
    $woocommerce_permalinks = get_option('woocommerce_permalinks');

    if ($woocommerce_permalinks && is_array($woocommerce_permalinks)) {
        $permalinks = maybe_unserialize($woocommerce_permalinks);
        $category_base = isset($permalinks['category_base']) ? $permalinks['category_base'] : '';

        return $category_base;
    }

    return '';
}



function boatrental_rating_fun()
{
    $product = wc_get_product(get_the_ID());
    $rating_count = $product->get_rating_count();
    $average_rating = $product->get_average_rating();
    $average_rating = trim($average_rating, " \""); // Remove spaces and quotes
    
    if ($rating_count > 0) {
        $rating_text = apply_filters('boatrental_product_rating_text', 'Rating');

        return $average_rating . ' ' . $rating_text;
    }

    return 0;
}

function get_post_author_name() {
    $post_author_id = get_post_field( 'post_author', get_the_ID() );
    $author_name = get_the_author_meta( 'display_name', $post_author_id );
    return $author_name;
}

function get_post_reading_time() {
    $post_content = get_post_field( 'post_content', get_the_ID() );
    $word_count = str_word_count( strip_tags( $post_content ) );
    $average_reading_speed = 200; // Average reading speed in words per minute
    $reading_time = ceil( $word_count / $average_reading_speed );
    return $reading_time;
}

function display_post_reading_time() {
    $reading_time = get_post_reading_time();
    echo $reading_time . ' minute read';
}


// ====================== Single Product Page ===============================//

add_action( 'boatrental_wc_single_title', 'boatrental_wc_template_single_title', 5 );
add_action( 'boatrental_wc_short_description', 'boatrental_wc_template_short_description', 6 );
add_action( 'boatrental_wc_wishlist', 'boatrental_wc_template_wishlist', 5 );
// add_action( 'boatrental_wc_before_single_product', 'boatrental_wc_template_single_price', 5 );
add_action( 'boatrental_wc_before_single_product', 'boatrental_wc_template_product_images', 10 );
add_action( 'boatrental_wc_template_product_thumbnails', 'boatrental_wc_template_product_thumbnails', 10 );
// if(isset($_GET['style']) && $_GET['step'] == 2){
add_action( 'boatrental_wc_single_product_summary_left', 'boatrental_wc_template_product_info', 10 );
add_action( 'boatrental_wc_single_product_summary_right', 'boatrental_wc_template_product_booking_form', 10 );
// }
add_action('add_meta_boxes', 'boatrental_add_product_custom_meta_boxes');
add_action('save_post_product', 'boatrental_save_product_custom_meta_box');
add_filter('woocommerce_product_tabs', 'boatrental_add_product_custom_tab');
add_action('woocommerce_after_single_product_summary', 'boatrental_remove_related_products', 1);

add_action('woocommerce_single_product_summary', 'boatrental_remove_summary_elements', 1);
add_filter('woocommerce_stock_html', 'boatrental_remove_out_of_stock_message', 10, 2);
add_action('woocommerce_template_single_rating', 'boatrental_template_single_rating', 1);
add_action('woocommerce_boatrental_price', 'boatrental_display_product_price');
add_action('woocommerce_before_single_product_summary', 'boatrental_remove_product_images', 10);
add_action('woocommerce_product_meta_mobile', 'woocommerce_product_meta_mobile', 10);
        


// =================================== Shop page hook =====================================//
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
add_action('woocommerce_before_main_content', 'boatrental_breadcrumb');
add_action('woocommerce_before_shop_loop_item_title', 'boatrental_display_media_thumbnail', 13);
add_action('woocommerce_shop_loop_item_title', 'boatrental_shop_loop_item_title', 14);
add_action('woocommerce_shop_loop_item_meta', 'boatrental_shop_loop_item_location', 10);
add_action('woocommerce_shop_loop_item_meta', 'boatrental_shop_loop_item_meta', 15);
add_action('woocommerce_shop_loop_item_meta', 'boatrental_shop_loop_item_price', 15);
add_action('init', 'boatrental_remove_woo_thumbnail');
add_filter( 'woocommerce_account_menu_items', 'boatrental_add_wishlist_menu_item', 11 );

// ===== Admin ======/
add_filter('woocommerce_product_data_tabs', 'change_attributes_tab_label', 10, 1);

