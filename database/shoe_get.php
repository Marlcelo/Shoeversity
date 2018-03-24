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
$brandID = $row['posted_by'];

mysqli_close($conn);

// Get brand name
require 'config.php';
$sql = "SELECT brand_name FROM brands WHERE uid = $brandID";
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
$row = mysqli_fetch_assoc($result);
$postedBy = $row['brand_name'];
	
$shoeDetails = array($name, $description, $color, $size, $price, $imgpath, $postedBy);
array_push($_SESSION['selected_shoe_details'], $shoeDetails);

mysqli_close($conn);

?>