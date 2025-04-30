<?php
class BoatRental_Options_textarea extends BoatRental_Options{	
	
	function __construct($field = array(), $value ='', $parent = null ){
		
		parent::__construct($parent->sections, $parent->args, $parent->extra_tabs);
		$this->field = $field;
		$this->value = $value;
		
		
	}//function
	
	
	function render(){
		
		$class = (isset($this->field['class']))? esc_attr( $this->field['class'] ):'large-text';
		
		$placeholder = (isset($this->field['placeholder']))?' placeholder="'.esc_attr($this->field['placeholder']).'" ':'';
		
		echo '<textarea id="'.esc_attr( $this->field['id'] ).'" name="'.$this->args['opt_name'].'['.$this->field['id'].']" '.$placeholder.'class="'.$class.'" >'.esc_textarea($this->value).'</textarea>';
		
		echo (isset($this->field['desc']) && !empty($this->field['desc']))?'<br/><span class="description">'.esc_html( $this->field['desc'] ).'</span>':'';
		
	}//function
	
	public function getCpanelHtml(){
		echo ' <div class="control-group">';
		echo '<label class="control-label">'.esc_html( $this->field['title'] ).'</label>';
		echo '<div class="controls">';
		$this->render();
		echo '</div></div>';
	}
}//class
?>