<?php
	require 'activity_check.php';
	require 'config.php';

	$query = "CALL SP_GET_ALL_BRANDS();";

	if($result = mysqli_query($conn,$query)) {

		$brands = array();

		while ($row = mysqli_fetch_assoc($result)){
			array_push($brands, $row);
		}

		//var_dump($users);
	}
	else 
		die(mysqli_error($conn));

?>	