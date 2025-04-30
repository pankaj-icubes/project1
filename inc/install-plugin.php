<?php

require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';

// function change_woocommerce_shop_page_name() {
// 	$new_shop_page_name = 'Yacht'; 
//     $shop_page = get_page_by_path('shop'); 

//     if ($shop_page) {
//         $shop_page->post_title = $new_shop_page_name;
//         wp_update_post($shop_page);
//     }

// }

// add_action('init', 'change_woocommerce_shop_page_name');


// ================== Ajax Action =================//

add_action('wp_ajax_verify_purchase_code', 'verify_purchase_code_check');

function verify_purchase_code_check()
{
	// Verify nonce
    if ( ! check_ajax_referer( 'boatrental_theme_install_nonce', 'nonce', false ) ) {
		echo json_encode(array('check' => 0, 'message' => 'Nonce verification failed'));
		die();
    }
	
	$input = isset($_POST['purchase']) ? $_POST['purchase'] : '';

	$check = 0;
	$input = trim($input);
	if (!preg_match("/^([a-f0-9]{8})-(([a-f0-9]{4})-){3}([a-f0-9]{12})$/i", $input)) {
		echo json_encode(array('check' => $check, 'message' => 'Invalid purchase code'));
		die();
	}

	if (boatrental_verify_purchase_code($input) == 200) {
		$check = 1;
		update_option('boatrental_purchase_code', $input);
	}
	$message = ($check) ? '' : esc_html(boatrental_verify_purchase_code($input), 'BoatRental');
	echo json_encode(array('check' => $check, 'message' => $message));
	die();
}



add_action('tgmpa_register', 'BoatRental_register_required_plugins');


function boatrental_verify_purchase_code($code)
{

	$url = esc_url('https://boatrental.cvla.nauticaltrips.com/wp-json/boatrental/token/verify-purchase/' . $code);

	$response = wp_remote_get($url);

	if (is_wp_error($response)) {
		// Handle the case where there's an error with the request
		throw new Exception("Failed to connect: " . $response->get_error_message());
	} else {

		// Response body
		$responseBody = wp_remote_retrieve_body($response);
		// Response code
		$responseCode = json_decode($responseBody, false)->response->code;

		// Handle response based on response code
		switch ($responseCode) {
			case 200:
				// Handle the case when the response code is 200 (OK)
				return $responseCode;
				// Process the response as needed
				break;
			case 404:
				// Handle the case when the response code is 404 (Not Found)
				return "Invalid purchase code";
			case 403:
				// Handle the case when the response code is 403 (Forbidden)
				return "The request is forbidden";
			case 401:
				// Handle the case when the response code is 401 (Unauthorized)
				return "Unauthorized request";
			default:
				// Handle other response codes
				return "Got status {$responseCode}, try again shortly";
		}
	}
}

