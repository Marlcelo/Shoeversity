<?php
	$highlight = $_SESSION['active_page'];

	if(!isset($_SESSION)) {
		session_start();
	}

	if(isset($_SESSION['cart'])) {
		$cartSize = sizeof($_SESSION['cart']);
	}
	else {
		$cartSize = 0;
	}
?>
<link rel="icon" type="image/png" href="../../images/logos/shoeversity-favicon.png">

<!--Header-->
<nav class="navbar navbar-default navbar-inverse navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header">
			<a class="navbar-brand" href="products.php"> <img class="img-circle" src="../../images/logos/shoeversity-logo.jpg" width="20px"> </a>
			<a class="navbar-brand" href="products.php"><strong>Shoeversity</strong></a> 
		</div>

		<ul class="nav navbar-nav pull-right">
			<li>
				<form action="../../database/search_shoes_users.php" method="POST" class="navbar-form" role="search">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Search" name="search-product" required>
						<div class="input-group-btn">
							<button class="btn btn-primary" type="submit" style="height: 34px; margin-top: 0px; border-radius: 0px 5px 5px 0px">
								<i class="glyphicon glyphicon-search"></i>
							</button>
						</div>
					</div>

					<!-- This button is not part of the form -->
					<button class="btn btn-primary" type="button" style="height: 35px; margin-top: 0px; margin-left:10px; border-radius:3px;" onclick="openCart();">
						<i class="glyphicon glyphicon-shopping-cart"></i>
						&nbsp; 
						<span class="badge">
							<?php echo $cartSize; ?>	
						</span> 
					</button>
				</form>
			</li>
			<li <?php if($highlight == 'products') echo "class='active'"; ?>><a href="products.php">Products</a></li>
			<li <?php if($highlight == 'account') echo "class='active'"; ?>><a href="account.php">My Account</a></li>
			<li <?php if($highlight == 'logout') echo "class='active'"; ?>><a href="../../database/logout.php">Logout</a></li>

		</ul>
	</div>
</nav>

<?php include 'user_shopping_cart_panel.php'; ?>