<?php
	session_start();
	if(isset($_GET['shoe'])){
		$shoe = $_GET['shoe'];

		unset($_SESSION['cart'][$shoe]);

		// reindex array (start at 0)
		$newCart = array();
		$newCart = array_values($_SESSION['cart']);
		$_SESSION['cart'] = $newCart;

		echo "<script> window.history.back(); </script>";				
	}
?>