$(document).ready(function () {
    Notiflix.Notify.Init({
        width: '15%',
        position: 'right-top',
        distance: '25px',
        opacity: 1,
        borderRadius: '5px',
        rtl: false,
        timeout: 3000,
        messageMaxLength: 500,
        backOverlay: false,
        backOverlayColor: 'rgba(0,0,0,0.5)',
        ID: 'NotiflixNotify',
        className: 'notiflix-notify',
        zindex: 4001,
        useGoogleFont: true,
        fontFamily: 'Quicksand',
        fontSize: '13px',
        cssAnimation: true,
        cssAnimationDuration: 250,
        cssAnimationStyle: 'from-right',
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
