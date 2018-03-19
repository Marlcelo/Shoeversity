$(window).scroll(function() {
    if ($(this).scrollTop() > 53) {
        $('.quicklink').css({
            "opacity" : "0", 
            "visibility" : "hidden",
            "-webkit-transition" : "visibility 0.2s linear, opacity 0.2s linear",
            "-moz-transition" : "visibility 0.2s linear, opacity 0.2s linear",
            "-o-transition" : "visibility 0.2s linear, opacity 0.2s linear"
        });
    }
    else {
        $('.quicklink').css({
            "opacity" : "1", 
            "visibility" : "visible"
        });
    }
});