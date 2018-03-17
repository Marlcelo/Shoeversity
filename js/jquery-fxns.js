var counter = 2; // for family records
var counter2 = 2;// for employment records
var counter3 = 2; //for relation case records
var counter4 = 2;// for complaints records
var counter5 = 2;//for criminal records
var counter6 = 2;//for seminars
var counter7 = 2;//for organizations
var counter8 = 2;//for emergency contacs
var counter9 = 2;//for character references


$(document).ready(function(){
//Jquery code here
educationFormStart();

$("#btnAddContact").click(function () {
    $("#contacts").append('<br><div class="input-group" id="contactNumbers'+counter+'"><span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span><input type="text" class="form-control" name="number'+counter+'" placeholder="Contact Number" required></div>');
    alert("Counter: " + counter);
    counter++;
});

$("#btnAddLocation").click(function(){
	$("#locations").append('<br><div class="input-group" id="location'+counter2+'"><span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span><input type="text" class="form-control" name="location'+counter2+'" placeholder="Location" required></div>');
	alert("Counter: " + counter2);
	counter2++;
});

$('#btnAddRelation').click(function() {
	$('#newRelationField').append('<label>'+counter3+'.</label><div class="row"> <div class="col-lg-4"><label>Name:</label><input type="text" class="form-control" id="rName' + counter3 + '" name = "rName' + counter3 + '" required></div><div class="col-lg-4"><label>Relationship:</label><input type="text" class="form-control" id="rRelationship' + counter3 + '" name = "rRelationship' + counter3 + '" required></div><div class="col-lg-4"><label>Department:</label><input type="text" class="form-control" id="rDepartment' + counter3 + '" name = "rDepartment' + counter3 + '" required></div></div><br>');
	alert("Counter: "+ counter3);
	counter3++;
});

$("#btnAddComplaint").click(function(){
	$("#newComplaintField").append('<label>'+counter4+'.</label><div class="row"><div class="col-lg-12"><label>Details:</label><input type="text" class="form-control" id="details'+counter4+'" name = "details'+counter4+'" required></div></div><br>');
	alert("Counter: "+ counter4);
	counter4++;
});

$("#btnAddCase").click(function() {
	$('#newCaseField').append('<label>'+counter5+'.</label><div class="row"><div class="col-lg-12"><label>Details:</label><input type="text" class="form-control" id="details'+counter5+'" name = "details'+counter5+'" required></div></div><br>');
	alert("Counter: "+ counter5);
	counter5++;
});

$("#btnAddSeminar").click(function(){
	$('#newSeminarsField').append('<label>'+counter6+'.</label><div class="row"><div class="col-lg-6"><label>Program Title:</label><input type="text" class="form-control" id="program'+counter6+'" name = "program'+counter6+'" required></div><div class="col-lg-3"><label>From:</label><input type="date" class="form-control" id="from'+counter6+'" name = "from'+counter6+'" required></div><div class="col-lg-3"><label>To:</label><input type="date" class="form-control" id="to'+counter6+'" name = "to'+counter6+'" required></div></div><br>');
	alert("Counter: " + counter6);
	counter6++;
});

$('#btnAddOrganziation').click(function(){
	$('#newOrganziationField').append('<br><label>'+counter7+'.</label><div class="row"><div class="col-lg-6"><label>Name of Organziation:</label><input type="text" class="form-control" id="organization'+counter7+'" name = "organization'+counter7+'" required></div><div class="col-lg-6"><label>Position:</label><input type="text" class="form-control" id="position'+counter7+'" name = "position'+counter7+'" required></div>    </div><div class="row"><div class="col-lg-6"><label>From:</label><input type="date" class="form-control" id="from'+counter7+'" name = "from'+counter7+'" required></div><div class="col-lg-6"><label>To:</label><input type="date" class="form-control" id="to'+counter7+'" name = "to'+counter7+'" required></div></div></div>');
	alert("Counter: " + counter7);
	counter7++;
});

$('#btnAddEmergency').click(function(){
	$('#newEmergencyContactField').append('<br><label>'+counter8+'.</label>  <div class="row"><div class="col-lg-4"><label>Last Name:</label><input type="text" class="form-control" id="last'+counter8+'" name = "last'+counter8+'" required></div><div class="col-lg-4"><label>First Name:</label><input type="text" class="form-control" id="first'+counter8+'" name = "first'+counter8+'" required></div><div class="col-lg-4"><label>Middle Name:</label><input type="text" class="form-control" id="middle'+counter8+'" name = "middle'+counter8+'" required></div>     </div><div class="row"><div class="col-lg-6"><label>Relation:</label><input type="text" class="form-control" id="relation'+counter8+'" name = "relation'+counter8+'" required></div><div class="col-lg-6"><label>Contact#:</label>    <input type="tel" class="form-control" id="contact'+counter8+'" name = "contact'+counter8+'" maxlength="11" required></div></div>');
	alert("Counter: " + counter8);
	counter8++;
});

$('#btnAddReference').click(function(){
	$('#newReferenceField').append('<br><label>'+counter9+'.</label>  <div class="row"><div class="col-lg-4"><label>Last Name:</label><input type="text" class="form-control" id="last'+counter9+'" name = "last'+counter9+'" required></div><div class="col-lg-4"><label>First Name:</label><input type="text" class="form-control" id="first'+counter9+'" name = "first'+counter9+'" required></div><div class="col-lg-4"><label>Middle Name:</label><input type="text" class="form-control" id="middle'+counter9+'" name = "middle'+counter9+'"  required></div>     </div><div class="row"><div class="col-lg-6"><label>Occupation:</label><input type="text" class="form-control" id="occupation'+counter9+'" name = "occupation'+counter9+'" required></div><div class="col-lg-6"><label>Contact#:</label><input type="tel" class="form-control" id="contact'+counter9+'" name = "contact'+counter9+'" maxlength="11" required></div></div>');
	alert("Counter: " + counter9);
	counter9++;

});

$('#btnProceedSkipOrganization').click(function(){
			$("#organization1").prop("required", false);
    		$("#position1").prop("required", false);
    		$("#from1").prop("required", false);
    		$("#to1").prop("required", false);
});

$("#btnProceedSkipEmployment").click(function() {
            $("#companyName1").prop("required", false);
            $("#companyTel1").prop("required", false);
            $("#position1").prop("required", false);
            $("#salary1").prop("required", false);
            $("#address1").prop("required", false);
            $("#supervisorName1").prop("required", false);
            $("#supervisorNum1").prop("required", false);
            $("#nob1").prop("required", false);
            $("#from1").prop("required", false);
            $("#to1").prop("required", false);
            $("#rfl1").prop("required", false);
            $("#responsibilities1").prop("required", false);
        });

$("#btnProceedSkipRelation").click(function() {
            $("#rName1").prop("required", false);
            $("#rRelationship1").prop("required", false);
            $("#rDepartment1").prop("required", false);
        });

$("#btnProceedSkipComplaint").click(function(){
			$("#details1").prop("required", false);
});

$("#btnProceedSkipCase").click(function(){
			$("#details1").prop("required", false);
});

$("#btnProceedSkipSeminar").click(function(){
			$("#program1").prop("required", false);
            $("#from1").prop("required", false);
            $("#to1").prop("required", false);
});

handleStatusChanged();

});


