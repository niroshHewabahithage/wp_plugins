(function ($) {
    $(document).ready(function () {
        $(".checkService").attr("checked", false);
        $(".checkUser").attr("checked", false);
        $("#other_information").slideUp(800);
        $(".checkService").click(function () {
            $("#need_partner").val(0);
            $("#have_sub").val(0);
            $("#other_information").slideUp(800);
            $("#set_price").html("රු " + WL.format_number("000", 2));
            $("#set_strologer").html("");
            $("#select_astrolger_div").slideUp(500);
            $("#basic_info").slideUp(500);
            $("#partner_details").slideUp(500);
            var $box = $(this);
            if ($box.is(":checked")) {
                var item_id = this.value;
                var data_id = $(this).attr("data-id");

                //                window.alert(data_id);
                var group = "input:checkbox[name='" + $box.attr("name") + "']";
                $(group).prop("checked", false);
                $box.prop("checked", true);
                Notiflix.Loading.Merge({
                    messageMaxLength: 700,
                });
                Notiflix.Loading.Pulse('මොහොතක් රැදීසිටින්න |Process in prograss');
                //send ajax request
                $("#no_error").slideUp(800);
                var data = [{ "name": "item_id", "value": item_id }];
                data.push({
                    name: "action",
                    value: "get_astrologist"
                });
                $.post(the_ajax_script.ajaxurl, data, function (response) {
                    var res = JSON.parse(response);
                    if (res.msg_type == "OK") {

                        if (res.sub_services != "") {
                            $("#sub_service").slideDown(800);
                            $("#sub_service").find("#astrology_services").html(res.sub_services);
                            $("#have_sub").val(1);
                        } else {
                            $("#sub_service").slideUp(800);
                            $("#sub_service").find("#astrology_services").html("");
                            $("#have_sub").val(0);
                        }
                        setTimeout(function () {
                            $("#no_error").slideUp(800);
                            $("#select_astrolger_div").slideDown(500);
                            $("#basic_info").slideDown(500);
                            $("#other_information").slideDown(800);

                            if (data_id == "multiple") {
                                $("#partner_details").slideDown(500);
                                $("#need_partner").val(1);
                            }
                            $("#set_strologer").slideDown(1500, function () {
                                $("#set_strologer").html(res.return_div)
                            });
                            $(".checkUser").click(function () {

                                var $box = $(this);
                                if ($box.is(":checked")) {
                                    var item_id = this.value;
                                    var data_value = $(this).data('value');
                                    var group = "input:checkbox[name='" + $box.attr("name") + "']";
                                    $(group).prop("checked", false);
                                    $box.prop("checked", true);
                                    $("#set_price").html("රු " + WL.format_number(data_value, 2));

                                    //send ajax request

                                } else {
                                    $box.prop("checked", false);
                                    $("#set_price").html("රු " + WL.format_number("000", 2));
                                }
                            });
                            $(".checkSub_Service").click(function () {

                                var $box = $(this);
                                if ($box.is(":checked")) {
                                    //                                    var item_id = this.value;
                                    //                                    var data_value = $(this).data('value');
                                    var group = "input:checkbox[name='" + $box.attr("name") + "']";
                                    $(group).prop("checked", false);
                                    $box.prop("checked", true);
                                    //                                    $("#set_price").html("රු " + WL.format_number(data_value, 2));

                                    //send ajax request

                                } else {
                                    $box.prop("checked", false);
                                    //                                    $("#set_price").html("රු " + WL.format_number("000", 2));
                                }
                            });
                        }, 800)


                        Notiflix.Loading.Remove(600);
                        //Notiflix.Notify.Success(res.msg);
                    } else {
                        $("#no_error").slideDown(800);
                        $("#sub_service").slideUp(800);
                        $("#sub_service").find("#astrology_services").html("");
                        // Notiflix.Notify.Failure(res.msg);
                        Notiflix.Loading.Remove(600);
                    }
                });
            } else {
                $box.prop("checked", false);
            }
        });

        $("#submit_values_home").click(function () {
            Notiflix.Loading.Merge({
                messageMaxLength: 700,
            });
            Notiflix.Loading.Pulse('මොහොතක් රැදීසිටින්න |Process in prograss');
            var data = $("#astrology_data").serializeArray();
            data.push({
                name: "action",
                value: "submit_form_data"
            });
            $.post(the_ajax_script.ajaxurl, data, function (response) {
                var res = JSON.parse(response);
                if (res.msg_type == "OK") {
                    Notiflix.Notify.Success(res.msg);
                    //                    WL.generate_function_messages("errorId", "alert-success", res.msg, "3000");
                    setTimeout(function () {
                        location.reload();
                    }, 2500);
                } else {
                    Notiflix.Notify.Failure(res.msg);
                    //                    WL.generate_function_messages("errorId", "alert-danger", res.msg, "3000");
                    Notiflix.Loading.Remove(600);
                    setTimeout(function () {
                        //location.reload();
                    }, 2500);
                }
            });
        });

    });
})(jQuery);