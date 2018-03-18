<?php
	require 'config.php';

	session_start();
	
	//mark user as inactive in database
	if(isset($_SESSION['a_username'])) {
		$current_user = $_SESSION['a_username'];
	}
	else if(isset($_SESSION['b_username'])) {
		$current_user = $_SESSION['b_username'];
	}
	else if(isset($_SESSION['u_username'])) {
		$current_user = $_SESSION['u_username'];
	}
	
	// Implement this later on
	// $sql = "CALL SP_DEL_USERACTIVITY('$current_user')";
	// $result = mysqli_query($conn, $sql);

	session_unset();
	session_destroy();

	header("Location: ../views/login.php");
	exit();
?>	