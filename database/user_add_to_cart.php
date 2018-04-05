<?php
	if(isset($_POST['add_to_cart'])){
		session_start();

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
		if($size == sizeof($_SESSION['cart']))
			header("Location: ../views/users/view_product.php?pid=".$_SESSION['pid']."&result=".md5("success")."");
		else
			header("Location: ../views/users/view_product.php?pid=".$_SESSION['pid']."&result=".md5("fail")."");
	}
?>