(function ($) {
  "use strict";
  // When the "View Log" button is clicked
  $("#ccg_log_display").click(function (e) {
    // Prevent the default action
    e.preventDefault();
    // And send an AJAX request to the server
    $.ajax({
      url: "/wp-admin/admin-ajax.php",
      type: "POST",
      data: {
        action: "coupon_log",
      },
      // On success, display the log content
      success: function (response) {
        // Display the log content
		  $("#ccg_log_content").html(response);
      },
      // And on error, display the error message
      error: function (jqXHR, textStatus, errorThrown) {
        console.log(errorThrown);
      },
    });
  });
})(jQuery);
