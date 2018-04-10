<?php 

require_once('../../database/config.php');
$query = "CALL SP_GET_SHOE('".$product."')";

$sql = "CALL SP_GET_SHOE_FROM(" . $_SESSION['b_id'] . ")";

$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
//var_dump($row);

$row = mysqli_fetch_assoc($result);


$posted_by = $row['posted_by'];
$name  = $row['name'];
$description  = $row['description'];
$type  = $row['type'];
$category = $row['category'];
$price = $row['price'];
$size  = $row['size'];
$color = $row['color'];
$photo   = $row['photo_url'];

// mysqli_close($conn);

// require_once('../../database/config.php');

// $sql = "CALL SP_GET_BRAND_INFO('".$posted_by."')";

// $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

// $row = mysqli_fetch_assoc($result);

// $brandname = $row['brand_name'];

$_SESSION['pid'] = $product;
?>