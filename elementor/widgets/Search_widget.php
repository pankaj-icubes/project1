<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use Elementor\Utils;

if (!defined('ABSPATH'))
	exit;


class Boatrental_Elementor_Search extends Widget_Base
{


	public function get_name()
	{
		return 'boatrental_elementor_search';
	}

	public function get_title()
	{
		return esc_html__('Search & Filter', 'boatrental');
	}

	public function get_icon()
	{
		return 'eicon-search';
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
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'version_1',
				'options' => [
					'version_1' => esc_html__('Version 1', 'boatrental'),
					'version_2' => esc_html__('Version 2', 'boatrental'),
				],
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
					'{{WRAPPER}} .search_widgets_form' => 'text-align: {{VALUE}}',
				],
			]
		);
		// Add Class control

		$this->add_control(
			'show_date',
			[
				'label' => esc_html__('Show Date', 'boatrental'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'boatrental'),
				'label_off' => esc_html__('Hide', 'boatrental'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'text_start_date',
			[
				'label' => esc_html__('Text Start Date', 'boatrental'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Choose Date', 'boatrental'),
				'condition' => [
					'show_date' => 'yes'
				]
			]
		);

		$this->add_control(
			'text_end_date',
			[
				'label' => esc_html__('Text End Date', 'boatrental'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Choose Date', 'boatrental'),
				'condition' => [
					'show_date' => 'yes'
				]
			]
		);

		$this->add_control(
			'show_location',
			[
				'label' => esc_html__('Show Location', 'boatrental'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'boatrental'),
				'label_off' => esc_html__('Hide', 'boatrental'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'text_location',
			[
				'label' => esc_html__('Text Location', 'boatrental'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Location', 'boatrental'),
				'condition' => [
					'show_location' => 'yes'
				]
			]
		);

		$this->add_control(
			'show_guest',
			[
				'label' => esc_html__('Show Guest', 'boatrental'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'boatrental'),
				'label_off' => esc_html__('Hide', 'boatrental'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'text_guest',
			[
				'label' => esc_html__('Text Guest', 'boatrental'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('No of Guests', 'boatrental'),
				'condition' => [
					'show_guest' => 'yes'
				]
			]
		);


		$this->add_control(
			'show_yacht_type',
			[
				'label' => esc_html__('Show Yach Type', 'boatrental'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'boatrental'),
				'label_off' => esc_html__('Hide', 'boatrental'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'text_yacht_type',
			[
				'label' => esc_html__('Text yacht type', 'boatrental'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Yacht of Type', 'boatrental'),
				'condition' => [
					'show_yacht_type' => 'yes'
				]
			]
		);

		$this->add_control(
			'show_cabin',
			[
				'label' => esc_html__('Show Cabin', 'boatrental'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'boatrental'),
				'label_off' => esc_html__('Hide', 'boatrental'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'text_cabin',
			[
				'label' => esc_html__('Text Cabin', 'boatrental'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Cabin No', 'boatrental'),
				'condition' => [
					'show_cabin' => 'yes'
				]
			]
		);


		$this->add_control(
			'icon',
			[
				'label' => esc_html__('Icon', 'boatrental'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fa fa-arrow-right',
					'library' => 'solid',
				],
				
			]
		);

		$this->end_controls_section();
		//END SECTION CONTENT

		//----------------------- STYLE---------------------//


	}

	// Render Template Here
	protected function render()
	{

		$settings = $this->get_settings_for_display();
		$version = $settings['version'];

		$show_date = $settings['show_date'];
		$show_location = $settings['show_location'];
		$show_guest = $settings['show_guest'];
		$show_yacht_type = $settings['show_yacht_type'];
		$show_cabin = $settings['show_cabin'];
		// text
		$text_start_date = $settings['text_start_date'];
		$text_end_date = $settings['text_end_date'];
		$text_location = $settings['text_location'];
		$text_guest = $settings['text_guest'];
		$text_cabin = $settings['text_cabin'];
		$text_yacht_type = $settings['text_yacht_type'];
		
		
		$icon = $settings['icon']['value'];
		if(empty($icon)){
			$icon = 'fas fa-arrow-right';
		}

		$terms = get_terms(
			array(
				'taxonomy' => 'location',
				'orderby' => 'ASC',
				'order' => 'ID',
			)
		);

		$guests = get_terms( array(
			'taxonomy'   => 'pa_guest',
			'hide_empty' => false,
			'orderby'    => 'slug',
			'order'      => 'ASC',
		) );

		$cabins = get_terms( array(
			'taxonomy'   => 'pa_cabins',
			'hide_empty' => false,
			'orderby'    => 'slug',
			'order'      => 'ASC',
		) );

		$yacht_type = get_terms(
			array(
			'taxonomy' => 'product_cat', // Assuming 'product_cat' is the taxonomy for boat types
			'hide_empty' => false,
			)
		);
?>


		<div class="br-yacht-search-wrapper br-light search_widgets_form">


			<div class="yacht-search-form">
				<form method="GET" action="<?php echo esc_url(home_url('shop/')); ?>" id="search-form">
					<input id="search-input" type="hidden" placeholder="<?php echo esc_attr_x('Search &hellip;', 'placeholder', 'boatrental'); ?>" value="<?php echo get_search_query(); ?>" name="s">

					<div class="form-column-group">
						<?php if ($show_date== 'yes') { ?>
							<div class="form-group">
								<label for="date"><?php echo esc_html($text_start_date); ?></label>
								<input type="date" id="yachtsearch-startdate" name="startdate" placeholder="Start Date">
							</div>

							<div class="form-group ">
								<label for="date"><?php echo esc_html( $text_end_date ); ?></label>
								<input type="date" id="yachtsearch-enddate" name="enddate" placeholder="End Date">
							</div>
						<?php } 
						if ($show_location== 'yes') { 
						?>
						<div class="form-group">
							<label for="destination"><?php echo esc_html( $text_location ); ?> </label>
							<select class="form-control" name="pro_location[]" id="yachtsearch-location">
								<option value>Select location</option>
								<?php
								if ($terms && !is_wp_error($terms)) :
									foreach ($terms as $term) : ?>
										<option value="<?php echo $term->term_id; ?>"><?php echo $term->name; ?></option>
								<?php endforeach;
								endif; ?>

							</select>
						</div>
						<?php } 
						if ($show_guest== 'yes') { 
							?>
						<div class="form-group">
							<label for="guests"><?php echo esc_html( $text_guest ); ?></label>
							<select class="form-control" name="filter_guest" id="yachtsearch-guests">
								<option value>Select guest</option>
								<?php
								foreach ( $guests as $guest ) {
									echo '<option value="' . esc_attr( $guest->slug ) . '">' . esc_html( $guest->name.' guest' ) . '</option>';
								}
								?>
							</select>
						</div>
						<?php } 
						if ($show_yacht_type== 'yes') { 
							?>
						<div class="form-group">
							<label for="guests"><?php echo esc_html( $text_yacht_type ); ?></label>
							<select class="form-control" name="yachttype[]" id="yachtsearch-type">
								<option value>Select yacht</option>
								<?php
								if ($yacht_type && !is_wp_error($yacht_type)) :
									foreach ($yacht_type as $term) : ?>
										<option value="<?php echo $term->term_id; ?>"><?php echo $term->name; ?></option>
								<?php endforeach;
								endif; ?>
							</select>
						</div>
						<?php } 
						if ($show_cabin== 'yes') { 
							?>
						<div class="form-group">
							<label for="guests"><?php echo esc_html( $text_cabin ); ?></label>
							<select class="form-control" name="filter_cabins" id="yachtsearch-cabin">
								<option value="0">Select cabin</option>
								<?php
								foreach ( $cabins as $cabin ) {
									echo '<option value="' . esc_attr( $cabin->slug ) . '">' . esc_html( 'cabin '.$cabin->name ) . '</option>';
								}
								?>
							</select>
						</div>
						<?php } ?>
					</div>
					<?php if($version == 'version_1'){ ?>
					<div class="br-button-- btn-white form-group submit-btn btn-v1">
						<button type="submit" class="br-button">
							<span  class="br-button__text">
								<i class="<?php echo esc_attr($icon); ?>" aria-hidden="true"></i>Search & Filter
							</span>
						</button>
					</div>

					<?php } if($version == 'version_2'){ ?>
					<div class="form-group submit-btn btn-v2">
						<button type="submit"> 
						<i class="<?php echo esc_attr($icon); ?>" aria-hidden="true"></i>
						Search & Filter
						</button>
					</div>
					<?php } 
					?>




				</form>
			</div>


		</div>

<?php }
}

$widgets_manager->register_widget_type(new Boatrental_Elementor_Search());
