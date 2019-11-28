(function ($) {
    $(document).ready(function () {
        $('select').select2();
        $("#attribute_name").keyup(function () {
            $("#attribute_slug").val(WL.string_to_slug($("#attribute_name").val()));
        });

        $("#save-attribute").click(function () {
            var data = $("#frm-manage-attributes").serializeArray();
            data.push({
                name: "action",
                value: "save_attribute"
            });
            $.post(the_ajax_script.ajaxurl, data, function (response) {
                var res = JSON.parse(response);
                if (res.msg_type == "OK") {
                    Notiflix.Notify.Success(res.msg);
                } else {
                    Notiflix.Notify.Failure(res.msg);
                }
            });
        });


    });

})(jQuery);


