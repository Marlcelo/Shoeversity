<?php

if(!isset($_SESSION)) {
	session_start();
}

$_SESSION['shoes_list'] = array();

require 'config.php';

// change this to a stored proc
$sql = "SELECT * FROM shoes";
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

while($row = mysqli_fetch_row($result)) {
	$name = $row[2];
	$description = $row[3];
	$color = $row[8];
	$size = $row[6];
	$price = $row[7];
	$imgpath = $row[9];
	// get other details
	
	$shoeDetails = array($name, $description, $color, $size, $price, $imgpath);
	array_push($_SESSION['shoes_list'], $shoeDetails);
}

mysqli_close($conn);

?>