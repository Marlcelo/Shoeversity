<?php
	# Retrieve a list of all brand names
	include '../../database/brand_list_get.php'; 	// stores brand names in $brands_list array

	if(!isset($_SESSION)) {
		session_start();
	}

	if(isset($_SESSION['cart'])) {
		$cartSize = sizeof($_SESSION['cart']);
	}
	else {
		$cartSize = 0;
	}

	$productURL = "../users/view_product.php?pid=";
	$totalPrice = 0;
?>

<div id="shoppingCartPanel" class="sidenav-cart">
	<a href="javascript:void(0)" class="closebtn-cart" onclick="closeCart()">&times;</a>

	<div class="col-md-12" style="margin-top: -20px">
		<h3 style="color:#eee">My Shopping Cart</h3>
		<hr>

		<?php if($cartSize == 0): ?>
			<div class="alert alert-info text-center">
				<h5>Your cart is empty!</h5>
			</div>
		<?php else: ?>
			<div class="pre-scrollable" style="max-height: 60vh; padding-right: 0px; margin-bottom: 10px">
				<?php foreach($_SESSION['cart'] as $itemID): ?>
					<div class="col-md-12" style="cursor:pointer; background: #eee; padding: 10px; margin: 10px 0px" 
						onclick="window.location.href='<?php echo $productURL.$itemID; ?>'">

						<?php include "../../database/user_cart_item.php"; ?>

						<div class="col-md-6">
							<img src="<?php echo $shoeImg; ?>">
						</div>
						<div class="col-md-6">
							<h4><?php echo $shoeName; ?></h4>
							<h5 class="text-info"><span>&#8369; <?php echo $shoePrice; ?></span></h5>
						</div>
					</div>

					<?php $totalPrice += $shoePrice; ?>
				<?php endforeach; ?>
			</div>

			<h3 class="pull-right" style="margin-bottom: 20px; color: #eee;">
				Grand Total: &nbsp; &#8369; <?php echo $totalPrice; ?>
			</h3>

			<button type="submit" class="btn btn-success pull-right" onclick="alert('check out')">
				<strong>Check out</strong>
			</button>
		<?php endif; ?>
	</div>
</div>