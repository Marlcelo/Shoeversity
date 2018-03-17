<?php
session_start();

$username = $_GET['user'];

// Get user type based on username
require 'config.php';
$sql = "SELECT username, type FROM site_users WHERE username = '".$username."' LIMIT 1;"; // CREATE A VIEW FOR THIS
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
$row = mysqli_fetch_assoc($result);
$userType = $row['type'];
mysqli_close($conn);


// Redirect user based on type
require 'config.php';

if($userType == "Admin") {
	$sql = "CALL SP_GET_ADMIN('$username');"; /* retrieve admin data */
	$result = mysqli_query($conn, $sql);
	$auth_user = mysqli_fetch_assoc($result);

	if($result) {
		/* Store results from database in $_SESSION variable */
		$_SESSION['a_id'] 			= $auth_user['uid'];
		$_SESSION['a_username']	 	= $auth_user['username'];
		$_SESSION['a_email'] 		= $auth_user['email'];	
		$_SESSION['a_gender'] 		= $auth_user['gender'];
		$_SESSION['a_firstname']	= $auth_user['first_name'];
		$_SESSION['a_lastname'] 	= $auth_user['middle_name'];
		$_SESSION['a_middlename'] 	= $auth_user['last_name'];
	}

	mysqli_close($conn);

	header("Location: ../views/admin/index.php");
	exit();
}
else if($userType == "Brand") {
	$sql = "CALL SP_GET_BRAND('$username');"; /* retrieve brand data */
	$result = mysqli_query($conn, $sql);
	$auth_user = mysqli_fetch_assoc($result);

	if($result) {
		if($auth_user['b_verified'] == 1) {	// Brand is verified
			/* Store results from database in $_SESSION variable */
			$_SESSION['b_id'] 			= $auth_user['uid'];
			$_SESSION['b_username']	 	= $auth_user['b_username'];
			$_SESSION['b_name'] 		= $auth_user['brand_name'];	
			$_SESSION['b_email'] 		= $auth_user['b_email'];
		}
		else {	// Brand is not verified
			$_SESSION['error_msg'] = "We're sorry, your brand registration hasn't been verified yet!";
			$_SESSION['error_msg'] .= "<br>";
			$_SESSION['error_msg'] .= "Please try again at a later time.";
		}
	}

	mysqli_close($conn);

	if($auth_user['b_verified'] == 1) {
		header("Location: ../views/brands/index.php");
		exit();
	}
	else {
		header("Location: ../views/login.php?auth=unverified");
		exit();
	}
}
else if($userType == "User") {
	$sql = "CALL SP_GET_USER('$username');"; /* retrieve user data */
	$result = mysqli_query($conn, $sql);
	$auth_user = mysqli_fetch_assoc($result);

	if($result) {
		/* Store results from database in $_SESSION variable */
		$_SESSION['u_id'] 			= $auth_user['uid'];
		$_SESSION['u_username']	 	= $auth_user['u_username'];
		$_SESSION['u_email'] 		= $auth_user['u_email'];	
		$_SESSION['u_gender'] 		= $auth_user['u_gender'];
		$_SESSION['u_firstname']	= $auth_user['first_name'];
		$_SESSION['u_lastname'] 	= $auth_user['middle_name'];
		$_SESSION['u_middlename'] 	= $auth_user['last_name'];
	}

	mysqli_close($conn);

	header("Location: ../views/users/index.php");
	exit();
}

?>