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
})(jQuery);

