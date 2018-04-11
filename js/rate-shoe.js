function rateProduct() {
	$('#rating_modal').modal({
	    show: true,
	    backdrop: 'static',
	    keyboard: false
	});
    $('#rating_modal').on('hidden.bs.modal', function () {
        window.location = 'products.php';
    })
}