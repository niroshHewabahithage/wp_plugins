(function ($) {
    $(document).ready(function () {
        $(".show-order").click(function () {
            Notiflix.Loading.Merge({
                messageMaxLength: 700,
            });
            Notiflix.Loading.Pulse('මොහොතක් රැදීසිටින්න |Process in prograss');
            $("#display_panel").slideUp(800);
            //            $("#list_orders").delay(800).removeClass("col-lg-8").addClass("col-lg-12");
            $("#custom-show-table").find("tbody").html();
            var item_value = this.value;
            var data = [{ "name": "item_value", "value": item_value }];
            data.push({
                name: "action",
                value: "get_single_order"
            });

            $.post(the_ajax_script.ajaxurl, data, function (response) {
                var res = JSON.parse(response);
                console.log(res);
                if (res.msg_type == "OK") {
                    $("#list_orders").removeClass("col-lg-12").addClass("col-lg-8");
                    $("#header-show").find("span").html(res.return_array.name);
                    $("#display_panel").slideDown(800);
                    $("#custom-show-table").find("tbody").html(res.return_div);
                    $("#requestId").val(res.request_id);
                    if (res.uplo == 1) {
                        $("#hide_upload_section").slideUp(800);
                    } else {
                        $("#hide_upload_section").slideDown(800);
                    }
                    Notiflix.Loading.Remove(600);

                    $("#btn_delete_value").click(function () {
                        var item_value = this.value;
                        var data = [{ "name": "item_value", "value": item_value }];
                        data.push({
                            name: "action",
                            value: "delete_attachement"
                        });
                        Notiflix.Loading.Pulse('මොහොතක් රැදීසිටින්න |Process in prograss');
                        $.post(the_ajax_script.ajaxurl, data, function (response) {
                            var res = JSON.parse(response);
                            if (res.msg_type == "OK") {
                                Notiflix.Notify.Success(res.msg);
                                // WL.generate_function_messages("errorId", "alert-success", res.msg, "3000");
                                setTimeout(function () {
                                    location.reload();
                                }, 2500);
                            } else {
                                Notiflix.Notify.Failure(res.msg);
                                // WL.generate_function_messages("errorId", "alert-danger", res.msg, "3000");
                                setTimeout(function () {
                                    //location.reload();
                                    Notiflix.Loading.Remove(600);
                                }, 2500);
                            }
                        });
                    });
                } else {
                    Notiflix.Notify.Failure(res.msg);
                    $("#display_panel").slideUp(800);
                    $("#list_orders").removeClass("col-lg-8").addClass("col-lg-12");
                    $("#custom-show-table").find("tbody").html();
                    Notiflix.Loading.Remove(600);
                }
            });
        });

        $('.upload_image_button').click(function () {
            var send_attachment_bkp = wp.media.editor.send.attachment;
            var button = $(this);
            wp.media.editor.send.attachment = function (props, attachment) {
                console.log(attachment);
                console.log(attachment.title);
                $("#uploadedName").val(attachment.title.substr(0, 20) + "...." + " Uploaded Successfully");
                $("#attachement_id").val(attachment.id);
            }
            wp.media.editor.open(button);
            return false;
        });

        // The "Remove" button (remove the value from input type='hidden')
        $('.remove_image_button').click(function () {
            var answer = confirm('Are you sure?');
            if (answer == true) {
                // var src = $(this).parent().prev().attr('data-src');
                // $(this).parent().prev().attr('src', src);
                // $(this).prev().prev().val('');
                $("#setMedia").html("");
                $("#uploadedName").val("");
                $("#attachement_id").val("");
            }
            return false;
        });

        $("#btn-upload-save-respond").click(function () {
            Notiflix.Loading.Pulse('මොහොතක් රැදීසිටින්න |Process in prograss');
            var data = $("#show_item-order").serializeArray();
            data.push({
                name: "action",
                value: "submit_respoonse"
            });
            window.console.warn(data);
            $.post(the_ajax_script.ajaxurl, data, function (response) {
                var res = JSON.parse(response);
                if (res.msg_type == "OK") {
                    Notiflix.Notify.Success(res.msg);
                    // WL.generate_function_messages("errorId", "alert-success", res.msg, "3000");
                    setTimeout(function () {
                        location.reload();
                    }, 2500);
                } else {
                    Notiflix.Notify.Failure(res.msg);
                    // WL.generate_function_messages("errorId", "alert-danger", res.msg, "3000");
                    setTimeout(function () {
                        //location.reload();
                        Notiflix.Loading.Remove(600);
                    }, 2500);
                }
            });
        });

    });
})(jQuery);