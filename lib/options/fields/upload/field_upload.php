<?php
class BoatRental_Options_upload extends BoatRental_Options{
	
	function __construct($field = array(), $value ='', $parent = ''){
		
		parent::__construct($parent->sections, $parent->args, $parent->extra_tabs);
		$this->field = $field;
		$this->value = $value;
		
	}//function
	

	function render(){
		
		$class = (isset($this->field['class']))? esc_attr( $this->field['class'] ):'regular-text';
		
		echo '<input type="hidden" id="'.esc_attr( $this->field['id'] ).'" name="'.$this->args['opt_name'].'['.$this->field['id'].']" value="'.$this->value.'" class="'.$class.'" />';
			
		echo '<img class="BoatRental-screenshot" id="BoatRental-screenshot-'.$this->field['id'].'" src="'.esc_url( $this->value ).'" width="30"/>';
		
		if($this->value == ''){$remove = ' style="display:none;"';$upload = '';}else{$remove = '';$upload = ' style="display:none;"';}
		echo ' <a href="javascript:void(0);" class="rental-upload button-secondary"'.$upload.' rel-id="'.$this->field['id'].'">'.esc_html__('Browse', 'BoatRental').'</a>';
		echo ' <a href="javascript:void(0);" class="rental-upload-remove"'.$remove.' rel-id="'.$this->field['id'].'">'.esc_html__('Remove', 'BoatRental').'</a>';
		
		echo (isset($this->field['desc']) && !empty($this->field['desc']))?'<br/><br/><span class="description">'.esc_html( $this->field['desc'] ).'</span>':'';
		
	}//function
	
	
	
	/**
	 * Enqueue Function.
	 *
	 * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
	 *
	 * @since BoatRental_Options 1.0
	*/
	function enqueue(){
		wp_enqueue_media();
		wp_enqueue_script(
			'rental-menu-upload-js',
			boatrental_lib_url.'/admin/js/field_upload.js',
			time(),
			true
		);
		
		wp_localize_script('rental-menu-upload-js', 'rental_upload', array('url' => boatrental_lib_url.'/admin/img/BoatRental.png'));
		
	}
	
   
	
	//function
	
}//class
?>