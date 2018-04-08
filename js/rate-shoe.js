function rateProduct() {
	$('#rating_modal').modal('show');
    $('#rating_modal').on('hidden.bs.modal', function () {
        window.location = 'products.php';
    })
}