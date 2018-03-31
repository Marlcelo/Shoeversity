<?php
	# Retrieve a list of all brand names
	include '../database/brand_list_get.php'; 	// stores brand names in $brands_list array
?>

<div id="mySidenav" class="sidenav">
	<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

	<form action="../database/filter_shoes_public.php" method="post" style="margin: 5px 25px">
		<!-- BRANDS -->
		<div class="form-group">
			<h5 style="color: #eee">Brand</h5>
			<select class="form-control" id="brand" name="brand">
				<option selected="selected" value="">All Brands</option>
				<option disabled>--</option>
				<?php
					foreach($brands_list as $brand) {
						echo "<option value='".$brand[0]."'>$brand[1]</option>";
					}
				?>
			</select>
		</div>

		<!-- PRICE -->
		<div class="form-group" style="margin-bottom: 60px">
			<h5 style="color: #eee">Price Range</h5>
			<div class="col-md-5" style="padding-left: 0 !important;padding-right: 0 !important;">
				<div class="input-group">
					<span class="input-group-addon">&#8369;</span>
					<input type="number" class="form-control" min="0" name="priceFrom" placeholder="From"> 
				</div>
			</div>
			<div class="col-md-2 text-center" style="color: #eee; margin-top: 5px">
				&mdash;
			</div>
			<div class="col-md-5" style="padding-left: 0 !important;padding-right: 0 !important;">
				<div class="input-group">
					<span class="input-group-addon">&#8369;</span>
					<input type="number" class="form-control" min="0" name="priceTo" placeholder="To"> 
				</div>
			</div>
		</div>

		<!-- TYPE: mens or womens -->
		<div class="form-group">
			<h5 style="color: #eee">Type</h5>
			<select class="form-control" id="type" name="type">
				<option selected="selected" value="">Mens &amp; Womens</option>
				<option disabled>--</option>
				<option value="mens">Mens</option>
				<option value="womens">Womens</option>
			</select>
		</div>

		<!-- CATEGORY -->
		<div class="form-group">
			<h5 style="color: #eee">Category</h5>
			<select class="form-control" id="category" name="category">
				<option selected="selected" value="">All Categories</option>
				<option disabled>--</option>
				<option>Sneakers</option>
				<option>Running</option>
				<option>Training</option>
				<option>Formal</option>
				<option>Casual</option>
			</select>
		</div>

		<!-- SIZE  -->
		<div class="form-group">
			<h5 style="color: #eee">Size</h5>
			<input type="number" class="form-control" min="0" id="size" name="size" placeholder="All Sizes"> 
		</div>

		<!-- COLOR -->
		<div class="form-group">
			<h5 style="color: #eee">Color</h5>
			<!-- <input type="color" class="form-control" id="color" name="color"> -->
			<select class="form-control" id="color" name="color">
				<option selected="selected" value="">All Colors</option>
				<option disabled>--</option>
				<option value="black">Black</option>
				<option value="white">White</option>
				<option value="red">Red</option>
				<option value="orange">Orange</option>
				<option value="yellow">Yellow</option>
				<option value="green">Green</option>
				<option value="blue">Blue</option>
				<option value="indigo">Indigo</option>
				<option value="violet">Violet</option>
			</select>
		</div>

		<!-- SUBMIT BUTTON -->
		<button type="submit" class="btn btn-success pull-right" style="margin-top: 20px">
			Apply Filter
		</button>
		<span class="color black"></span> 
	</form>
</div>

<span class="glyphicon glyphicon-menu-hamburger" id="btnToggle" onclick="openNav()" style="font-size: 40px; margin-left: 20px; cursor: pointer;"></span> 