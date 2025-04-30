jQuery(document).ready(function(){

		
		jQuery('.BoatRental-group-tab:first').slideDown('fast');
		jQuery('#BoatRental-group-menu li:first').addClass('active');

        

                
	
jQuery('.BoatRental-group-tab-link-a').click(function(){
    relid = jQuery(this).attr('data-rel');
    
    // jQuery('#last_tab').val(relid);
    
    jQuery('.BoatRental-group-tab').each(function(){
        if(jQuery(this).attr('id') == relid+'_section_group'){
            jQuery(this).show();
        }else{
            jQuery(this).hide();
        }
        
    });
    jQuery('.BoatRental-group-tab-link-li').each(function(){
        if(jQuery(this).attr('id') != relid+'_section_group_li' && jQuery(this).hasClass('active')){
            jQuery(this).removeClass('active');
        }
        if(jQuery(this).attr('id') == relid+'_section_group_li'){
            jQuery(this).addClass('active');
        }
});

});
    
  jQuery('.menu_alignment').change(function()
  {
    alert("The text has been changed.");
  });

});