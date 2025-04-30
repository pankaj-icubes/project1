<?php
if (defined('boatrental_URL')     == false)     define('boatrental_URL', get_template_directory());
if (defined('boatrental_URI')     == false)     define('boatrental_URI', get_template_directory_uri());

if (!defined('THEME_IMG_PATH')) {
    define('THEME_IMG_PATH', get_template_directory_uri() . '/assets/images/');
}

if (!defined('THEME_URI')) {
    define('THEME_URI', get_stylesheet_uri());
}

if (!isset($content_width)) { $content_width = 940; }

define('boatrental_no_image', THEME_IMG_PATH.'product/no_post.jpg');

require_once get_template_directory() . '/inc/install-plugin.php';
require_once get_template_directory() . '/inc/class-main.php';
require_once get_template_directory() . '/inc/class-taxonomy.php';
// Main Feature

require_once(get_template_directory() . '/inc/sidebar_widgets/boatrental_date_widget.php');
require_once(get_template_directory() . '/inc/sidebar_widgets/boatrental_yacht_type_widget.php');
require_once(get_template_directory() . '/inc/sidebar_widgets/boatrental_location_widget.php');
require_once(get_template_directory() . '/inc/sidebar_widgets/boatrental_price_slider_widget.php');
require_once(get_template_directory() . '/inc/sidebar_widgets/boatrental_subscribe_widget.php');
require_once(get_template_directory() . '/inc/sidebar_widgets/boatrental_title_widget.php');
require_once(get_template_directory() . '/inc/sidebar_widgets/boatrental_footer_widget.php');
require_once(get_template_directory() . '/inc/sidebar_widgets/boatrental_footer_widget1.php');

require_once(get_template_directory() . '/inc/class-Helper.php');

// woocommerce

require_once get_template_directory() . '/inc/woocommerce_hook.php';
require_once get_template_directory() . '/inc/woocommerce_hook_template.php';

// Elementor
if (defined('ELEMENTOR_VERSION')) {
    require_once get_template_directory() . '/inc/class-elementor.php';
}

add_filter('elementor/column/layout/before_section_end', function ($section, $args) {
    $section->add_render_attribute('_wrapper', 'class', 'column1');
});

// ========= Theme Option ============//

require_once get_template_directory() . '/lib/defines.php';





//================================ start elementor widgets =======================//


function my_custom_search_query($query)
{
    if (class_exists('WooCommerce')) {
        if (!is_admin() && is_shop() && $query->is_main_query()) {
            $query->set('post_type', array('product'));

            // Check if date and location parameters are present in the query
            $pro_locations = $_GET['pro_location'] ?? array();
            $pro_yachttype = $_GET['yachttype'] ?? array();
            $tax_queries = array();

            if (!empty($pro_locations[0])) {
                foreach ($pro_locations as $pro_location) {
                    if (!empty($pro_location)) {
                        $tax_queries[] = array(
                            'taxonomy' => 'location',
                            'field' => 'term_id',
                            'terms' => $pro_location,
                            'operator' => 'IN'
                        );
                    }
                }
            }
            if (!empty($pro_yachttype)) {
                foreach ($pro_yachttype as $product_cat) {
                    if (!empty($product_cat)) {
                        $tax_queries[] = array(
                            'taxonomy' => 'product_cat',
                            'field' => 'term_id',
                            'terms' => $product_cat,
                            'operator' => 'IN'
                        );
                    }
                }
            }



            $attributeValues = array();

            foreach ($_GET as $key => $value) {
                if (strpos($key, 'attr_') === 0) {
                    $attributeName = substr($key, 5);
                    $attributeValues[$attributeName] = $value;
                }
            }
            foreach ($attributeValues as $taxonomy => $terms) {
                $tax_queries[] = array(
                    'taxonomy' => 'pa_' . $taxonomy,
                    'field' => 'term_id',
                    'terms' => $terms,
                    'operator' => 'IN'
                );
            }

            if (!empty($pro_yachttype[0]) || !empty($pro_locations[0]) || !empty($attributeValues)) {
                $query->set('tax_query', array(
                    'relation' => 'AND',
                    $tax_queries
                ));
            }

            if (!empty($_GET['startdate']) && !empty($_GET['enddate'])) {
                $query->set('date_query', array(
                    array(
                        'after'     => $_GET['startdate'],
                        'before'    => $_GET['enddate'],
                        'inclusive' => true,
                    )
                ));
            }

            $meta_queries = array();

            if (!empty($_GET['guest'])) {
                $meta_queries[] = array(
                    'key' => '_guest',
                    'value' => intval($_GET['guest']),
                    'compare' => '=',
                );
            }

            if (!empty($_GET['rental_type'])) {
                
                $meta_queries[] = array(
                    'key' => 'rmw_rent_charge_type',
                    'value' => sanitize_text_field($_GET['rental_type']),
                    'compare' => '=',
                );
            }

            if (!empty($_GET['cabins'])) {
                $meta_queries[] = array(
                    'key' => '_rental_cabins',
                    'value' => intval($_GET['cabins']),
                    'compare' => '=',
                );
            }

            if (!empty($_GET['br_min_price'])) {
                $meta_queries[] = array(
                    'key' => '_price',
                    'value' => $_GET['br_min_price'],
                    'type' => 'numeric',
                    'compare' => '>=',
                );
            }

            if (!empty($_GET['br_max_price'])) {
                $meta_queries[] = array(
                    'key' => '_price',
                    'value' => $_GET['br_max_price'],
                    'type' => 'numeric',
                    'compare' => '<=',
                );
            }

            if (!empty($meta_queries)) {
                $query->set('meta_query', array(
                    'relation' => 'AND',
                    $meta_queries,
                ));
            }
        }

    }


    // echo "<pre>"; print_r($query); die;
    return $query;
}

