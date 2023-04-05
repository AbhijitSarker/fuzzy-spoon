(function ($) {
  $("table.wp-list-table.contacts").on("click", "a.submitdelete", function (e) {
    e.preventDefault();

    if (!confirm(fuzzySpoon.confirm)) {
      return;
    }

    var self = $(this),
      id = self.data("id");

    // wp.ajax
    //   .send("f_spoon_delete_contact", {
    //     data: {
    //       id: id,
    //       _wpnonce: fuzzySpoon.nonce,
    //     },
    //  })
    wp.ajax
      .post("f_spoon_delete_contact", {
        id: id,
        _wpnonce: fuzzySpoon.nonce,
      })
      .done(function (response) {
        self
          .closest("tr")
          .css("background-color", "red")
          .hide(400, function () {
            $(this).remove();
          });
      })
      .fail(function () {
        alert(fuzzySpoon.error);
      });
  });
})(jQuery);
