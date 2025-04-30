<?php
class BoatRental_Options_color extends BoatRental_Options{	
	
	function __construct($field = array(), $value ='', $parent = null ){
		
		parent::__construct($parent->sections, $parent->args, $parent->extra_tabs);
		$this->field = $field;
		$this->value = $value;
		
		
	}
	
	function render(){
		
		$class = (isset($this->field['class']))? esc_attr( $this->field['class'] ):'';
		
		echo '<div class="farb-popup-wrapper">';
		
		echo '<input type="text" id="'.esc_attr( $this->field['id'] ).'" name="'.$this->args['opt_name'].'['.$this->field['id'].']" value="'.esc_attr( $this->value ).'" class="'.$class.' BoatRental-popup-colorpicker" style="width:70px;"/>';
		
		echo (isset($this->field['desc']) && !empty($this->field['desc']))?' <div><span class="description">'.esc_html( $this->field['desc'] ).'</span></div>':'';
		
		echo '</div>';
		
	}

	function enqueue(){
		wp_enqueue_style( 'wp-color-picker' ); 
		wp_enqueue_script(
			'BoatRental-field-color-js', 
			boatrental_lib_url.'/options/fields/color/field_color.js', 
			array('jquery', 'wp-color-picker'),
			time(),
			true
		);
		
	}//function
	
}//class
?>