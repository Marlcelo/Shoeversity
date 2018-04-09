<?php

require "config.php";

if(!isset($_SESSION)) {
	session_start();
}

$shoeID = $_SESSION['pid'];
$userID = $_SESSION['u_id'];

$sql = "CALL SP_GET_RATING_FOR($shoeID, $userID)";

$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0) {
	$row = mysqli_fetch_assoc($result);
	$prevRating = $row['rating'];
}

?>