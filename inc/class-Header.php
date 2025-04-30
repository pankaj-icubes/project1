<?php

/**
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
 * Class with manage header elements.
 */


if (!defined('ABSPATH'))
  exit;


if (!class_exists('Boatrental_Header')) {

  class Boatrental_Header
  {
    /**
    * Constructor for the Boatrental_Header class.
    *
    * Initializes Header layouts.
    */
    public function __construct()
    {
        add_action( 'boatrental_custom_header_style_callback', array( $this, 'boatrental_custom_header_style_callback' ) );
        add_filter( 'boatrental_show_header_elements', array( $this, 'boatrental_show_header_elements' ));

    }

    function boatrental_show_header_elements($show_header_elements) {
        if (!array_key_exists("disable_search",Boatrental_Main::get_meta()) && Boatrental_Main::get_meta('disable_search') !== 1) { 
            $show_header_elements['search_form'] = true;
          } else {
            $show_header_elements['search_form'] = false;
          }

          if (!array_key_exists("disable_top_header", Boatrental_Main::get_meta()) && Boatrental_Main::get_meta('disable_top_header') !== 1) {
            $show_header_elements['show_header'] = true;
          } else {
            $show_header_elements['show_header'] = false;
          }
        
          if (Boatrental_Authentication::is_user_logged_in_check()) {
            $show_header_elements['cart_link'] = true;
            $show_header_elements['dashboard_link'] = true;
            $show_header_elements['signup_link'] = false;
            $show_header_elements['login_link'] = false;
          } else {
            $show_header_elements['cart_link'] = false;
            $show_header_elements['dashboard_link'] = false;
            $show_header_elements['signup_link'] = true;
            $show_header_elements['login_link'] = true;
          }
        
          return $show_header_elements;
    }

    function boatrental_custom_header_style_callback() {
      $header_style = Boatrental_Main::get_meta('Top_header_style');
      $class = boatrental_get_extra_class();
      ?><header id="masthead" class="br-header-wrapper <?php echo esc_attr($class); ?>" role="banner"><?php
     
      if($header_style == 'version2'){
        get_template_part('template-parts/header/navbar2');
      }else{
        get_template_part('template-parts/header/navbar');
      }
      ?></header><?php
      do_action('boatrental_breadcrumb');  

      }
 
     
      } //end class
     
     }

return new Boatrental_Header();

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

