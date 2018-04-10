<form class="form-horizontal" name="register_user" action="../database/user_register.php" id="register" method="POST">

	<div class="row">
		<div class="col-md-4">	
			<input type="text" class="form-control" name="fname" placeholder="First Name" required>
		</div>

		<div class="col-md-4">
			<input type="text" class="form-control" name="mname" placeholder="Middle Name" required>
		</div>

		<div class="col-md-4">
			<input type="text" class="form-control" name="lname" placeholder="Last Name" required>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-md-4">
			<div class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
				<input type="text" class="form-control" name="uname" placeholder="Username"  pattern="[A-Za-z0-9].{8,30}" title="Must be atleast 8 to 30 characters" required>
			</div>
		</div>

		<div class="col-md-5">
			<div class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></i></span>
				<input type="text" class="form-control" name="email" placeholder="Email" required>
			</div>
		</div>

		<div class="col-md-3">
			<div class="radio text-center">
				<label><input type="radio" name="gender" value="m" checked>Male</label>
				<label><input type="radio" name="gender" value="f">Female</label>
			</div>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-md-6">
			<div class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
				<input type="password" class="form-control" name="pword" id="password" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
			</div>
			<span id="result"></span>
		</div>

		<div class="col-md-6">
			<div class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
				<input type="password" class="form-control" name="confirmpword" placeholder="Confirm Password" required>
			</div>
		</div>
	</div>
	<br>

<!-- 	<div class="input-group">
		<span class="input-group-addon">Middle name</span>
		<input type="text" class="form-control" name="mname" placeholder="Terrence" required>
	</div><br>
	<div class="input-group">
		<span class="input-group-addon">Last name</span>
		<input type="text" class="form-control" name="lname" placeholder="Doe" required>
	</div><br> -->
<!-- 	<div class="radio text-center">
		<label><input type="radio" name="gender" value="m" checked>Male</label>
		<label><input type="radio" name="gender" value="f">Female</label>
	</div> -->

	<br>

	<!-- Submit Button -->	
	<div class="form-group"> 
		<div class="col-sm-12 controls">
		    <button type="submit" class="btn btn-primary" name="registerUser" style="padding: 7px; width: 100%">
		        <img src="../images/icons/login.png" alt="" style="width: 24px;">
		        <strong>Register</strong>
		    </button>
		</div>
	</div>
</form>