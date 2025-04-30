<?php
class BoatRental_Options_text extends BoatRental_Options{
  
    function __construct($field = array(), $value ='', $parent = null ){
		if ( !isset($parent->sections) ){
			$parent->sections = array();
		}
		parent::__construct($parent->sections, $parent->args);
		$this->field = $field;
		$this->value = $value;
		
	}//function

	function render(){

		
		$class = (isset($this->field['class']))? esc_attr( $this->field['class'] ):'regular-text';
		
		
		$placeholder = (isset($this->field['placeholder']))?' placeholder="'.esc_attr($this->field['placeholder']).'" ':'';
		
		echo '<input type="text" id="'.esc_attr( $this->field['id'] ).'" name="'.$this->args['opt_name'].'['.$this->field['id'].']" '.$placeholder.'value="'.esc_attr($this->value).'" class="'.$class.'" />';
		
		echo (isset($this->field['desc']) && !empty($this->field['desc']))?' <div><span class="description">'. $this->field['desc'] .'</span></div>':'';
		
	}



}