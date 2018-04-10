<?php 

require_once('../../database/config.php');
$sql = "CALL SP_GET_SHOE('".$product."')";

$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
//var_dump($row);

$row = mysqli_fetch_assoc($result);

$name  = $row['name'];
$description  = $row['description'];
$type  = $row['type'];
$category = $row['category'];
$price = $row['price'];
$size  = $row['size'];
$color = $row['color'];
$photo   = $row['photo_url'];
$posted = $row['brand_name'];

$_SESSION['pid'] = $product;

?>