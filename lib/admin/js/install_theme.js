;(function($) {
	"use strict";  
	
	//* Form js
	function verificationForm(){
		//jQuery time
		var current_fs, next_fs, previous_fs; //fieldsets
		
		
		$(document).on( "click", ".grid-homepages > li", function () { 			
			$(this).addClass( "active" );
			$(this).siblings().removeClass( "active" );
		});
		var ajaxurl = boatrental_theme_install.ajax_url;
		var url = boatrental_theme_install.current_url;
		$(document).on( "click", ".next", function () { 			
			var check = false;
			var current_fs = $(this).parent();
			var next_fs = $(this).parent().next();
			var $this = $(this);				
			if( $(this).hasClass( "purchase" ) && !$(this).hasClass( "checked" ) ){				
				var purchase = $(this).parent().find( "#boatrental_purchase_code" ).val();	
				current_fs.addClass( "loading" );
				$.ajax({
					type: "POST",
					dataType: "json",
					url: ajaxurl,
					headers: { "api-key":Math.random() },
					data: {
						action: "verify_purchase_code",
						purchase: purchase
					},
					success: function(data){
						current_fs.removeClass( "loading" ); 
						if( data.check == 1 ){							
							$this.addClass( "checked" );
							$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
							next_fs.addClass( "active" );
							current_fs.removeClass( "active" );								
							$this.removeClass( "purchase" );
							window.history.pushState("string", "Title", url + "&step=2" );
							// location.reload();
						}else{
							// alert( data.message );
							//$("#error-msg").text("Invalid purchase code");
							$("#error-msg").text("Invalid purchase code").addClass("error-msg");

						}
					}
				});
			}
			
			if( $(this).hasClass( "import" ) ){				
				var layout_active = $(this).data( "active" );
				var target_layout = next_fs.find( ".ocdi__gl-item" );
				$( target_layout ).each( function(){
					if( $(this).data( "title" ) == layout_active ){
						$(this).addClass( "active" );
					}
				});
				
				window.history.pushState("string", "Title", url + "&step=3" );
				window.location.reload();
				location.reload();
				
			}
			
			if( $(this).hasClass( "finish" ) ){				
				window.history.pushState("string", "Title", boatrental_theme_install.admin_url );
				location.reload();
			}
			
			if( $(this).hasClass( "checked" ) ){
				//activate next step on progressbar using the index of next_fs
				$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
				//show the next fieldset
				next_fs.addClass( "active" );
				//hide the current fieldset with style
				current_fs.removeClass( "active" );			
			}
		});

		$(".previous").click(function () { 

			current_fs = $(this).parent();
			previous_fs = $(this).parent().prev();
			
			if( $(this).hasClass( "purchase" ) ){
				window.history.pushState("string", "Title", url );
			}
			if( $(this).hasClass( "layout" ) ){
				previous_fs.find( ".next" ).addClass( "layout" );
				window.history.pushState("string", "Title", url + "&step=1" );
			}
			if( $(this).hasClass( "import" ) ){
				window.history.pushState("string", "Title", url + "&step=2" );
			}

			//de-activate current step on progressbar
			$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

			//show the previous fieldset
			previous_fs.addClass( "active" );
			//hide the current fieldset with style
			current_fs.removeClass( "active" );	
			
		});

		$(".submit").click(function () {
			return false;
		})
	}; 	
	verificationForm ();
})(jQuery); 