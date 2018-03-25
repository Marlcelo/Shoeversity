<?php
	require 'config.php';

	$query = "CALL SP_GET_ALL_ADMINS();";

	if($result = mysqli_query($conn,$query)) {

		$admins = array();

		while ($row = mysqli_fetch_assoc($result)){
			array_push($admins, $row);
		}	
	}
	else 
		die(mysqli_error($conn));

?>	