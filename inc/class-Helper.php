<?php
/**
 * Static functions used in the boatrental theme.
 * 
 * Class Boatrental_Header
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

/**
 * Class with static helper functions.
 */

 if (!defined('ABSPATH')) exit;
 
  
class Helpers {
  
  /**
  * Constructor for the Helpers class.
  *
  * Register header footer menus or display cart section.
  */
    public function __construct()
    {

        add_action( 'boatrental_custom_header_style_callback', array( $this, 'boatrental_custom_header_style_callback' ) );
        add_action( 'init', array( $this, 'boatrental_register_menus' ) );
        add_action( 'boatrental_display_minicart', array( $this, 'boatrental_display_minicart' ) );
        
    }

    public function boatrental_register_menus() {
      register_nav_menus( array(
        'primary_menu'   => esc_html__( 'Header Menu', 'boatrental' ),
        'footer_menu'   => esc_html__( 'Footer Menu', 'boatrental' )
      ) );
  }

    public function boatrental_custom_header_style_callback() 
    {

        $header_style = Boatrental_Main::get_meta('Top_header_style');
        $class = boatrental_get_extra_class();
        ?>
        <header id="masthead" class="br-header-wrapper <?php echo esc_attr($class); ?>" role="banner">
        <?php
       
        if($header_style == 'version2' || is_page('homepage-2')){
          get_template_part('template-parts/header/navbar2');
        }else{
          get_template_part('template-parts/header/navbar');
        }
        ?></header><?php
        do_action('boatrental_breadcrumb');  
        // do_action('woocommerce_before_main_content');  
  
        }

    public static function is_user_logged_in_check() 
    {
        
        return is_user_logged_in() ? true : false;
    }

    public static function boatrental_get_all_menu($location)
    {
        $_menu_location = get_nav_menu_locations();
        return !empty($_menu_location[$location]) ? $_menu_location[$location] : '';
    }

    public static function boatrental_get_child_menu( $menu_array, $parent_id ) {
        $child_menus = [];
        if ( ! empty( $menu_array ) && is_array( $menu_array ) ) {
            foreach ( $menu_array as $menu ) {
                if ( intval( $menu->menu_item_parent) === $parent_id ) {
                    array_push( $child_menus, $menu);
                }
            }
        }

        return $child_menus;
    }


    public function boatrental_display_minicart(){
      if (class_exists('WooCommerce')) {
        ?>
        <div class="br-cart">
          <a href="<?php echo esc_url(boatrental_url . 'cart/') ?>"> <i class="fas fa-shopping-cart" aria-hidden="true"></i> <span class="cart_count">
            <?php 
              // Get the cart instance
                $cart = WC()->cart;
            
                // Get the cart item count
                $cart_item_count = $cart->get_cart_contents_count();
            
                if ($cart_item_count > 0) {
                    // Display the cart item count
                    echo $cart_item_count ;
                } else {
                    // Cart is empty
                    echo 0;
                }
            
            ?>
          </span></a>

          <div class="mini-cart">
            <?php echo display_boatrental_mini_cart(); ?>
          </div>
        </div>

        <?php

      } 
    }




}

return new Helpers();


//  ===================== Add Global Functions ========================//

function boatrentalGetFaviconUrl() {
  // Check if the favicon URL is available
  $favicon_url = get_site_icon_url();

  if (!empty($favicon_url)) {
      // If the favicon URL is available, return it
      return esc_url($favicon_url);
  }
  // Check if the Boatrental_Main class exists and if its method get_meta exists
  if (class_exists('Boatrental_Main') && method_exists('Boatrental_Main', 'get_meta')) {
      // If the custom favicon URL is available, return it
      $custom_favicon_url = Boatrental_Main::get_meta('favicon');

      if (!empty($custom_favicon_url)) {
          return esc_url($custom_favicon_url);
      }
  }

  // Default favicon URL
  $default_favicon_url = get_template_directory_uri() . '/path-to-default-favicon.png';

  // If custom favicon URL is not available, return the default favicon URL
  return esc_url($default_favicon_url);
}



