(function ($) {
    $(document).ready(function () {
        $("#discount_code").change(function () {
            var package_price = $(this).parent().find('.price_come').val();
            var symbol = $(this).parent().find('.price_symbol').val();
            var discount_code = $(this).val();
            var elem = this;
            var data = [{"name": "total", "value": package_price}, {"name": "discount_code", "value": discount_code}, {"name": "symbol", "value": symbol}];
            data.push({
                name: "action",
                value: "val_discount_code"
            });

            $.post(the_ajax_script.ajaxurl, data, function (response) {
                var res = JSON.parse(response);
                if (res.msg_type == "OK") {
                    Notiflix.Notify.Success(res.msg);
                    $("#error_code").addClass("success_font").html(res.msg);
                    $("#discountVal").html(res.symbol + " " + WL.format_number(res.discount, 2));
                    $("#final_value").html(res.symbol + " " + WL.format_number(res.total_value_final, 2));
                } else {
                    Notiflix.Notify.Failure(res.msg);
                    $("#error_code").addClass("error_font").html(res.msg);
                }
            });
        });
    });
})(jQuery);