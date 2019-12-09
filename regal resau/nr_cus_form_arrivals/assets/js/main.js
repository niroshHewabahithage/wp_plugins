const monthNames = ["JAN", "FEB", "MAR", "APR", "MAY", "JUN",
    "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"
];
$(document).ready(function () {
//    Notiflix.Notify.Success('Sol lucet omnibus');
    $(function () {
        $('#arrivaldate').bootstrapMaterialDatePicker({
            time: false
        });
    });
    $(function () {
        $('#departure_date').bootstrapMaterialDatePicker({
            time: false
        });
    });

    var d = new Date();

    var month = d.getMonth() + 1;
    var day = d.getDate();
//    window.alert(d.getMonth());
    var monthName = monthNames[d.getMonth()];
    console.log("The current month is " + monthNames[d.getMonth()]);
    $("#firstImpression").find(".section_month").html(monthName);
    $("#firstImpression").find("#section_arrival").find(".section_date").html(day);
    $("#firstImpression").find("#section_departure").find(".section_date").html(day + 1);

    $("#section_arrival").click(function () {
//        window.alert();
//        window.alert(this.id);
        $("#arrivaldate").trigger('focus');
        $("#clicked_view_id").val(this.id);
        $(".dtp-btn-ok").click(function () {

        });

    });
    $("#section_departure").click(function () {
//        window.alert();
//        window.alert(this.id);
        $("#departure_date").trigger('focus');
        $("#clicked_view_id").val(this.id);
        $(".dtp-btn-ok").click(function () {

        });

    });


    $("#btn-check-availability").click(function () {
        var arrivaldate = $("#arrivaldate").val();
        var departureDate = $("#departure_date").val();
        var rooms = $("#rooms").val();

        if (arrivaldate != "" && typeof arrivaldate != 'undefined') {
            if (departureDate != "" && typeof departureDate != 'undefined') {
                if (rooms != null) {
                    $("#firstImpression").fadeOut(500).hide();
                    $("#second_impression").fadeIn(1500).show();
                } else {
                    Notiflix.Notify.Failure('Please Select how Many Rooms');
                }
            } else {
                Notiflix.Notify.Failure('Please Select a Departure Date');
            }
        } else {
            Notiflix.Notify.Failure('Please Select a Arrival Date');
        }
    });

    $("#btn-submit-email").click(function () {
        var name = $("#name").val();
        var phone = $("#telephone").val();
        var email = $("#email").val();
        var is_valid = false;

        if (name.trim() != "" && typeof name != "undefined") {
            if (phone.trim() != "" && typeof phone != "undefined") {
                if (email.trim() != "" && typeof email != "undefined") {
                    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                    if (re.test(email)) {
                        is_valid = true;
                    } else {
                        Notiflix.Notify.Failure('Please Provide Us a Valid Email');
                    }
                } else {
                    Notiflix.Notify.Failure('Please Provide Us a Email');
                }
            } else {
                Notiflix.Notify.Failure('Please Provide Us a Phone');
            }
        } else {
            Notiflix.Notify.Failure('Please Provide Us a Name');
        }
        
        if (is_valid){
            var data=$("#submit_arrival_form").serializeArray();
            window.console.warn(data);
        }
        
    });

});

function view_dates_list(selected_view, monthName_from, Datanames, yearName, next_date) {
    const monthNames = ["JAN", "FEB", "MAR", "APR", "MAY", "JUN",
        "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"
    ];


    var monthName = monthNames[monthName_from - 1];
    $("#firstImpression").find('#' + selected_view).find(".section_month").html(monthName);
    $("#firstImpression").find('#' + selected_view).find(".section_date").html(Datanames);

}


