<form class="form-horizontal" name="register_user" action="RegisterUserServlet" method="post">

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
				<input type="text" class="form-control" name="uname" placeholder="Username" required>
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
				<input type="password" class="form-control" name="pword" placeholder="Password" required>
			</div>
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

	<div class="form-group">
		<div class="col-sm-12 controls">
			<input type="submit" value="Register" name="register" class="btn btn-primary pull-right btn-block" style="padding: 7px; width: 100%"/>
		</div>
	</div>
</form>