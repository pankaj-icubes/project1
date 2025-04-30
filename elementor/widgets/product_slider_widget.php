<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;


if (!defined('ABSPATH'))
	exit; // Exit if accessed directly

class Boatrental_Elementor_holiday_place extends Widget_Base
{

	public function get_name()
	{
		return 'boatrental_elementor_holiday_place';
	}

	public function get_title()
	{
		return esc_html__('Destination Slider', 'boatrental');
	}

	public function get_icon()
	{
		return 'eicon-products';
	}

	public function get_categories()
	{
		return ['boatrental'];
	}

	protected function register_controls()
	{

		$this->start_controls_section(
			'section_product_list_content',
			[
				'label' => esc_html__('Content', 'boatrental'),
			]
		);

		$this->add_control(
			'slider_control',
			[
				'label' => esc_html__('Show Slider', 'boatrental'),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'options' => [
					'yes' => esc_html__('Yes', 'boatrental'),
					'no' => esc_html__('No', 'boatrental'),
				],
				'frontend_available' => true,
				'condition' => [
					'version' => 'version_2',
				],
			]
		);


		$this->add_control(
			'version',
			[
				'label' => esc_html__('Version', 'boatrental'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'lSlider_1',
				'options' => [
					'lSlider_1' => esc_html__('Location Slider 1', 'boatrental'),
					'lSlider_2' => esc_html__('Location Slider 2', 'boatrental'),
					'pSlider_1' => esc_html__('Product Slider 1', 'boatrental'),
					'pSlider_2' => esc_html__('Product Slider 2', 'boatrental'),
				],
			]
		);

		$args_query = [
			'taxonomy' => 'product_cat',
			'orderby' => 'name',
			'order' => 'ASC'
		];

		$categories = get_categories($args_query);
		$defautl_category = array('all' => esc_html__('All', 'boatrental'));
		$args_category = array();
		$result = array();

		if ($categories && is_array($categories)) {
			foreach ($categories as $category) {
				$args_category[$category->slug] = $category->cat_name;
			}
		}

		$result = array_merge($defautl_category, $args_category);

		$this->add_control(
			'show_featured',
			[
				'label' => __('Only Show Featured', 'boatrental'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __('Show', 'boatrental'),
				'label_off' => __('Hide', 'boatrental'),
				'default' => 'no',
			]
		);

		$this->add_control(
			'categories',
			[
				'label' => esc_html__('Select Category', 'boatrental'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'all',
				'options' => $result,
				'condition' => [
					'version' => ['pSlider_1', 'pSlider_2'],
				],
			]
		);

		$this->add_control(
			'posts_per_page',
			[
				'label' => esc_html__('Posts Per Page', 'boatrental'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 3,
				'min' => 3,
			]
		);

		$this->add_control(
			'orderby',
			[
				'label' => esc_html__('Order By', 'boatrental'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'title',
				'options' => [
					'title' => esc_html__('Title', 'boatrental'),
					'ID' => esc_html__('ID', 'boatrental'),
					'date' => esc_html__('Date', 'boatrental'),
				],
			]
		);

		$this->add_control(
			'order',
			[
				'label' => esc_html__('Order', 'boatrental'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'ASC',
				'options' => [
					'ASC' => esc_html__('Ascending', 'boatrental'),
					'DESC' => esc_html__('Descending', 'boatrental'),
				],
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'section_product_list_style',
			[
				'label' => esc_html__('Content', 'boatrental'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->end_controls_section();

		/****************************  START SECTION ADDITIONAL *********************/
		$this->start_controls_section(
			'section_additional_options',
			[
				'label' => esc_html__('Additional Options', 'boatrental'),
			]
		);

		$this->add_control(
			'pause_on_hover',
			[
				'label' => esc_html__('Pause on Hover', 'boatrental'),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'options' => [
					'yes' => esc_html__('Yes', 'boatrental'),
					'no' => esc_html__('No', 'boatrental'),
				],
				'frontend_available' => true,
				// 'condition' => [
				// 	'version' => 'pSlider_1',
				// ],
			]
		);

		$this->add_control(
			'draggable',
			[
				'label' => esc_html__('Draggable', 'boatrental'),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'options' => [
					'yes' => esc_html__('Yes', 'boatrental'),
					'no' => esc_html__('No', 'boatrental'),
				],
				'frontend_available' => true,
				// 'condition' => [
				// 	'version' => 'pSlider_1',
				// ],
			]
		);

		// $this->add_control(
		// 	'slidesToScroll',
		// 	[
		// 		'label' => esc_html__('Slides To Scroll', 'boatrental'),
		// 		'type' => \Elementor\Controls_Manager::NUMBER,
		// 		'default' => 1,
		// 		'min' => 1,
		// 		'max' => 5,
		// 	]
		// );

		$this->add_control(
			'infinite',
			[
				'label' => esc_html__('Infinite', 'boatrental'),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
				'options' => [
					'yes' => esc_html__('Yes', 'boatrental'),
					'no' => esc_html__('No', 'boatrental'),
				],
				'frontend_available' => true,
				// 'condition' => [
				// 	'version' => 'pSlider_1',
				// ],
			]
		);


		$this->add_control(
			'autoplay',
			[
				'label' => esc_html__('Autoplay', 'boatrental'),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
				'options' => [
					'yes' => esc_html__('Yes', 'boatrental'),
					'no' => esc_html__('No', 'boatrental'),
				],
				'frontend_available' => true,
				// 'condition' => [
				// 	'version' => 'pSlider_1',
				// ],
			]
		);

		$this->add_control(
			'autoplay_speed',
			[
				'label' => esc_html__('Autoplay Speed', 'boatrental'),
				'type' => Controls_Manager::NUMBER,
				'default' => 3000,
				'step' => 500,
				'condition' => [
					'autoplay' => 'yes',
					//'version' => 'pSlider_1',
				],
				'frontend_available' => true,

			]
		);

		$this->end_controls_section();
		/****************************  END SECTION ADDITIONAL *********************/
	}


	protected function boatrental_get_product_list($args)
	{

		$args_query = [
			'post_type' => 'product',
			'post_status' => 'publish',
			'posts_per_page' => $args['posts_per_page'],
			'orderby' => $args['orderby'],
			'order' => $args['order'],
			'fields' => 'ids',
			'tax_query' => [],
		];

		if ('yes' === $args['show_featured']) {
			$featured = [
				'taxonomy' => 'product_visibility',
				'field' => 'name',
				'terms' => 'featured',
				'operator' => 'IN'
			];

			array_push($args_query['tax_query'], $featured);
		}

		if ('all' != $args['category_slug']) {
			$category_args = [
				'taxonomy' => 'product_cat',
				'field' => 'slug',
				'terms' => $args['category_slug'],
				'operator' => 'IN',
			];
			array_push($args_query['tax_query'], $category_args);
		}


		$result = new WP_Query($args_query);

		return $result;
	}

	protected function render()
	{
		$settings = $this->get_settings();
		$version = $settings['version'];

		$data_options = array();

			$data_options['pause_on_hover'] = $settings['pause_on_hover'] === 'yes' ? true : false;
			$data_options['draggable'] = $settings['draggable'] === 'yes' ? true : false;
			$data_options['autoplay'] = $settings['autoplay'] === 'yes' ? true : false;
			$data_options['autoplay_speed'] = $settings['autoplay'] === 'yes' ? $settings['autoplay_speed'] : false;
			$data_options['infinite'] = $settings['infinite'] === 'yes' ? true : false;
			
		$args = [
			'posts_per_page' => $settings['posts_per_page'],
			'orderby' => $settings['orderby'],
			'order' => $settings['order'],
			'category_slug' => $settings['categories'],
			'show_featured' => $settings['show_featured']
		];

		$all_products = $this->boatrental_get_product_list($args);

		$data_product_sliderone_add_settings = json_encode($data_options);

		if ($version == 'lSlider_1' || $version == 'lSlider_2') {
			
			if($version == 'lSlider_1' ){
				require get_theme_file_path('elementor/widgets/templates/holiday-place.php');
			}else{
				require get_theme_file_path('elementor/widgets/templates/holiday-place2.php');	
			}
			
		} else {
			
			if ($version == 'pSlider_1') {
				require get_theme_file_path('elementor/widgets/templates/product-slider.php');
			} else {
				require get_theme_file_path('elementor/widgets/templates/product-slider2.php');
			}
		}
	}
}

$widgets_manager->register_widget_type(new Boatrental_Elementor_holiday_place());
