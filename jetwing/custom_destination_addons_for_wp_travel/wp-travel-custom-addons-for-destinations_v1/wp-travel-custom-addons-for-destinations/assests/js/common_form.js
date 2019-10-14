$(document).ready(function () {
    $("#dateofbirth").attr("max", WL.define_max_min_date(15)).val(WL.define_max_min_date(15));
    $("#dateofbirth").change(function () {
        var dateofbirth = this.value;
        var age_of_user = WL.define_age_from_dob(dateofbirth);
    });

    $("#btn-save-personal_info").click(function () {
        Notiflix.Loading.Standard('Loading ...');
        Notiflix.Loading.Change('Please Wait..');
        var data = $("#save_personal_information").serializeArray();
        data.push({
            name: "action",
            value: "primary_info"
        });
        window.console.warn(data);
        $.post(the_ajax_script.ajaxurl, data, function (response) {
            var res = JSON.parse(response);
            if (res.msg_type == "OK") {
                Notiflix.Notify.Success(res.msg);
                $(".show_error").slideDown(800).find(".set_class").addClass("my_success").find("span").html(res.msg);
                var trigger_element = $("#trigger_from_id").val();
                $("#" + trigger_element).slideDown(1500);
                $("#primary_person_id").val(res.primary_id);
                WL.disable_btn_fa("btn-save-personal_info","Saving Package inprograss");
                setTimeout(function () {
                    
                    $(".show_error").slideUp(800).find(".set_class").removeClass("my_success").find("span").html("");
                    Notiflix.Loading.Remove(300);
                }, 1500);
            } else {
                Notiflix.Notify.Failure(res.msg);
                $(".show_error").slideDown(800).find(".set_class").addClass("my_error").find("span").html(res.msg);
                setTimeout(function () {
                    Notiflix.Loading.Remove(300);
                    $(".show_error").slideUp(800).find(".set_class").removeClass("my_error").find("span").html("");
                }, 1500);
            }
        });
    });
});


