<?php

	require 'config.php';
	$sql = "SELECT * FROM logs ORDER BY time_stamp DESC LIMIT 0,5";
	$result = mysqli_query($conn, $sql);

	$notifications = array();
	while($row = mysqli_fetch_assoc($result)) {
		array_push($notifications, $row);
	}

?>