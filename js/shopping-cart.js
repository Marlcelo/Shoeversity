function openCart() {
    document.getElementById("shoppingCartPanel").style.right = "0px";
}

function closeCart() {
    document.getElementById("shoppingCartPanel").style.right = "-350px";
}

function removeProduct(pid) {
	alert(pid);
	$.ajax({
        url:"../../database/user_remove_from_cart.php",
        method:"POST",
        data:{pid:pid},
        success:function(data){
            // alert(data);

            //open cart
            document.getElementById("shoppingCartPanel").style.right = "0px";
        }
    })
}