add_action('pre_get_posts', 'my_custom_search_query');


function meta($meta_key)
{
    $meta_value = get_post_meta(get_the_ID(), $meta_key, true);
    return !empty($meta_value) ? $meta_value : '';
}

function get_product_location($product_id,$attr = NULL)
{
    $locations = get_the_terms($product_id, empty($attr)?'location':$attr);
    
    if ($locations && !is_wp_error($locations)) {
        // Create an array to store the names of the locations
        $location_names = array();
    
        // Loop through each location and extract its name
        foreach ($locations as $location) {
            $location_names[] = $location->name;
        }
    
        // Now you can use $location_names to get an array of all the location names associated with the product
        return implode(', ', $location_names);
    } else {
        // If no locations are found or an error occurs, return 0
        return 0;
    }
}


function boatrental_typography_webfonts(){

	$webfont	= Boatrental_Main::get_meta('google_webfonts');
	$tag_font_family = Boatrental_Main::get_meta('tag_font_family');
		
	if ( $webfont || $tag_font_family ):
		$font_url = '';
		$font_weight = Boatrental_Main::get_meta('webfonts_weight');
        
        if( $tag_font_family ){
			$webfont .= ( $webfont ) ? '|' . $tag_font_family : $tag_font_family;
		}

		if ( 'off' !== _x( 'on', 'Google font: on or off', 'boatrental' ) ) {
			$font_url = add_query_arg( 'family', urlencode( $webfont ), "//fonts.googleapis.com/css" );
		}

		return $font_url;
	endif;
}

function boatrental_googlefonts_script() {
    wp_enqueue_style( 'boatrental-googlefonts', boatrental_typography_webfonts(), array(), '1.0.0' );
}
add_action( 'wp_enqueue_scripts', 'boatrental_googlefonts_script' );



function process_subscribe_form() {
    if (isset($_POST['email'])) {   
        $email = sanitize_email($_POST['email']);
        if (is_email($email)) {
            // Send the email
            $to = get_option('admin_email');
            $subject = esc_html__('New Subscription', 'boatrental');
            $message = esc_html__('A new user has subscribed with email: ', 'boatrental') . $email;

            $sent = wp_mail($to, $subject, $message);
            
            if ($sent) {
                esc_html_e('Thank you for subscribing!', 'boatrental');
            } else {
                esc_html_e('There was an issue sending the email. Please try again later.', 'boatrental');
            }
        } else {
            esc_html_e('Please provide a valid email address.', 'boatrental');
        }
    }
    wp_die();
}

add_action('wp_ajax_process_subscribe_form', 'process_subscribe_form');
add_action('wp_ajax_nopriv_process_subscribe_form', 'process_subscribe_form');



if (!function_exists('boatrentalUpdateThemeOption')) {
    function boatrentalUpdateThemeOption() {
        // Define the path to the file
        $file_path = esc_url('https://boatrental.cvla.nauticaltrips.com/?rental_theme_options=9877');
        // Read the file and get its content
        $file_content = file_get_contents($file_path);
        if ($file_content !== false) {
            // If content is successfully read from the file
            $unserialized_data = unserialize($file_content);
            if ($unserialized_data !== false) {
                // If unserialization is successful
                // Update the option 'BoatRental_theme' with the unserialized data
                update_option('BoatRental_theme', $unserialized_data);
            } else {
                // If there is an issue with unserialization, handle the error
                return 'Error: Unable to unserialize data from file.';
            }
        } else {
            // If there is an issue reading the file, handle the error
            return 'Error: Unable to read file.';
        }
    }
}


function custom_excerpt($excerpt, $length) {
    $trimmed_excerpt = wp_trim_words($excerpt, $length, '...');
    return $trimmed_excerpt;
}

