<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Color;
use Elementor\Utils;


if (!defined('ABSPATH'))
	exit; // Exit if accessed directly

class Boatrental_Elementor_Testimonial_Carousel extends Widget_Base
{

	public function get_name()
	{
		return 'boatrental_elementor_testimonial_carousel';
	}

	public function get_title()
	{
		return esc_html__('Testimonial Carousel', 'boatrental');
	}

	public function get_icon()
	{
		return 'eicon-testimonial';
	}

	public function get_categories()
	{
		return ['boatrental'];
	}


	protected function register_controls()
	{


		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__('Content', 'boatrental'),
			]
		);

		$this->add_control(
			'version',
			[
				'label' => esc_html__('Version', 'boatrental'),
				'type' => Controls_Manager::SELECT,
				'default' => 'version_1',
				'options' => [
					'version_1' => esc_html__('Version 1', 'boatrental'),
					'version_2' => esc_html__('Version 2', 'boatrental'),
				]
			]
		);

		$repeater = new \Elementor\Repeater();


		$repeater->add_control(
			'name_author',
			[
				'label' => esc_html__('Author Name', 'boatrental'),
				'type' => \Elementor\Controls_Manager::TEXT,
			],


		);

		$repeater->add_control(
			'company_name',
			[
				'label' => esc_html__('Company name', 'boatrental'),
				'type' => \Elementor\Controls_Manager::TEXT,

			]
		);

		$repeater->add_control(
			'image_author',
			[
				'label' => esc_html__('Author Image', 'boatrental'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'testimonial',
			[
				'label' => esc_html__('Testimonial ', 'boatrental'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s', 'boatrental'),
			]
		);

		$this->add_control(
			'tab_item',
			[
				'label' => esc_html__('Items Testimonial', 'boatrental'),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'name_author' => esc_html__('Avengers', 'boatrental'),
						'company_name' => esc_html__('Marvel', 'boatrental'),
						'testimonial' => esc_html__('Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'boatrental'),
					],
				],
				'title_field' => '{{{ name_author }}}',
				'condition' => [
					'version' => 'version_1',
				],
			]
		);

		//repeater v2
		$repeater2 = new \Elementor\Repeater();

		$repeater2->add_control(
			'icon',
			[
				'label' => __('Icon', 'boatrental'),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'icomoon icomoon-comment-2',
					'library' => 'solid',
				],
				'condition' => [
					'version' => 'version_1',
				],
			]
		);

		$repeater2->add_control(
			'name_author',
			[
				'label' => esc_html__('Author Name', 'boatrental'),
				'type' => \Elementor\Controls_Manager::TEXT,
			],


		);

		$repeater2->add_control(
			'company_name',
			[
				'label' => esc_html__('company_name', 'boatrental'),
				'type' => \Elementor\Controls_Manager::TEXT,

			]
		);

		$repeater2->add_control(
			'image_author',
			[
				'label' => esc_html__('Author Image', 'boatrental'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater2->add_control(
			'link',
			[
				'label' => esc_html__('Link', 'boatrental'),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__('https://your-link.com', 'boatrental'),
				'default' => [
					'url' => '',
					'is_external' => false,
					'nofollow' => false,
					'custom_attributes' => '',
				],
				'label_block' => true,
			]
		);

		$repeater2->add_control(
			'testimonial',
			[
				'label' => esc_html__('Testimonial ', 'boatrental'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__('"Sed ullamcorper morbi tincidunt or massa eget egestas purus. Non nisi est sit amet facilisis magna etiam."', 'boatrental'),
			]
		);

		$this->add_control(
			'tab_item_v2',
			[
				'label' => esc_html__('Items Testimonial', 'boatrental'),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater2->get_controls(),
				'default' => [
					[
						'name_author' => esc_html__('James thomas', 'boatrental'),
						'company_name' => esc_html__('Some Company Name', 'boatrental'),
						'testimonial' => esc_html__('Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy.', 'boatrental'),
					],
					[
						'name_author' => esc_html__('Sofia brichet', 'boatrental'),
						'company_name' => esc_html__('Some Company Name', 'boatrental'),
						'testimonial' => esc_html__('There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don"t look even.', 'boatrental'),
					],

				],
				'title_field' => '{{{ name_author }}}',
				'condition' => [
					'version' => 'version_2',
				],
			]
		);

		$this->end_controls_section();

		/*****************  END SECTION CONTENT ******************/


		/*****************************************************************
		START SECTION ADDITIONAL
		******************************************************************/

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
				'condition' => [
					'version' => 'version_1',
				],
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
				'condition' => [
					'version' => 'version_1',
				],
			]
		);

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
					
				],
				'frontend_available' => true,

			]
		);






		$this->end_controls_section();

		/****************************  END SECTION ADDITIONAL *********************/


	}

	protected function render()
	{

		$settings = $this->get_settings();

		$version = $settings['version'];
		$tab_item = $settings['tab_item'];
		$tab_item_v2 = $settings['tab_item_v2'];
		$data_options = array();
		$data_options['pause_on_hover'] = $settings['pause_on_hover'] === 'yes' ? true : false;
		$data_options['draggable'] = $settings['draggable'] === 'yes' ? true : false;
		$data_options['autoplay'] = $settings['autoplay'] === 'yes' ? true : false;
		$data_options['autoplay_speed'] = $settings['autoplay'] === 'yes' ? $settings['autoplay_speed'] : false;
		$data_options['infinite'] = $settings['infinite'] === 'yes' ? true : false;

		$data_product_sliderone_add_settings = json_encode($data_options);
		
		if($version == 'version_1'){
			require_once get_theme_file_path('elementor/widgets/templates/Carousel-slider.php');
		}else{
			require_once get_theme_file_path('elementor/widgets/templates/Carousel-slider2.php');
		}
		
	}
// end render
}

$widgets_manager->register_widget_type(new Boatrental_Elementor_Testimonial_Carousel());