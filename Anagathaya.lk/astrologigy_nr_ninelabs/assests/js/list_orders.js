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
            var data = [{"name": "item_value", "value": item_value}];
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
                    Notiflix.Loading.Remove(600);
                } else {
                    Notiflix.Notify.Failure(res.msg);
                    $("#display_panel").slideUp(800);
                    $("#list_orders").removeClass("col-lg-8").addClass("col-lg-12");
                    $("#custom-show-table").find("tbody").html();
                    Notiflix.Loading.Remove(600);
                }
            });
        });
    });
})(jQuery);