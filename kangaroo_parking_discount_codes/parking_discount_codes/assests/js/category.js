
(function ($) {
    $(document).ready(function () {
        $("#item_name").keyup(function () {
            $("#item_slug").val(WL.string_to_slug(this.value));
        });

        $("#btn-submit_category").click(function () {
            var data = $("#save-category").serializeArray();
            data.push({
                name: "action",
                value: "save_category"
            });
            window.console.warn(data);

            $.post(the_ajax_script.ajaxurl, data, function (response) {
                var res = JSON.parse(response);
                if (res.msg_type == "OK") {
                    Notiflix.Notify.Success(res.msg);
                    $("#save-category").find(".show_error").slideDown(800).find(".set_class").addClass("my_success").find("span").html(res.msg);
                    setTimeout(function () {
                        $("#save-category").find(".show_error").slideUp(800).find(".set_class").removeClass("my_success").find("span").html("");
                    }, 3500);
                } else {
                    Notiflix.Notify.Failure(res.msg);
                    $("#save-category").find(".show_error").slideDown(800).find(".set_class").addClass("my_error").find("span").html(res.msg);
                    setTimeout(function () {
                        $("#save-category").find(".show_error").slideUp(800).find(".set_class").removeClass("my_error").find("span").html("");
                    }, 3500);
                }
            });
        });
    });
})(jQuery);