<?php
	session_start();

	if(isset($_GET['id'])){
		$shoe = $_GET['id'];		

		unset($_SESSION['cart'][$shoe]);

				// reindex array (start at 0)
				$newCart = array();
				$newCart = array_values($_SESSION['cart']);
				$_SESSION['cart'] = $newCart;

				header("location:../views/users/products.php");


	}
?>