function BoatRental_register_required_plugins()
{
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		array(
			'name' => esc_html__('Contact Form 7', 'BoatRental'),
			'slug' => 'contact-form-7',
			'required' => false,
		),
		array(
			'name' => esc_html__('Woocommerce', 'BoatRental'),
			'slug' => 'woocommerce',
			'required' => false,
		),
		array(
			'name' => esc_html__('Elementor', 'BoatRental'),
			'slug' => 'elementor',
			'required' => false,
		),

		array(
			'name' => esc_html__('Revslider', 'BoatRental'),
			'slug' => 'revslider',
			'source' => esc_url('https://boatrental.cvla.nauticaltrips.com/?rental_revslider=453'),
			'required' => true,
			'version' => '6.6.15'
		),
		array(
			'name' => esc_html__('YITH Woocommerce Wishlist', 'BoatRental'),
			'slug' => 'yith-woocommerce-wishlist',
			'required' => false
		),
		array(
			'name' => esc_html__('One Click Demo Import', 'BoatRental'),
			'slug' => 'one-click-demo-import',
			'source' => esc_url('https://boatrental.cvla.nauticaltrips.com/?rental_demo_import=533'),
			'required' => true,
			'version' => '3.1.2'
		),
		array(
			'name' => esc_html__('Rentify', 'BoatRental'),
			'slug' => 'rentme-plugin-master',
			'source' => esc_url('https://boatrental.cvla.nauticaltrips.com/?rental_rentify=421'),
			'required' => true,
			'version' => '1.0'
		),

	);

	$config = array(
		'id' => 'BoatRental',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'domain' => 'BoatRental',
		'parent_slug' => 'admin.php',            // Parent menu slug.
		'capability' => 'manage_options',
		'default_path' => '',                      // Default absolute path to bundled plugins.


		'menu' => 'BoatRental-install-plugin', // Menu slug.
		'has_notices' => true,                    // Show admin notices or not.
		'dismissable' => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg' => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => true,                   // Automatically activate plugins after installation or not.
		'message' => '',                      // Message to output right before the plugins table.
		'strings' => array(
			'page_title' => __('', 'BoatRental'),
			'menu_title' => __('Install Plugins', 'BoatRental'),
			'installing' => __('Installing Plugin: %s', 'BoatRental'),
			'updating' => __('Updating Plugin: %s', 'BoatRental'),
			'oops' => __('Something went wrong with the plugin API.', 'BoatRental'),
			'notice_can_install_required' => _n_noop(
				'This theme requires the following plugin: %1$s.',
				'This theme requires the following plugins: %1$s.',
				'BoatRental'
			),
			'notice_can_install_recommended' => _n_noop(
				'This theme recommends the following plugin: %1$s.',
				'This theme recommends the following plugins: %1$s.',
				'BoatRental'
			),
			'notice_ask_to_update' => _n_noop(
				'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
				'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
				'BoatRental'
			),
			'notice_ask_to_update_maybe' => _n_noop(
				'There is an update available for: %1$s.',
				'There are updates available for the following plugins: %1$s.',
				'BoatRental'
			),
			'notice_can_activate_required' => _n_noop(
				'The following required plugin is currently inactive: %1$s.',
				'The following required plugins are currently inactive: %1$s.',
				'BoatRental'
			),
			'notice_can_activate_recommended' => _n_noop(
				'The following recommended plugin is currently inactive: %1$s.',
				'The following recommended plugins are currently inactive: %1$s.',
				'BoatRental'
			),
			'install_link' => _n_noop(
				'Begin installing plugin',
				'Begin installing plugins',
				'BoatRental'
			),
			'update_link' => _n_noop(
				'Begin updating plugin',
				'Begin updating plugins',
				'BoatRental'
			),
			'activate_link' => _n_noop(
				'Begin activating plugin',
				'Begin activating plugins',
				'BoatRental'
			),
			'return' => __('Return to Required Plugins Installer', 'BoatRental'),
			'plugin_activated' => __('Plugin activated successfully.', 'BoatRental'),
			'nag_type' => '', // Determines admin notice type - can only be one of the typical WP notice classes, such as 'updated', 'update-nag', 'notice-warning', 'notice-info' or 'error'. Some of which may not work as expected in older WP versions.
		),

	);

	tgmpa($plugins, $config);
}



// ================== install theme ========================


