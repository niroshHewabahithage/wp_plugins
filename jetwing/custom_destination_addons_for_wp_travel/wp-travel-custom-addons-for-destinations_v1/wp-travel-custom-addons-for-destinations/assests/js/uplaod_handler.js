(function ($) {
    $(document).ready(function () {
        // var new_item_incrm = 0;

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
                    //new_item_incrm = +new_item_incrm + 1

                    //console.log(new_item_incrm);
                    // $("#wordpress_multiple_uploader").find("#item_name").val("multi_uploader" + new_item_incrm);
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
            $(this).attr("disabled", true);
            var data = $("#frm_save-destination-items").serializeArray();
            data.push({
                name: "action",
                value: "save_items"
            });
            var elem = this;
            //WL.disable_ele_fa(elem, "Saving Items");
            $.post(the_ajax_script.ajaxurl, data, function (response) {
                var res = JSON.parse(response);
                if (res.msg_type == "OK") {
                    Notiflix.Notify.Success(res.msg);
                    setTimeout(function () {
                        location.reload();
                    }, 1500)
                } else {
                    $(this).attr("disabled", false);
                    Notiflix.Notify.Failure(res.msg);
                }
            });
        });

        $(".edit_items").click(function () {
            Notiflix.Loading.Standard('Loading ...');
            $(".edit_items").attr("disabled", true);
            $("#frm_save-destination-items").slideDown(1500);
            var destination = $(this).parent().find(".destination").val();
            var destination_slug = $(this).parent().find(".destination_slug").val();

            $("#destination_name span").html(destination);
            $("#frm_destination_name").val(destination);
            $("#destination_id span").html(destination_slug);
            $("#frm_destination_slug").val(destination_slug);
            var data = $(this).parent().find('.form_items').serializeArray();
            data.push({
                name: "action",
                value: "fetch_custom_items"
            });

            $.post(the_ajax_script.ajaxurl, data, function (response) {
                var res = JSON.parse(response);
                console.log(res);
                if (res.msg_type == "OK") {
                    $("#frm_item_destination_id").val(res.item_id_desti);
                    $("#tgLine").val(res.tgLine);
                    $("#desCapital").val(res.capital);
                    $("#desCurrency").val(res.currency);
                    $("#desPopulation").val(res.population);
                    $("#desLanguages").val(res.languages);
                    $("#destiVisa").val(res.visaP);
                    $("#attractions").val(res.attractions);
                    $("#sMediaTags").val(res.sMediaTags);
                    $(".key_map_left").attr("src", res.key_map_left);
                    $(".key_map_left_down").val(res.key_map_left_id);
                    $(".key_map_right").attr("src", res.key_map_right);
                    $(".key_map_right_down").val(res.key_map_right_id);
                    $("#set_multiple").html(res.return_item);
                    $("#save_buttons_btn-items").hide(1000);
                    $("#update_buttons_btn-items").show(1000);

                    Notiflix.Loading.Remove(300);
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
                    $('.remove_div').click(function () {
                        var answer = confirm('Are you sure?');
                        if (answer == true) {
                            window.alert();

                            $(this).parent().parent().parent().remove();
                        }
                        return false;
                    });
                } else {
                    Notiflix.Loading.Remove(300);
                    //Notiflix.Notify.Failure(res.msg);
                }
            });

        });

        $("#update_buttons_btn-items").click(function () {
            $(this).attr("disabled", true);
            var data = $("#frm_save-destination-items").serializeArray();
            data.push({
                name: "action",
                value: "update_items"
            });
            var elem = this;
            //WL.disable_ele_fa(elem, "Saving Items");
            $.post(the_ajax_script.ajaxurl, data, function (response) {
                var res = JSON.parse(response);
                if (res.msg_type == "OK") {
                    Notiflix.Notify.Success(res.msg);
                    setTimeout(function () {
                        location.reload();
                    }, 1500)
                } else {
                    $(this).attr("disabled", false);
                    Notiflix.Notify.Failure(res.msg);
                }
            });
        });
    });
})(jQuery);