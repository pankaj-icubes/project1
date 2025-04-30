<?php

/**
 * Class boatrental_Elementor
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
 */


/**
 * Class with register category or widgets functions.
 */

if (!defined('ABSPATH'))
exit;



if (!class_exists('boatrental_Elementor')) {

	class boatrental_Elementor
	{

		function __construct()
		{
			/**
			* Constructor for the boatrental_Elementor class.
			*
			* Initializes Register Category.
			*/
			add_action('elementor/elements/categories_registered', array($this, 'boatrentalAddCategory'));

			add_action('elementor/widgets/widgets_registered', array($this, 'boatrentalIncludeWidgets'));

			add_action('elementor/frontend/after_register_scripts', array($this, 'boatrentalEnqueueScripts'));

			add_action('elementor/element/image-box/section_style_content/before_section_end', array($this, 'boatrental_image_box'), 10, 2);
		}

		function boatrentalAddCategory()
		{
			\Elementor\Plugin::instance()->elements_manager->add_category(
				'boatrental',
				[
					'title' => __('boatrental', 'boatrental'),
					'icon' => 'fa fa-plug',
				]
			);
		}

		function boatrentalIncludeWidgets($widgets_manager)
		{
			$files = glob(get_theme_file_path('elementor/widgets/*.php'));
			foreach ($files as $file) {
				$file = get_theme_file_path('elementor/widgets/' . wp_basename($file));
				if (file_exists($file)) {
					require_once $file;
				}
			}
		}



		function boatrentalEnqueueScripts()
		{

			$files = glob(get_theme_file_path('/assets/js/elementor/*.js'));

			foreach ($files as $file) {
				$file_name = wp_basename($file);
				$handle    = str_replace(".js", '', $file_name);
				$src       = get_theme_file_uri('/assets/js/elementor/' . $file_name);

				if (file_exists($file)) {
					wp_register_script('boatrental-elementor-' . $handle, $src, ['jquery'], false, true);
					wp_enqueue_script('boatrental-elementor-' . $handle);
				}
			}
		}

		function boatrental_image_box($element, $args)
		{
			$element->add_responsive_control(
				'title_margin',
				[
					'label' => esc_html__('Title Margin', 'boatrental'),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => ['px', '%', 'em'],
					'selectors' => [
						'{{WRAPPER}} .elementor-image-box-wrapper .elementor-image-box-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$element->add_responsive_control(
				'description_margin',
				[
					'label' => esc_html__('Description Margin', 'boatrental'),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => ['px', '%', 'em'],
					'selectors' => [
						'{{WRAPPER}} .elementor-image-box-wrapper .elementor-image-box-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
		}
	}

	return new boatrental_Elementor();
	
}


