<?php
	require 'config.php';

	$query = "CALL SP_GET_ALL_USERS();";

	if($result = mysqli_query($conn,$query)) {

		$users = array();

		while ($row = mysqli_fetch_assoc($result)){
			array_push($users, $row);
		}

		//var_dump($users);
	}
	else 
		die(mysqli_error($conn));

?>	