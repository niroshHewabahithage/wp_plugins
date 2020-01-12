(function ($) {
    $(document).ready(function () {

        $('select').select2();
        var is_viewed = '';
        $("#basic-addon2-view_pass").click(function () {
            if (is_viewed == "") {
                $(this).parent().parent().find('input').attr("type", "text");
                $(this).html("Hide Password");
                is_viewed = 1;
            } else {
                $(this).parent().parent().find('input').attr("type", "password");
                $(this).html("Show Password");
                is_viewed = '';
            }
        });

        $("#save-items").click(function () {
            var data = $("#template_item").serializeArray();
            data.push({
                name: "action",
                value: "save_astrologist"
            });
            $.post(the_ajax_script.ajaxurl, data, function (response) {
                var res = JSON.parse(response);
                if (res.msg_type == "OK") {
                    Notiflix.Notify.Success(res.msg);
                    setTimeout(function () {
                        location.reload();
                    }, 2500);
                } else {
                    Notiflix.Notify.Failure(res.msg);
                    setTimeout(function () {
                        //location.reload();
                    }, 2500);
                }
            });
        });
        $('.upload_image_button').click(function () {
            var send_attachment_bkp = wp.media.editor.send.attachment;
            var button = $(this);
            wp.media.editor.send.attachment = function (props, attachment) {
                console.log(attachment);
                $(button).parent().prev().attr('src', attachment.url);
                $(button).prev().val(attachment.id);
                wp.media.editor.send.attachment = send_attachment_bkp;
            }
            wp.media.editor.open(button);
            return false;
        });

// The "Remove" button (remove the value from input type='hidden')
        $('.remove_image_button').click(function () {
            var answer = confirm('Are you sure?');
            if (answer == true) {
                var src = $(this).parent().prev().attr('data-src');
                $(this).parent().prev().attr('src', src);
                $(this).prev().prev().val('');
            }
            return false;
        });
    });

    $(".edit-items").click(function () {
//        window.alert();
    });

    $(".change-price").click(function () {

        var item_id = this.value;
        var data = [{"name": "item_id", "value": item_id}]
        data.push({
            name: "action",
            value: "get_services_astrologer"
        });
//        data.push();
        $.post(the_ajax_script.ajaxurl, data, function (response) {
            var res = JSON.parse(response);
            if (res.msg_type == "OK") {
                $("#template_item").slideUp(800);
                $("#template_form").slideDown(800);
                if (res.div_content != "") {
                    $("#template_form").find("#set_value_prices").fadeIn(800).html(res.div_content);
                }
            } else {
                Notiflix.Notify.Failure(res.msg);
            }
        });

    });

    $("#save-items-prices").click(function () {
        WL.disable_ele_fa(this, "");
        var elem=this;
        var data = $("#template_form").serializeArray();
        data.push({
            "name": "action",
            'value': "submit_prices_astrologer"
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
                WL.enable_ele_fa(elem, "");
            }
        });
    });
})(jQuery);

