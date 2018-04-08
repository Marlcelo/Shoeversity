<?php
	if(isset($_SESSION['cart'])){
		$cart = $_SESSION['cart'];
		$items = array();
		$subtotal = 0;
		foreach ($cart as $shoe) {
			require 'config.php';
			$query = "CALL SP_GET_SHOE('".$shoe."')";
			$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

			$row = mysqli_fetch_assoc($result);
			$item = array($row['photo_url'],$row['name'],$row['price'],$row['uid']);
			$subtotal +=$row['price'];
			array_push($items, $item);
			mysqli_close($conn);
		}
		$total = $subtotal + ($subtotal * 0.10);
	}
	
?>