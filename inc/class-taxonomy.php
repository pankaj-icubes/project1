<?php
/**
 * 
 * Class Boatrental_Taxonomy
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
Create custom taxonomy
=============================================================

*/


if (!defined('ABSPATH'))
	exit;

if (!class_exists('Boatrental_Taxonomy')) {

	class Boatrental_Taxonomy
	{

		public function __construct()
		{
			add_action('admin_enqueue_scripts', array($this, 'boatrental_image_uploader_enqueue'));
			add_action('init', array($this, 'create_location_taxonomy'));
			add_action('location_add_form_fields', array($this, 'location_add_form_fields'));
			add_action('created_location', array($this, 'location_taxonomy_save_meta_field'), 10, 2);
			add_action('edited_location', array($this, 'update_image_upload'), 10, 2);
			add_action('location_edit_form_fields', array($this, 'edit_image_upload'), 10, 2);
			add_filter('manage_edit-location_columns', array($this, 'location_taxonomy_custom_column'));
			add_action('manage_location_custom_column', array($this, 'location_taxonomy_custom_column_content'), 10, 3);

		}

		public function boatrental_image_uploader_enqueue()
		{
			global $typenow;
			if (($typenow == 'product')) {
				wp_enqueue_media();

				wp_register_script('meta-image', get_template_directory_uri() . '/assets/js/media-uploader.js', array('jquery'));
				wp_localize_script(
					'meta-image',
					'meta_image',
					array(
						'title' => 'Upload an Image',
						'button' => 'Use this Image',
					)
				);
				wp_enqueue_script('meta-image');
			}
		}

		public function location_add_form_fields($taxonomy)
		{
?>
			<div class="form-field term-group">
				<label for="image-upload"><?php esc_html_e('Upload an Image', 'boatrental'); ?></label>
				<input type="hidden" name="txt_upload_image" id="txt_upload_image" value="" style="width: 77%">
				<input type="button" id="upload_image_btn" class="button" value="Upload an Image" />
			</div>
		<?php
		}



		public function create_location_taxonomy()
		{
			$labels = array(
				'name' => __('Locations', 'boatrental'),
				'singular_name' => __('Location', 'boatrental'),
				'search_items' => __('Search Locations', 'boatrental'),
				'all_items' => __('All Locations', 'boatrental'),
				'parent_item' => __('Parent Location', 'boatrental'),
				'parent_item_colon' => __('Parent Location:', 'boatrental'),
				'edit_item' => __('Edit Location', 'boatrental'),
				'update_item' => __('Update Location', 'boatrental'),
				'add_new_item' => __('Add New Location', 'boatrental'),
				'new_item_name' => __('New Location Name', 'boatrental'),
				'menu_name' => __('Locations', 'boatrental'),
			);

			$args = array(
				'labels' => $labels,
				'public' => true,
				'hierarchical' => true,
				'show_ui' => true,
				'show_admin_column' => true,
				'show_in_nav_menus' => true,
				'show_tagcloud' => false,
				'rewrite' => array(
					'slug' => 'location',
					'with_front' => false
				),
			);

			register_taxonomy('location', array('product'), $args);
		}


		// Add form field for image upload
		public function location_taxonomy_save_meta_field($term_id, $tt_id)
		{
			if (isset($_POST['txt_upload_image']) && '' !== $_POST['txt_upload_image']) {
				add_term_meta($term_id, 'term_image', $_POST['txt_upload_image'], true);
			}
		}

		public function update_image_upload($term_id, $tt_id)
		{
			if (isset($_POST['txt_upload_image']) && '' !== $_POST['txt_upload_image']) {
				update_term_meta($term_id, 'term_image', $_POST['txt_upload_image']);
			}
		}

		public function edit_image_upload($term, $taxonomy)
		{
			// get current group
			$txt_upload_image = get_term_meta($term->term_id, 'term_image', true);
		?>
			<tr class="form-field term-image-wrap">
				<th scope="row"><label for="category_image"><?php echo esc_html('Image'); ?></label></th>
				<td>
					<img src="<?php echo $txt_upload_image ?>" style="width:100px;"><br><br>
					<input type="hidden" name="txt_upload_image" id="txt_upload_image" value="<?php echo $txt_upload_image ?>" style="width: 77%">
					<input type="button" id="upload_image_btn" class="button" value="Upload an Image" />
				</td>
			</tr>
<?php
		}

		public function location_taxonomy_custom_column($columns)
		{
			$columns['term_image'] = __('Image', 'boatrental');
			return $columns;
		}

		public function location_taxonomy_custom_column_content($content, $column_name, $term_id)
		{
			if ($column_name === 'term_image') {
				$image = get_term_meta($term_id, 'term_image', true);
				if (!empty($image)) {
					$image = $image ? $image : 'No image found';
					$content = '<img src="' . $image . '" style="width:100px;"><br><br>';
				}
			}
			return $content;
		}


	} //end class
}

return new Boatrental_Taxonomy();
