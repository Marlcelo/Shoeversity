<?php
	# Retrieve a list of all brand names
	include '../../database/brand_list_get.php'; 	// stores brand names in $brands_list array
?>

<div id="shoppingCartPanel" class="sidenav-cart">
	<a href="javascript:void(0)" class="closebtn-cart" onclick="closeCart()">&times;</a>

	<div class="col-md-12" style="margin-top: -20px">
		<h3 style="color:#eee">My Shopping Cart</h3>
		<hr>
	</div>
</div>