function install_plugins_page()
{


	$step = isset($_GET['step']) ? $_GET['step'] : 0;
	// echo esc_attr( ( $step == 2 ) ? 'active': '' ); die;	
	// echo get_option( 'boatrental_purchase_code' ); die;	
	$purchase = get_option('boatrental_purchase_code');
	?>
			<div class="br_activation-form">
				<div class="activation-form-inner">
					<!-- Multi step form -->
					<section class="multi_step_form">
						<div id="msform">
							<!-- Tittle -->
							<div class="tittle">
								<h2><?php esc_html_e('Installation Process', 'boatrental') ?></h2>
							</div>
							<!-- progressbar -->
							<ul id="progressbar" class="grid-3">


								<li class="<?php echo (empty($purchase) ? 'active' : ''); ?>class_0" data-step="1"><?php esc_html_e('Verify Purchase Code', 'boatrental') ?></li>


								<li class="<?php echo esc_attr(($step == 1 || $step > 1 || !empty($purchase)) ? 'active' : '') ?> class_1" data-step="2"><?php esc_html_e('Install Plugins', 'boatrental') ?></li>


								<li class="<?php echo esc_attr(($step == 2 || $step > 2) ? 'active' : '') ?> class_2" data-step="3"><?php esc_html_e('Complete Import', 'boatrental') ?></li>
							</ul>
							<!-- fieldsets -->

							<fieldset class="<?php echo (empty($purchase) ? 'active' : ''); ?> class_55">
								<?php if (empty(get_option('boatrental_purchase_code')) || empty($step) || $step == 1) { ?>
											<div class="br_activation">
												<label for="boatrental_purchase_code" class="clearfix">
													<input type="text" id="boatrental_purchase_code" placeholder="<?php echo esc_attr__('Enter Your Purchase Code', 'boatrental'); ?>" name="boatrental_purchase_code" value="<?php echo esc_attr(get_option('boatrental_purchase_code')); ?>" />
													
												</label>
												<span id="error-msg"></span>
											</div>
											<button type="button" class="next purchase action-button"><?php esc_html_e('Continue', 'boatrental') ?></button>
								<?php } ?>

							</fieldset>



							<fieldset class="class_00 <?php echo esc_attr((!empty(get_option('boatrental_purchase_code')) && (empty($step) || $step == 2)) ? 'active' : ''); ?>">
								<div class="br-activation">
									<?php
									// Store new instance of plugin table in object.
									$plugin_table = new TGMPA_List_Table;
									// Return early if processing a plugin installation action.
									if ((('tgmpa-bulk-install' === $plugin_table->current_action() || 'tgmpa-bulk-update' === $plugin_table->current_action()) && $plugin_table->process_bulk_actions())) {
										return;
									}

									// Force refresh of available plugin information so we'll know about manual updates/deletes.
									wp_clean_plugins_cache(false);

									?>
									<div class="tgmpa wrap">
										<?php $plugin_table->prepare_items(); ?>

										<?php $plugin_table->views(); ?>

										<form id="tgmpa-plugins" action="" method="post">
											<input type="hidden" name="tgmpa-page" value="<?php echo esc_attr('menu'); ?>" />
											<input type="hidden" name="plugin_status" value="<?php echo esc_attr($plugin_table->view_context); ?>" />
											<?php $plugin_table->display(); ?>
										</form>
									</div>

								</div>
								<button type="button" class="action-button layout previous"><?php esc_html_e('Back', 'boatrental') ?></button>
								<button type="button" class="next import checked action-button" data-active="<?php echo get_option('install_layout'); ?>"><?php esc_html_e('Continue', 'boatrental') ?></button>
							</fieldset>
							<fieldset class="class_11 <?php echo esc_attr(($step == 3) ? 'active' : '') ?>">
								<div class="br_activation">
									<?php
									if (class_exists('OCDI\OneClickDemoImport')) {
										require_once PT_OCDI_PATH . 'vendor/autoload.php';
										$pt_one_click_demo_import = OCDI\OneClickDemoImport::get_instance();
										$pt_one_click_demo_import->display_plugin_page();
									} else {
										$class = 'notice notice-error';
										$message = esc_html__('Please Install or active plugin One Click Demo Import to import data!', 'boatrental');
										printf('<div class="%1$s"><p>%2$s</p></div>', esc_attr($class), esc_html($message));
									}
									?>
								</div>
								<button type="button" class="action-button previous_button import previous"><?php esc_html_e('Back', 'boatrental') ?></button>
								<button type="button" class="next finish hidden action-button"><?php esc_html_e('Finish', 'boatrental') ?></button>
							</fieldset>
						</div>
					</section>
				</div>
			</div>
		<?php
}

