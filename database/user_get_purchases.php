<?php
	require 'activity_check.php';
	require 'config.php';

	$id = $_SESSION['u_id'];

	$query = "CALL SP_GET_PURCHASED(".$id.");";

	if($result = mysqli_query($conn,$query)) {

		$purchased = array();

		while ($row = mysqli_fetch_assoc($result)){
			array_push($purchased, $row);
		}
	}
	else 
		die(mysqli_error($conn));


?>