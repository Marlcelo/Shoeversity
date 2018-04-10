<?php
	require 'activity_check.php';
	require 'config.php';

	$query = "CALL SP_GET_ALL_LOGS();";

	if($result = mysqli_query($conn,$query)) {

		$logs = array();

		while ($row = mysqli_fetch_assoc($result)){
			array_push($logs, $row);
		}	
	}
	else 
		die(mysqli_error($conn));

?>	