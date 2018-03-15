<?php
	$highlight = $_SESSION['active_page'];
?>

<nav class="navbar navbar-default navbar-inverse navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header">
			<a class="navbar-brand" href="index.php"> <img class="img-circle" src="../images/logos/shoeversity-logo.jpg" width="20px"> </a>
			<a class="navbar-brand" href="index.php">Shoeversity</a> 
		</div>

		<ul class="nav navbar-nav pull-right">
			<li>
				<!-- TO-DO: Add search form action -->
				<form action="" class="navbar-form" role="search">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Search" name="search-product">
						<div class="input-group-btn">
							<button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-search"></i></button>
						</div>
					</div>
				</form>
			</li>
			<li <?php if($highlight == 'products') echo "class='active'"; ?>><a href="index.php">Products</a></li>
			<!--<li <?php /*if($highlight == '') echo "class='active'"; ?>><a href=".php">My Account</a></li>
			<li <?php if($highlight == '') echo "class='active'"; ?>><a href=".php">Logout</a></li>
			-->*/
		</ul>
	</div>
</nav>