function admin_menu()
{
	// Make sure privileges are correct to see the page.
	if (!current_user_can('install_plugins')) {
		return;
	}

	$args = apply_filters(
		'tgmpa_admin_menu_args',
		array(
			'parent_slug' => 'themes.php',                     // Parent Menu slug.
			'page_title' => 'Install Themes',           // Page title.
			'menu_title' => 'Install Themes',           // Menu title.
			'capability' => 'edit_theme_options',                      // Capability.
			'menu_slug' => 'install-theme',                            // Menu slug.
			'function' => 'install_plugins_page', // Callback.
		)
	);

	add_theme_page(
		$args['page_title'],
		$args['menu_title'],
		$args['capability'],
		$args['menu_slug'],
		$args['function']
	);
}

add_action('admin_menu', 'admin_menu');


function boatrental_enqueue_script()
{
	$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
	$full_url = $protocol . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

	if (strpos($full_url, 'themes.php') !== false) {

		wp_enqueue_style('boatrental_theme_install', get_template_directory_uri() . '/lib/admin/css/install_theme.css');
		wp_enqueue_script('boatrental_theme_install', get_template_directory_uri() . '/lib/admin/js/install_theme.js', array('jquery'), '1.1.2', true);
		$current_url = esc_url(admin_url('themes.php?page=install-theme'));
		$nonce = wp_create_nonce('boatrental_theme_install_nonce');
		$args = array(
			'ajax_url' => esc_url(admin_url('admin-ajax.php', 'relative')),
			'admin_url' => esc_url(admin_url('/', 'relative')),
			'current_url' => $current_url,
			'nonce' => $nonce // Pass nonce to JavaScript
		);

		wp_localize_script('boatrental_theme_install', 'boatrental_theme_install', $args);
	}

	if (strpos($full_url, 'themes.php') !== false) {
		wp_enqueue_style('boatrental-font-awesome', boatrental_URI . '/assets/css/cdn/font-awesome_5.15.3_css_all.min.css');
	}
}
add_action('admin_enqueue_scripts', 'boatrental_enqueue_script');



function ocdi_change_time_of_single_ajax_call()
{
	return 120;
}
add_filter('ocdi/time_for_one_ajax_call', 'ocdi_change_time_of_single_ajax_call');

