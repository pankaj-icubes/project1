<?php

/**
 * Single Product Thumbnails
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-thumbnails.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.5.1
 */

defined('ABSPATH') || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if (!function_exists('wc_get_gallery_image_html')) {
	return;
}

global $product;

$attachment_ids = $product->get_gallery_image_ids();

$imageCount = 0;

if ( $attachment_ids  ) {
    $displayed_images = 0;
    
    if(!empty($product->get_image_id())){
        $imageCount = 4;
    } else{
        $imageCount = 3;
    }
    foreach ( $attachment_ids as $index => $attachment_id ) {
       
        echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', wc_get_gallery_image_html( $attachment_id ), $attachment_id ); // phpcs:disable WordPress.XSS.EscapeOutput.OutputNotEscaped

        if ($index >= $imageCount) {
            echo '<script>';
            echo 'jQuery(document).ready(function($) {';
            echo '    $(".woocommerce-product-gallery__image").eq(' . ($index + 1) . ').hide();';
            echo '});';
            echo '</script>';
        }

        $displayed_images++;
    }

    while ($displayed_images < 4) {
        $default_image_url = wc_placeholder_img_src( 'woocommerce-placeholder-600x600' );
        echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', '<img src="' . esc_url( $default_image_url ) . '" alt="Default Image" style="max-width: 295px; width: 100%; height: 210px;" class="wp-post-default-image">', 0 );
        $displayed_images++;
    }
}

if($index >= $imageCount && !empty($index) ){
?>
	<button class="see-all open_Images"><img src="<?php echo esc_url(THEME_IMG_PATH . '/product/see_all.svg'); ?>" alt="" class="icon-txt"> <?php echo esc_html('See All'); ?></button>

<?php } 