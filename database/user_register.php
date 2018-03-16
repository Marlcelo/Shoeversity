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

			$result = mysqli_query($conn,$query) or die(mysql_error($conn));

			$row = mysqli_fetch_assoc($result);
			var_dump($row);

			if($row['col'] == 'SUCCESS')
				echo "STORED";
			else
				echo "ERROR";	// For Checking purposes

			header("Location: ../index.php"); //PLEASE CHANGE THIS TO USER LANDING PAGE
		}
	}

?>