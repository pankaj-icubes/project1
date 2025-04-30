<?php
$lib_dire = trailingslashit( str_replace( '\\', '/', get_template_directory() . '/lib/' ) );

if( !defined('boatrental_dir') ){
	define( 'boatrental_dir', $lib_dire );
}

if( !defined('boatrental_lib_url') ){
	define( 'boatrental_lib_url', trailingslashit( get_template_directory_uri() ) . 'lib' );
}



define("BoatRental_PRODUCT_TYPE","product");
define("BoatRental_PRODUCT_DETAIL_TYPE","product_detail");
if(!class_exists('BoatRental_Options')){
	get_template_part('lib/options/options');
}


function BoatRental_setup()
{
    global $BoatRental_options , $options_args , $options;
	$options = array();
	


	$args = array(
		'post_type' => 'page', // Specify the post type as 'page'
		'posts_per_page' => -1, // Get all pages
	);
	$pages_list = get_pages( $args );
	
		// Initialize an empty array for custom homepage options
		$homepage_args = array();

		
		// Loop through the existing pages and add them to the custom homepage options
		foreach ($pages_list as $page) {
			if (strpos($page->post_title, 'Home') !== false) {
				$homepage_args[$page->post_title] = $page->post_title;
			}
		}


    $options[] = array(
		'title'=>esc_html('General','BoatRental'),
		'desc'=> wp_kses( __('<p class="description">The theme allows you to customize your style directly from the backend, no coding expertise required. In the "General" settings, easily adjust fundamental options like site layout, homepage layout and logo to suit your preferences.</p>','BoatRental'),array('p'=>array('class'=>array()))),
		'icon' => 'fas fa-cog',
		'fields'=> array(
              
			   array(
				'id' => 'site_layout',
				'type' => 'select',
				'title' => esc_html__('Site Layout', 'BoatRental'),
				'sub_desc' => esc_html__( 'Select the site layout.', 'BoatRental' ),
				'options' => array(
					'light'	=>  esc_html__( 'Light Layout', 'BoatRental' ),
					'dark' =>  esc_html__( 'Dark Layout', 'BoatRental' )								
				),
				'std' => 'light',
				),
				array(
					'id' => 'home_page_layout',
					'type' => 'select',
					'title' => esc_html__('Homepage Layout', 'BoatRental'),
					'sub_desc' => esc_html__( 'Select the home page layout.', 'BoatRental' ),
					'options' => $homepage_args,
					'std' => 'Home v1',
					),
			   array(
				'id' => 'sitelogo',
				'type' => 'upload',
				'title' => esc_html__('Logo', 'BoatRental'),
				'sub_desc' => esc_html__( 'Upload the logo.', 'BoatRental' ),
				'std' => ''
				),
				
				

		)
	) ;

	$options[] = array(
		'title' => esc_html__('Color Scheme', 'BoatRental'),
		'desc' => wp_kses( __('<p class="description">The "Color Scheme" options allow you to select and customize the color palette for your website, including primary and secondary colors.</p>', 'BoatRental'), array( 'p' => array( 'class' => array() ) ) ),
		'icon' => 'fas fa-paint-brush',
		'fields' => array(		
			array(
				'id' => 'Primary_Color',
				'type' => 'color',
				'title' => esc_html__('Primary color', 'BoatRental'),
				'sub_desc' => esc_html__('Select the primary color.', 'BoatRental'),
				'std' => '#e09145'
				),
			
			array(
				'id' => 'Secondry_Color',
				'type' => 'color',
				'title' => esc_html__('Secondary color', 'BoatRental'),
				'sub_desc' => esc_html__('Select the secondary color.', 'BoatRental'),
				'std' => '#292c35'
				),
	
			)
	);

$options[] = array(
	'title' => esc_html__('Header', 'BoatRental'),
	'desc' => wp_kses( __('<p class="description">In the "Header" settings, you can control the header`s appearance and functionality.</p>', 'BoatRental'), array( 'p' => array( 'class' => array() ) ) ),
	'icon' => 'fas fa-certificate',
	'fields'=>array(
		array(
		'id' => 'disable_top_header',
		'title' => esc_html__( 'Disable Menu', 'BoatRental' ),
		'type' => 'checkbox',
		'sub_desc' => esc_html__( 'Disabling the menu removes the navigation menu.', 'BoatRental' ),
		'desc' => '',
		'std' => '0'
		),
		array(
		'id' => 'Top_header_style',
		'type' => 'select',
		'title' => esc_html__('Header Version', 'BoatRental'),
		'sub_desc' => esc_html__('Select the header version.', 'BoatRental'),
		'options' => array(
				'version1'  => esc_html__( 'Version 1', 'BoatRental' ),
				'version2'  => esc_html__( 'Version 2', 'BoatRental' ),
		),
		'std' => 'version2'
		),
        
			array(
				'id' => 'disable_search',
				'title' => esc_html__( 'Disable Search', 'BoatRental' ),
				'type' => 'checkbox',
				'sub_desc' => esc_html__( 'Disables the search option.', 'BoatRental' ),
				'desc' => '',
				'std' => '0'
				),
			
			
		    			
			
)
);	
$options[] = array(
	'title' => esc_html__('Footer', 'BoatRental'),
	'desc' => wp_kses( __('<p class="description">Settings for customizing the footer.</p>', 'BoatRental'), array( 'p' => array( 'class' => array() ) ) ),
	'icon' => 'fas fa-th-large',
	'fields'=>array(
		array(
		'id' => 'footer_logo',
		'type' => 'upload',
		'title' => esc_html__('Footer Logo', 'BoatRental'),
		'sub_desc' => 'Upload footer logo.',
		'std' => ''
		),
		array(
			'id' => 'main_footer_style',
			'type' => 'select',
			'title' => esc_html__('Footer Version', 'BoatRental'),
			'sub_desc' => esc_html__('Select the footer version.', 'BoatRental'),
			'options' => array(
					'layout1'  => esc_html__( 'Version 1', 'BoatRental' ),
					'layout2'  => esc_html__( 'Version 2', 'BoatRental' ),
			),
			'std' => 'layout2'
			),
		array(
		'id' => 'disable_footer',
		'title' => esc_html__( 'Disable Footer', 'BoatRental' ),
		'type' => 'checkbox',
		'sub_desc' => esc_html__( 'Disabling the footer removes the entire footer section.', 'BoatRental' ),
		'desc' => '',
		'std' => '0'
		),
		
		
			
			
			array(
				'id' => 'footer_copyright',
				'type' => 'editor',
				'sub_desc' => 'Enter the copyright text.',
				'title' => esc_html__( 'Copyright', 'BoatRental'),
				'std'=> 'Boat Rental. All Rights Reserved'
				),

				array(
				'id' => 'footer_address',
				'type' => 'editor',
				'sub_desc' => 'Enter the business address.',
				'title' => esc_html__( 'Address', 'BoatRental'),
				'std'=> '123 Main Street, Anytown, USA 12345'
				),	
				
				array(
					'id' => 'footer_phone_number',
					'type' => 'text',
					'sub_desc' => 'Enter the phone number.',
					'title' => esc_html__( 'Phone Number', 'BoatRental'),
					'std'=> '+1 001 1234 342'
					),	

					
				array(
					'id' => 'footer_email',
					'type' => 'text',
					'sub_desc' => 'Enter the email.',
					'title' => esc_html__( 'Email', 'BoatRental'),
					'std'=> 'email@gmail.com'
					),	
	
			
					
			
)
);
$options[] = array(
	'title' => __('Social', 'BoatRental'),
	'desc' => wp_kses( __('<p class="description">Under the "Social" settings, you can input your social media profiles, enabling easy sharing and linking on your website.</p>', 'BoatRental'), array( 'p' => array( 'class' => array() ) ) ),
	'icon' => 'fas fa-share',
	'fields' => array(
		array(
			'id' => 'share_link_fb',
			'title' => esc_html__( 'Facebook', 'BoatRental' ),
			'type' => 'text',
			'sub_desc' => '',
			'desc' => '',
			'std' => '',
			),
		array(
			'id' => 'share_link_tw',
			'title' => esc_html__( 'Linkedin', 'BoatRental' ),
			'type' => 'text',
			'sub_desc' => '',
			'desc' => '',
			'std' => '',
			),
		array(
			'id' => 'share_twitter',
			'title' => esc_html__( 'Twitter', 'BoatRental' ),
			'type' => 'text',
			'sub_desc' => '',
			'desc' => '',
			'std' => '',
			),
		
		array(
			'id' => 'share_link_instagram',
			'title' => esc_html__( 'Instagram', 'BoatRental' ),
			'type' => 'text',
			'sub_desc' => '',
			'desc' => '',
			'std' => '',
			),
		array(
			'id' => 'share_pinterest',
			'title' => esc_html__( 'Pinterest', 'BoatRental' ),
			'type' => 'text',
			'sub_desc' => '',
			'desc' => '',
			'std' => '',
			),
		array(
			'id' => 'share_link_youtube',
			'title' => esc_html__( 'Youtube', 'BoatRental' ),
			'type' => 'text',
			'sub_desc' => '',
			'desc' => '',
			'std' => '',
			)
		),
		array(
			'id' => 'share_vimeo',
			'title' => esc_html__( 'Vimeo', 'BoatRental' ),
			'type' => 'text',
			'sub_desc' => '',
			'desc' => '',
			'std' => '',
			)
);

$options[] = array(
	'title'=> esc_html__('Typography','BoatRental'),
	'desc' => wp_kses( __('<p class="description">The "Typography" options let you configure font styles and sizes for different sections of your website, ensuring a consistent and attractive text presentation.</p>', 'BoatRental'), array( 'p' => array( 'class' => array() ) ) ),
	'icon' => 'fas fa-font',
    'fields'=>array(
		array(
			'id'=>'info_typo1',
			'type'=>'info',
			'title'=>esc_html('Global Typography','BoatRental'),
			'desc' => '',
			'class' => 'boatRental-heading'
		),
		array(
			'id'=>'google_webfonts',
			'type'=>'google_webfonts',
			'title' => esc_html__('Font Family', 'BoatRental'),
			'sub_desc' => esc_html__( 'Select the font family.', 'BoatRental' ), 
			'std' => 'Poppins'
			),
			
			array(
				'id' => 'webfonts_weight',
				'class' => 'boatrental-opt-info br_font_weight',
				'type' => 'select',
				'sub_desc' => esc_html__( 'Select the font weight in pixels.
				', 'BoatRental' ),
				'title' => esc_html__('Font Weight', 'BoatRental'),
				'options' => array(
					'100' => '100',
					'200' => '200',
					'300' => '300',
					'400' => '400',
					'500' => '500',
					'600' => '600',
					'700' => '700',
					'800' => '800',
					'900' => '900'
					),
				'std' => '400'
				),
			array(
				'id' => 'info_typo2',
				'type' => 'info',
				'title' => esc_html( 'Heading Typography', 'BoatRental' ),
				'desc' => '',
				'class' => 'boatRental-heading'
				),
			
			array(
			'id' => 'tag_font_family',
			'type' => 'google_webfonts',
			'title' => esc_html__('Font Family', 'BoatRental'),
			'sub_desc' => esc_html__( 'Select the font family.', 'BoatRental' ), 
			'std' => 'Yeseva One'
			),
			array(
				'id' => 'tag_fonts_weight',
				'type' => 'select',
				'sub_desc' => esc_html__( 'Select the font weight in pixels.
				', 'BoatRental' ),
				'title' => esc_html__('Font Weight', 'BoatRental'),
				'options' => array(
					'100' => '100',
					'200' => '200',
					'300' => '300',
					'400' => '400',
					'500' => '500',
					'600' => '600',
					'700' => '700',
					'800' => '800',
					'900' => '900'
					),
				'std' => '500'
				),

				array(
					'id' => 'info_typo3',
					'type' => 'info',
					'title' => esc_html( 'Font Size', 'BoatRental' ),
					'desc' => '',
					'class' => 'boatRental-heading'
					),
				
				array(
					'id' => 'h1_tag_fontsize',
					'type' => 'text',
					'title' => esc_html__('Heading H1', 'BoatRental'),
					'sub_desc' => esc_html__( 'Enter font size in pixels.', 'BoatRental' ),
					'std' => 40
					),
				array(
					'id' => 'h2_tag_fontsize',
					'type' => 'text',
					'title' => esc_html__('Heading H2', 'BoatRental'),
					'sub_desc' => esc_html__( 'Enter font size in pixels.', 'BoatRental' ),
					'std' => 32
					),
				array(
					'id' => 'h3_tag_fontsize',
					'type' => 'text',
					'title' => esc_html__('Heading H3', 'BoatRental'),
					'sub_desc' => esc_html__( 'Enter font size in pixels.', 'BoatRental' ),
					'std' => 28
					),
					array(
						'id' => 'h4_tag_fontsize',
						'type' => 'text',
						'title' => esc_html__('Heading H4', 'BoatRental'),
						'sub_desc' => esc_html__( 'Enter font size in pixels.', 'BoatRental' ),
						'std' => 24
						),
					array(
						'id' => 'h5_tag_fontsize',
						'type' => 'text',
						'title' => esc_html__('Heading H5', 'BoatRental'),
						'sub_desc' => esc_html__( 'Enter font size in pixels.', 'BoatRental' ),
						'std' => 20
						),
					array(
						'id' => 'h6_tag_fontsize',
						'type' => 'text',
						'title' => esc_html__('Heading H6', 'BoatRental'),
						'sub_desc' => esc_html__( 'Enter font size in pixels.', 'BoatRental' ),
						'std' => 16
						),
			
			
		    				
		
	)	
);
$options[] = array(
	'title' => esc_html__('Blog', 'BoatRental'),
	'desc' => wp_kses( __('<p class="description">Within the "Blog," you can customize settings related to your blog page, such as layouts, sidebar, and post formats.</p>', 'BoatRental'), array( 'p' => array( 'class' => array() ) ) ),
	'icon' => 'fas fa-comment',
	'fields' => array(

		array(
			'id' => 'info_typo2',
			'type' => 'info',
			'title' => esc_html( 'Blog page', 'BoatRental' ),
			'desc' => '',
			'class' => 'boatRental-heading'
			),

			array(
				'id' => 'blog_col',
				'type' => 'select',
				'title' => esc_html__('Page Layout', 'BoatRental'),
				'sub_desc' => esc_html__( 'Select the number of blogs to display in each row.', 'BoatRental' ),
				'options' => array(
					'1' => '1',
					'2' => '2',
					'3' => '3',				
					),
				'std' => '3',
				),
	
		
		array(
			'id' => 'info_typo2',
			'type' => 'info',
			'title' => esc_html( 'Individual page', 'BoatRental' ),
			'desc' => '',
			'class' => 'boatRental-heading'
			),
		array(
			'id' => 'sidebar_blog',
			'type' => 'select',
			'title' => esc_html__('Sidebar Position', 'BoatRental'),
			'sub_desc' => esc_html__( 'Select sidebar position for individual page.', 'BoatRental' ),
			'options' => array(
			'left'	=>  esc_html__( 'Left Sidebar', 'BoatRental' ),
			'right' => esc_html__( 'Right Sidebar', 'BoatRental' ),
			'full' => esc_html__( 'None', 'BoatRental' ),	
			),
			'std' => 'right',
			),	

			
			array(
				'id' => 'single_blog_layout',
				'type' => 'select',
				'title' => esc_html__('Page Layout', 'BoatRental'),
				'sub_desc' => esc_html__( 'Select the individual page layout.
				', 'BoatRental' ),
				'options' => array(
				'version_1' => esc_html__( 'Layout 1', 'BoatRental' ),		
				'version_2'	=>  esc_html__( 'Layout 2', 'BoatRental' ),
				),
				'std' => 'version_1',
				),	
			
)
);

$options[] = array(
	'title' => esc_html__('Shop', 'BoatRental'),
	'desc' => wp_kses( __('<p class="description">Customize shop page options easily with our user-friendly settings. Enhance your online store today.</p>', 'BoatRental'), array( 'p' => array( 'class' => array() ) ) ),
	'icon' => 'fas fa-shopping-bag',
	'fields' => array(
			array(
			'id' => 'category_col',
			'type' => 'select',
			'title' => esc_html__('Products Columns', 'BoatRental'),
			'sub_desc' => esc_html__( 'Select the number of product to display in each row.', 'BoatRental' ),
			'options' => array(
				'1' => '1',
				'2' => '2',
				'3' => '3',
									
				),
			'std' => '3',
			),

		array(
			'id' => 'product_col_page',
			'type' => 'select',
			'title' => esc_html__('Products Per Column', 'BoatRental'),
			'options' => array(
				'1' => '1',
				'2' => '2',
				'3' => '3',
				'4' => '4',
				'5' => '5',
				'6' => '6',
				'7' => '7',
				'8' => '8',
				'9' => '9',
				'10' => '10',
				
				),
			'std' => '5',
			'sub_desc' => esc_html__( 'Select the number of products to display in each column.', 'BoatRental' ),
		),

		array(
			'id' => 'product_category_enable',
			'title' => esc_html__( 'Disable Product Type', 'BoatRental' ),
			'type' => 'checkbox',
			'sub_desc' => 'Disabling product types means associated icons (Catamaran, Sailboat, Cruiser, etc.) won`t be displayed.',
			'std' => '1'
			),
	)			
);

$options[] = array(
	'title' => esc_html__('Product Page ', 'BoatRental'),
	'desc' => wp_kses( __('<p class="description">Customize product page options easily with our user-friendly settings. Enhance your online store today.</p>', 'BoatRental'), array( 'p' => array( 'class' => array() ) ) ),
	'icon' => 'fas fa-shopping-cart',
	'fields' => array(
		
	array(
	'id' => 'info_typo1',
	'type' => 'info',
	'title' => esc_html( 'Individual Product Page ', 'BoatRental' ),
	'desc' => '',
	'class' => 'boatRental-heading'
	),


	array(
	'id' => 'product_layout',
	'type' => 'select',
	'title' => esc_html__('Page Layout', 'BoatRental'),
	'options' => array(
		'layout_1' 	=>  esc_html__( 'Layout 1', 'BoatRental' ),
		'layout_2'	=>  esc_html__( 'Layout 2', 'BoatRental' ),
		'layout_3'	=>  esc_html__( 'Layout 3', 'BoatRental' )											
	),
	'std' => 'layout_1',
	'sub_desc' => esc_html__( 'Select the individual product page layout.', 'BoatRental' ),
	),





	// ================ WooCommerce product Tab  =====================//

	array(
		'id' => 'info_typo2',
		'type' => 'info',
		'title' => esc_html( 'WooCommerce Product Information Tabs', 'BoatRental' ),
		'desc' => '',
		'class' => 'boatRental-heading'
		),
		
	array(
		'id' => 'tab_description',
		'type' => 'text',
		'title' => esc_html__('Description Title', 'BoatRental'),
		'sub_desc' => esc_html__( 'Enter the title.', 'BoatRental' ),
		'std' => 'Description',
		
		),
	array(
		'id' => 'tab_description_icon',
		'type' => 'text',
		'title' => esc_html__('Description Icon', 'BoatRental'),
		'sub_desc' => esc_html__( 'Enter the Font Awesome icon.', 'BoatRental' ),
		'desc' => 'Please <a href="https://fontawesome.com/v4/icons/" target="_blank">browse Font Awesome icons</a>.',
		'std' => 'fas fa-file-alt',
		),
		
		array(
			'id' => 'technical_specification',
			'type' => 'text',
			'title' => esc_html__('Specification Title', 'BoatRental'),
			'sub_desc' => esc_html__( 'Enter the title.', 'BoatRental' ),
			'std' => 'Technical Specification'
			),
		array(
			'id' => 'technical_specification_icon',
			'type' => 'text',
			'title' => esc_html__('Specification Icon', 'BoatRental'),
			'sub_desc' => esc_html__( 'Enter the Font Awesome icon.', 'BoatRental' ),
			'desc' => 'Please <a href="https://fontawesome.com/v4/icons/" target="_blank">browse Font Awesome icons</a>.',
			'std' => 'fas fa-cog',
			),

		array(
			'id' => 'tab_reviews',
			'type' => 'text',
			'title' => esc_html__('Review Title', 'BoatRental'),
			'sub_desc' => esc_html__( 'Enter the title.', 'BoatRental' ),
			'std' => 'Review'
			),
		array(
			'id' => 'tab_reviews_icon',
			'type' => 'text',
			'title' => esc_html__('Review Icon', 'BoatRental'),
			'sub_desc' => esc_html__( 'Enter the Font Awesome icon.', 'BoatRental' ),
			'desc' => 'Please <a href="https://fontawesome.com/v4/icons/" target="_blank">browse Font Awesome icons</a>.',
			'std' => 'fas fa-comment',
			),
		array(
			'id' => 'tab_additional_information',
			'type' => 'text',
			'title' => esc_html__('Additional Information Title', 'BoatRental'),
			'sub_desc' => esc_html__( 'Enter the title.', 'BoatRental' ),

			'std' => 'Additional information'
			),
		array(
			'id' => 'tab_additional_information_icon',
			'type' => 'text',
			'title' => esc_html__('Additional information Icon', 'BoatRental'),
			'sub_desc' => esc_html__( 'Enter the Font Awesome icon.', 'BoatRental' ),
			'desc' => 'Please <a href="https://fontawesome.com/v4/icons/" target="_blank">browse Font Awesome icons</a>.',
			'std' => 'fas fa-info-circle',
			),


// ================ Custom product Tab  =====================//


array(
	'id' => 'info_typo3',
	'type' => 'info',
	'title' => esc_html( 'Custom Product Information Tabs', 'BoatRental' ),
	'desc' => '',
	'class' => 'boatRental-heading'
	),

	array(
	'id' => 'tab_title1_enable',
	'type' => 'checkbox',
	'title' => esc_html__('Disable Crew Profile', 'BoatRental'),
	'sub_desc' => esc_html__( 'Disabling this setting removes the Crew Profile.', 'BoatRental' ),
	'std' => '1'
	),

	array(
	'id' => 'tab_title1',
	'type' => 'text',
	'title' => esc_html__('Crew Profile Title', 'BoatRental'),
	'sub_desc' => esc_html__( 'Enter the title.', 'BoatRental' ),
	'std' => 'Crew Profile',
	),
	array(
		'id' => 'tab_title1_icon',
		'type' => 'text',
		'title' => esc_html__('Crew Profile Icon', 'BoatRental'),
		'sub_desc' => esc_html__( 'Enter the Font Awesome icon.', 'BoatRental' ),
		'desc' => 'Please <a href="https://fontawesome.com/v4/icons/" target="_blank">browse Font Awesome icons</a>.',
		'std'=> 'fas fa-user',
		),

	array(
		'id' => 'tab_title2_enable',
		'type' => 'checkbox',
		'title' => esc_html__('Disable Sample Menu', 'BoatRental'),
		'sub_desc' => esc_html__( 'Disabling this setting removes the Sample Menu.', 'BoatRental' ),
		
		'std' => '0',
		),

	array(
		'id' => 'tab_title2',
		'type' => 'text',
		'title' => esc_html__('Sample Menu Title', 'BoatRental'),
		'sub_desc' => esc_html__( 'Enter the title.', 'BoatRental' ),
		'std' => 'tab_title2',
		),
		array(
			'id' => 'tab_title2_icon',
			'type' => 'text',
			'title' => esc_html__('Sample Menu Icon', 'BoatRental'),
			'sub_desc' => esc_html__( 'Enter the Font Awesome icon.', 'BoatRental' ),
			'desc' => 'Please <a href="https://fontawesome.com/v4/icons/" target="_blank">browse Font Awesome icons</a>.',
			'std' => 'fas fa-utensils',
			),


	// ================ product Tab  =====================//

				
	// ================ product Info Tab  =====================//

		array(
			'id' => 'info_typo2',
			'type' => 'info',
			'title' => esc_html( 'Basic Product Specifications', 'BoatRental' ),
			'desc' => '',
			'class' => 'boatRental-heading'
			),

		array(
			'id' => 'tab_built_check',
			'type' => 'checkbox',
			'title' => esc_html__('Disable Year', 'BoatRental'),
			'sub_desc' => esc_html__( 'Disabling this will remove the year.', 'BoatRental' ),
			'std' => '0'
			),

		array(
			'id' => 'tab_built_year',
			'type' => 'text',
			'title' => esc_html__('Year Title', 'BoatRental'),
			'sub_desc' => esc_html__( 'Enter the title.', 'BoatRental' ),
			'std' => 'Year',
			),

		array(
			'id' => 'tab_built_icon',
			'type' => 'text',
			'title' => esc_html__('Year Icon', 'BoatRental'),
			'sub_desc' => esc_html__( 'Enter the Font Awesome icon.', 'BoatRental' ),
			'desc' => 'Please <a href="https://fontawesome.com/v4/icons/" target="_blank">browse Font Awesome icons</a>.',
			'std' => 'fa fa-anchor big',
			),

			
		array(
			'id' => 'tab_yacht_field__check',
			'type' => 'checkbox',
			'title' => esc_html__('Disable Length', 'BoatRental'),
			'sub_desc' => esc_html__( 'Disabling this will remove the length.', 'BoatRental' ),
			'std' => '0'
			),

		array(
			'id' => 'tab_yacht_field',
			'type' => 'text',
			'title' => esc_html__('Length Title', 'BoatRental'),
			'sub_desc' => esc_html__( 'Enter the title.', 'BoatRental' ),
			'std' => 'Length'
			),

		array(
			'id' => 'tab_yacht_field_icon',
			'type' => 'text',
			'title' => esc_html__('Length Icon', 'BoatRental'),
			'sub_desc' => esc_html__( 'Enter the Font Awesome icon.', 'BoatRental' ),
			'desc' => 'Please <a href="https://fontawesome.com/v4/icons/" target="_blank">browse Font Awesome icons</a>.',
			'std' => 'fas fa-expand'
			),

		array(
			'id' => 'tab_number_of_cabins_check',
			'type' => 'checkbox',
			'title' => esc_html__('Disable Cabins', 'BoatRental'),
			'sub_desc' => esc_html__( 'Disabling this will remove the cabins.', 'BoatRental' ),
			),

		array(
			'id' => 'tab_number_of_cabins',
			'type' => 'text',
			'title' => esc_html__('Cabins Title', 'BoatRental'),
			'sub_desc' => esc_html__( 'Enter the title.', 'BoatRental' ),
			'std' => 'Cabins',
			),

		array(
			'id' => 'tab_number_of_cabins_icon',
			'type' => 'text',
			'title' => esc_html__('Cabins Icon', 'BoatRental'),
			'sub_desc' => esc_html__( 'Enter the Font Awesome icon.', 'BoatRental' ),
			'desc' => 'Please <a href="https://fontawesome.com/v4/icons/" target="_blank">browse Font Awesome icons</a>.',
			'std' => 'fas fa-hotel',
			),

		array(
			'id' => 'tab_number_of_guest_check',
			'type' => 'checkbox',
			'title' => esc_html__('Disable Guest', 'BoatRental'),
			'sub_desc' => esc_html__( 'Disabling this will remove the guest.', 'BoatRental' ),
			'std' => '0',
			),

		array(
			'id' => 'tab_number_of_guest',
			'type' => 'text',
			'title' => esc_html__('Guest Title', 'BoatRental'),
			'sub_desc' => esc_html__( 'Enter the title.', 'BoatRental' ),
			'std' => 'Guest',
			),

		array(
			'id' => 'tab_number_of_guest_icon',
			'type' => 'text',
			'title' => esc_html__('Guest Icon', 'BoatRental'),
			'sub_desc' => esc_html__( 'Enter the Font Awesome icon.', 'BoatRental' ),
			'desc' => 'Please <a href="https://fontawesome.com/v4/icons/" target="_blank">browse Font Awesome icons</a>.',
			'std' => 'fas fa-user',
			),

		array(
			'id' => 'tab_total_crew_check',
			'type' => 'checkbox',
			'title' => esc_html__('Disable Crew', 'BoatRental'),
			'sub_desc' => esc_html__( 'Disabling this will remove the crew.', 'BoatRental' ),
			'std' => '0',
			),

		array(
			'id' => 'tab_total_crew',
			'type' => 'text',
			'title' => esc_html__('Crew Title', 'BoatRental'),
			'sub_desc' => esc_html__( 'Enter the title.', 'BoatRental' ),
			'std' => 'Number of crew',
			),

		array(
			'id' => 'tab_total_crew_icon',
			'type' => 'text',
			'title' => esc_html__('Crew Icon', 'BoatRental'),
			'sub_desc' => esc_html__( 'Enter the Font Awesome icon.', 'BoatRental' ),
			'desc' => 'Please <a href="https://fontawesome.com/v4/icons/" target="_blank">browse Font Awesome icons</a>.',
			'std' => 'fas fa-users',
			),

			array(
				'id' => 'tab_price_check',
				'type' => 'checkbox',
				'title' => esc_html__('Disable Price', 'BoatRental'),
				'sub_desc' => esc_html__( 'Disabling this will remove the price.', 'BoatRental' ),
				'std' => '0',
				),

			array(
				'id' => 'tab_price',
				'type' => 'text',
				'title' => esc_html__('Price Title', 'BoatRental'),
				'sub_desc' => esc_html__( 'Enter the title.', 'BoatRental' ),
				'std' => 'price',
				),

			array(
				'id' => 'tab_price_icon',
				'type' => 'text',
				'title' => esc_html__('Price Icon', 'BoatRental'),
				'sub_desc' => esc_html__( 'Enter the Font Awesome icon.', 'BoatRental' ),
				'desc' => 'Please <a href="https://fontawesome.com/v4/icons/" target="_blank">browse Font Awesome icons</a>.',
				'std' => 'fas fa-dollar-sign',
				),
		
	)			
);

	
    $options_args['opt_name'] = 'BoatRental_theme';
    $options_args['menu_title']= esc_html__('Theme Option','BoatRental');
	$options_args['page_title'] = esc_html__('Boat Rental Options', 'BoatRental');
	$options_args['page_slug'] = 'BoatRental_theme_options';
	$options_args['page_type'] = 'submenu';
    $BoatRental_options = new Boatrental_Options($options,$options_args);
 
}

add_action('admin_init','BoatRental_setup',0);
Boatrental_setup();

