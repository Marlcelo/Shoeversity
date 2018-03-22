<?php

if(!isset($_SESSION)) {
	session_start();
}

$shoe_id = $_SESSION['pid'];
$_SESSION['selected_shoe_details'] = array();

require 'config.php';

// change this to a stored proc
$sql = "SELECT * FROM shoes WHERE uid = ".$shoe_id;
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
$row = mysqli_fetch_assoc($result);


$name = $row['name'];
$description = $row['description'];
$color = $row['color'];
$size = $row['size'];
$price = $row['price'];
$imgpath = $row['photo_url'];

	
$shoeDetails = array($name, $description, $color, $size, $price, $imgpath);
array_push($_SESSION['selected_shoe_details'], $shoeDetails);

mysqli_close($conn);

?>