function openCart() {
    document.getElementById("shoppingCartPanel").style.right = "0px";
}

function closeCart() {
    document.getElementById("shoppingCartPanel").style.right = "-350px";
}

function removeProduct(pid, token) {
	$.ajax({
        url:"../../database/user_remove_from_cart.php",
        method:"POST",
        data:{pid:pid},
        success:function(data){
        	window.location.href = "../users/products.php?token="+token;
        }
    })
}

function openCartModal(token) {
    $('#cart_modal').modal({
        show: true,
        backdrop: 'static',
        keyboard: false
    });
    $('#cart_modal').on('hidden.bs.modal', function () {
        window.location = 'products.php?token='+token;
    })
}