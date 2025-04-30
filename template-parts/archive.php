<?php

/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined('ABSPATH') || exit;

get_header('shop');

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
?>


<!-- Category Page Title Start  -->

<div class="br-main-wrapper br-product-cat">

	<div class="wrap-header-banner header-txt-left">
		<div class="container">

		<div class="header-main-section">
			<h1 class="header-title"><?php esc_html_e('Yacht Category', 'boatrental'); ?></h1>
			<p class="header-description"><?php esc_html_e('Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet.', 'boatrental'); ?></p>
		</div>

		</div>
	</div>

	<!-- Category Page Title End   -->

	<!-- Sub Category Start  -->

	<?php

	defined('ABSPATH') || exit;

	if (empty(Boatrental_Main::get_meta('product_category_enable'))) {



		$boat_types = get_terms(array(
			'taxonomy' => 'product_cat', // Assuming 'product_cat' is the taxonomy for boat types
			'hide_empty' => false,
		));
		if (!empty($boat_types) && !is_wp_error($boat_types)) { ?>
			<div class="br-subcat-wrap">
				<div class="container">
					<ul class="br-subcat-inner">
						<?php foreach ($boat_types as $boat_type) {

						?>
							<li class="br-subcat-list">
								<a href="<?php echo esc_url(home_url() . '/product-category/' . esc_attr($boat_type->slug)); ?>">
									<div class="subcat-img">
										<img src="<?php echo esc_url(THEME_IMG_PATH . '/category/yacht.png'); ?>" alt="" class="br-product-img">
									</div>
									<div class="subcat-title">
										<?php echo esc_html($boat_type->name); ?>
									</div>
								</a>
							</li>

						<?php
						}
						?>
					</ul>
				</div>
			</div>
	<?php

		}
	}


	do_action('woocommerce_archive_description');
	?>


	<div class="cat-main-wrapper">

		<div class="container">
			<!-- Category Ordering Start  -->



			<!-- Category Ordering End  -->
			<div class="cat-cont-inner">

				<?php
				// do_action('custom_category_sidebar_left_hook');
				do_action('woocommerce_archive_description');
				?>

				<!-- left Start  -->
				<div class="cat-left">

					<?php if (is_active_sidebar('woocommerce-sidebar')) : ?>
						<div class="prod-ordering-left">
						<div class="prod-filter"><?php echo esc_html('Filter'); ?> <i class="fas fa-filter" aria-hidden="true"></i></div>
						</div>
					<?php endif; ?>

					<?php
					do_action('woocommerce_sidebar'); ?>
				</div><!-- #secondary -->
				<!-- Left end  -->


				<!-- Right Start  -->
				<div class="cat-right">
					<?php
					do_action('custom_product_ordering');

					?>
					<div class="cat-prod-inner">

						<?php
						woocommerce_product_loop_start();
						if (wc_get_loop_prop('total')) {

							$total_results = wc_get_loop_prop('total');
							// echo 'Showing 1–' . $total_results . ' of ' . $total_results . ' results';
						?>

							<ul class="br-product-wrapper br-prod-col column<?php echo esc_attr(Boatrental_Main::get_meta('category_col')); ?>">
								<?php

								// do_action('woocommerce_before_shop_loop_item'); design issue with this hook
								
								while (have_posts()) {
									the_post();
									/**
									 * Hook: woocommerce_shop_loop.
									 */
									
									do_action('woocommerce_shop_loop');
									get_template_part('template-parts/post/content-post');
								}

								?>
							</ul>

						<?php
							woocommerce_product_loop_end();
							do_action('woocommerce_after_shop_loop');
						} else {
							do_action('woocommerce_no_products_found');
						}


						?>



					</div>

				</div>
				<!-- Right End  -->

			</div>
			<?php

			do_action('woocommerce_after_main_content');

			/**
			 * Hook: woocommerce_sidebar.
			 *
			 * @hooked woocommerce_get_sidebar - 10
			 */
			?>
		</div>
	</div>


</div>


<?php

get_footer('shop');






