<?php
	if(isset($_POST['registerUser'])){
		session_start();

		$pass = $_POST['pword'];
		$cpass = $_POST['confirmpword'];

		if($pass == $cpass){
			require 'config.php';
			$uname = $_POST['uname'];

			//Check if username matches another accounts
			$query = "CALL SP_CHECK_UNAME_DUPLICATE('".$uname."');"; 
			echo $query;

			$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

			$row = mysqli_fetch_assoc($result);
			var_dump($row);
			mysqli_close($conn);
			if($row['col'] == 'TRUE'){ //Same username as another account
				$error_msg .= "Sorry the username has already been taken!<br>Please try a different username.";
				$_SESSION['error_msg'] = $error_msg;
				$error_path = "../views/register.php?register=" . md5('failed');
				header("Location: $error_path");
				exit();
			}else{
				//Unique username has been inputted
				require 'config.php';
				$fname = $_POST['fname'];
				$mname = $_POST['mname'];
				$lname = $_POST['lname'];
				$email = $_POST['email'];

				$gender = $_POST['gender'];

				$query = "CALL SP_ADD_NEWUSER('".$uname."','".$pass."','".$email."','".$gender."', '".$fname."','".$mname."','".$lname."');";

				echo $query;

				$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

				$row = mysqli_fetch_assoc($result);
				var_dump($row);

				if($row['col'] == 'SUCCESS')
					echo "STORED USER INFORMATION";
				else
					echo "ERROR";	// For Checking purposes

	//*******************************************************
	// STORE TO SITE_USERS TABLE
	//********************************************************
				mysqli_close($conn);
				require 'config.php';

				$query = "CALL SP_ADD_SITE_USER('User','".$uname."',FN_GET_HASHEDPASSWORD('".$pass."'));";

				echo "$query";

				$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

				$row = mysqli_fetch_assoc($result);
				var_dump($row);

				if($row['col'] == 'SUCCESS')
					echo "STORED USER SITE USER";
				else
					echo "ERROR";

				mysqli_close();

				
				$_SESSION['username'] = $uname;
				$_SESSION['password'] = $pass;
				header("Location:user_authenticate.php");
				}

			
		}
	}

?>