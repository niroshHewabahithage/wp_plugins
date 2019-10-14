(function ($) {
    $(document).ready(function () {
        var new_item_incrm = 0;

        $('.upload_image_button').click(function () {
            var send_attachment_bkp = wp.media.editor.send.attachment;
            var button = $(this);
            wp.media.editor.send.attachment = function (props, attachment) {
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
        $("#add_new_image_slot").click(function () {
            var data = $("#wordpress_multiple_uploader").serializeArray();
            data.push({
                name: "action",
                value: "fetch_button"
            });
            $.post(the_ajax_script.ajaxurl, data, function (response) {
                var res = JSON.parse(response);
                if (res.msg_type == "OK") {
                    $("#set_multiple").append(res.return_array);
                    new_item_incrm = +new_item_incrm + 1

                    console.log(new_item_incrm);
                    $("#wordpress_multiple_uploader").find("#item_name").val("multi_uploader" + new_item_incrm);
                    //Notiflix.Notify.Success(res.msg);
                    $('.upload_image_button').click(function () {
                        var send_attachment_bkp = wp.media.editor.send.attachment;
                        var button = $(this);
                        wp.media.editor.send.attachment = function (props, attachment) {
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
                } else {
                    //Notiflix.Notify.Failure(res.msg);
                }
            });
        });

        $("#save_buttons_btn-items").click(function () {
            var data = $("#frm_save-destination-items").serializeArray();
            data.push({
                name: "action",
                value: "save_items"
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