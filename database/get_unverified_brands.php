<?php
	require 'config.php';

	$query = "CALL SP_GET_ALL_BRANDSUV();";

	if($result = mysqli_query($conn,$query)) {

		$uvbrands = array();

		while ($row = mysqli_fetch_assoc($result)){
			array_push($uvbrands, $row);
		}	
	}
	else 
		die(mysqli_error($conn));

?>	