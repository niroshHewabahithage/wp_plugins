//! moment.js locale configuration
//! locale : Japanese [ja]
//! author : LI Long : https://github.com/baryon

;(function (global, factory) {
   typeof exports === 'object' && typeof module !== 'undefined'
       && typeof require === 'function' ? factory(require('../moment')) :
   typeof define === 'function' && define.amd ? define(['../moment'], factory) :
   factory(global.moment)
}(this, (function (moment) { 'use strict';


var ja = moment.defineLocale('ja', {
    months : '1æœˆ_2æœˆ_3æœˆ_4æœˆ_5æœˆ_6æœˆ_7æœˆ_8æœˆ_9æœˆ_10æœˆ_11æœˆ_12æœˆ'.split('_'),
    monthsShort : '1æœˆ_2æœˆ_3æœˆ_4æœˆ_5æœˆ_6æœˆ_7æœˆ_8æœˆ_9æœˆ_10æœˆ_11æœˆ_12æœˆ'.split('_'),
    weekdays : 'æ—¥æ›œæ—¥_æœˆæ›œæ—¥_ç«æ›œæ—¥_æ°´æ›œæ—¥_æœ¨æ›œæ—¥_é‡‘æ›œæ—¥_åœŸæ›œæ—¥'.split('_'),
    weekdaysShort : 'æ—¥_æœˆ_ç«_æ°´_æœ¨_é‡‘_åœŸ'.split('_'),
    weekdaysMin : 'æ—¥_æœˆ_ç«_æ°´_æœ¨_é‡‘_åœŸ'.split('_'),
    longDateFormat : {
        LT : 'HH:mm',
        LTS : 'HH:mm:ss',
        L : 'YYYY/MM/DD',
        LL : 'YYYYå¹´MæœˆDæ—¥',
        LLL : 'YYYYå¹´MæœˆDæ—¥ HH:mm',
        LLLL : 'YYYYå¹´MæœˆDæ—¥ HH:mm dddd',
        l : 'YYYY/MM/DD',
        ll : 'YYYYå¹´MæœˆDæ—¥',
        lll : 'YYYYå¹´MæœˆDæ—¥ HH:mm',
        llll : 'YYYYå¹´MæœˆDæ—¥ HH:mm dddd'
    },
    meridiemParse: /åˆå‰|åˆå¾Œ/i,
    isPM : function (input) {
        return input === 'åˆå¾Œ';
    },
    meridiem : function (hour, minute, isLower) {
        if (hour < 12) {
            return 'åˆå‰';
        } else {
            return 'åˆå¾Œ';
        }
    },
    calendar : {
        sameDay : '[ä»Šæ—¥] LT',
        nextDay : '[æ˜Žæ—¥] LT',
        nextWeek : '[æ¥é€±]dddd LT',
        lastDay : '[æ˜¨æ—¥] LT',
        lastWeek : '[å‰é€±]dddd LT',
        sameElse : 'L'
    },
    dayOfMonthOrdinalParse : /\d{1,2}æ—¥/,
    ordinal : function (number, period) {
        switch (period) {
            case 'd':
            case 'D':
            case 'DDD':
                return number + 'æ—¥';
            default:
                return number;
        }
    },
    relativeTime : {
        future : '%så¾Œ',
        past : '%så‰',
        s : 'æ•°ç§’',
        ss : '%dç§’',
        m : '1åˆ†',
        mm : '%dåˆ†',
        h : '1æ™‚é–“',
        hh : '%dæ™‚é–“',
        d : '1æ—¥',
        dd : '%dæ—¥',
        M : '1ãƒ¶æœˆ',
        MM : '%dãƒ¶æœˆ',
        y : '1å¹´',
        yy : '%då¹´'
    }
});

return ja;

})));