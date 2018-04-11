<?php

if(!isset($_SESSION)) {
	session_start();
}

$token = $_POST['passwordToken'];	// protect against CSRF
$email = $_POST['email'];
$uname = $_POST['username'];
$pass  = $_POST['password'];
$cpass = $_POST['cpassword'];

$token 	= trim($token );
$email 	= trim($email);
$uname 	= trim($uname);
$pass 	= trim($pass);
$cpass 	= trim($cpass);

$token  = filter_var($token , FILTER_SANITIZE_STRING);	
$email 	= filter_var($email, FILTER_SANITIZE_EMAIL);
$uname 	= filter_var($uname, FILTER_SANITIZE_STRING);
$pass 	= filter_var($pass, FILTER_SANITIZE_STRING);
$cpass 	= filter_var($cpass, FILTER_SANITIZE_STRING);

if($pass == $cpass) {
	require 'config.php';
	$sql = "CALL SP_SET_PASSWORD('$email', '$uname', '$pass')";

	$result = mysqli_query($conn, $sql);

	if($result) {
		$_SESSION['success_msg'] = "Your password was successfully updated!";
		$successLoc = "../views/login.php?success=" . md5("passwordReset");
		header("Location: $successLoc");
		exit();
	}
	else {
		$_SESSION['error_msg'] = "Uh oh! An error occurred.";
		$errLoc = "../views/login.php?error=" . md5("passwordResetError");
		header("Location: $errLoc");
		exit();
	}
}
else {
	$_SESSION['error_msg'] = "The passwords you entered did not match. No changes were made; try resetting your password again.";
	$errLoc = "../views/login.php?error=" . md5("passwordResetError");
	header("Location: $errLoc");
	exit();
}


?>