<?php
class BoatRental_Options_checkbox extends BoatRental_Options{
	

	function __construct($field = array(), $value ='', $parent = null ){
		
		parent::__construct($parent->sections, $parent->args, $parent->extra_tabs);
		$this->field = $field;
		$this->value = $value;
		
		
	}//function
	
	
	
	function render(){
		
		$class = (isset($this->field['class'])) ? $this->field['class'] : '';
		
		echo (isset($this->field['desc'])) ?' <label>' : '';
		
		echo '<input type="checkbox" id="'.esc_attr( $this->field['id'] ).'" name="'.$this->args['opt_name'].'['.$this->field['id'].']" value="1" class="'.$class.'" '.checked($this->value, '1', false).'/>';
		
		echo (isset($this->fielxd['desc']) && !empty($this->field['desc']))?' '.esc_html( $this->field['desc'] ).'</label>':'';
		
	}//function
	
}//class
?>