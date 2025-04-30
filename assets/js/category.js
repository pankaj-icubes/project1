document.addEventListener("DOMContentLoaded", function() {
  var currentUrl = window.location.href;
  var urlParams = new URLSearchParams(window.location.search);
  // Check if the current page is an archive or shop page
  if (urlParams.has("s") || currentUrl.includes("/shop/")) {
    (function($) {
      "use strict";
      $(document).ready(function() {
        var form = $(".date_filter");
        form.on("click", function(event) {
          event.preventDefault(); // Prevent form submission
          
          var startDateInput = $("#yachtsearch-startdate");
          var endDateInput = $("#yachtsearch-enddate");
          
          var url = new URL(window.location.href);
  
          // Remove existing startdate and enddate query parameters
          url.searchParams.delete("startdate");
          url.searchParams.delete("enddate");
  
          // Set new startdate and enddate query parameters
          url.searchParams.set("startdate", startDateInput.val());
          url.searchParams.set("enddate", endDateInput.val());
  
          // Redirect to the updated URL
          window.location.href = url.href;
        });
      });
    })(jQuery);
  }
});



function updateQueryString(paramName, element) {
  let url = new URL(window.location.href);
  let elementValue = element.value;
  let isChecked = element.checked || (element.type === "radio" && element.checked);
  let paramValues = url.searchParams.getAll(paramName + "[]");

  if (isChecked) {
      if (element.type === "radio") {
          url.searchParams.set(paramName, elementValue);
          if(paramName == 'rental_type' && elementValue == 'both'){
              url.searchParams.delete("rental_type", "both");
            }
          
      } else {
          paramValues.push(elementValue);
          url.searchParams.delete(paramName + "[]");
          paramValues.forEach(function (value) {
              url.searchParams.append(paramName + "[]", value);
          });
      }
  } else {
      paramValues = paramValues.filter(function (value) {
          return value !== elementValue;
      });
      url.searchParams.delete(paramName + "[]");
      paramValues.forEach(function (value) {
          url.searchParams.append(paramName + "[]", value);
      });
  }

  // Reload the page with the updated query string
  window.location.href = url.href;
}
