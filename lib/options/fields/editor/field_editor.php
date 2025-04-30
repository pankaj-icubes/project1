<?php
class BoatRental_Options_editor extends BoatRental_Options{	
	
	function __construct($field = array(), $value ='', $parent = null ){
		
		parent::__construct($parent->sections, $parent->args, $parent->extra_tabs);
		$this->field = $field;
		$this->value = $value;
		
		
	}//function
	
	
	function render(){
		
		$class = (isset($this->field['class']))? esc_attr( $this->field['class'] ):'';
		
		$settings = array(
			'textarea_name' => $this->args['opt_name'].'['.$this->field['id'].']', 
			'editor_class' => $class,
			'media_buttons' => false
			);
		wp_editor($this->value, $this->field['id'], $settings );
		
		echo (isset($this->field['desc']) && !empty($this->field['desc']))?'<br/><span class="description">'.esc_html( $this->field['desc'] ).'</span>':'';
		
	}//function
	
}//class
?>