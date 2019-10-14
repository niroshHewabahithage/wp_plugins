(function ($) {
    $(document).ready(function () {
        $("#item_name").keyup(function () {
            $("#item_slug").val(WL.string_to_slug(this.value));
            $("#item_shortcode").val(WL.string_to_short_code(this.value));
        });

        //click function
        $("#btn-submit_package").click(function () {
            var data = $("#save-package").serializeArray();
            data.push({
                name: "action",
                value: "save_package"
            });

            $.post(the_ajax_script.ajaxurl, data, function (response) {
                var res = JSON.parse(response);
                if (res.msg_type == "OK") {
                    Notiflix.Notify.Success(res.msg);
                    $("#save-package").find(".show_error").slideDown(800).find(".set_class").addClass("my_success").find("span").html(res.msg);
                    setTimeout(function () {
                        location.reload();
                        $("#save-package").find(".show_error").slideUp(800).find(".set_class").removeClass("my_success").find("span").html("");
                    }, 3500);
                } else {
                    Notiflix.Notify.Failure(res.msg);
                    $("#save-package").find(".show_error").slideDown(800).find(".set_class").addClass("my_error").find("span").html(res.msg);
                    setTimeout(function () {
                        $("#save-package").find(".show_error").slideUp(800).find(".set_class").removeClass("my_error").find("span").html("");
                    }, 3500);
                }
            });
        });
    });
})(jQuery);