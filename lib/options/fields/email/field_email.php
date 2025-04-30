<?php
class BoatRental_Options_email extends BoatRental_Options{
	
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
		
		echo '<input type="email" id="'.esc_attr( $this->field['id'] ).'" name="'.$this->args['opt_name'].'['.$this->field['id'].']" '.$placeholder.'value="'.esc_attr($this->value).'" class="'.$class.'" />';
		
		echo (isset($this->field['desc']) && !empty($this->field['desc']))?' <span class="description">'.esc_html( $this->field['desc'] ).'</span>':'';
		
	}//function
	
	// public function getCpanelHtml(){
	// 	echo ' <div class="control-group">';
	// 	echo '<label class="control-label">'.esc_html( $this->field['title'] ).'</label>';
	// 	echo '<div class="controls">';
	// 	$this->render();
	// 	echo '</div></div>';
	// }
}//class
?>