function add_custom_js_to_admin_footer() {
    if (wp_script_is('jquery', 'done')) {
        echo '<script>
            jQuery(document).ready(function($) {
                $("#footer_phone_number").on("input", function() {
                    var sanitizedValue = $(this).val().replace(/[^0-9+ ]/g, "");
                   $(this).val(sanitizedValue);
                });
            });
        </script>';
    }
}

add_action('admin_footer', 'add_custom_js_to_admin_footer');

// =========== Template layout functions ============//
// =========== Call single product layout ============//

if (!function_exists('boatrental_layout1')) {

    function boatrental_layout1()
    {
      ?>
      <div class="br_v1_wrap">
            <?php
            do_action('boatrental_wc_single_title');
            do_action('boatrental_wc_before_single_product');
            ?>

            <div class="br-prod-detail-wrapper">
              <div class="summary entry-summary">
                <div class="br-prod-detail-left">
                  <?php
                  /**
                   * Hook: woocommerce_single_product_summary.
                   *
                   * @hooked woocommerce_template_single_title - 5
                   * @hooked woocommerce_template_single_rating - 10
                   * @hooked woocommerce_template_single_price - 10
                   * @hooked woocommerce_template_single_excerpt - 20
                   * @hooked woocommerce_template_single_add_to_cart - 30
                   * @hooked woocommerce_template_single_meta - 40
                   * @hooked woocommerce_template_single_sharing - 50
                   * @hooked WC_Structured_Data::generate_product_data() - 60
                   */
                  do_action('boatrental_wc_single_product_summary_left');
                  ?>
                </div>
              </div>

              <div class="br-prod-detail-right">
                <?php 
                do_action('boatrental_wc_single_product_summary_right'); 
                do_action( 'woocommerce_product_meta_start' );
                if (wp_is_mobile()) {
                  do_action('woocommerce_product_meta_mobile');
                }else{
                  do_action( 'woocommerce_product_meta_end' );
                }
                ?>
              </div>
            </div>
      </div>
      <?php
      
    }
  }

add_action('boatrental_layout1','boatrental_layout1');


if (!function_exists('boatrental_layout2')) {
  
  function boatrental_layout2()
  {
    ?>
    <div class="br_v2_wrap">
      <div class="br_v2_left">
        <?php
        do_action('boatrental_wc_before_single_product');

        do_action('boatrental_wc_single_product_summary_left');
        ?>
      </div>
      <div class="br_v2_right">
        <?php
        do_action('boatrental_wc_single_title');
        do_action('boatrental_wc_single_product_summary_right');
        do_action( 'woocommerce_product_meta_start' );
        if (wp_is_mobile()) {
          do_action('woocommerce_product_meta_mobile');
        }else{
          do_action( 'woocommerce_product_meta_end' );
        }
        ?>

      </div>
    </div>
    <?php
    
  }

}

add_action('boatrental_layout2','boatrental_layout2');


if (!function_exists('boatrental_layout3')) {
  
function boatrental_layout3()
{
  ?>
  <div class="br_v3_wrap">
    <div class="br_v3_cont">
      <div class="br_v3_left">
        <?php
          do_action('boatrental_wc_single_title');
          do_action('boatrental_wc_single_product_summary_left');
        ?>
      </div>
      <div class="br_v3_right">
        <?php 
          do_action('boatrental_wc_single_product_summary_right'); 
          do_action( 'woocommerce_product_meta_start' );
        if (wp_is_mobile()) {
          do_action('woocommerce_product_meta_mobile');
        }else{
          do_action( 'woocommerce_product_meta_end' );
        }
        ?>
      
      </div>
    </div>
  </div>
  <?php
  
}

}

add_action('boatrental_layout3','boatrental_layout3');


// =========== End Call single product layout ============//


function is_tablet() {
    // Check if the request is coming from a known tablet user agent
    $tablet_user_agents = array(
        'iPad',            // iPad
        'Android',         // Android tablets
        'Kindle',          // Kindle tablets
        'PlayBook',        // BlackBerry PlayBook
        'TouchPad',        // HP TouchPad
        'Silk'             // Amazon Silk
    );

    $user_agent = $_SERVER['HTTP_USER_AGENT'];

    foreach ($tablet_user_agents as $tablet_user_agent) {
        if (stripos($user_agent, $tablet_user_agent) !== false) {
            return true;
        }
    }

    return false;
}





// =========== Template layout functions ============//


function get_term_id_by_slug($slug) {
    global $wpdb;
    // MySQL query to retrieve term ID based on slug
    $query = $wpdb->prepare("SELECT term_id FROM {$wpdb->terms} WHERE slug LIKE %s", '%' . $wpdb->esc_like($slug) . '%');
    $term_id = $wpdb->get_results($query, OBJECT);

    return $term_id;
}
