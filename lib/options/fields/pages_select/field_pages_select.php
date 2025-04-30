<?php
class BoatRental_Options_pages_select extends BoatRental_Options{	
	
	function __construct($field = array(), $value ='', $parent = null ){
		
		parent::__construct($parent->sections, $parent->args, $parent->extra_tabs);
		$this->field = $field;
		$this->value = $value;
		
		
	}//function
	
	function render(){
		
		$class = (isset($this->field['class']))?'class="'.esc_attr( $this->field['class'] ).'" ':'';
		
		echo '<select id="'.esc_attr( $this->field['id'] ).'" name="'.$this->args['opt_name'].'['.$this->field['id'].']" '.$class.'>';
		echo '<option value="" selected>'.esc_html__( 'Select page', 'BoatRental' ).'</option>';
		
		$pages = get_pages(); 
		foreach ( $pages as $page ) {
			echo '<option value="'.esc_attr( $page->ID ).'"'.selected($this->value, $page->ID, false).'>'.esc_html( $page->post_title ).'</option>';
		}

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