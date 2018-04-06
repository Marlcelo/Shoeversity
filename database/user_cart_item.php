<?php

$shoeID = $itemID; // $item is the ID coming from user_shopping_cart_panel.php

require 'config.php';
$sql = "CALL SP_GET_SHOE($shoeID)";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$shoeName = $row['name'];
$shoeImg  = "../".$row['photo_url'];

#return to user_shopping_cart_panel.php
?>