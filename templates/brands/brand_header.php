<?php
	$highlight = $_SESSION['active_page'];
?>
<!--Header-->
<nav class="navbar navbar-default navbar-inverse navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header">
			<a class="navbar-brand" href="#"> <img class="img-circle" src="../IMAGES/sample_logo.png" width="20px"> </a>
			<a class="navbar-brand" href="#">Shoeversity</a> 
		</div>

		<ul class="nav navbar-nav pull-right">
			<li>
				<form class="navbar-form" role="search">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Search" name="q">
						<div class="input-group-btn">
							<button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-search"></i></button>
						</div>
					</div>
				</form>
			</li>
			<li <?php if($highlight == 'products') echo "class='active'"; ?>><a href="#">Products</a></li>
			<li <?php if($highlight == 'account') echo "class='active'"; ?>><a href="#">My Account</a></li>
			<li <?php if($highlight == 'logout') echo "class='active'"; ?>><a href="#">Logout</a></li>
		</ul>
	</div>
</nav>
