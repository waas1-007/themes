jQuery(function ($) {
    "use strict";
  $(".radiantthemes_loadmore").click(function () {
    var button = $(this),
      data = {
        action: "loadmore",
        query: radiantthemes_loadmore_params.posts,
        page: radiantthemes_loadmore_params.current_page,
      };
    $.ajax({
      url: radiantthemes_loadmore_params.ajaxurl,
      data: data,
      type: "POST",
      beforeSend: function (xhr) {
        $(".t").show();
        button.html(
          'load more ..<img style="" src="/wp-content/themes/dello/assets/images/loder.gif">'
        );
      },
      success: function (data) {
        if (data) {
          $(".t").hide();
          $(".radiantthemes_loadmore").show();
          button.text("load more...").prev().after(data);
          radiantthemes_loadmore_params.current_page++;
          if (
            radiantthemes_loadmore_params.current_page ==
            radiantthemes_loadmore_params.max_page
          )
            button.remove();
        } else {
          button.remove();
        }
      },
    });
  });
});
