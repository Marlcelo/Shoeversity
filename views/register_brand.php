<form class="form-horizontal" name="register_brand" id="register1" action="../database/brand_register.php" method="POST">
	<div class="row">
		<div class="col-md-6">	
			<div class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
				<input type="text" class="form-control" name="brandname" placeholder="Brand Name" required>
			</div><br>
		</div>
		<div class="col-md-6">	
			<div class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
				<input type="text" class="form-control" name="uname" placeholder="Username" required>
			</div><br>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">	
			<div class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
				<input type="password" id="password1" class="form-control" name="pword" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!,%,&,@,#,$,^,*,?,_,~,.]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, a special character, and at least 8 or more characters" required>
			</div>
			<span id="result1"></span>
		</div>
		<div class="col-md-6">	
			<div class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
				<input type="password" class="form-control" name="confirmpword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!,%,&,@,#,$,^,*,?,_,~,.]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, a special character, and at least 8 or more characters" placeholder="Confirm Password" required>
			</div><br>
		</div>
	</div>

	<div class="input-group">
		<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
		<input type="email" class="form-control" name="email" placeholder="Official Email Address" required>
	</div><br>

	<div id ="contacts">
		<div class="input-group" id="contactNumbers1">
			<span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
			<input type="text" class="form-control" name="number1" pattern="[0-9]{3,4}[-][0-9]{3}[-][0-9]{4}" title="Format: XXXX-XXX-XXXX" placeholder="Contact Number" required>
		</div>
	</div>
	<div class="input-group">
		<button class = "btn btn-info pull-right btn-block btn-sm" id="btnAddContact" type="button">Add Contact#</button>
	</div>
	<div class="alert alert-warning">need to add multiple contact #s</div>

	<div id="locations">
		<div class="input-group" id="location1">
			<span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
			<input type="text" pattern="[A-Za-z0-9].{1,100}" class="form-control" name="location1" placeholder="Location" required>
		</div>
	</div>
	<div class="input-group">
		<button class = "btn btn-info pull-right btn-block btn-sm" id="btnAddLocation" type="button">Add Location</button>
	</div>
	<div class="alert alert-warning">need to add multiple locations</div>

	<div class="row">
		<div class="col-md-6">
			<div class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-link"></i></span>
				<input type="url" class="form-control" name="website" placeholder="Website (Optional)">
			</div><br>
		</div>
		<div class="col-md-6">
			<div class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-link"></i></span>
				<input type="url" class="form-control" name="facebook" placeholder="Facebook (Optional)">
			</div><br>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<div class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-link"></i></span>
				<input type="url" class="form-control" name="twitter" placeholder="Twitter (Optional)">
			</div><br>
		</div>
		<div class="col-md-6">
			<div class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-link"></i></span>
				<input type="url" class="form-control" name="instagram" placeholder="Instagram (Optional)">
			</div><br>
		</div>
	</div>

	<!-- Submit Button -->	
	<div class="form-group"> 
		<div class="col-sm-12 controls">
		    <button type="submit" class="btn btn-primary" name="registerBrand" style="padding: 7px; width: 100%">
		        <img src="../images/icons/login.png" alt="" style="width: 24px;">
		        <strong>Register</strong>
		    </button>
		</div>
	</div>
</form>
