<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use Elementor\Utils;

if (!defined('ABSPATH'))
	exit; // Exit if accessed directly


class Boatrental_Elementor_Blog extends Widget_Base
{


	public function get_name()
	{
		return 'boatrental_elementor_blog';
	}

	public function get_title()
	{
		return esc_html__('Blog', 'boatrental');
	}

	public function get_icon()
	{
		return 'eicon-table-of-contents';
	}

	public function get_categories()
	{
		return ['boatrental'];
	}

	protected function register_controls()
	{

		$args = array(
			'orderby' => 'name',
			'order' => 'ASC'
		);

		$categories = get_categories($args);
		$cate_array = array();
		$arrayCateAll = array('all' => esc_html__('All categories', 'boatrental'));

		if ($categories) {
			foreach ($categories as $cate) {
				$cate_array[$cate->slug] = $cate->cat_name;
			}
		} else {
			$cate_array["No content Category found"] = esc_html__('No content Category found', 'boatrental');
		}

		//SECTION CONTENT
		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__('Content', 'boatrental'),
			]
		);
		$this->add_responsive_control(
			'align_content',
			[
				'label' => esc_html__('Alignment', 'boatrental'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__('Left', 'boatrental'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'boatrental'),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__('Right', 'boatrental'),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'left',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .post-wrap' => 'text-align: {{VALUE}}',
				],
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
		// Add Class control
		$this->add_control(
			'category',
			[
				'label' => esc_html__('Category', 'boatrental'),
				'type' => Controls_Manager::SELECT,
				'default' => 'all',
				'options' => array_merge($arrayCateAll, $cate_array),
				'condition' => [
					'version' => 'version_1'
				]
			]

		);

		$this->add_control(
			'total_count',
			[
				'label' => esc_html__('Post Count', 'boatrental'),
				'type' => Controls_Manager::NUMBER,
				'default' => 3,
				
			]
		);

		$this->add_control(
			'number_column',
			[
				'label' => esc_html__('Number Of Columns', 'boatrental'),
				'type' => Controls_Manager::SELECT,
				'default' => '2',
				'options' => [
					'1' => esc_html__('1 Columns', 'boatrental'),
					'2' => esc_html__('2 Columns', 'boatrental'),
					'3' => esc_html__('3 Columns', 'boatrental'),
					
				],
				'condition' => [
					'version' => 'version_1'
				]
			]
		);

		$this->add_control(
			'order_by_ad',
			[
				'label' => esc_html__('Order', 'boatrental'),
				'type' => Controls_Manager::SELECT,
				'default' => 'desc',
				'options' => [
					'asc' => esc_html__('Ascending', 'boatrental'),
					'desc' => esc_html__('Descending', 'boatrental'),
				]
			]
		);
		$this->add_control(
			'order_by',
			[
				'label' => esc_html__('Order By', 'boatrental'),
				'type' => Controls_Manager::SELECT,
				'default' => 'ID',
				'options' => [
					'ID' => esc_html__('ID', 'boatrental'),
					'title' => esc_html__('Title', 'boatrental'),
					'date' => esc_html__('Date', 'boatrental'),
				]
			]
		);

		$this->add_control(
			'text_readmore',
			[
				'label' => esc_html__('Text Read More', 'boatrental'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Read more', 'boatrental'),
				'condition' => [
					'show_read_more' => 'yes'
				]
			]
		);

		$this->add_control(
			'show_read_more',
			[
				'label' => esc_html__('Show Read More', 'boatrental'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'boatrental'),
				'label_off' => esc_html__('Hide', 'boatrental'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'icon',
			[
				'label' => esc_html__('Icon', 'boatrental'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'icomoon icomoon-long-arrow-right',
					'library' => 'solid',
				],
				'condition' => [
					'show_read_more' => 'yes'
				]
			]
		);

		$this->end_controls_section();
		//END SECTION CONTENT

		//----------------------- STYLE---------------------//

		//SECTION TAB STYLE DATE
		$this->start_controls_section(
			'section_date',
			[
				'label' => esc_html__('Date', 'boatrental'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		

		$this->add_control(
			'hr',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
				'default' => 'after',
			]
		);

		$this->start_controls_tabs('style_tabs_date');


		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'hr_month_day',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
				'default' => 'after',
			]
		);

		$this->add_responsive_control(
			'padding_date',
			[
				'label' => esc_html__('Padding', 'boatrental'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .post-date ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		//END SECTION TAB STYLE DATE



		//SECTION TAB STYLE TITLE
		$this->start_controls_section(
			'section_title',
			[
				'label' => esc_html__('Title', 'boatrental'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs(
			'style_tabs_title'
		);

		$this->start_controls_tab(
			'style_normal_tab_title',
			[
				'label' => esc_html__('Normal', 'boatrental'),
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography_title',
				'label' => esc_html__('Typography', 'boatrental'),
				'selector' => '{{WRAPPER}} .br-blog-title',

			]
		);
		$this->add_control(
			'color_title',
			[
				'label' => esc_html__('Color', 'boatrental'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .br-blog-title' => 'color : {{VALUE}};',
				],
			]
		);


		$this->end_controls_tab();


		$this->start_controls_tab(
			'style_hover_tab_title',
			[
				'label' => esc_html__('Hover', 'boatrental'),
			]
		);

		$this->add_control(
			'color_title_hover',
			[
				'label' => esc_html__('Color Hover', 'boatrental'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .br-blog-title:hover' => 'color : {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'hr_title',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$this->add_responsive_control(
			'margin_title',
			[
				'label' => esc_html__('Margin', 'boatrental'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .br-blog-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'align_title',
			[
				'label' => esc_html__('Alignment', 'boatrental'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__('Left', 'boatrental'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'boatrental'),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__('Right', 'boatrental'),
						'icon' => 'eicon-text-align-right',
					],
				],
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .br-blog-title' => 'text-align: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();
		//END SECTION TAB STYLE TITLE

		//SECTION TAB STYLE EXCERT
		$this->start_controls_section(
			'section_excerpt',
			[
				'label' => esc_html__('Excerpt', 'boatrental'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography_excerpt',
				'label' => esc_html__('Typography', 'boatrental'),
				'selector' => '{{WRAPPER}} .excerpt p',

			]
		);

		$this->add_control(
			'color_excerpt',
			[
				'label' => esc_html__('Color', 'boatrental'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .excerpt p' => 'color : {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'margin_excerpt',
			[
				'label' => esc_html__('Margin', 'boatrental'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .excerpt p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'align_excerpt',
			[
				'label' => esc_html__('Alignment', 'boatrental'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__('Left', 'boatrental'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'boatrental'),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__('Right', 'boatrental'),
						'icon' => 'eicon-text-align-right',
					],
				],
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .excerpt' => 'text-align: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();
		//END SECTION TAB STYLE EXCERPT


		//SECTION TAB STYLE BUTTON
		$this->start_controls_section(
			'section_button',
			[
				'label' => esc_html__('Button', 'boatrental'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs('style_tabs');

		$this->start_controls_tab(
			'style_normal_tab_button',
			[
				'label' => esc_html__('Normal', 'boatrental'),
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'readmore_typography',
				'selector' => '{{WRAPPER}} .readmore ',
			]
		);

		$this->add_control(
			'color_readmore',
			[
				'label' => esc_html__('Color', 'boatrental'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .readmore ' => 'color : {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'color_readmore_background',
			[
				'label' => esc_html__('Background', 'boatrental'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .readmore' => 'background-color : {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'Border',
				'label' => esc_html__('Border', 'boatrental'),
				'selector' => '{{WRAPPER}} .readmore',
			]
		);

		$this->add_control(
			'select_border_radius_button',
			array(
				'label' => esc_html__('Border Radius', 'boatrental'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', '%'),
				'selectors' => array(
					'{{WRAPPER}} .readmore' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);


		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_hover_tab_button',
			[
				'label' => esc_html__('Hover', 'boatrental'),
			]
		);

		$this->add_control(
			'color_readmore_hover',
			[
				'label' => esc_html__('Color Hover', 'boatrental'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .readmore:hover ' => 'color : {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'color_readmore_hover_background',
			[
				'label' => esc_html__('Background Hover', 'boatrental'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .readmore:hover' => 'background-color : {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ova_button_border_color_hover',
			[
				'label' => esc_html__('Border color', 'boatrental'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .readmore:hover' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'hr_button',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$this->add_responsive_control(
			'margin_readmore',
			[
				'label' => esc_html__('Margin', 'boatrental'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .readmore ' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'padding_readmore',
			[
				'label' => esc_html__('Padding', 'boatrental'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .readmore ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		//END SECTION TAB STYLE BUTTON
	}

	// Render Template Here
	protected function render()
	{

		$settings = $this->get_settings_for_display();
		$version = $settings['version'];

		$category = $settings['category'];
		$total_count = $settings['total_count'];
		$order_ad = $settings['order_by_ad'];
		$order_by = $settings['order_by'];
		$number_column = $settings['number_column'];

		$text_readmore = $settings['text_readmore'];
		
		$show_read_more = $settings['show_read_more'];
		$icon = $settings['icon']['value'];

		$args = [];
		if ($category == 'all') {
			$args = [
				'post_type' => 'post',
				'posts_per_page' => $total_count,
				'order' => $order_ad,
				'orderby' => $order_by
			];
		} else {
			$args = [
				'post_type' => 'post',
				'category_name' => $category,
				'posts_per_page' => $total_count,
				'order' => $order_ad,
				'orderby' => $order_by
			];
		}

		$blog = new \WP_Query($args);

		if ($version == 'version_1') {


?>

			<div class="yacht-blog">


				<ul class="br-blogs-wrapper column<?php echo $number_column;?>">
					<?php
					if ($blog->have_posts()) :
						while ($blog->have_posts()) :
							$blog->the_post();

							$blog_img = wp_get_attachment_image_url(get_post_thumbnail_id(), 'boatrental_thumbnail');
							$categories = get_the_category();
							$image_alt = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', TRUE);

					?>
							<li class="br-blog-list post-wrap">
								<div class="br-head-blog">
									<?php if ($blog_img) { ?>
										<a href="<?php echo esc_attr(get_the_permalink()); ?>" title="<?php the_title_attribute(); ?>">
											<img alt="<?php echo esc_attr($image_alt); ?>" src="<?php echo esc_url($blog_img); ?>" class="br-blog-img">
										</a>
									<?php } else { ?>
										<a href="<?php echo esc_attr(get_the_permalink()); ?>" title="<?php the_title_attribute(); ?>">
											<img alt="<?php echo esc_attr($image_alt); ?>" src="<?php echo esc_url(boatrental_no_image); ?>" class="br-blog-img">
										</a>
									<?php } ?>
								</div>

								<div class="br_foot_blog">
									<h5 class="br-blog-title">
										<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									</h5>

									<div class="excerpt br-blog-description">
										<?php echo custom_excerpt(get_the_excerpt(), 13); ?>
									</div>

									<?php if ($show_read_more == 'yes') { ?>
										<a class="br-blog-btn" href="<?php the_permalink(); ?>">
											<?php echo esc_html($text_readmore); ?>
											<i class="<?php echo esc_attr($icon); ?>"></i>
										</a>
									<?php } ?>
								</div>
							</li>

					<?php
						endwhile;
					endif;
					wp_reset_postdata();
					?>
				</ul>

			</div>

		<?php
		} else { ?>
			<div class="yacht-blog version2 blog_layout2">
				<div class="br-blog-wrap">
					<?php
					$args = array(
						'post_type' => 'post', // Replace 'post' with your custom post type if applicable
						'posts_per_page' => 4, // Number of posts to display
						'orderby' => 'date', // Sort by date
						'order' => 'DESC' // Display in descending order (latest first)
					);

					// $query = new WP_Query($args);

					if ($blog->have_posts()) :
						while ($blog->have_posts()) : $blog->the_post();
							$post_id = get_the_ID();
							$thumbnail_url = wp_get_attachment_url(get_post_thumbnail_id($post_id)); // Get the featured image URL
					?>
							<div class="br-post-content <?php echo $blog->current_post === 0 ? 'blog-left' : 'blog-right'; ?>">
								<?php if ($blog->current_post === 0) : ?>
									<div class="post_media">
										<div class="br-post-image">
											<img src="<?php echo $thumbnail_url ? $thumbnail_url : boatrental_no_image; ?>" alt="Post Image">
										</div>
									</div>
								<?php endif; ?>
								<div class="post-title">
									<h3 class="br-product-title">
										<a href="<?php the_permalink(); ?>" class="post-link" data-excerpt="<?php the_excerpt(); ?>" data-post_id="<?php echo $post_id; ?>" data-thumbnail_id="<?php echo $thumbnail_url; ?>" title="<?php the_title(); ?>">
											<?php the_title(); ?>
										</a>
									</h3>
								</div>
								<div class="post-excerpt">
									<?php echo custom_excerpt(get_the_excerpt(), 13); ?>
								</div>
								<?php if ($show_read_more == 'yes') { ?>
									<div class="post-readmore">
										<a href="<?php the_permalink(); ?>" class="viewdetail">
										<?php echo esc_html($text_readmore); ?>
										</a>
										<i class="<?php echo esc_attr($icon); ?>"></i>
									</div>
								<?php } ?>
								
							</div>
					<?php
						endwhile;
						wp_reset_postdata();
					else :
						echo 'No posts found.';
					endif;
					?>
				</div>

			</div>




<?php
		}
	}
}

$widgets_manager->register_widget_type(new Boatrental_Elementor_Blog());
