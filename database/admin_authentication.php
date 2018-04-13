<?php

	if (isset($_POST['btn_authenticate'])) {
		session_start();
		require 'activity_check.php';
		
		$password = $_POST['pword'];
		$password = trim($password);
		

		if (strlen($pass) < 8 || !preg_match("#[0-9]+#", $pass) || !preg_match("#[a-zA-Z]+#", $pass) || !preg_match("#[!,%,&,@,#,$,^,*,?,_,~,.]+#", $pass)) {
			
	       $error_msg .= "Invalid input. Try again!";
			$_SESSION['error_msg'] = $error_msg;
			header("Location: ../views/admin/reauthentication.php?result=".md5("failed")."&token=".$_SESSION['sessionToken']);
			exit();
    	}
    }

    $username = $_SESSION['a_username'];
	echo $username . " ". $password;
	require 'config.php';

	/* Issue query on database */
	$sql = "CALL SP_GET_AUTHUSER('$username', 
								  FN_GET_HASHEDPASSWORD('$password'));";	/* Check hashed password */

	$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

	/* Stores a String indicating if the password matches the username in the database */
	$message = mysqli_fetch_assoc($result);

	mysqli_close($conn);

	if($message['strreturn'] == 'SUCCESS'){
		header("Location: ../views/admin/dashboard.php?token=".$_SESSION['sessionToken']);
	}
	else{
		$_SESSION['error_msg'] = "There seems to be a problem with your transaction. Please try again!";
			header("Location: ../views/admin/reauthentication.php?token=".$_SESSION['sessionToken']);
	}

?>
