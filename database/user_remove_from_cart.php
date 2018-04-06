<?php

if(isset($_POST['pid'])) {
	$pid = $_POST['pid'];
}

if(!isset($_SESSION)) {
	session_start();
}

// remove item from cart
// if(isset($_SESSION['cart'])) {
	unset($_SESSION['cart'][$pid]);
// }

?>