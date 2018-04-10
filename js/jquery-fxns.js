var counter = 2; // for family records
var counter2 = 2;// for employment records


$(document).ready(function(){
//Jquery code here

$("#btnAddContact").click(function () {
    $("#contacts").append('<br><div class="input-group" id="contactNumbers'+counter+'"><span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span><input type="text" class="form-control" name="number'+counter+'" placeholder="Contact Number" required></div>');
    counter++;
});

$("#btnAddLocation").click(function(){
	$("#locations").append('<br><div class="input-group" id="location'+counter2+'"><span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span><input type="text" class="form-control" name="location'+counter2+'" placeholder="Location" required></div>');
	counter2++;
});
});

