function showEmailPopup() {
	$('#forgot_password_modal').modal('show');
    $('#forgot_password_modal').on('hidden.bs.modal', function () {    //reload login form
        window.location = 'login.php';
    })
}