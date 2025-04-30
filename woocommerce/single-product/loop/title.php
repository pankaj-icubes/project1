<?php

/**
 * Single Product title
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/title.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see        https://docs.woocommerce.com/document/template-structure/
 * @package    WooCommerce\Templates
 * @version    1.6.4
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

global $product;
$id = $product->get_id();


$html = '';
$review_count   = $product->get_review_count();
$rating         = $product->get_average_rating();

?>
<div class="br-product-top-sec">
	<div class="prod-top-left">
		<div class="prod-main-title"><?php the_title('<h1 class="product_title entry-title">', '</h1>'); ?></div>

		<!-- rewiew start-->

		<?php do_action('woocommerce_template_single_rating'); ?>
		<!-- rewiew end-->
	</div>


	<?php

if(!isset($_GET['style'])){

	if (Boatrental_Main::get_meta('product_layout') == 'layout_1' && $product->is_type('rmw_rental')) {
		do_action('boatrental_wc_wishlist');
	}
	if (Boatrental_Main::get_meta('product_layout') == 'layout_2' || !$product->is_type('rmw_rental')) {
	?>

		<div class="br_pro_v2_right">
			<div class="price">
				<?php do_action('woocommerce_boatrental_price'); ?>
			</div>
		</div>
	<?php
	}
	?>
</div>
<?php 
if (Boatrental_Main::get_meta('product_layout') != 'layout_1') {
	do_action('boatrental_wc_short_description');
}

}

else{
	if ($_GET['style'] == '1') {
		do_action('boatrental_wc_wishlist');
	}
	if ($_GET['style'] == '2') {
	?>

		<div class="br_pro_v2_right">
			<div class="price">
				<?php do_action('woocommerce_boatrental_price'); ?>
			</div>
		</div>
	<?php
	}
	?>
</div>
<?php 
if ($_GET['style'] != '1') {
	do_action('boatrental_wc_short_description');
}
}

?>
<?php
