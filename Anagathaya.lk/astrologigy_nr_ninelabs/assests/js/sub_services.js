(function ($) {
    $(document).ready(function () {
        $('select').select2();

        $("#save-items").click(function () {
            var data = $("#custom_sub_service_data").serializeArray();
            data.push({
                name: "action",
                value: "save_sub_services"
            });
            $.post(the_ajax_script.ajaxurl, data, function (response) {
                var res = JSON.parse(response);
                if (res.msg_type == "OK") {
                    Notiflix.Notify.Success(res.msg);
                    setTimeout(function () {
                        location.reload();
                    }, 2500)
                } else {
                    Notiflix.Notify.Failure(res.msg);
                }
            });
        });
    });
})(jQuery);