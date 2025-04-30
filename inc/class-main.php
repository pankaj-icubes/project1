<?php

/**
 * 
 * Class Boatrental_Main
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
Enqueue, widgets, footer, body classes, theme support
=============================================================
*/

if (!defined('ABSPATH'))
	exit;

if (!class_exists('Boatrental_Main')) {

	class Boatrental_Main
	{

		public function __construct()
		{

			add_action('after_setup_theme', array($this, 'boatrental_theme_support'));
			add_filter('body_class', array($this, 'boatrental_body_classes'));
			add_action('wp_enqueue_scripts', array($this, 'boatrental_enqueue_scripts'), 10);
			add_action('init', array($this, 'boatrental_add_var'));
			add_action('wp_enqueue_scripts', array($this, 'boatrental_vars_data'));
			add_filter('boatrental_blog_template', array($this, 'boatrental_blog_template'));
			add_filter('boatrental_show_singular_title', '__return_false');
			add_action('wp_enqueue_scripts', array($this, 'boatrental_add_custom_css'));
			add_filter('sidebars_widgets', array($this, 'register_custom_sidebars'));
			add_action('footer_layout', array($this, 'boatrental_footer_layout'));
		}



		function boatrental_theme_support()
		{

			add_theme_support("wp-block-styles");

			add_theme_support('title-tag');


			// Adds RSS feed links to <head> for posts and comments.
			add_theme_support('automatic-feed-links');

			// to output valid HTML5.
			add_theme_support('html5', array('search-form', 'comment-form', 'comment-list'));

			add_theme_support('responsive-embeds');

			/* See http://codex.wordpress.org/Post_Formats */
			add_theme_support('post-formats', array('image', 'gallery', 'audio', 'video'));

			add_theme_support('post-thumbnails');

			add_theme_support('woocommerce');

			add_theme_support('elementor');

			add_filter('gutenberg_use_widgets_block_editor', '__return_false');

			add_filter('use_widgets_block_editor', '__return_false');
		}


		function boatrental_body_classes($classes)
		{

			global $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;

			$remove_classes = array(
				'default',
			);

			if ($is_chrome) {
				$classes[] = 'chrome';
			}
			if ($is_iphone) {
				$classes[] = 'iphone';
			}

			// Adds a class to blogs with more than 1 published author.
			if (is_multi_author()) {
				$classes[] = 'group-blog';
			}

			// Add class when using homepage template + featured image.
			if (class_exists('WooCommerce')) {
				if (has_post_thumbnail()) {
					$classes[] = 'has-post-thumbnail';
				}
				if (is_account_page()) {
					$classes[] = 'br_woocommerce_account';
				}
				if (is_cart()) {
					$classes[] = 'cart-wrap';
					$classes[] = 'br_woocommerce_cart';
				}

				if (is_checkout()) {
					$classes[] = 'br_woocommerce_checkout';
					$classes[] = 'checkout-wrap';
				}

				if (is_shop() || is_product()) {
					$remove_classes[] = 'woocommerce';
					$remove_classes[] = 'woocommerce-page';
				}

				if (is_tax('product_cat')) {
					$remove_classes[] = 'woocommerce';
					$remove_classes[] = 'woocommerce-page';
				}
			}
			$classes = array_diff($classes, $remove_classes);

			return $classes;
		}





		function boatrental_enqueue_scripts()
		{
			wp_enqueue_style('boatrental-font-awesome', boatrental_URI . '/assets/css/cdn/font-awesome_5.15.3_css_all.min.css');

			wp_register_style('boatrental-stylesheet', boatrental_URI . '/style.css', array(), boatrental_URI . '/style.css/?var=1.6');

			wp_register_style('boatrental-category-css', boatrental_URI . '/assets/css/woocommerce/category.css', array(), boatrental_URI . '/assets/css/category.css/?v=2.64');

			wp_enqueue_script('jquery-ui', boatrental_URI . '/assets/js/cdn/jquery-ui.min.js', array('jquery'), '1.12.0', true);

			wp_enqueue_script('jquery-ui-touch-punch', boatrental_URI . '/assets/js/cdn/touch-punch.min.js', array('jquery', 'jquery-ui-core', 'jquery-ui-widget', 'jquery-ui-mouse'), '0.2.3', true);

			wp_register_script('boatrental-main-js', boatrental_URI . '/assets/js/main.js', array(),  array('jquery'), '1.0', true);

			wp_register_script('boatrental-category-js', boatrental_URI . '/assets/js/category.js', array('jquery'), '1.0', true);

			wp_enqueue_style('boatrental-stylesheet');

			wp_enqueue_style('boatrental-tour-destination', boatrental_URI . '/assets/css/tour-destination.css?v=1.13');

			wp_enqueue_style('boatrental-header', boatrental_URI . '/assets/css/header.css?v=5.32');

			wp_enqueue_style('boatrental-footer', boatrental_URI . '/assets/css/footer.css?v=3.65');

			wp_enqueue_style('boatrental-blog', boatrental_URI . '/assets/css/blog.css?var=1.71');

			wp_enqueue_style('boatrental-common', boatrental_URI . '/assets/css/common.css?v=2.05');

			wp_enqueue_style('boatrental-typography', boatrental_URI . '/assets/css/typography.css?v=1.36');

			wp_enqueue_style('boatrental-layout', boatrental_URI . '/assets/css/layout.css?v=1.24');

			wp_enqueue_style('boatrental-form', boatrental_URI . '/assets/css/form.css?v=1.18');

			wp_enqueue_style('boatrental-404', boatrental_URI . '/assets/css/404.css?v=1.14');

			wp_enqueue_style('boatrental-contact', boatrental_URI . '/assets/css/contact.css?v=1.34');

			wp_enqueue_style('boatrental-account', boatrental_URI . '/assets/css/account.css?var=1.26');

			wp_enqueue_style('boatrental-searchpage', boatrental_URI . '/assets/css/search-page.css?var=1.23');

			//wp_enqueue_style('boatrental-skin-light', boatrental_URI . '/assets/css/skin-light.css?var=1.59');

			wp_enqueue_style('boatrental-skin-dark', boatrental_URI . '/assets/css/skin-dark.css?var=1.99');

// Sass integration
			wp_enqueue_style('scss-style', boatrental_URI . '/assets/scss/style.css');

			// Woocommerce Css

			if ( class_exists( 'WooCommerce' ) ) {
				wp_enqueue_style('boatrental-checkout', boatrental_URI . '/assets/css/woocommerce/checkout.css?var=1.12');
				wp_enqueue_style('boatrental-single_product', boatrental_URI . '/assets/css/woocommerce/single-product.css?v=3.18');
				wp_enqueue_style('boatrental-cart', boatrental_URI . '/assets/css/woocommerce/cart.css?var=1.24');
			}

			global $post;
			if (is_a($post, 'WP_Post') && strpos($post->post_name, 'wishlist') !== false) {
				wp_enqueue_style('boatrental-wishlist', boatrental_URI . '/assets/css/woocommerce/wishlist.css?var=1.11');
			}

			// Woocommerce Css

			wp_enqueue_style('slick-slider', get_template_directory_uri() . '/assets/css/slick.css');
			wp_enqueue_style('slick-theme-slider', get_template_directory_uri() . '/assets/css/slick-theme.css');
			wp_enqueue_script('slick-slider', get_template_directory_uri() . '/assets/js/slick.js', array('jquery'), false, true);


			// Elementor Css

			wp_enqueue_style('boatrental-blogs', boatrental_URI . '/assets/css/elementor/blog_wid.css?var=1.48');

			wp_enqueue_style('boatrental-search', boatrental_URI . '/assets/css/elementor/search.css?v=1.41');

			wp_enqueue_style('boatrental-product-slider', boatrental_URI . '/assets/css/elementor/product-slider.css?v=2.30');

			wp_enqueue_style('boatrental-product-tab', boatrental_URI . '/assets/css/elementor/product-tab.css?v=1.51');

			wp_enqueue_style('boatrental-holiday-place', boatrental_URI . '/assets/css/elementor/holiday-place.css?v=1.43');

			wp_enqueue_style('boatrental-carousel-slider', boatrental_URI . '/assets/css/elementor/carousel-slider.css?v=1.77');

			wp_enqueue_script('boatrental-select_2-js', boatrental_URI . '/assets/js/cdn/select2.min.js', array('jquery'), '', true);

			// Elementor Css

			// if (is_shop() || is_search()) {
			// Enqueue the script or css only for category and search pages
			wp_enqueue_style('boatrental-category-css');

			wp_enqueue_script('boatrental-category-js', get_theme_file_uri('/assets/js/category.js'), array(), boatrental_URI . '/assets/js/category.js', true);
			// }
			if (class_exists('WooCommerce')) {
				if (is_product()) {
					wp_enqueue_style('boatrental-popup', boatrental_URI . '/assets/css/cdn/magnific-popup.css');
					wp_enqueue_script('boatrental-popup-js', boatrental_URI . '/assets/js/cdn/magnific-popup.min.js', array('jquery'), '', true);
				}
			}

			wp_localize_script(
				'boatrental-main-js',
				'boatrental_vars',
				array(
					'ajax_url' => admin_url('admin-ajax.php'),
				)
			);

			wp_enqueue_script('boatrental-main-js');
		}

		public function register_custom_sidebars($sidebars)
		{
			$custom_sidebars = array(
				'boatrental_sidebar' => esc_html__('Sidebar', 'boatrental'),
				'footer-widget1' => esc_html__('Footer widget 1', 'boatrental'),
				'footer-widget2' => esc_html__('Footer widget 2', 'boatrental'),
				'footer-widget3' => esc_html__('Footer widget 3', 'boatrental'),
				'footer-widget4' => esc_html__('Footer widget 4', 'boatrental'),
				'woocommerce-sidebar' => esc_html__('WooCommerce Sidebar', 'boatrental'),
			);

			foreach ($custom_sidebars as $sidebar_id => $sidebar_name) {
				$sidebar_args = array(
					'name' => $sidebar_name,
					'id' => $sidebar_id,
					'before_widget' => '<section id="%1$s" class="widget %2$s">',
					'after_widget' => '</section>',
					'before_title' => '<h2 class="widget-title">',
					'after_title' => '</h2>',
				);
				register_sidebar($sidebar_args);
			}

			return $sidebars;
		}

		public function boatrental_vars_data()
		{
			$is_login_page = $this->is_page('login');
			$is_register_page = $this->is_page('registration');
			$boatrental_vars = array(
				'ajax_url' => admin_url('admin-ajax.php')
			);

			if ($is_login_page) {
				$boatrental_vars['login'] = $is_login_page;
			} elseif ($is_register_page) {
				$boatrental_vars['register'] = $is_register_page;
			}

			wp_localize_script('boatrental-main-js', 'boatrental_vars', $boatrental_vars);
		}

		function boatrental_add_custom_css()
		{
			ob_start();
?>
			.br-product-cat .wrap-header-banner {
			background-image: url(<?php echo THEME_IMG_PATH . 'category/category_banner.jpg'; ?>);
			}
			<?php
			$custom_css = ob_get_clean();
			wp_add_inline_style('boatrental-category-css', $custom_css);

			// ================ Change Custom Root Color ===============

			$Primarycolor = Boatrental_Main::get_meta('Primary_Color');
			$Secondrycolor = Boatrental_Main::get_meta('Secondry_Color');
			$google_webfonts = Boatrental_Main::get_meta('google_webfonts');
			$tag_font_family = Boatrental_Main::get_meta('tag_font_family');
			$tag_fonts_weight = Boatrental_Main::get_meta('tag_fonts_weight');
			$h1_tag_fontsize = Boatrental_Main::get_meta('h1_tag_fontsize') ? Boatrental_Main::get_meta('h1_tag_fontsize') . 'px' : '32px';
			$h2_tag_fontsize = Boatrental_Main::get_meta('h2_tag_fontsize') ? Boatrental_Main::get_meta('h2_tag_fontsize') . 'px' : '24px';
			$h3_tag_fontsize = Boatrental_Main::get_meta('h3_tag_fontsize') ? Boatrental_Main::get_meta('h3_tag_fontsize') . 'px' : '18px';
			$h4_tag_fontsize = Boatrental_Main::get_meta('h4_tag_fontsize') ? Boatrental_Main::get_meta('h4_tag_fontsize') . 'px' : '16px';
			$h5_tag_fontsize = Boatrental_Main::get_meta('h5_tag_fontsize') ? Boatrental_Main::get_meta('h5_tag_fontsize') . 'px' : '14px';
			$h6_tag_fontsize = Boatrental_Main::get_meta('h6_tag_fontsize') ? Boatrental_Main::get_meta('h6_tag_fontsize') . 'px' : '12px';

			$custom_css = "
				:root {
					--primary: $Primarycolor;
					--primary-hover: $Primarycolor;
					--secondary: $Secondrycolor;
					--secondary-hover: $Secondrycolor;
					--heading : $tag_font_family;
					--heading-font-weight : $tag_fonts_weight ;
					--h1-font-size : $h1_tag_fontsize;
					--h2-font-size : $h2_tag_fontsize;
					--h3-font-size : $h3_tag_fontsize;
					--h4-font-size : $h4_tag_fontsize;
					--h5-font-size : $h5_tag_fontsize;
					--h6-font-size : $h6_tag_fontsize;
				}
			";
			wp_add_inline_style('boatrental-common', $custom_css);

			$webfonts_css = "
				:root {
					--text : $google_webfonts;
				}
			";
			wp_add_inline_style('boatrental-typography', $webfonts_css);

			$background_image = "
				.tour-wrapper .wrap-header-banner {
					background-image: url(" . THEME_IMG_PATH . "/tours/tour_taxonomy_banner.jpg);
				}
				.br-tour-wrapper .wrap-header-banner {
					background-image: url(" . THEME_IMG_PATH . "/tours/tour_banner.jpg);
				}
			";

			wp_add_inline_style('boatrental-tour-destination', $background_image);

			if (empty(get_the_post_thumbnail_url(get_the_ID(), 'full'))) {
				$image = boatrental_no_image;
			} else {
				$image = get_the_post_thumbnail_url(get_the_ID(), 'full');
			}
			$background_image = "
			.single-blog {
					background-image: url(" . $image . ");
				}
				
			";

			wp_add_inline_style('boatrental-tour-destination', $background_image);

			$background_image = "
				.br-list-blog {
					background-image: url(" . THEME_IMG_PATH . "/blog/blog_img.jpg);
				}
				
			";
			wp_add_inline_style('boatrental-blog', $background_image);


			// ================ Change Custom Root Color ===============

		}


		public function is_page($url)
		{
			$is_page = (strpos($_SERVER['REQUEST_URI'], $url) !== false);
			return $is_page;
		}


		public function boatrental_add_var()
		{
			if (!defined('boatrental_url')) {
				define('boatrental_url', home_url() . '/');
			}
		}

		public static function get_meta($key = null)
		{
			$meta = get_option('BoatRental_theme');
			return ($key !== null) ? ($meta[$key] ?? null) : $meta;
		}

		public static function get_template_part()
		{
			if (is_singular()) {
				if (is_page()) {
					return 'page';
				} else {
					return 'single';
				}
			} elseif (is_archive() || is_home()) {
				return 'archive';
			} elseif (is_search()) {
				return 'search';
			} else {
				return '404';
			}
		}

		function boatrental_blog_template()
		{
			$blog_template = $this->get_meta();
			return $blog_template['site_layout'];
		}

		function boatrental_footer_layout()
		{

			$footer_mennu = wp_get_nav_menu_items(Helpers::boatrental_get_all_menu('footer_menu'));


			if (Boatrental_Main::get_meta('main_footer_style') == 'layout1') {
			?>
				<div class="footer-inner">
					<!-- Footer Layout 1  -->
					<div class="footer-column col-space">
						<ul>
							<?php
								if (is_active_sidebar('footer-widget1')) :
									dynamic_sidebar('footer-widget1');
								endif;
							?>
						</ul>
					</div>
					<div class="footer-column col-space">
						<ul>
							<?php
								if (is_active_sidebar('footer-widget2')) :
									dynamic_sidebar('footer-widget2');
								endif;
							?>
						</ul>
					</div>
					<div class="footer-column col-space">
						<div class="col-sec">
						
							<?php
								if (is_active_sidebar('footer-widget4')) :
									dynamic_sidebar('footer-widget4');
								endif;
							?>
							
						
						</div>
					</div>
					<div class="footer-column">
							<?php
								if (is_active_sidebar('footer-widget3')) :
									dynamic_sidebar('footer-widget3');
								endif;
							?>
						
					</div>
				</div>
				<div class="br-copyright">
					<div class="br-content">
						<div class="footer-bottom-col col-left">
							<div class="foot-copyright-logo">
								<img src="<?php echo esc_url(Boatrental_Main::get_meta('footer_logo')); ?>" alt="">
							</div>
						</div>
						<?php if(!empty(Boatrental_Main::get_meta('footer_copyright')) > 0){ ?>
						<div class="footer-bottom-col col-center aligncenter">
							<p>&copy; <?php echo esc_html(date('Y') . ' ' . Boatrental_Main::get_meta('footer_copyright')); ?></p>
						</div>
						<?php } ?>
						<div class="footer-bottom-col col-right">
							<div class="social-col">
								<?php if (!empty(Boatrental_Main::get_meta('share_link_tw'))) : ?>
									<span class="social-icon"><a href="<?php echo esc_url(Boatrental_Main::get_meta('share_link_tw')); ?>"><i class="fab fa-twitter"></i></a></span>
								<?php endif; ?>

								<?php if (!empty(Boatrental_Main::get_meta('share_link_fb'))) : ?>
									<span class="social-icon"><a href="<?php echo esc_url(Boatrental_Main::get_meta('share_link_fb')); ?>"><i class="fab fa-facebook"></i></a></span>
								<?php endif; ?>

								<?php if (!empty(Boatrental_Main::get_meta('share_link_instagram'))) : ?>
									<span class="social-icon"><a href="<?php echo esc_url(Boatrental_Main::get_meta('share_link_instagram')); ?>"><i class="fab fa-instagram"></i></a></span>
								<?php endif; ?>

								<?php if (!empty(Boatrental_Main::get_meta('share_link_linkedin'))) : ?>
									<span class="social-icon"><a href="<?php echo esc_url(Boatrental_Main::get_meta('share_link_linkedin')); ?>"><i class="fab fa-linkedin"></i></a></span>
								<?php endif; ?>

								<?php if (!empty(Boatrental_Main::get_meta('share_link_pinterest'))) : ?>
									<span class="social-icon"><a href="<?php echo esc_url(Boatrental_Main::get_meta('share_link_pinterest')); ?>"><i class="fab fa-pinterest-p"></i></a></span>
								<?php endif; ?>

								<?php if (!empty(Boatrental_Main::get_meta('share_link_vimeo'))) : ?>
									<span class="social-icon"><a href="<?php echo esc_url(Boatrental_Main::get_meta('share_link_vimeo')); ?>"><i class="fab fa-vimeo"></i></a></span>
								<?php endif; ?>

								<?php if (!empty(Boatrental_Main::get_meta('share_link_youtube'))) : ?>
									<span class="social-icon"><a href="<?php echo esc_url(Boatrental_Main::get_meta('share_link_youtube')); ?>"><i class="fab fa-youtube"></i></a></span>
								<?php endif; ?>
							</div>

						</div>
					</div>
				</div>
				<!-- Footer Layout 2  -->
			<?php } else {
			?>
				<div class="newsletter-wrap">
				<?php
					if (is_active_sidebar('footer-widget3')) :
						dynamic_sidebar('footer-widget3');
					endif;
				?>	
				
				</div>
				<div class="footer-inner">
					<div class="footer-column col-space footer-logo">
						<div class="footer-logo">
							<img src="<?php echo esc_url(Boatrental_Main::get_meta('footer_logo')); ?>" alt="">
						</div>
						<div class="footer-txt">
							<?php
							echo esc_html("Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit.");
							?>
						</div>
						<div class="social-col">
							<?php if (!empty(Boatrental_Main::get_meta('share_link_tw'))) : ?>
								<span class="social-icon"><a href="<?php echo esc_url(Boatrental_Main::get_meta('share_link_tw')); ?>"><i class="fab fa-twitter"></i></a></span>
							<?php endif; ?>

							<?php if (!empty(Boatrental_Main::get_meta('share_link_fb'))) : ?>
								<span class="social-icon"><a href="<?php echo esc_url(Boatrental_Main::get_meta('share_link_fb')); ?>"><i class="fab fa-facebook"></i></a></span>
							<?php endif; ?>

							<?php if (!empty(Boatrental_Main::get_meta('share_link_instagram'))) : ?>
								<span class="social-icon"><a href="<?php echo esc_url(Boatrental_Main::get_meta('share_link_instagram')); ?>"><i class="fab fa-instagram"></i></a></span>
							<?php endif; ?>

							<?php if (!empty(Boatrental_Main::get_meta('share_link_youtube'))) : ?>
								<span class="social-icon"><a href="<?php echo esc_url(Boatrental_Main::get_meta('share_link_youtube')); ?>"><i class="fab fa-youtube"></i></a></span>
							<?php endif; ?>
						</div>
					</div>
					<?php
					$menu_name = 'Discover'; // Replace with the name of your menu
					$menu_items = wp_get_nav_menu_items($menu_name);
					// if ($menu_items) {
					?>
						<div class="footer-column col-space">
						
							<ul>
							<?php
								if (is_active_sidebar('footer-widget1')) :
									dynamic_sidebar('footer-widget1');
								endif;
							?>
							</ul>
						</div>
					<?php
					// }
					
					$menu_name = 'Footer Menu'; // Replace with the name of your menu
					$menu_items = wp_get_nav_menu_items($menu_name);
					// if ($menu_items) {
					?>
						<div class="footer-column col-space">
							<ul>
							<?php
								if (is_active_sidebar('footer-widget2')) :
									dynamic_sidebar('footer-widget2');
								endif;
							?>
							</ul>
						</div>
					<?php 
					// }
					?>
					<div class="footer-column">
						<div class="col-sec">
				
						  <?php
								if (is_active_sidebar('footer-widget4')) :
									dynamic_sidebar('footer-widget4');
								endif;
							?>
						
							
					</div>
				</div>
				</div>
				<div class="br-copyright">
					<div class="br-content">
					<?php if(!empty(Boatrental_Main::get_meta('footer_copyright'))){ ?>
						<div class="footer-bottom-col">
							<p>&copy; <?php echo esc_html(date('Y') . ' ' . Boatrental_Main::get_meta('footer_copyright')); ?></p>
						</div>
					<?php } ?>
					</div>
				</div>
			<?php }
			?>

<?php
		}
	} //end class
}

return new Boatrental_Main();
