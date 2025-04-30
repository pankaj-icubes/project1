<?php

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

global $post;

$description = apply_filters('the_excerpt', $post->post_excerpt);


$_beds = get_metadata('post', get_the_ID(), '_beds', true);
$_bathroom = get_metadata('post', get_the_ID(), '_bathroom', true);

// ============== Attribute ============ //
$rental_max_adults = get_product_location(get_the_ID(), 'pa_guest');
$rental_year = get_product_location(get_the_ID(), 'pa_rental-year');
$rental_feet = get_product_location(get_the_ID(), 'pa_feet');
$rental_cabins = get_product_location(get_the_ID(), 'pa_cabins');
$rental_crew = get_product_location(get_the_ID(), 'pa_crew');


?>

<div class="br-prod-info">

<?php if (empty(Boatrental_Main::get_meta('tab_built_check'))): ?>
		<div class="info-box">
			<i class="<?php echo Boatrental_Main::get_meta('tab_built_icon'); ?>" aria-hidden="true"></i>
			<!-- <div class="icons-title space">Built/Refit</div> -->
			<div class="sub-title space"><?php echo empty(Boatrental_Main::get_meta('tab_built_year')) ? esc_html__('Year', 'boatrental') : Boatrental_Main::get_meta('tab_built_year'); ?></div>
			<div class="quantity-figures space"><?php echo $rental_year; ?></div>
		</div>

	<?php endif; ?>
	<?php if (empty(Boatrental_Main::get_meta('tab_yacht_field__check'))): ?>
		<div class="info-box">
			<i class="<?php echo Boatrental_Main::get_meta('tab_yacht_field_icon'); ?>" aria-hidden="true"></i>
			<!-- <div class="icons-title space">Yacht</div> -->
			<div class="sub-title space"><?php echo empty(Boatrental_Main::get_meta('tab_yacht_field')) ? esc_html__('Feet', 'boatrental') : Boatrental_Main::get_meta('tab_yacht_field'); ?></div>
			<div class="quantity-figures space"><?php echo $rental_feet; ?></div>
		</div>
	<?php endif; ?>
	<?php if (empty(Boatrental_Main::get_meta('tab_number_of_cabins_check'))): ?>
		<div class="info-box">
			<i class="<?php echo Boatrental_Main::get_meta('tab_number_of_cabins_icon'); ?>" aria-hidden="true"></i>
			<!-- <div class="icons-title space">Number of</div> -->
			<div class="sub-title space"><?php echo empty(Boatrental_Main::get_meta('tab_number_of_cabins')) ? esc_html__('cabins', 'boatrental') : Boatrental_Main::get_meta('tab_number_of_cabins'); ?></div>
			<div class="quantity-figures space"><?php echo $rental_cabins; ?></div>
		</div>
	<?php endif; ?>
<?php if (empty(Boatrental_Main::get_meta('tab_number_of_guest_check'))): ?>
		<div class="info-box">
			<i class="<?php echo Boatrental_Main::get_meta('tab_number_of_guest_icon'); ?>" aria-hidden="true"></i>
			<!-- <div class="icons-title space">Number of</div> -->
			<div class="sub-title space"><?php echo empty(Boatrental_Main::get_meta('tab_number_of_guest')) ? esc_html__('Guest', 'boatrental') : Boatrental_Main::get_meta('tab_number_of_guest'); ?></div>
			<div class="quantity-figures space"><?php echo $rental_max_adults; ?></div>
		</div>
	<?php endif; ?>
	<?php if (empty(Boatrental_Main::get_meta('tab_total_crew_check'))): ?>
		<div class="info-box">
			<i class="<?php echo Boatrental_Main::get_meta('tab_total_crew_icon'); ?>" aria-hidden="true"></i>
			<!-- <div class="icons-title space">Total</div> -->
			<div class="sub-title space"><?php echo empty(Boatrental_Main::get_meta('tab_total_crew')) ? esc_html__('Crew', 'boatrental') : Boatrental_Main::get_meta('tab_total_crew'); ?></div>
			<div class="quantity-figures space"><?php echo $rental_crew; ?></div>
		</div>
	
	<?php endif;
		if (empty(Boatrental_Main::get_meta('tab_price_check')) && !isset($_GET['style']) && Boatrental_Main::get_meta('product_layout') != 'layout_2') {
			?>
			<div class="info-box">
				<i class="<?php echo Boatrental_Main::get_meta('tab_price_icon'); ?>" aria-hidden="true"></i>
				<!-- <div class="icons-title space">Rates</div> -->
				<div class="sub-title space"><?php echo empty(Boatrental_Main::get_meta('tab_price')) ? esc_html__('From', 'boatrental') : Boatrental_Main::get_meta('tab_price'); ?></div>
				<div class="quantity-figures prod-price space"><?php do_action('woocommerce_boatrental_price'); ?></div>
			</div>

		<?php }
		if (isset($_GET['style']) && $_GET['style'] != '2') {
			?>
			<div class="info-box">
				<i class="<?php echo Boatrental_Main::get_meta('tab_price_icon'); ?>" aria-hidden="true"></i>
				<!-- <div class="icons-title space">Rates</div> -->
				<div class="sub-title space"><?php echo empty(Boatrental_Main::get_meta('tab_price')) ? esc_html__('From', 'boatrental') : Boatrental_Main::get_meta('tab_price'); ?></div>
				<div class="quantity-figures prod-price space"><?php do_action('woocommerce_boatrental_price'); ?></div>
			</div>

			<?php 
		} 
	?>
	

</div>


   




<div class="br-prod-description">
	<div class="prod-title"><?php the_title(); ?> (<?php echo $rental_year; ?>)</div>
	<div class="prod-detail">
		<span><?php echo $rental_max_adults; ?> guests</span>
		<span aria-hidden="true"> · </span>
		<span><?php echo $_beds; ?> Beds</span>
		<span aria-hidden="true"> · </span>
		<span><?php echo $_bathroom; ?> Bathroom</span>
	</div>

	<div class="prod-description">
		<?php echo $description; ?>
	</div>

</div>