function educationFormStart() {
	$("#hs_div :input").prop("disabled", true);
	$("#undergrad_div :input").prop("disabled", true);
	$("#vocational_div :input").prop("disabled", true);
	$("#masterals_div :input").prop("disabled", true);
	$("#doctorate_div :input").prop("disabled", true);

}

function handleStatusChanged() {
    $('#hstoggleElement').on('change', function () {
      toggleStatus();   
    });
}

function toggleStatus() {

		if ($('#hstoggleElement').is(':checked')) {
			$('#hs_div :input').attr('disabled', false);
		} else {
			$('#hs_div :input').attr('disabled', true);
		}

		if ($('#collegetoggleElement').is(':checked')) {
			$('#undergrad_div :input').attr('disabled', false);
		} else {
			$('#undergrad_div	:input').attr('disabled', true);
		}

		if ($('#vocationaltoggleElement').is(':checked')) {
			$('#vocational_div	:input').attr('disabled', false);
		} else {
			$('#vocational_div	:input').attr('disabled', true);
		}

		if ($('#masteraltoggleElement').is(':checked')) {
			$('#masterals_div :input').attr('disabled', false);
		} else {
			$('#masterals_div :input').attr('disabled', true);
		}

		if ($('#doctoratetoggleElement').is(':checked')) {
			$('#doctorate_div :input').attr('disabled', false);
		} else {
			$('#doctorate_div :input').attr('disabled', true);
		}


    
}