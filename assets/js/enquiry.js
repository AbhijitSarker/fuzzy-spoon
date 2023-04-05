(function ($) {
  $("#spoon-enquiry-form").on("submit", function (e) {
    e.preventDefault();

    var data = $(this).serialize();

    // ajax on adding single product page
    $.ajax({
      url: fuzzySpoon.ajaxurl,
      type: "post",
      data: {
        action: "f_spoon_enquiry",
      },
      success: function (response) {
        alert(response.data.message);
      },
    });
  });

  //   $.post(fuzzySpoon.ajaxurl, data, function (data) {
  //     if(response.success){
  //       console.log(respone.success);
  //     }else{
  //       alert(response.data.message);
  //     }
  //   })
  //   .fail(function (error) {
  //     alert(fuzzySpoon.error);
  //   })
  // });
})(jQuery);
