$(window).scroll(function() {
    if ($(this).scrollTop() > 53) {
        $('.quicklink').css({
            'display': 'none',
            '-o-transition': '.5s',
            '-ms-transition': '.5s',
            '-moz-transition': '.5s',
            '-webkit-transition': '.5s',
            'transition': '.5s'
        });
    }
    else {
        $('.quicklink').css({
            'display': 'block',
            '-o-transition': '.5s',
            '-ms-transition': '.5s',
            '-moz-transition': '.5s',
            '-webkit-transition': '.5s',
            'transition': '.5s'
        });
    }
});