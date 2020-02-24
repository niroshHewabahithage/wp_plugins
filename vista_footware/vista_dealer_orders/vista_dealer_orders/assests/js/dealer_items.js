jQuery.noConflict();
(function($) {
    $(function() {
        $(document).ready(function() {
            var triggered_item = "";
            $(".item_selection").change(function() {
                console.log(triggered_item);
                var item_value = this.value;
                var box = this;

                // if ($(box).is(":checked")) {

                var data = [{ "name": "item_value", "value": item_value }];
                data.push({
                    name: "action",
                    value: "get_color_size"
                });
                Notiflix.Loading.Merge({
                    messageMaxLength: 700,
                });
                Notiflix.Loading.Pulse('Process in prograss');
                $.post(the_ajax_script.ajaxurl, data, function(response) {
                    var res = JSON.parse(response);
                    if (res.msg_type == "OK") {

                        // Notiflix.Notify.Success(res.msg);
                        $("#set_colorSize").slideDown(800).append(res.return_div);
                        if (triggered_item != "") {
                            $("#" + triggered_item).find(".size_box_front").slideUp(800);
                            triggered_item = "";
                        } else {

                        }
                        Notiflix.Loading.Remove(600);
                        triggered_item = box.value;

                        $(".minimize").click(function() {
                            $(this).closest(".form-group").find(".size_box_front").slideUp(800);
                            $(this).slideUp(500);
                            $(this).closest(".form-group").find(".maximize").slideDown(700);
                        });
                        $(".maximize").click(function() {
                            $(this).closest(".form-group").find(".size_box_front").slideDown(800);
                            $(this).slideUp(500);
                            $(this).closest(".form-group").find(".minimize").slideDown(700);
                        });
                        $(".close").click(function() {
                            $(this).closest(".form-group").remove();
                        });

                        $(".itemColors").click(function() {
                            var itemValues = this;
                            var checbox = this;
                            if ($(checbox).is(":checked")) {
                                $(checbox).closest(".size_box_front").find(".size_list").slideDown(800);
                            } else {
                                $(checbox).closest(".size_box_front").find("input[type='checkbox']").prop("checked", false);
                                $(checbox).closest(".size_box_front").find("input[type='text']").val("");
                                $(checbox).closest(".size_box_front").find(".size_list").slideUp(800);
                            }
                        });

                        $(".size_set").click(function() {
                            if ($(this).is(":checked")) {
                                $(this).closest(".row").find(".qty_amount").slideDown(800);
                            } else {
                                $(this).closest(".row").find(".qty_amount").slideUp(800);
                            }
                        });
                        // res.return_div
                    } else {
                        Notiflix.Notify.Failure(res.msg);
                        Notiflix.Loading.Remove(600);
                        // WL.generate_function_messages("errorId", "alert-danger", res.msg, "3000");
                        setTimeout(function() {
                            //location.reload();
                        }, 2500);
                    }
                });
                // } else {
                //     $("#" + item_value).remove();
                // }
            });

            $("#save-items").click(function() {
                Notiflix.Loading.Merge({
                    messageMaxLength: 700,
                });
                // Notiflix.Loading.Pulse('Process in prograss');
                var data = $("#form_dealer").serializeArray();
                data.push({
                    name: "action",
                    value: "submit_request"
                });
                var elem = this;
                $.post(the_ajax_script.ajaxurl, data, function(response) {
                    var res = JSON.parse(response);
                    if (res.msg_type == "OK") {
                        Notiflix.Notify.Success(res.msg);
                        $("#set_custom_email_view").html(res.cus);
                        setTimeout(function() {
                            // location.reload();
                        }, 1800)
                    } else {
                        Notiflix.Notify.Failure(res.msg);
                        // $("#" + res.id_value).addClass("error_glow");
                        // Notiflix.Loading.Remove(600);
                        setTimeout(function() {
                            // WL.enable_ele_fa(elem, "");
                            $("#" + res.id_value).removeClass("error_glow");
                            //location.reload();
                        }, 2500);
                    }
                });
            });
        });
    });
})(jQuery);