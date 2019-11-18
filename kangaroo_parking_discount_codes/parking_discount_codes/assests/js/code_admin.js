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
//                    $('#configform')[0].reset();
                    location.reload();
                } else {
                    Notiflix.Notify.Failure(res.msg);
                }
            });
        });
        $("#update-discount-code").click(function () {
            var data = $("#frm-add-discount-code").serializeArray();
            data.push({
                name: "action",
                value: "update_discount_code"
            });
            $.post(the_ajax_script.ajaxurl, data, function (response) {
                var res = JSON.parse(response);
                if (res.msg_type == "OK") {
                    Notiflix.Notify.Success(res.msg);
//                    $('#configform')[0].reset();
                    location.reload();
                } else {
                    Notiflix.Notify.Failure(res.msg);
                }
            });
        });
    });

    $(".edit-items").click(function () {
        var item_id = this.value;
        $(".wp-list-table").find("button").attr("disabled", true);
        var data = [{"name": "item_id", "value": item_id}];
        data.push({
            name: "action",
            value: "edit_discount_code"
        });
        $.post(the_ajax_script.ajaxurl, data, function (response) {
            var res = JSON.parse(response);
            if (res.msg_type == "OK") {
                $("#discountCode").val(res.return_value.discount_code);
                $("#itemId").val(res.return_value.id);
                $("#percentage").val(res.return_value.percentage);
                $("#note").val(res.return_value.note);
                $("#save-discount-code").slideUp(500);
                $("#update-discount-code").delay(500).slideDown(800);
            } else {
                $(".wp-list-table").find("button").attr("disabled", false);
                Notiflix.Notify.Failure(res.msg);
            }
        });
    });

    $(".deactivate-items").click(function () {
        Notiflix.Loading.Merge({
            messageMaxLength: 700,
        });
        Notiflix.Loading.Pulse('Process in prograss');
        var item_id = this.value;
        var data = [{"name": "item_id", "value": item_id}];
        data.push({
            name: "action",
            value: "disable_discount_code"
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
    });
    $(".enable-items").click(function () {
        Notiflix.Loading.Merge({
            messageMaxLength: 700,
        });
        Notiflix.Loading.Pulse('Process in prograss');
        var item_id = this.value;
        var data = [{"name": "item_id", "value": item_id}];
        data.push({
            name: "action",
            value: "enable_discount_code"
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
                    value: "delete_discount_code"
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