<?php
	if(isset($_POST['registerUser'])){
		$pass = $_POST['pword'];
		$cpass = $_POST['confirmpword'];

		if($pass == $cpass){
			require 'config.php';

			$fname = $_POST['fname'];
			$mname = $_POST['mname'];
			$lname = $_POST['lname'];

			$uname = $_POST['uname'];
			$email = $_POST['email'];

			$gender = $_POST['gender'];

			$query = "CALL SP_ADD_NEWUSER('".$uname."','".$pass."','".$email."','".$gender."', '".$fname."','".$mname."','".$lname."');";

			echo "$query";

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

			session_start();
			$_SESSION['username'] = $uname;
			$_SESSION['password'] = $pass;
			header("Location:user_authenticate.php");
		}
	}

?>