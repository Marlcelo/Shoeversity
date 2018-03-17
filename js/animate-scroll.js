$("#header-2").hide(); // hide the fixed navbar initially

var topofDiv = $("#header-container").offset().top; //gets offset of header
var height = $("#header-container").outerHeight(); //gets height of header

$(window).scroll(function(){
    if($(window).scrollTop() > (topofDiv + height)){
       $("#header-2").show();
    }
    else{
       $("#header-2").hide();
    }
});