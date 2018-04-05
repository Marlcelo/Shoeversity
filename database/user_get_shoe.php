<?php 

require_once('../../database/config.php');
$query = "CALL SP_GET_SHOE('".$product."')";

$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

$row = mysqli_fetch_assoc($result);
//var_dump($row);

$name = $row['name'];
$description = $row['description'];
$price = $row['price'];
$type = $row['type'];
$category = $row['category'];
$color = $row['color'];
$photo = $row['photo_url'];
$size  = $row['size'];
$posted = $row['brand_name'];

$_SESSION['pid'] = $product;
?>