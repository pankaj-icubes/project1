var $ = "jQuery";


// mini cart ========

function displayMiniCart() {
  document.querySelector(".mini-cart").style.display = "block";
}

function hideMiniCart() {
  // Delay the hiding of the mini cart to allow the mouse to move into it
  setTimeout(function () {
    var miniCart = document.querySelector(".mini-cart");
    var isMouseOverMiniCart = miniCart.matches(":hover");

    if (!isMouseOverMiniCart) {
      miniCart.style.display = "none";
    }
  }, 200);
}

function openMagnificPopup(current_image){
  var images = []; // Create an array to hold image URLs
  var $ = jQuery;
  // Loop through each element with the class "woocommerce-product-gallery__wrapper"
  $(".woocommerce-product-gallery__wrapper").find("a").each(function () {
    var imageUrl = $(this).attr("href"); // Get the image URL from the "href" attribute
    images.push({ src: imageUrl }); // Add the image URL to the array
  });

  // var current_image = "https://boatrental.cvla.nauticaltrips.com/wp-content/uploads/2023/04/best-holidays1.jpg";
  startIndex = 0;
  // Find the index of the current_image URL in the images array
  if (typeof current_image === "string") {
    
    var startIndex = images.findIndex(function(item) {
      return item.src === current_image;
    });
  } 
  // Open the Magnific Popup
  $.magnificPopup.open({
    type: "image",
    items: images, // Pass the array of image URLs
    gallery: {
      enabled: true
    },
    callbacks: {
      open: function () {
        this.goTo(startIndex);
      }
    }
  });

}


(function($) {
  "use strict";

  $(document).ready(function() {
      $(".image_right .woocommerce-product-gallery__image").on("click", function(e) {
          e.preventDefault();
          var imageSrc = $(this).find("a img").attr("src").replace("-100x100.jpg", ".jpg");
          var largeImageSrc = $(this).find("a img").attr("data-large_image").replace("-100x100.jpg", ".jpg");
          $(".image_left .woocommerce-product-gallery__image a").parent().attr("data-thumb", imageSrc);
          $(".image_left .woocommerce-product-gallery__image a").attr("data-thumb", imageSrc);
          $(".image_left .woocommerce-product-gallery__image a").attr("href", imageSrc);
          $(".image_left .woocommerce-product-gallery__image img").attr("src", imageSrc);
          $(".image_left .woocommerce-product-gallery__image img").attr("srcset", imageSrc + " 600w, " + largeImageSrc + " 825w");
          $(".image_left .woocommerce-product-gallery__image img").attr("data-src", imageSrc);
          $(".image_left .woocommerce-product-gallery__image img").attr("data-large_image", largeImageSrc);

      });

      $(".image_left").on("click", function(e) {
          e.preventDefault();
          var largeImageSrc = $(this).find("a img").attr("data-large_image");
          openMagnificPopup(largeImageSrc);
      });

      var $imageRightImages = $(".image_right .woocommerce-product-gallery__image");

      $imageRightImages.on("click", function(event) {
          event.preventDefault();
          event.stopPropagation();
      });

      // ============== Image on click

      $(".open_Images").on("click", function(e) {
          e.preventDefault(); // Prevent the default link behavior
          var index = $(".open_Images").index(e.currentTarget);
          openMagnificPopup(index);

      });

      $(".search_popup_icon").on("click", function(e) {
          e.preventDefault(); // Prevent the default link behavior
          $(".search-popup").toggle();
      });

      // ============== Image on click

      // ============== Subscribe ===========

      $(".newsletter-form").on("submit", function(e) {
          e.preventDefault();

          var email = $("#email").val();

          // Perform AJAX request to process the form data
          $.ajax({
              url: boatrental_vars.ajax_url,
              type: "post",
              data: {
                  action: "process_subscribe_form",
                  email: email
              },
              success: function(response) {
                  $(".newsletter-form").html(response);
              }
          });
      });

      // ============= add custom class for mobile menu ==============//

      $(".br-main-menu-mobile .menu-item-has-children > a").click(function(e) {
          e.preventDefault();
          $(this).siblings(".sub-menu").toggleClass("show");
      });

      // close ready section
  });
  
})(jQuery);



function openMobileBookingcat() {
    document.getElementById("mySideBooking").style.height = "100%";
}

function closeBooking() {
    document.getElementById("mySideBooking").style.height = "0";
}

function boatrentalTrimWords(text, length) {
  var words = text.split(" ");
  if (words.length > length) {
    var truncated = words.slice(0, length).join(" ");
    return truncated + "...";
  } else {
    return text;
  }
}