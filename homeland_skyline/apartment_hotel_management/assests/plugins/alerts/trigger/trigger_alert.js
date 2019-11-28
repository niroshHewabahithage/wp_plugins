//@author Nirosh Ranidmal
(function ($) {
    $(document).ready(function () {
        Notiflix.Notify.Init({
            width: '350px',
            position: 'right-bottom',
            distance: '25px',
            opacity: 1,
            borderRadius: '5px',
            rtl: false,
            timeout: 3500,
            messageMaxLength: 500,
            backOverlay: false,
            backOverlayColor: 'rgba(0,0,0,0.5)',
            ID: 'NotiflixNotify',
            className: 'notiflix-notify',
            zindex: 999999,
            useGoogleFont: true,
            fontFamily: 'Quicksand',
            fontSize: '13px',
            cssAnimation: true,
            cssAnimationDuration: 500,
            cssAnimationStyle: 'from-top',
            closeButton: false,
            useIcon: true,
            useFontAwesome: false,
            fontAwesomeIconStyle: 'basic',
            fontAwesomeIconSize: '34px',
            success: {
                background: '#00b462',
                textColor: '#fff',
                childClassName: 'success',
                notiflixIconColor: 'rgba(0,0,0,0.2)',
                fontAwesomeClassName: 'fas fa-check-circle',
                fontAwesomeIconColor: 'rgba(0,0,0,0.2)',
            },
            failure: {
                background: '#f44336',
                textColor: '#fff',
                childClassName: 'failure',
                notiflixIconColor: 'rgba(0,0,0,0.2)',
                fontAwesomeClassName: 'fas fa-times-circle',
                fontAwesomeIconColor: 'rgba(0,0,0,0.2)',
            },
            warning: {
                background: '#f2bd1d',
                textColor: '#fff',
                childClassName: 'warning',
                notiflixIconColor: 'rgba(0,0,0,0.2)',
                fontAwesomeClassName: 'fas fa-exclamation-circle',
                fontAwesomeIconColor: 'rgba(0,0,0,0.2)',
            },
            info: {
                background: '#00bcd4',
                textColor: '#fff',
                childClassName: 'info',
                notiflixIconColor: 'rgba(0,0,0,0.2)',
                fontAwesomeClassName: 'fas fa-info-circle',
                fontAwesomeIconColor: 'rgba(0,0,0,0.2)',
            },
        });
        Notiflix.Loading.Init({
            className: 'notiflix-loading',
            zindex: 4000,
            backgroundColor: 'rgba(0,0,0,0.8)',
            rtl: false,
            useGoogleFont: true,
            fontFamily: 'Quicksand',
            cssAnimation: true,
            cssAnimationDuration: 400,
            clickToClose: false,
            customSvgUrl: null,
            svgSize: '80px',
            svgColor: '#00b462',
            messageID: 'NotiflixLoadingMessage',
            messageFontSize: '15px',
            messageMaxLength: 34,
            messageColor: '#dcdcdc',
        });
        // Notiflix Confirm - All Options
        Notiflix.Confirm.Init({
            className: 'notiflix-confirm',
            width: '280px',
            zindex: 4003,
            position: 'center',
            distance: '10px',
            backgroundColor: '#f8f8f8',
            borderRadius: '25px',
            backOverlay: true,
            backOverlayColor: 'rgba(0,0,0,0.5)',
            rtl: false,
            useGoogleFont: true,
            fontFamily: 'Quicksand',
            cssAnimation: true,
            cssAnimationStyle: 'fade',
            cssAnimationDuration: 300,
            titleColor: '#00b462',
            titleFontSize: '16px',
            titleMaxLength: 34,
            messageColor: '#1e1e1e',
            messageFontSize: '14px',
            messageMaxLength: 110,
            buttonsFontSize: '15px',
            buttonsMaxLength: 34,
            okButtonColor: '#f8f8f8',
            okButtonBackground: '#00b462',
            cancelButtonColor: '#f8f8f8',
            cancelButtonBackground: '#a9a9a9',
            plainText: true, // New Option: @1.3.0 and next versions - (@1.0.0 and next versions for React)});

        });
    });
    function noty_alerts(err_msg, err_type, err_duration) {
        new Noty({
            text: err_msg,
            timeout: err_duration,
            type: err_type,
            animation: {
                open: 'animated bounceInRight', // Animate.css class names
                close: 'animated bounceOutRight' // Animate.css class names
            }
        }).show();
        return;
    }
})(jQuery);


