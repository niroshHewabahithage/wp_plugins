(function ($) {
    $(document).ready(function () {
        $(".checkService").attr("checked", false);
        $(".checkUser").attr("checked", false);
        $(".checkService").click(function () {
            $("#set_strologer").html("");
            $("#select_astrolger_div").slideUp(500);
            $("#basic_info").slideUp(500);
            $("#partner_details").slideUp(500);
            var $box = $(this);
            if ($box.is(":checked")) {
                var item_id = this.value;
                var data_id = $(this).attr("data-id");
                var data_value = $(this).data('value');
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
                var data = [{"name": "item_id", "value": item_id}];
                data.push({
                    name: "action",
                    value: "get_astrologist"
                });
                $.post(the_ajax_script.ajaxurl, data, function (response) {
                    var res = JSON.parse(response);
                    if (res.msg_type == "OK") {
                        $("#no_error").slideUp(800);
                        $("#select_astrolger_div").slideDown(500);
                        $("#basic_info").slideDown(500);
                        $("#set_price").html("රු " + WL.format_number(data_value, 2));
                        if (data_id == "multiple") {
                            $("#partner_details").slideDown(500);
                        }
                        $("#set_strologer").slideDown(1500, function () {
                            $("#set_strologer").html(res.return_div)
                        });
                        Notiflix.Loading.Remove(600);
                        //Notiflix.Notify.Success(res.msg);
                    } else {
                        $("#no_error").slideDown(800);
                        // Notiflix.Notify.Failure(res.msg);
                        Notiflix.Loading.Remove(600);
                    }
                });
            } else {
                $box.prop("checked", false);
            }
        });
        $(".checkUser").click(function () {
            var $box = $(this);
            if ($box.is(":checked")) {
                var item_id = this.value;
                var group = "input:checkbox[name='" + $box.attr("name") + "']";
                $(group).prop("checked", false);
                $box.prop("checked", true);

                //send ajax request

            } else {
                $box.prop("checked", false);
            }
        });
    });
})(jQuery);