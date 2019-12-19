(function ($) {
    $(document).ready(function () {
        $("#save-items").click(function () {
            WL.disable_ele_fa(this, "");
            var data = $("#frm_submit_details").serializeArray();
            data.push({
                name: "action",
                value: "save_service"
            });
            var elem = this;
            $.post(the_ajax_script.ajaxurl, data, function (response) {
                var res = JSON.parse(response);
                if (res.msg_type == "OK") {
                    Notiflix.Notify.Success(res.msg);
                    setTimeout(function () {
                        location.reload();
                    }, 2500);
                } else {
                    Notiflix.Notify.Failure(res.msg);
                    setTimeout(function () {
                        WL.enable_ele_fa(elem, "");
                        //location.reload();
                    }, 2500);
                }
            });
        });
    });

    $(".edit-items").click(function () {
        var item_id = this.value;
        var data = [{"name": "item_id", "value": item_id}];
        data.push({
            name: "action",
            value: "get_edit_details"
        });
        $.post(the_ajax_script.ajaxurl, data, function (response) {
            var res = JSON.parse(response);
            if (res.msg_type == "OK") {
//                Notiflix.Notify.Success(res.msg);
                $("#itemId").val(res.return_array.id);
                $("#serviceNameSin").val(res.return_array.service_name_si);
                $("#serviceNameEn").val(res.return_array.service_name_en);
                $("#servicePrice").val(res.return_array.service_price);
                if (res.return_array.is_multiple == 1) {
                    $("#serviceMultiple").attr("checked", true);
                } else {
                    $("#serviceMultiple").attr("checked", false);
                }
                $("#save-items").slideUp(500);
                $("#update-items").delay(500).slideDown(800);
            } else {
                Notiflix.Notify.Failure(res.msg);
                setTimeout(function () {
                    //location.reload();
                }, 2500);
            }
        });
    });

    $("#update-items").click(function () {
        var data = $("#frm_submit_details").serializeArray();
        data.push({
            name: "action",
            value: "update_services"
        });
        $.post(the_ajax_script.ajaxurl, data, function (response) {
            var res = JSON.parse(response);
            if (res.msg_type == "OK") {
                Notiflix.Notify.Success(res.msg);
                setTimeout(function () {
                    location.reload();
                }, 2500);
            } else {
                Notiflix.Notify.Failure(res.msg);
                WL.generate_function_messages("errorId", "alert-danger", res.msg, "3000");
                setTimeout(function () {
                    //location.reload();
                }, 2500);
            }
        });
    });

    $(".delete-items").click(function () {
        Swal.fire({
            title: 'Are you sure?',
            text: "To delete this Discount Code, this will Pememntly Delete!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                Notiflix.Loading.Merge({
                    messageMaxLength: 700,
                });
                Notiflix.Loading.Pulse('Process in prograss');
                var item_id = this.value;
                var data = [{"name": "item_id", "value": item_id}];
                data.push({
                    name: "action",
                    value: "delete_service"
                });
                $.post(the_ajax_script.ajaxurl, data, function (response) {
                    var res = JSON.parse(response);
                    if (res.msg_type == "OK") {
                        Notiflix.Notify.Success(res.msg);
                        Notiflix.Loading.Change(res.msg);
                        setTimeout(function () {
                            location.reload();
                        }, 800)
                    } else {
                        Notiflix.Notify.Failure(res.msg);
                        Notiflix.Loading.Change(res.msg);
                        Notiflix.Loading.Remove(600);
                    }
                });
            }
        })

    });
})(jQuery);


