(function ($) {
    $(document).ready(function () {
        $(".checkService").attr("checked", false);
        $(".checkService").click(function () {
            var $box = $(this);
            if ($box.is(":checked")) {
                var item_id = this.value;
                var group = "input:checkbox[name='" + $box.attr("name") + "']";
                $(group).prop("checked", false);
                $box.prop("checked", true);

                //send ajax request
               var data=[{"name":"item_id","value":item_id}]; 
                data.push({
                name: "action",
                value: "get_astrologist"
            });
                $.post(the_ajax_script.ajaxurl, data, function (response) {
                    var res = JSON.parse(response);
                    if (res.msg_type == "OK") {
                        Notiflix.Notify.Success(res.msg);
                    } else {
                        Notiflix.Notify.Failure(res.msg);
                    }
                });
            } else {
                $box.prop("checked", false);
            }
        });
    });
})(jQuery);