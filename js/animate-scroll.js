// $("#promote-products-link").hide(); // hide the fixed navbar initially

// var topofDiv = $(window).offset().top; //gets offset of header
// var height = $(window).outerHeight(); //gets height of header

// $(window).scroll(function(){
//     if($(window).scrollTop() > (topofDiv + height)){
//        $("#promote-products-link").show();
//     }
//     else{
//        $("#promote-products-link").hide();
//     }
// });


// function($) {

    var $nav = $('#promote-products-link');
    var $win = $(window);
    var winH = $win.height();   // Get the window height.

    $x = document.getElementById("promote-products-link");
    $x.style.display = "none";

    $win.on("scroll", function () {
        if ($(this).scrollTop() > winH ) {
        	// alert("hello");
            $nav.hide();
        } else {
            $nav.show();
        }
    }).on("resize", function(){ // If the user resizes the window
       winH = $(this).height(); // you'll need the new height value
    });

// }