(function ($) {
    $(document).ready(function () {

        // $('select').selectpicker();
    });
    function get_objectsize(obj) {
        var size = 0, key;
        for (key in obj) {
            if (obj.hasOwnProperty(key))
                size++;
        }
        return size;
    }
    function readURL(input, img) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#' + img).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    function nl2br(str, is_xhtml) {
        var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
        return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
    }
    function br2nl(str) {
        var regex = /<br\s*[\/]?>/gi;
        return(str.replace(regex, "\n"));
    }
    function YouTubeGetID(url) {
        var ID = '';
        url = url.replace(/(>|<)/gi, '').split(/(vi\/|v=|\/v\/|youtu\.be\/|\/embed\/)/);
        if (url[2] !== undefined) {
            ID = url[2].split(/[^0-9a-z_\-]/i);
            ID = ID[0];
        } else {
            ID = url;
        }
        return ID;
    }


    $(document).on("keypress", "input:not(.no-enter)", function (event) {
        return event.keyCode != 13;
    });


    WL = {
        Notify: function (message, type, not_close) {
            var parent = document.createElement("div");
            $(parent).css(
                    {
                        position: "fixed",
                        top: "-100",
                        right: "5px",
                        "z-index": "900000",
                        padding: "10px",
                        "margin-bottom": "0px",
                        width: "350px"
                    });
            $(parent).addClass("alert text-left alert-dismissible").addClass("alert-" + type);
            var lable = document.createElement("h4");
            var p = document.createElement("p");
            $(lable).addClass("font18px");
            $(lable).html(type === "success" ? "SUCCESSFULL" : "ERROR!");
            $(p).html(message);
            $(p).addClass("font14px");
            if (typeof not_close !== "undefined") {
                $(parent).append('<button type="button" class="close" data-dismiss="alert" style="right:0">&times;</button>');
            }
            $(parent).append(lable, p);
            $('body').append(parent);
            $(parent).show();
            $(parent).animate({top: "10px"}, 500, "easeOutElastic", function () {
                setTimeout(function () {
                    if (typeof not_close === "undefined") {
                        $(parent).animate({"top": '-100px'}, 1000, "easeInElastic", function () {
                            $(parent).remove();
                        });
                    }
                }, 2000);
            });
            return false;
        },
        Confirm: function (message, func, func_before, func_after) {
            if (typeof func_before !== "undefined") {
                func_before();
            }
            if (typeof func_after === "undefined") {
                func_after = function () {};
            }
            var parent_overlay = document.createElement("div");
            var parent_overlay_content = document.createElement("div");
            $(parent_overlay).css(
                    {
                        position: "fixed",
                        top: "0px",
                        left: "0px",
                        right: "0px",
                        bottom: "0px",
                        opacity: "0.2",
                        "background-color": "rgba(0, 0, 0, 0.2)",
                        "z-index": "10051"
                    }).addClass(" bg-grey-gallery bg-font-grey-gallery");
            $(parent_overlay_content).css({height: "100%"});
            var parent = document.createElement("div");
            $(parent).css(
                    {
                        position: "fixed",
                        top: "-100",
                        right: "5px",
                        "z-index": "900000",
                        padding: "10px",
                        "margin-bottom": "0px",
//                    "background-color": "#7b2121",
                        color: "#fff",
                        width: "350px",
                        border: "3px solid"
                    });
            $(parent).addClass("alert text-left alert-dismissible bg-red-flamingo bg-font-red-flamingo").addClass("");
            var lable = document.createElement("h4");
            var p = document.createElement("p");
            var p_btn = document.createElement("p");
            $(lable).addClass("font18px");
            $(lable).html("Confirmation ?");
            var yes = document.createElement("button");
            var no = document.createElement("button");
            $(yes).click(func);
            $(yes).addClass("btn btn-success btn-sm").html("Yes").click(function () {
                $(parent).animate({"top": '-100px'}, 500, "easeInOutQuart", function () {
                    $(parent).remove();
                    $(parent_overlay).remove();
                    func_after();
                });
            });
            $(no).addClass("btn btn-default btn-sm").html("No").click(function () {
                $(parent).animate({"top": '-100px'}, 500, "easeInOutQuart", function () {
                    $(parent).remove();
                    $(parent_overlay).remove();
                    func_after();
                });
            });
            $(p).html(message);
            $(p_btn).append(yes, "&nbsp;&nbsp;", no);
            $(p).addClass("font14px");
            var cls_btn = document.createElement("button");
            $(cls_btn).addClass("close").attr({type: "button", "data-dismiss": "alert"}).css({right: 0}).html("&times;");
            $(cls_btn).click(function () {
                $(parent_overlay).remove();
                func_after();
            });
            $(parent).append(cls_btn);
            $(parent).append(lable, p, p_btn);
            $('body').append(parent_overlay);
            $('body').append(parent);
            $(parent).show();
            $(parent).animate({top: "0px"}, 500, "easeOutElastic", function () {
                $(yes).focus();
            });
            return false;
        },
        Input: function (message, name, cls, func) {
            var parent_overlay = document.createElement("div");
            var parent_overlay_content = document.createElement("div");
            $(parent_overlay).css(
                    {
                        position: "fixed",
                        top: "0px",
                        left: "0px",
                        right: "0px",
                        bottom: "0px",
                        "background-color": "rgba(0, 0, 0, 0.2)",
                        "z-index": "10000"
                    });
            $(parent_overlay_content).css({height: "100%"});
            var parent = document.createElement("div");
            $(parent).css(
                    {
                        position: "fixed",
                        top: "-100",
                        right: "5px",
                        "z-index": "900000",
                        padding: "10px",
                        "margin-bottom": "0px",
                        width: "350px"
                    });
            $(parent).addClass("alert text-left alert-dismissible").addClass("alert-warning");
            var lable = document.createElement("h4");
            var p = document.createElement("p");
            var p_btn = document.createElement("p");
            $(lable).addClass("font18px");
            $(lable).html("Confirmation !");
            var yes = document.createElement("button");
            var no = document.createElement("button");
            $(yes).click(func);
            $(yes).addClass("btn btn-success btn-sm").html("Yes").click(function () {
                $(parent).animate({"top": '-100px'}, 500, "easeInOutQuart", function () {
                    $(parent).remove();
                    $(parent_overlay).remove();
                });
            });
            $(no).addClass("btn btn-default btn-sm").html("No").click(function () {
                $(parent).animate({"top": '-100px'}, 500, "easeInOutQuart", function () {
                    $(parent).remove();
                    $(parent_overlay).remove();
                });
            });
            $(p).html(message);
            var inpt = document.createElement("input");
            $(inpt).attr({type: "text", id: name}).css({
                display: "block",
                width: "100%",
                height: "37px",
                "padding-left": "20px",
                "line-height": "1.846",
                color: "#666666",
                "background-color": "#fff",
//                        border: "1px solid transparent",
//                        "border-radius": "3px",
                "-webkit-transition": "border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s",
                "-o-transition": "border-color ease -in-out .15s, box-shadow ease-in-out .15s",
                transition: "border-color ease-in-out .15s, box-shadow ease-in-out .15s",
                "padding": "15px !important",
                "margin-bottom": "15px",
                "border": "none",
                "border-radius": "0",
                "-webkit-appearance": "none",
                "-webkit-box-shadow": "inset 0 -1px 0 #ddd",
                "box-shadow": "inset 0 -1px 0 #ddd",
                "font-size": "16px"
            });
            if (cls === "date") {
                $(inpt).datepicker({dateFormat: "yy-mm-dd"});
            }
            if (cls === "number") {
                $(inpt).number(true, 2);
            }
            $(inpt).addClass(cls);
            $(inpt).keypress(function (e) {
                if (e.keyCode == 13) {
                    $(yes).trigger("click");
                }
            })
            $(p_btn).append(yes, "&nbsp;&nbsp;", no);
            $(p).addClass("font14px");
            var cls_btn = document.createElement("button");
            $(cls_btn).addClass("close").attr({type: "button", "data-dismiss": "alert"}).css({right: 0}).html("&times;");
            $(cls_btn).click(function () {
                $(parent_overlay).remove();
            });
            $(parent).append(cls_btn);
            $(parent).append(lable, p, inpt, p_btn);
            $('body').append(parent_overlay);
            $('body').append(parent);
            $(parent).show();
            $(parent).animate({top: "0px"}, 500, "easeOutElastic", function () {
                $(inpt).focus()
            });
            return false;
        },
        Overlay_notify: function (title, text, type) {
            var parent_overlay = document.createElement("div");
            var parent_overlay_content = document.createElement("div");
            $(parent_overlay).css(
                    {
                        position: "fixed",
                        top: "0px",
                        left: "0px",
                        right: "0px",
                        bottom: "0px",
                        "background-color": "rgba(0, 0, 0, 0.8)",
                        "z-index": "10000"
                    });
            $(parent_overlay_content).css({height: "100%"});
            var parent = document.createElement("div");
            $(parent).addClass("col-md-4").addClass("col-md-offset-4");
            $(parent).css(
                    {
                        top: "25%",
                        color: "#000",
                        padding: "20px",
                        "background-color": "#fff",
                        position: "relative"
                    });
            var label = document.createElement("label");
            $(parent).addClass("text-center");
            var h5 = document.createElement("p");
            var h4 = document.createElement("h4");
            $(h4).html(title).addClass("text-" + type);
            $(h5).html(text);
            ;
            $(h4).css({
                "padding": "5px 10px 10px 10px",
                "border-bottom": "1px solid #666"
            });
            var span = document.createElement("span");
            var small = document.createElement("small");
            $(span).html("text-dim");
            $(span).html("click to dismis");
            $(small).css({position: "absolute", "bottom": 2, right: 5});
            $(small).append(span);
            $(label).append(h5);
            $(parent).append(h4);
            $(parent).append(small);
            $(parent).append(label);
            $(parent_overlay_content).append(parent);
            $(parent_overlay).append(parent_overlay_content);
            $('body').css({overflow: "hidden"});
            $('body').append(parent_overlay);
            $(parent_overlay).click(function () {
                $(parent_overlay).fadeOut(300, function () {
                    $(parent_overlay).remove();
                    $('body').css({overflow: "scroll"});
                });
            });
            $(parent).show();
            return false;
        },
        /**
         * @description Generate an Overlay popup input dialog
         * @data title: "",
         value: "",
         placeholder: "",
         type: "text",
         options: false,
         no_empty: false,
         greater_than: "no",
         button: {
         yes: {txt: "OK"},
         no: {txt: "CANCEL"}
         },
         before: function () {
         },
         click: function () {
         alert("");
         }
         * @param {title} String Tilte Of the dialog
         * @param {placeholder} String placeholder Of the input field
         * @param {type} String typeOf the input field
         * @param {value} String Initial Value
         * @param {empty} boolean If the input field eccept empty values before submit
         * @param {options} array If input field an instant Select
         * @param {click} function On click function for OK btn
         * @param {button_txt} String primary btn text
         **/
        Overlay_input: function (config) {
            var defaults = {
                title: "",
                value: "",
                placeholder: "",
                type: "text",
                options: false,
                no_empty: false,
                greater_than: "no",
                button: {
                    yes: {txt: "OK"},
                    no: {txt: "CANCEL"}
                },
                before: function () {
                },
                click: function () {
                    alert("");
                }
            };
            var options = defaults;
            if (config) {
                options = $.extend(defaults, config);
            }

            var title, placeholder, type, no_empty, i_options;
            title = options.title;
            placeholder = options.placeholder;
            type = options.type;
            no_empty = options.no_empty;
            i_options = options.options;

            var parent_overlay = document.createElement("div");
            var parent_overlay_content = document.createElement("div");
            $(parent_overlay).css(
                    {
                        position: "fixed",
                        top: "0px",
                        left: "0px",
                        right: "0px",
                        bottom: "0px",
                        "background-color": "rgba(0, 0, 0, 0.8)",
                        "z-index": "10050"
                    });
            $(parent_overlay_content).css({height: "100%"});
            var parent = document.createElement("div");
            $(parent).addClass("col-md-4").addClass("col-md-offset-4");
            $(parent).css("cssText", "border-radius: 10px!important");
            $(parent).css(
                    {
                        top: "25%",
                        color: "#000",
                        padding: "20px",
                        "background-color": "#fff",
                        position: "relative",
                        border: "2px solid rgb(51, 122, 183)",
                        "border-radius": "10px!important"
                    });
            $(parent).addClass("text-center");
            var h4 = document.createElement("p");
            $(h4).html(title).addClass("text-primary");
            $(h4).css({
                "padding": "5px 10px 10px 0px",
                "margin-left": 0,
                "text-align": "left",
                "font-size": '15px',
                "font-weight": 700
            });

            if (type.toLowerCase() === "select") {
                var input = document.createElement("select");
                $(input).addClass("form-control input-sm");
                for (var option in i_options) {
                    var opt = document.createElement("option");
                    $(opt).html(i_options[option]).val(option);
                    $(input).append(opt);
                }
            } else if (type == "textarea") {
                var input = document.createElement("textarea");
            } else {
                var input = document.createElement("input");
                if (type.toLowerCase() === "number") {
                    $(input).number(true, 2);
                    type = "text";
                }
                if (type.toLowerCase() === "date") {
                    $(input).datepicker(i_options);
                    type = "text";
                }
                $(input).attr({type: type, placeholder: placeholder}).addClass("form-control").val(options.value);
            }
            var span = document.createElement("span");
            var small = document.createElement("small");

            var div = document.createElement("div");
            var div_col_8 = document.createElement("div");
            var div_col_4 = document.createElement("div");

            var btn = document.createElement("button");
            $(btn).attr({type: "button"}).html("<span>" + options.button.yes.txt + "</span>").addClass("btn-block btn btn-success");

            if (type === "textarea") {

                $(div_col_8).addClass("col-lg-12 form-group");
                $(div).addClass("row");
                $(btn).addClass("pull-right").removeClass("btn-block");
                $(input).addClass("form-control").css({"margin-bottom": "10px"});
                ;
                $(div_col_8).append(input, btn);

                $(div).append(div_col_8, div_col_4);

            } else {

                $(div_col_4).addClass("col-lg-3");
                $(div_col_8).addClass("col-lg-9 form-group");
                $(div).addClass("row");

                $(div_col_8).append(input);
                $(div_col_4).append(btn);
                $(div).append(div_col_8, div_col_4);
            }

            $(btn).click(function () {
                WL.disable_ele_fa(btn, "Processing");
                var v = $(input).val();
                if (options.greater_than !== "no") {
                    if (Number(v) <= Number(options.greater_than)) {
                        $(input).css({border: "1px solid red"});
                        return false;
                    }
                }

                if (no_empty === false) {
                    if (v === "") {
                        $(input).css({border: "1px solid red"});
                        return false;
                    } else {
                        options.click(v);
                        $(parent_overlay).fadeOut(300, function () {
                            $(parent_overlay).remove();
                            $('body').css({overflow: "initial"});
                        });
                    }
                } else {
                    options.click(v);
                    $(parent_overlay).fadeOut(300, function () {
                        $(parent_overlay).remove();
                        $('body').css({overflow: "initial"});
                    });
                }
                $(parent_overlay).fadeOut(300, function () {
                    $(parent_overlay).remove();
                    $('body').css({overflow: "initial"});
                });
            });
            if (type !== "textarea") {
                $(input).keyup(function (e) {
                    if (e.keyCode === 13) {
                        $(btn).trigger("click");
                    }
                });
            }

            $(span).addClass("text-danger text-strong");
            $(span).html("&times;");
            $(small).css({position: "absolute", "top": 5, right: 8, cursor: "pointer"});
            $(small).append(span);
            $(parent).append(h4);
            $(parent).append(small);
            $(parent).append(div);
            $(parent_overlay_content).append(parent);
            $(parent_overlay).append(parent_overlay_content);
            $('body').css({overflow: "hidden"});
            $(small).click(function () {
                $(parent_overlay).fadeOut(300, function () {
                    $(parent_overlay).remove();
                    $('body').css({overflow: "initial"});
                });
            });
            $('body').append(parent_overlay);
            $(parent).show(function () {
                options.before(input);
                console.log(input);
                $(input).focus().select();
            });
            return false;
        },
        /**
         * @description Generate an Overlay Yes No Dialog. 
         * 
         * @param {title} String Tilte Of the dialog
         * @param {click} function On click function for OK btn
         * @param {btn_yes_txt} String YES btn text
         * @param {btn_no_txt} String NO btn text
         *      title: "",
         placeholder: "",
         no_empty: "",
         btn_txt: "",
         func: function(){}
         **/
        Overlay_confirm: function (config) {
            var defaults = {
                title: "",
                button: {
                    yes: {txt: "YES"},
                    no: {txt: "NO"}
                },
                click: function () {
                    alert("");
                }
            }
            var options = defaults;
            if (config) {
                options = $.extend(defaults, config);
            }


            var parent_overlay = document.createElement("div");
            var parent_overlay_content = document.createElement("div");
            $(parent_overlay).css({
                position: "fixed",
                top: "0px",
                left: "0px",
                right: "0px",
                bottom: "0px",
                "background-color": "rgba(0, 0, 0, 0.8)",
                "z-index": "10000"
            });
            $(parent_overlay_content).css({height: "100%"});
            var parent = document.createElement("div");
            $(parent).addClass("col-md-4").addClass("offset-md-4");
            $(parent).css("cssText", "border-radius: 10px!important");
            $(parent).css(
                    {
                        top: "25%",
                        color: "#000",
                        padding: "20px",
                        "background-color": "#fff",
                        position: "relative",
                        border: "2px solid rgb(51, 122, 183)",
                        "border-radius": "10px!important"
                    });
            $(parent).addClass("text-center");
            var h4 = document.createElement("p");
            $(h4).html(options.title)//.addClass("text-primary");
            $(h4).css({
                "padding": "5px 10px 10px 0px",
                "margin-left": 0,
                "font-size": '15px',
                "font-weight": 400
            });
            var span = document.createElement("span");
            var small = document.createElement("small");

            var div = document.createElement("div");
            var div_col_4 = document.createElement("div");

            var btn = document.createElement("button");
            var btn_no = document.createElement("button");
            $(btn).attr({type: "button"}).html(options.button.yes.txt).addClass("btn btn-sm btn-success").css({"margin-right": "5px", "margin-left": "5px"});
            $(btn_no).attr({type: "button"}).html(options.button.no.txt).addClass("btn btn-sm btn-danger").css({"margin-right": "5px", "margin-left": "5px"});

            $(div_col_4).addClass("col-lg-12 text-center");
            $(div).addClass("row");

            $(div_col_4).append(btn, btn_no);
            $(div).append(div_col_4);

            $(btn).click(function () {
                var v = true;
                options.click(v);
                $(parent_overlay).fadeOut(300, function () {
                    $(parent_overlay).remove();
                    $('body').css({overflow: "initial"});
                });
            });
            $(btn_no).click(function () {
                var v = false;
                options.click(v);
                $(parent_overlay).fadeOut(300, function () {
                    $(parent_overlay).remove();
                    $('body').css({overflow: "initial"});
                });
            });

            $(span).addClass("text-danger text-strong");
            $(span).html("&times;");
            $(small).css({position: "absolute", "top": 5, right: 8, cursor: "pointer"});
            $(small).append(span);
            $(parent).append(h4);
            $(parent).append(small);
            $(parent).append(div);
            $(parent_overlay_content).append(parent);
            $(parent_overlay).append(parent_overlay_content);
            $('body').css({overflow: "hidden"});
            $(small).click(function () {
                $(parent_overlay).fadeOut(300, function () {
                    $(parent_overlay).remove();
                    $('body').css({overflow: "initial"});
                });
            });
            $('body').append(parent_overlay);
            $(btn).focus();
            return false;
        },
        enable_btn: function (id, after) {
            $("#" + id).removeClass("disabled");
            $("#" + id).prop({disabled: false});
            $("#" + id + " img").addClass("hidden");
            $("#" + id + " span").html(after);
            $("#" + id + " b").removeClass("hidden");
        },
        disable_btn: function (id, before) {
            $("#" + id).prop({disabled: true});
            $("#" + id).addClass("disabled");
            $("#" + id + " img").removeClass("hidden");
            $("#" + id + " span").html(before);
            $("#" + id + " b").addClass("hidden");
        },
        enable_btn_fa: function (id, after) {
            $("#" + id).prop({disabled: false});
            $("#" + id).removeClass("disabled");
            var cls = $("#" + id).data("cls");
            $("#" + id + " i").removeClass("fa fa-spinner fa-spin").addClass(cls);
            $("#" + id + " span").html(after);
        },
        disable_btn_fa: function (id, before) {
            $("#" + id).prop({disabled: true});
            $("#" + id).addClass("disabled");
            var cls = $("#" + id + " i").attr("class");
            $("#" + id + " i").removeAttr("class");
            $("#" + id).data('cls', cls);
            $("#" + id + " i").addClass("fa fa-spinner fa-spin");
            $("#" + id + " span").html(before);
        },
        enable_ele_fa: function (ele, after) {
            $(ele).prop({disabled: false});
            $(ele).removeClass("disabled");
            var cls = $(ele).data("cls");
            $(ele).find("i").removeClass("fa fa-spinner fa-spin").addClass(cls);
            $(ele).find("span").html(after);
        },
        disable_ele_fa: function (ele, before) {
            $(ele).prop({disabled: true});
            $(ele).addClass("disabled");
            var cls = $(ele).find("i").attr("class");
            $(ele).find("i").removeAttr("class");
            $(ele).data('cls', cls);
            $(ele).find("i").addClass("fa fa-spinner fa-spin");
            $(ele).find("span").html(before);
        },
        format_number: function (num, decimals) {
            if (typeof decimals !== "undefinded") {
                var number = $.number(num, decimals);
                return number;
            } else {
                var number = $.number(num, 2);
                return number;
            }
        },
        replace_coma: function (num) {
            var number = num.replace(",", "");
            return number;
        },
        highlight_err: function (ele) {
            $("#" + ele).parent().parent().addClass("has-error");
            setTimeout(function () {
                $("#" + ele).parent().parent().removeClass("has-error");
            }, 1500);
        },
        /**
         * @description Generate an Overlay Yes No Dialog. 
         * 
         * @param {title} String Tilte Of the dialog
         * @param {click} function On click function for OK btn
         * @param {btn_yes_txt} String YES btn text
         * @param {btn_no_txt} String NO btn text
         *      title: "",
         url: "",
         func: function(){}
         **/
        load_to_model: function (config) {
            var defaults = {
                title: "",
                url: "http://www.google.com/",
                type: "",
                fade: "fade",
                success: function () {

                }
            };
            var options = defaults;
            if (config) {
                options = $.extend(defaults, config);
            }
            var modal = document.createElement("div");
            var modal_dialog = document.createElement("div");
            var modal_content = document.createElement("div");
            var modal_header = document.createElement("div");
            var modal_body = document.createElement("div");

            var close_btn = document.createElement("button");
            var title = document.createElement("h4");

            var loading = document.createElement("h4");
            $(loading).html("Loading <i class='fa fa-spinner fa-spin'></i>").addClass("text-center");

            $(title).html(options.title).addClass("modal-title");
            $(close_btn).addClass("close").attr({type: "button", 'data-dismiss': "modal", 'aria-label': "Close"}).html('<span aria-hidden="true">&times;</span>');
            $(modal_header).addClass("modal-header").append(close_btn, title);
            $(modal_body).addClass("modal-body").append(loading);

            $(modal_content).append(modal_header, modal_body).addClass("modal-content");
            $(modal_dialog).append(modal_content).attr({role: "document"}).addClass("modal-dialog " + options.type);
            $(modal).addClass("modal " + options.fade).append(modal_dialog).attr({role: "dialog", tabindex: "-1"});
            $('body').append(modal);
            $(modal).modal();

            $(modal_body).load(options.url, function () {
                options.success();
            });
            $(modal).on('hidden.bs.modal', function () {
                $(modal).remove();
            });
            this.modal = modal;
            return modal;
        },
        /**
         * @description Generate an Overlay Yes No Dialog. 
         * 
         * @param {title} String Tilte Of the dialog
         * @param {click} function On click function for OK btn
         * @param {btn_yes_txt} String YES btn text
         * @param {btn_no_txt} String NO btn text
         *      title: "",
         url: "",
         func: function(){}
         **/
        show_model: function (config) {
            var defaults = {
                title: "",
                selector: "body",
                type: "",
                fade: "fade",
                success: function () {

                }
            };
            var options = defaults;
            if (config) {
                options = $.extend(defaults, config);
            }
            var modal = document.createElement("div");
            var modal_dialog = document.createElement("div");
            var modal_content = document.createElement("div");
            var modal_header = document.createElement("div");
            var modal_body = document.createElement("div");

            var close_btn = document.createElement("button");
            var title = document.createElement("h4");

            var loading = document.createElement("h4");
            $(loading).html("Loading <i class='fa fa-spinner fa-spin'></i>").addClass("text-center");

            $(title).html(options.title).addClass("modal-title");
            $(close_btn).addClass("close").attr({type: "button", 'data-dismiss': "modal", 'aria-label': "Close"}).html('<span aria-hidden="true">&times;</span>');
            $(modal_header).addClass("modal-header").append(close_btn, title);
            $(modal_body).addClass("modal-body").append(loading);

            $(modal_content).append(modal_header, modal_body).addClass("modal-content");
            $(modal_dialog).append(modal_content).attr({role: "document"}).addClass("modal-dialog " + options.type);
            $(modal).addClass("modal " + options.fade).append(modal_dialog).attr({role: "dialog", tabindex: "-1"});
            $('body').append(modal);
            $(modal).modal();

            $(modal_body).html("");
            $(options.selector + " > div").appendTo(modal_body);
            $(options.selector).find("input");
            $(modal).on('hidden.bs.modal', function () {
                $(modal_body).find("div:first").appendTo(options.selector);
                $(modal).remove();
            });
            $(modal).on('shown.bs.modal', function () {
                options.success();
            });
            this.modal = modal;
            return modal;
        },
        modal: null,
        getCookie: function (cname) {
            var name = cname + "=";
            var decodedCookie = decodeURIComponent(document.cookie);
            var ca = decodedCookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "";
        },
        close_model: function () {
            $(this.modal).modal("hide");
        },
        show_inline_msg: function (ele, message, type) {

            if (message.indexOf('<p>') !== -1) {
                message = $(message).text();
            }

            var msg = '<div class="alert alert-' + type + ' alert-dismissible alert-dismissible" role="alert">';
            msg += message;
            msg += '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
            $(ele).html(msg);
        },
        string_to_slug: function (str) {
            str = str.replace(/^\s+|\s+$/g, ''); // trim
            str = str.toLowerCase();
            str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
                    .replace(/\s+/g, '-') // collapse whitespace and replace by -
                    .replace(/-+/g, '-'); // collapse dashes
            return str;
        },
        string_to_short_code: function (str) {
            str = str.replace(/^\s+|\s+$/g, ''); // trim
            str = str.toLowerCase();
            str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
                    .replace(/\s+/g, '-') // collapse whitespace and replace by -
                    .replace(/-+/g, '-'); // collapse dashes
//            var new_shortCode="123";
            var new_shortCode = str.substring(0, 20);
            return new_shortCode;
        },
        random_string: function (config) {

            var defaults = {
                type: config,
                length: 4
            };
            var options = defaults;
            if (config) {
                options = $.extend(defaults, config);
            }
            var text = "";

            if (options.type === "allnum") {
                var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
            } else if (options.type === "alpha") {
                var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
            } else {
                var possible = "0123456789";
            }

            for (var i = 0; i < options.length; i++)
                text += possible.charAt(Math.floor(Math.random() * possible.length));

            return text;
        },
        check_upload_count: function (current_number) {
            var maximum_amount = 5;
            var okay = "";
            if (current_number < maximum_amount) {
                var btn = document.createElement("button");
                var i_tg = document.createElement("i");
                var spn = document.createElement("span");
                var spn_de = $(spn).addClass("span_this").css("margin", "0 10px").css("font-size", "22").html("Upload");
                var i_tg_des = $(i_tg).addClass("fa fa-upload").html(spn_de);
                var okay = $(btn).addClass("btn btn-block btn-warning btn-upload").attr("type", "button").attr("id", "multiple_uploader").html(i_tg_des);
                $("#btn-update_student").attr("disabled", false);
            } else if (current_number == maximum_amount) {
                var p_elem = document.createElement("p");
                var msg = "You have reached your maximum Upload Limit, if you want please remove one or more and try again";
                okay = $(p_elem).addClass("success_clipped").html(msg);
                $("#btn-update_student").attr("disabled", false);
//            WL.enable_btn_fa("btn-update_student", "");
            } else {
                var p_elem = document.createElement("p");
                var msg = "You have made a mistake while you upload ref documents, the maximum upload limit is " + maximum_amount + ", but you have add " + current_number + ", please delete untill it came to " + maximum_amount + " ";
                okay = $(p_elem).addClass("error_clipped").html(msg);
                $("#btn-update_student").attr("disabled", true);
            }
            return $("#upload_items_files").fadeIn(500).html(okay);
        },
        //count items
        set_values_cutom: function (new_value) {
            $("#numof").val(new_value);
            document_count = new_value;
        },
        //max date
        define_max_min_date: function ($years) {
            var d = new Date();
            var month = d.getMonth() + 1;
            var day = d.getDate();
            var output = d.getFullYear() - $years + '-' +
                    (month < 10 ? '0' : '') + month + '-' +
                    (day < 10 ? '0' : '') + day;
            return output;
        },
        //calculate age
        define_age_from_dob: function ($dob) {
            var dob = new Date($dob);
            var today = new Date();
            var age = Math.floor((today - dob) / (365.25 * 24 * 60 * 60 * 1000));
            return age;
        },
        //generate password 
        password_generate: function (length) {
            var result = '';
            var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            var charactersLength = characters.length;
            for (var i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            return result;
        },
        get_current_month_name: function (option) {
            if (option == true) {
                var months = ['JANUARY', 'FEBRURAY', 'MARCH', 'APRIL', 'MAY', 'JUNE', 'JULY', 'AUGUST', 'SEPTEMBER', 'OCTOBER', 'NOVEMBER', 'DECEMBER'];
            } else if (option == false) {
                var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
            } else {
                var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'];

            }
            var now = new Date();
            var thisMonth = months[now.getMonth()];
            return thisMonth;
        },
        genarate_user_initals: function (element, name, font_size, bg_color, font_color, width, radius) {
            var elem = element;

            var user_name = name;
            var matches = user_name.match(/\b(\w)/g);
            var acronym = matches.slice(0, 2).join('');
            var p = document.createElement("p");
            var set_initials = $(p).css("font-size", font_size + "px").css("background", bg_color).css("text-align", "center").css("width", width + "%").css("border-radius", radius + "px").css("color", font_color).html(acronym);
            $(elem).parent().html(set_initials);
        },
        generate_function_messages: function (target_id, alert_class, text_value, timeout) {

            var div1 = document.createElement("div");
            var div2 = document.createElement("div");
            var div3 = document.createElement("div");
            var i_tag = document.createElement("i");

            $(div1).addClass("alert " + alert_class + "").attr("role", 'alert').appendTo("#" + target_id);
            $(i_tag).addClass("flaticon-questions-circular-button");
            $(div2).addClass("alert-icon").append(i_tag).appendTo(div1);
            $(div3).addClass('alert-text').html(text_value).appendTo(div1);
            $("#" + target_id).slideDown(850);
            if (timeout != 0) {
                setTimeout(function () {
                    $("#" + target_id).slideUp(850);
                    $("#" + target_id).html("");
                }, 3000)
            } else {

            }

        }
    };
    function showRedirect_message(text) {
        var parent_overlay = document.createElement("div");
        var parent_overlay_content = document.createElement("div");
        $(parent_overlay).css(
                {
                    position: "fixed",
                    top: "0px",
                    left: "0px",
                    right: "0px",
                    bottom: "0px",
                    "background-color": "rgba(0, 0, 0, 0.8)",
                    "z-index": "10000"
                });
        $(parent_overlay_content).css({height: "100%"});
        var parent = document.createElement("div");
        $(parent).addClass("col-md-4").addClass("col-md-offset-4");
        $(parent).css(
                {
                    top: "25%",
                    color: "#000",
                    padding: "20px",
                    "background-color": "#fff"
                });
        var label = document.createElement("label");
        $(parent).addClass("text-center").addClass("confirm_back");
        var h5 = document.createElement("h5");
        var h4 = document.createElement("h4");
        $(h5).html("Please Wait...");
        $(h4).html(text);
        $(h4).css({
            "padding": "5px 10px 10px 10px",
            "border-bottom": "1px solid #666"
        });
        $(label).append(h5);
        $(parent).append(h4);
        $(parent).append(label);
        $(parent_overlay_content).append(parent);
        $(parent_overlay).append(parent_overlay_content);
        $('body').css({overflow: "hidden"});
        $('body').append(parent_overlay);
        $(parent).show();
        return false;
    }
    function showo_verlay_message(text, type) {
        var parent_overlay = document.createElement("div");
        var parent_overlay_content = document.createElement("div");
        $(parent_overlay).css(
                {
                    position: "fixed",
                    top: "0px",
                    left: "0px",
                    right: "0px",
                    bottom: "0px",
                    "background-color": "rgba(0, 0, 0, 0.8)",
                    "z-index": "10000"
                });
        $(parent_overlay_content).css({height: "100%"});
        var parent = document.createElement("div");
        $(parent).addClass("col-md-4").addClass("col-md-offset-4");
        $(parent).css(
                {
                    top: "25%",
                    color: "#000",
                    padding: "20px",
                    "background-color": "#fff",
                    position: "relative"
                });
        var label = document.createElement("label");
        $(parent).addClass("text-center");
        var h5 = document.createElement("h5");
        var h4 = document.createElement("h4");
        $(h4).html("Information!");
        $(h5).html(text);
        $(h5).addClass(type);
        $(h4).css({
            "padding": "5px 10px 10px 10px",
            "border-bottom": "1px solid #666"
        });
        var span = document.createElement("span");
        var small = document.createElement("small");
        $(span).html("text-dim");
        $(span).html("click to dismis");
        $(small).css({position: "absolute", "bottom": 2, right: 5});
        $(small).append(span);
        $(label).append(h5);
        $(parent).append(h4);
        $(parent).append(small);
        $(parent).append(label);
        $(parent_overlay_content).append(parent);
        $(parent_overlay).append(parent_overlay_content);
        $('body').css({overflow: "hidden"});
        $('body').append(parent_overlay);
        $(parent_overlay).click(function () {
            $(parent_overlay).fadeOut(300, function () {
                $(parent_overlay).remove();
                $('body').css({overflow: "scroll"});
            });
        });
        $(parent).show();
        return false;
    }

    function call_fillup_(elem, name, font_size, bg_color, font_color, width, radius) {
        WL.genarate_user_initals(elem, name, font_size, bg_color, font_color, width, radius);

    }
})(jQuery);