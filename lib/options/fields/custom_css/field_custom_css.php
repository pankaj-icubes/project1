<?php
class BoatRental_Options_custom_css extends BoatRental_Options
{
    function __construct($field=array(),$value='',$parent='')
    {
       parent::__construct($parent->sections,$parent->args,$parent->extra_tabs);
     
       $this->field = $field;
       $this->value = $value; 

    }//function

    function render(){
	  	
		echo'<div id="customcss" style="position:relative;width=75%;height:400px;"></div>';	
	    echo '<textarea id= "cssdata"  name="'.$this->args['opt_name'].'['.$this->field['id'].']" style="display:none;visibility:hidden;"></textarea>';
        
	}//function
	
    function enqueue(){
		
           wp_enqueue_script(
            'BoatRental_custom_css',
			boatrental_lib_url.'/admin/js/field_custom_css.js',
            array('jquery'),
			time(),
			true
		);
    }  


}


?>
