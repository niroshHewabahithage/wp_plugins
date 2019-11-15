(function ($) {
    $(document).ready(function () {

        $("#frm-add-discount-code").reset;
        $("#basic-addon2").click(function () {
            var customPrefix = "KPARKING";
            var monthName = WL.get_current_month_name();
            var randomCode = WL.random_string();
            var discountCode = customPrefix + monthName + "-" + randomCode;
            $("#discountCode").val(discountCode);
            x = 0;
            setTimeout(function () {
                if ($("#discountCode").val() != "") {
                    $("#discountCode").trigger('change');
                }
            }, 400)

        });

        var x = 0;
        $("#discountCode").change(function () {
            Notiflix.Loading.Merge({
                messageMaxLength: 700,
            });
            Notiflix.Loading.Pulse('Validating the Created Discount Code for Duplicates...');
            var discount_code = this.value;
            var elem = this;
            var data = [{name: "discount_code", value: discount_code}];
            data.push({
                name: "action",
                value: "validate_discount_code"
            });
            $.post(the_ajax_script.ajaxurl, data, function (response) {
                var res = JSON.parse(response);
                if (res.msg_type == "OK") {

                } else {
                    Notiflix.Loading.Change(res.msg);
                    Notiflix.Notify.Failure(res.msg);
                    x = 1;

                }
                setTimeout(function () {
                    if (x == 1) {
                        $("#basic-addon2").trigger('click');
                    }
                    Notiflix.Loading.Remove(600);
                }, 1800)
            });
        });

        $("#save-discount-code").click(function () {
            var data = $("#frm-add-discount-code").serializeArray();
            data.push({
                name: "action",
                value: "save_discount_code"
            });
            $.post(the_ajax_script.ajaxurl, data, function (response) {
                var res = JSON.parse(response);
                if (res.msg_type == "OK") {
                    Notiflix.Notify.Success(res.msg);
                    $('#configform')[0].reset();
                } else {
                    Notiflix.Notify.Failure(res.msg);
                }
            });
        });
    });
})(jQuery);