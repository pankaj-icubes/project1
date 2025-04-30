<?php
class BoatRental_Options_select extends BoatRental_Options{	
	
	function __construct($field = array(), $value ='', $parent = null ){
		
		parent::__construct($parent->sections, $parent->args, $parent->extra_tabs);
		$this->field = $field;
		$this->value = $value;
		
		
	}//function
	


	function render(){
		
		$class = (isset($this->field['class']))?'class="'.esc_attr( $this->field['class'] ).'" ':'';
		
		echo '<select id="'.esc_attr( $this->field['id'] ).'" name="'.$this->args['opt_name'].'['.$this->field['id'].']" '.$class.'>';
			
			foreach($this->field['options'] as $k => $v){
				
				echo '<option value="'.esc_attr( $k ).'" '.selected($this->value, $k, false).'>'.esc_html( $v ).'</option>';
				
			}//foreach

		echo '</select>';

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