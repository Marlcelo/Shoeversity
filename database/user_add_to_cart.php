<?php
	if(isset($_POST['add_to_cart'])){
		session_start();
		require 'activity_check.php';

		$size = sizeof($_SESSION['cart']);


		if(isset($_SESSION['cart'])){
			array_push($_SESSION['cart'],$_SESSION['pid']);
			$size++;
		}else{
			$_SESSION['cart'] = array();
			array_push($_SESSION['cart'],$_SESSION['pid']);
			$size++;
		}


		var_dump($_SESSION['cart']);
		if($size == sizeof($_SESSION['cart'])) {
			$_SESSION['success_msg'] = "This item has been added to your cart.";
			header("Location: ../views/users/view_product.php?pid=".$_SESSION['pid']."&result=".md5("success")."");
		}
		else {
			$_SESSION['error_msg']  = "Uh oh, something went wrong!";
			header("Location: ../views/users/view_product.php?pid=".$_SESSION['pid']."&result=".md5("fail")."");
		}
	}
?>