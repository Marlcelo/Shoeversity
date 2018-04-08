<?php

require 'config.php';

if(!isset($_SESSION))
	session_start();

$pid = $product;	 // This variable comes from view_product.php

$sql = "CALL SP_GET_RATING($pid)";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0) {
	$row = mysqli_fetch_assoc($result);
	$rating = $row['AVG(rating)'];
}

?>