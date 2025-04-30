(function($) {
	$( document ).on( "click", ".rental-upload, .rental-menu-upload", function( event ) {
		var file_frame;	
		var formfield = $(this).attr("rel-id");
		var preview = $(this).parent().find("img");

		// If the media frame already exists, reopen it.
		if ( file_frame ) {
			file_frame.open();
			return;
		}

		// Create the media frame.
		file_frame = wp.media.frames.downloadable_file = wp.media({
			title: "Choose an image",
			button: {
				text: "Use image"
			},
			multiple: false
		});

		// When an image is selected, run a callback.
		file_frame.on( "select", function() {
			var attachment = file_frame.state().get( "selection" ).first().toJSON();
			$(formfield).val( attachment.sizes.full.url );
			$img_url = ( typeof( attachment.sizes.thumbnail ) != "undefined" ) ? attachment.sizes.thumbnail.url : attachment.sizes.full.url;
			$(preview).attr( "src", $img_url );
			$("#"+formfield).val( attachment.sizes.full.url );
            $("#BoatRental-screenshot-"+formfield).css( "display","block" );
			$(formfield).next().fadeIn("slow");
			$(formfield).next().next().fadeOut("slow");
			$(formfield).next().next().next().fadeIn("slow");
		});

		// Finally, open the modal.
		file_frame.open();
		event.preventDefault();
	});
	$(document).ready(function(){
		$( document ).on( "click", ".rental-upload-remove, .rental-menu-upload-remove", function(){
			$relid = $(this).attr("rel-id");
			$($relid).val("");
			$($relid).val("");
			$(this).prev().fadeIn("fast");
			$(this).prev().prev().fadeOut("fast", function(){jQuery(this).attr("src", rental_upload.url);});
			$(this).fadeOut("slow");
		});
	});
	function MenuClick(){
		$(".menu-advance-href").on("click", function(){
			$(this).parent().find(".menu-config-content").slideToggle();
		});
	}
	$(document).ready(function(){
		MenuClick();
	});
}(jQuery));