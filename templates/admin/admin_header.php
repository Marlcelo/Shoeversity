<?php
	$highlight = $_SESSION['active_page'];
?>
<link rel="icon" type="image/png" href="../../images/logos/shoeversity-favicon.png">

<nav class="navbar navbar-default navbar-inverse navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header">
			<a class="navbar-brand" href="dashboard.php"> <img class="img-circle" src="../../images/logos/shoeversity-logo.jpg" width="20px"> </a>
			<a class="navbar-brand" href="dashboard.php"><strong>Shoeversity</strong></a> 
		</div>
		
		<ul class="nav navbar-nav pull-right">
			<li>

				<form action="../../database/search_shoes_admin.php" method="POST" class="navbar-form" role="search">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Search" name="search-product">
						<div class="input-group-btn">
							<button class="btn btn-primary" type="submit" style="margin-top: 0px">
								<i class="glyphicon glyphicon-search"></i></button>
							<!-- <button class="btn btn-primary" type="submit" style="margin-top: 0px; margin-left:10px; border-radius:2px;">
								<i class="glyphicon glyphicon-bell"></i></button> -->
						</div>
					</div>
				</form>
			</li>
			<li <?php if($highlight == 'dashboard') echo "class='active'"; ?>><a href="dashboard.php">Dashboard</a></li>
			<li <?php if($highlight == 'account') echo "class='active'"; ?>><a href="account.php">My Account</a></li>
			<li <?php if($highlight == 'logout') echo "class='active'"; ?>><a href="../../database/logout.php">Logout</a></li>
		</ul>
	</div>
</nav>