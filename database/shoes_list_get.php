<?php

if(!isset($_SESSION)) {
	session_start();
}

$_SESSION['shoes_list'] = array();

require 'config.php';

// change this to a stored proc
$sql = "SELECT * FROM shoes";
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

$sql2 = "SELECT * FROM brands";
$result2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));

while($row = mysqli_fetch_row($result)) {
	$postedby = $row[1]; 
	$name = $row[2];
	$description = $row[3];
	$color = $row[8];
	$size = $row[6];
	$price = $row[7];
	$imgpath = $row[9];
	// get other details

	while($brandrow = mysqli_fetch_row($result2)){

		$brandid = $brandrow[0];

		if($brandid == $row[1]){ //if brand id is the same as the brand posted by of the shoe
			$postedby = $brandrow[1]; //store brand name 
		}
	}
	
	$shoeDetails = array($postedby, $name, $description, $color, $size, $price, $imgpath);
	array_push($_SESSION['shoes_list'], $shoeDetails);
}

mysqli_close($conn);

?>