function display_boatrental_mini_cart() {
    ob_start();
  
    // Retrieve the cart items
    $cart_items = WC()->cart->get_cart();
    $cart_url = wc_get_cart_url();
    $checkout_url = wc_get_checkout_url();
  
    if (WC()->cart->is_empty()) :
      echo '<label>' . esc_html__('Your shopping cart is empty', 'boatrental') . '</label>';
    else :
      ?>
      <ul class="mini-cart-items">
        <?php
        foreach ($cart_items as $cart_item_key => $cart_item) {
          // Get the product data
          $product_id = $cart_item['product_id'];
          $product = wc_get_product($product_id);
  
          // Display the cart item
          ?>
          <li class="mini-cart-item">
            <?php echo $product->get_image(array(50, 50)); ?>
            <p class="br-item-name"><?php echo $product->get_name(); ?></p>
            <p class="br-item-price"><?php echo wc_price($product->get_price()); ?></p>
            <a href="<?php echo esc_url(WC()->cart->get_remove_url($cart_item_key)); ?>" class="remove-item" title="<?php esc_attr_e('Remove this item', 'boatrental'); ?>">
              <i class="fa fa-times"></i>
            </a>
          </li>
          <?php
        }
  
        do_action('woocommerce_before_mini_cart');
  
        // Check if a discount coupon is applied
        if (WC()->cart->applied_coupons) {
          $subtotal = WC()->cart->get_subtotal(); // Get the subtotal amount
          $discount_total = WC()->cart->get_discount_total(); // Get the discount total amount
          $total_amount = $subtotal - $discount_total; // Calculate the total amount after discount
  
          // Display the discounted total amount
          ?>
          <div class="br-coupon-discount br-minicart-subtotal">
            <div class="br-total-label"><?php esc_html_e('Coupon Discount:', 'boatrental'); ?></div>
            <div class="br-total-price"><?php echo '- ' . wc_price($discount_total); ?></div>
          </div>
          <?php
        } else {
          // No discount coupon applied, display the regular total amount
          $total_amount = WC()->cart->get_subtotal();
        }
  
        // Display the total amount
        ?>
        <div class="br-minicart-subtotal">
          <div class="br-total-label"><?php esc_html_e('Subtotal:', 'boatrental'); ?></div>
          <div class="br-total-price"><?php echo wc_price($total_amount); ?></div>
        </div>
        <?php
        do_action('woocommerce_after_mini_cart');
        ?>
      </ul>
      <?php
    endif;
  
    echo '<div class="dropdown-footer">';
    echo '<a href="' . esc_url($cart_url) . '" class="button view-cart">' . esc_html__('View cart', 'boatrental') . '</a>';
    echo '<a href="' . esc_url($checkout_url) . '" class="button checkout button-secondary">' . esc_html__('Checkout', 'boatrental') . '</a>';
    echo '</div>';
  
    $content = ob_get_clean();
    return $content;
  }
  
  function boatrental_header_page_title()
  {
      $description = '';
      if (is_home()) {
          $title       = get_bloginfo('name');
          $description = get_bloginfo('description');
      } elseif (function_exists('is_woocommerce') && is_woocommerce()) {
          $title = woocommerce_page_title(false);
      } elseif (is_category()) {
          $title       = str_replace('category:', '', get_the_archive_title());
          $description = get_the_archive_description();
      } elseif (is_tag()) {
          $title       = str_replace('tag:', '', get_the_archive_title());
          $description = get_the_archive_description();
      } elseif (is_archive()) {
          $title       = str_replace('archives:', '', get_the_archive_title());
          $description = get_the_archive_description();
      } elseif (is_search()) {
          $title = sprintf(__('Search Results for : %s', 'boatrental'), get_search_query());
      } elseif (is_404()) {
          $title = sprintf(__('Error 404  : Page Not Found', 'boatrental'));
      } elseif (is_single()) {
          $title = get_the_title();
      } else {
          $title = get_the_title();
      }
  
      if (!empty($title)) {
          echo wp_kses_post($title);
      }
  
  }
