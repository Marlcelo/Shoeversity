<?php

	if (isset($_POST['btn_checkout'])) {
		session_start();
		require 'activity_check.php';
		echo "Here";
		$password = $_POST['pword'];
		$username = $_SESSION['u_username'];
		echo $username . " ". $password;
		require 'config.php';
		/* Issue query on database */
		$sql = "CALL SP_GET_AUTHUSER('$username', 
									  FN_GET_HASHEDPASSWORD('$password'));";	/* Check hashed password */

		$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

		/* Stores a String indicating if the password matches the username in the database */
		$message = mysqli_fetch_assoc($result);
		mysqli_close($conn);

		/* Process Purchase */
		if($message['strreturn'] == 'SUCCESS') {
			
			$uid = $_SESSION['u_id'];
			$cart = $_SESSION['cart'];
			$counter = 0;

			foreach ($cart as $item) {
				require 'config.php';
				$query = "CALL SP_ADD_PURCHASE('".$uid."','".$item."')";
				$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

				
				$row = mysqli_fetch_assoc($result);
				if($row['col'] == "SUCCESS")
					$counter++;

				
			}
			if($counter == sizeof($cart)){
				$_SESSION['success_msg'] = "Your order is now being processed. Confirmation email has been sent.<br>Thank you for shopping at Shoeversity!.";
						header("Location: ../views/users/products.php?result=".md5("success")."");
				$_SESSION['cart'] = array();
				exit();
			}else{
				$_SESSION['error_msg'] = "There seemed to be a problem processing your order/s. Please try again!";
						header("Location: ../views/users/products.php?result=".md5("failed")."");
			}
			
		}else{
			$_SESSION['error_msg'] = "There seems to be a problem with your transaction. Please try again!";
						header("Location: ../views/users/products.php?result=".md5("failed")."");
		}
	}
		
?>