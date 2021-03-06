<?php
	$highlight = $_SESSION['active_page'];

	if(!isset($_SESSION)) {
		session_start();
	}
	$token = $_SESSION['sessionToken'];
?>
<link rel="icon" type="image/png" href="../../images/logos/shoeversity-favicon.png">
<!--Header-->
<nav class="navbar navbar-default navbar-inverse navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header">
			<a class="navbar-brand" href="products.php?token=<?php echo $token ?>"> <img class="img-circle" src="../../images/logos/shoeversity-logo.jpg" width="20px"> </a>
			<a class="navbar-brand" href="products.php?token=<?php echo $token ?>"><strong>Shoeversity</strong></a> 
		</div>

		<ul class="nav navbar-nav pull-right">
			<!-- <li>
				<form class="navbar-form" role="search">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Search" name="search-product" required>
						<div class="input-group-btn">
							<button class="btn btn-primary" type="submit" style="margin-top: 0px">
								<i class="glyphicon glyphicon-search"></i></button>
						</div>
					</div>
				</form>
			</li> -->
			<li <?php if($highlight == 'products') echo "class='active'"; ?>><a href="products.php?token=<?php echo $token ?>">Products</a></li>
			<li <?php if($highlight == 'account') echo "class='active'"; ?>><a href="account.php?token=<?php echo $token ?>">My Account</a></li>
			<li <?php if($highlight == 'logout') echo "class='active'"; ?>><a href="../../database/logout.php">Logout</a></li>
		</ul>
	</div>
</nav>
