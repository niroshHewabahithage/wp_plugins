jQuery.noConflict();
(function($) {
    $(function() {
        $(document).ready(function() {
            $(".itemColors").change(function() {
                var color_value = this.value;
                var colorBox = this;
                if ($(colorBox).is(":checked")) {
                    $("#" + color_value).slideDown(800);
                } else {
                    $("#" + color_value).find("input[type='checkbox']").attr("checked", false);
                    $("#" + color_value).slideUp(800);
                }
            });

            $("#save-items").click(function() {

                Notiflix.Loading.Merge({
                    messageMaxLength: 700,
                });
                Notiflix.Loading.Pulse('Process in prograss');
                var data = $("#form_items").serializeArray();
                data.push({
                    name: "action",
                    value: "save_items"
                });
                var elem = this;
                $.post(the_ajax_script.ajaxurl, data, function(response) {
                    var res = JSON.parse(response);
                    if (res.msg_type == "OK") {
                        Notiflix.Notify.Success(res.msg);
                        setTimeout(function() {
                            location.reload();
                        }, 2500);
                    } else {
                        Notiflix.Notify.Failure(res.msg);
                        $("#" + res.id_value).addClass("error_glow");
                        Notiflix.Loading.Remove(600);
                        setTimeout(function() {
                            WL.enable_ele_fa(elem, "");
                            $("#" + res.id_value).removeClass("error_glow");
                            //location.reload();
                        }, 2500);
                    }
                });
            });

            $(".delete-items").click(function() {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "To delete this Item, this will Pememntly Delete!",
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
                        var data = [{ "name": "item_id", "value": item_id }];
                        data.push({
                            name: "action",
                            value: "delete_items"
                        });
                        $.post(the_ajax_script.ajaxurl, data, function(response) {
                            var res = JSON.parse(response);
                            if (res.msg_type == "OK") {
                                Notiflix.Notify.Success(res.msg);
                                Notiflix.Loading.Change(res.msg);
                                setTimeout(function() {
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
        });
    });
})(jQuery);