if (!function_exists('boatrental_after_import_setup')):

	add_action('pt-ocdi/after_import', 'boatrental_after_import_setup');

	function boatrental_after_import_setup()
	{
		global $wpdb;
		$primary_menu = get_term_by('name', 'Header Menu', 'nav_menu');

		set_theme_mod(
			'nav_menu_locations',
			array(
				'primary_menu' => $primary_menu->term_id,
			)
		);


		// Assign front page and posts page (blog page).
		$front_page_id = get_page_by_title('Home v1');
		$blog_page_id = get_page_by_title('Blog');


		update_option('show_on_front', 'page');
		update_option('page_on_front', $front_page_id->ID);
		update_option('page_for_posts', $blog_page_id->ID);

		boatrentalUpdateThemeOption();

		rentifyUpdateOption();

		// ========== update shop page data ============//
		
		$shop_id = $wpdb->get_var( "SELECT ID FROM $wpdb->posts WHERE post_title = 'shop' and post_status = 'publish' " );
		$postid = $wpdb->get_var( "SELECT ID FROM $wpdb->posts WHERE post_title = 'yacht' and post_status = 'publish' " );
		if(isset($postid) && isset($shop_id)){
			update_post_meta($postid,'_menu_item_object_id',$shop_id);
		}
		$wpdb->query("UPDATE {$wpdb->posts} SET post_status = 'publish' WHERE post_title IN ('Privacy Policy', 'Refund and Returns Policy') AND post_status = 'draft'");

		$footer_column_term_id = get_term_id_by_slug('footer-column');
		$data = array(
			1 => array(
				'menu' => $footer_column_term_id[0]->term_id,
				'title' => 'Discover'
			),
			2 => array(
				'menu' => $footer_column_term_id[1]->term_id,
				'title' => 'Company'
			),
			'_multiwidget' => 1
		);

		update_option('widget_custom_menu_widget', $data);

		// Remove sidebar unwanted code

		$existing_sidebars_widgets = get_option('sidebars_widgets');

		if (is_array($existing_sidebars_widgets) && isset($existing_sidebars_widgets['woocommerce-sidebar'])) {
			foreach ($existing_sidebars_widgets['woocommerce-sidebar'] as $key => $widget) {
				if ($widget === 'block-5' || $widget === 'block-6') {
					unset($existing_sidebars_widgets['woocommerce-sidebar'][$key]);
				}
			}
			// Update 'sidebars_widgets' key with the modified array
			update_option('sidebars_widgets', $existing_sidebars_widgets);
		}

		if (class_exists('revslider')) {
			$RevSlider = array(
				get_template_directory() . "/demo-import/home-version-1-1.zip",
				get_template_directory() . "/demo-import/slider-11.zip",
			);

			$slider = new RevSlider();

			foreach ($RevSlider as $filepath) {
				$slider->importSliderFromPost(true, true, $filepath);
			}
		}

	}

endif;

function rentifyUpdateOption()
{
	add_option('rmw_basic_enable_deposit', 'yes', '', 'no');
	add_option('rmw_basic_enable_booking_tab', 'yes', '', 'no');
	add_option('rmw_basic_enable_request_tab', 'yes', '', 'no');

	$rmw_request_email_recipient = [get_option('admin_email')];
	$rmw_request_email_recipient = implode(",", $rmw_request_email_recipient);
	add_option('rmw_request_form_email_recipient', $rmw_request_email_recipient, '', 'no');

	$rmw_request_email_subject = "Request For Booking";
	add_option('rmw_request_form_email_subject', $rmw_request_email_subject, '', 'no');

	$request_mail_template = "Hi {full_name},<br /><br />Thank you for your interest in our {rmw_product_name}. We have received your inquiry and will get back to you shortly to assist with your rental request.<br /><br />Here are the details you provided:<br /><br /><b>Name :</b>{full_name}<br /><b>Email :</b>{user_email}<br /><b>Phone Number :</b>{user_phone}<br /><b>Check-in :</b>{rmw_check_in}<br /><b>Checkout :</b>{rmw_check_out}<br /><br /><br />Our team will review your request and reach out to you with more information, answers to your questions, and assistance in planning your upcoming trip.We appreciate your interest in our services and look forward to helping you with your rental needs.";
	$request_mail_template = htmlentities($request_mail_template);
	add_option('rmw_request_form_email_body', $request_mail_template, '', 'no');


	// Mark the plugin as activated to avoid re-insertion on future activations
	update_option('rentify_plugin_activated', '1', 'no');
}

function boatrental__import_files()
{
	return [
		[
			'import_file_name' => 'Demo Import',
			'categories' => ['Category 1', 'Category 2'],
			'import_file_url' => 'https://boatrental.cvla.nauticaltrips.com/?boatrental_database=234',
			'import_widget_file_url' => 'https://boatrental.cvla.nauticaltrips.com/?boatrental_widgets=234',
			'import_customizer_file_url' => 'https://boatrental.cvla.nauticaltrips.com/?boat_rental_export=234',

			'import_preview_image_url' => esc_url('data:image/jpeg;base64,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'),
			'import_notice' => __('This import maybe finish on 5-10 minutes', 'boatrental'),
			'preview_url' => 'https://icubes.org//',
		],

	];
}
add_filter('ocdi/import_files', 'boatrental__import_files');
