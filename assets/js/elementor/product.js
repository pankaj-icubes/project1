// ======================== Product slider ============================//
var urlParams = new URLSearchParams(window.location.search);
  function initializeSlider(sliderClass) {
    var $ = jQuery; 
    var $slickEl = $('.center_' + sliderClass);
    var jsonData = $('.center_' + sliderClass).data('json_format');

    if (jsonData && typeof jsonData === 'object') {
        $slickEl.slick({
          centerMode: true,
          slidesToShow: jsonData.slidesToScroll !== undefined ? jsonData.slidesToScroll : 2,
          autoplay: jsonData.autoplay !== undefined ? jsonData.autoplay : false,
          autoplaySpeed : jsonData.autoplay_speed !== undefined ? jsonData.autoplay_speed : 3000,
          pauseOnHover: jsonData.pause_on_hover !== undefined ? jsonData.pause_on_hover : false,
          draggable: jsonData.draggable !== undefined ? jsonData.draggable : false,
          focusOnSelect: true,
          dots: false,
          infinite: jsonData.infinite !== undefined ? jsonData.infinite : false,
          nextArrow: $(".next_" + sliderClass),
          prevArrow: $(".prev_" + sliderClass),
          responsive: [
              {
                  breakpoint: 767,
                  settings: {
                      slidesToShow: 1, 
                  }
              }
          ]
      });
          
      }else{
        $slickEl.slick({
          centerMode: true,
          slidesToShow: 2,
          autoplay: false,
          draggable: false,
          focusOnSelect: true,
          dots: false,
          infinite: false,
          nextArrow: $(".next_" + sliderClass),
          prevArrow: $(".prev_" + sliderClass),
          responsive: [
            {
                breakpoint: 767, // Adjust for smaller screens (e.g., mobile)
                settings: {
                    slidesToShow: 1, // Show 1 item at a time on mobile
                }
            }
        ]
        });
      }

  }

// ======================== End Product slider ============================//

// Product Tabs
(function($) {
  "use strict";

  function handleTabClick(e) {
      e.preventDefault();
      var tab = $(this);
      var tab_id = tab.attr('href');

      $('.product-tab-content').not(tab_id).hide();
      $('.product-tabs-navigation a').not(tab).removeClass('active');

      $(tab_id).fadeIn();
      tab.addClass('active');
  }

  function handleCategoryClick() {
      var category = $(this).attr('class').split(' ')[1];
      if (category === 'all') {
          $('.br_products').hide();
          $('.product_all').show();
      } else {
          $('.product_all').hide();
          $('.product_' + category).show();
      }
      $('.br_span .spanCategory').removeClass('active');
      $(this).addClass('active');
  }

  function updateSliderValues(minValue, maxValue) {
      $("#amount").val("$" + minValue + " - $" + maxValue);
      $(".min_price").val(minValue);
      $(".max_price").val(maxValue);
      $(".rental-min-price").text(minValue);
      $(".rental-max-price").text(maxValue);
  }

  function updateQueryString(minVal, maxVal) {
      var currentUrl = window.location.href;
      urlParams.set('br_min_price', minVal);
      urlParams.set('br_max_price', maxVal);
      var newUrl = currentUrl.split('?')[0] + '?' + urlParams.toString();
      window.history.replaceState('', '', newUrl);
      location.reload();
  }

  function initPriceSlider() {
      var minPrice = urlParams.has('br_min_price') ? parseInt(urlParams.get('br_min_price')) : 0;
      var highPrice = parseInt($('#max_price').data('product_high_price'));
      var maxPrice = urlParams.has('br_max_price') ? parseInt(urlParams.get('br_max_price')) : highPrice;

      $("#slider-range").slider({
          range: true,
          min: 0,
          max: highPrice,
          step: 100,
          values: [minPrice, maxPrice],
          slide: function(event, ui) {
              updateSliderValues(ui.values[0], ui.values[1]);
          },
          change: function(event, ui) {
              updateSliderValues(ui.values[0], ui.values[1]);
              updateQueryString(ui.values[0], ui.values[1]);
          }
      });

      $("#slider-range").on("change", function(event) {
          var rangeWidth = $(this).width();
          var clickOffset = event.offsetX;
          var sliderMax = $(this).slider("option", "max");
          var maxPosition = (clickOffset / rangeWidth) * sliderMax;
          $(this).slider("values", 1, maxPosition);
          updateSliderValues($("#slider-range").slider("values", 0), maxPosition);
          updateQueryString($("#slider-range").slider("values", 0), maxPosition);
      });

      updateSliderValues(minPrice, maxPrice);
  }

  // Product Tabs
  $(document).ready(function($) {
      $('.product-tabs-navigation a:first-child').addClass('active');
      $('.product-tabs-navigation a').on('click', handleTabClick);

      $('.br_products').hide();
      $('.product_all').show();
      $('.br_span .spanCategory').click(handleCategoryClick);

      // Price Slider
      initPriceSlider();

      // Boat Type Select
      const boatTypeSelect = document.getElementById('boattype');
      if (boatTypeSelect) {
          boatTypeSelect.addEventListener('change', function() {
              const selectedValue = this.value;
              const queryString = new URLSearchParams(window.location.search);
              queryString.set('attr_boat-type', selectedValue);
              const newUrl = window.location.pathname + '?' + queryString.toString();
              history.replaceState(null, null, newUrl);
              location.reload();
          });
      }
  });
})(jQuery);
