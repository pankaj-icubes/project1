<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;


if (!defined('ABSPATH'))
	exit; // Exit if accessed directly

class boatrental_Elementor_Product_List extends Widget_Base
{

	public function get_name()
	{
		return 'boatrental_elementor_product_list';
	}

	public function get_title()
	{
		return esc_html__('Product Grid', 'boatrental');
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
			'product_tab',
			[
				'label' => __('Show Product Tab', 'boatrental'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __('Show', 'boatrental'),
				'label_off' => __('Hide', 'boatrental'),
				'default' => 'no',
			]
		);

		$this->add_control(
			'columns',
			[
				'label' => esc_html__('Columns', 'boatrental'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'column3',
				'options' => [
					'column1' => esc_html__('Column 1', 'boatrental'),
					'column2' => esc_html__('Column 2', 'boatrental'),
					'column3' => esc_html__('Column 3', 'boatrental'),
					
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
			'categories',
			[
				'label' => esc_html__('Select Category', 'boatrental'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'all',
				'options' => $result,
				'condition' => [
					'product_tab' => '', 
				],
			]
		);

		$this->add_control(
			'posts_per_page',
			[
				'label' => esc_html__('Posts Per Column', 'boatrental'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 3,
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

		$this->add_control(
			'category_in',
			[
				'label' => esc_html__('Choose Category', 'boatrental'),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => true,
				'default' => array_keys($result),
				// another value 'all'
				'options' => $result,
				'condition' => [
					'product_tab' => 'yes',
				],
			]
		);


		$this->end_controls_section();
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

		// print_r($featured); die;

		if ('all' != $args['category_slug']) {
			$category_args = [
				'taxonomy' => 'product_cat',
				'field' => 'slug',
				'terms' => $args['category_slug'],
				'operator' => 'IN',
			];
			array_push($args_query['tax_query'], $category_args);
		}


		$result = new \WP_Query($args_query);

		return $result;
	}

	protected function render()
	{
		$settings = $this->get_settings();

		$args = [
			'posts_per_page' => $settings['posts_per_page'],
			'orderby' => $settings['orderby'],
			'order' => $settings['order'],
			'category_slug' => $settings['categories'],
			'category_in' => $settings['category_in'],
			'show_featured' => $settings['show_featured']
		];

		$all_products = $this->boatrental_get_product_list($args);
		// print_r($all_products); die;
		$categories = isset($settings['category_in']) ? $settings['category_in'] : array(); // Get list of categories from settings
		$categories = $settings['category_in'];

		if ('yes' === $settings['product_tab']) {
			
			require_once get_theme_file_path('elementor/widgets/templates/product-tab.php');

		} else { ?>
			<div class="br-main-wrapper product-tabs yacht-tabs">
				<div class="product-tab-content active">
					<ul class="br-product-wrapper br-prod-col <?php echo esc_attr( $settings['columns'] ); ?>">
						<?php while ($all_products->have_posts()) :
							$all_products->the_post();
							
							get_template_part('template-parts/post/content-post');
							
							endwhile; ?>
					</ul>

				</div>
			</div>
	<?php }
	}
}

$widgets_manager->register_widget_type(new boatrental_Elementor_Product_List());
