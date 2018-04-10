<?php
require 'activity_check.php';
require 'config.php';
$sql = "CALL SP_GET_BRAND_NAMES();";
$result = mysqli_query($conn, $sql); 

$brands_list = array();

while($row = mysqli_fetch_assoc($result)) {
	$brand = array();
	array_push($brand, $row['uid']);
	array_push($brand, $row['brand_name']);

	array_push($brands_list, $brand);
}

mysqli_close($conn);

?>