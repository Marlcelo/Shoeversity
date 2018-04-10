<!DOCTYPE html>
<html lang="en">
<head>
    <title>Shoeversity</title>

    <?php
        // Include Bootstrap and main styles 
        include "../templates/public_bs_styles.php";
        include "../templates/public_shoeversity_styles.php";

        session_start();
        // Set active page
        $_SESSION['page_type'] = "Public";
        $_SESSION['active_page'] = "";

        // CHECK FOR CSRF ATTEMPTS
		if(empty($_POST) || !isset($_SESSION['resetPasswordToken'])) {
			// display error message
			$_SESSION['error_msg'] = "The page you requested has expired.";
			include "modals/error.php";

			echo "<script> 
						window.stop();

                        $('#error_modal').modal('show');
                        $('#error_modal').on('hidden.bs.modal', function () {
                            window.history.back();
                        })
                    </script>";

            $_SESSION['error_msg'] = "";    // reset
		}
		else {	// VALID PAGE REQUEST
			$token = $_POST['passwordToken'];
			$email = $_POST['email'];
			$username = $_POST['username'];

			if($token != $_SESSION['resetPasswordToken']) {
				$_SESSION['error_msg'] = "The page you requested has expired.";
				include "modals/error.php";

				echo "<script> 
						window.stop();

                        $('#error_modal').modal('show');
                        $('#error_modal').on('hidden.bs.modal', function () {
                            window.history.back();
                        })
                    </script>";

	            $_SESSION['error_msg'] = "";    // reset
			}	
			else {
				// $token == $_SESSION['resetPasswordToken']
			}

			//reset session token
			unset($_SESSION['resetPasswordToken']);
		}
    ?>
</head>
<body>
    <!-- BEGIN HEADER -->
    <link rel="icon" type="image/png" href="../images/logos/shoeversity-favicon.png">

	<nav class="navbar navbar-default navbar-inverse navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand"><img class="img-circle" src="../images/logos/shoeversity-logo.jpg" width="20px"> </a>
				<a class="navbar-brand"><strong>Shoeversity</strong></a> 
			</div>
		</div>
	</nav>
    <!-- .END HEADER -->

    <!-- BEGIN MAIN CONTENT -->
    <div class="container content-wrapper">
        <div class="col-md-12" style="margin-top: -10px;">
            <div class="col-md-3">  
            </div>

            <div class="col-md-6">
                <!-- Login Form Container --> 
                <div class="panel panel-default panel-login" style="padding-top: 10px">

                    <div class="text-center" style="margin-bottom: 10px solid black"> 
                        <img src="../images/logos/shoeversity-logo.jpg" height="200px" class="img-circle" alt="Shoeversity">
                        <h1 style="margin-top: 0px">Reset Password</h1>
                    </div>

                    <hr>

                    <!-- Reset Password Form -->
                    <div class="panel-body">
                    	<p style="font-size: 15px">Enter your new password below.</p>
                        <form action='../database/password_reset.php' method='post'>
                        	<!-- CSRF Token -->
                        	<input type="text" value="<?php echo $token?>" name="passwordToken" style="display:none">
                        	<input type="email" value="<?php echo $email ?>" name="email" style="display:none">
                        	<input type="text" value="<?php echo $username?>" name="username" style="display:none">

                            <!-- Password -->
                            <div class="input-group" style="margin-bottom: 16px">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input type='password' name='password' class='form-control' placeholder="Password" required>
                            </div>

                            <!-- Confirm Password -->
                            <div class="input-group" style="margin-bottom: 16px">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input type='password' name='cpassword' class='form-control' placeholder="Confirm Password" required>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary" style="padding: 7px; width: 100%">
                                <strong>Reset Password</strong>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-3">  
            </div>
        </div>
    </div>
     <!-- .END MAIN CONTENT -->

    <!-- BEGIN FOOTER -->
    <?php require "../templates/public_footer.php"; ?>
    <!-- .END FOOTER -->
    
    <!-- Include Javascript files -->
</body>
</html>