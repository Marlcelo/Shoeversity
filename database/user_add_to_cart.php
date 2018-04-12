<?php
	if(isset($_POST['add_to_cart'])){
		session_start();
		require 'activity_check.php';

		$token = $_SESSION['sessionToken'];

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

			require 'config.php';

			$query = "CALL SP_ADD_LOG(".$_SESSION['u_username'].",'Added Item ".$_SESSION['pid']." to cart')";
			$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

			mysqli_close($conn);

			$_SESSION['success_msg'] = "This item has been added to your cart.";
			header("Location: ../views/users/view_product.php?pid=".$_SESSION['pid']."&result=".md5("success")."&token=".$token);
		}
		else {
			$_SESSION['error_msg']  = "Uh oh, something went wrong!";
			header("Location: ../views/users/view_product.php?pid=".$_SESSION['pid']."&result=".md5("fail")."&token=".$token);
		}
	}
?>