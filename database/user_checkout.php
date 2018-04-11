<?php

	if (isset($_POST['btn_checkout'])) {
		session_start();
		require 'activity_check.php';
		
		$password = $_POST['pword'];
		$password = trim($password);
		$password = filter_var($password,FILTER_SANITIZE_STRING);
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

				mysqli_close($conn);
			}
			if($counter == sizeof($cart)){
				$_SESSION['success_msg'] = "Your order is now being processed. An email containing your receipt has been sent to ".$_SESSION['u_email'].".<br>Thank you for shopping at Shoeversity!";
				
				/*****************************************/
				/*		SEND RECEIPT THROUGH EMAIL  	 */
				/*****************************************/
				require '../libs/PHPMailer/PHPMailerAutoload.php';

				$mail = new PHPMailer;

				// $mail->SMTPDebug = 4;                              // Enable verbose debug output

				$mail->isSMTP();                                      // Set mailer to use SMTP
				$mail->Host = 'smtp.gmail.com';  					  // Specify main SMTP servers
				$mail->SMTPAuth = true;                               // Enable SMTP authentication
				$mail->Username = 'shoeversityofficial@gmail.com';    // SMTP username
				$mail->Password = 'FlashByte';                        // SMTP password
				$mail->SMTPSecure = 'ssl';                            // Enable SSL encryption
				$mail->Port = 465;                                    // TCP port to connect to for SSL

				$mail->setFrom('shoeversityofficial@gmail.com', 'Shoeversity Official');
				$mail->addAddress($_SESSION['u_email']);               
				$mail->IsHTML(true);  
				$mail->AddEmbeddedImage('../images/logos/shoeversity-logo.jpg', 'logo_shoeversity');

				$mail->Subject = 'Official Receipt - ' . date("m/d/Y");
				$total = 0;
				$tax = 0;
				$message = '
						<div style="position: fixed; top: 0px; height: auto; width: auto; padding: 7px 15px; background: #10263e; color: #fff">
							<h2>Shoeversity Official Receipt</h2>
						</div>
						<div style="height:auto; width: auto; padding: 80px 110px; background: #eee; color: #121212 !important; text-align: center;">

							<img src="cid:logo_shoeversity" style="border-radius: 50%">
							
							<h1 style="margin-top: 40px">Thank you for shopping at Shoeversity!</h1>

							<h3>Hi, '.$_SESSION['u_firstname'].' '.$_SESSION['u_lastname'].'! Your order has been received and is now being processed. Below are the details of your purchase(s) for your reference.</h3>

							<center>
							<table border="1" style="border-collapse:collapse" cellpadding="12">
								<thead>
									<tr style="background: #10263e; color: #fff">
										<th>Product</th>
										<th>Brand</th>
										<th>Type</th>
										<th>Category</th>
										<th>Size</th>
										<th>Color</th>
										<th>Price</th>
									</tr>
								</thead>
								<tbody>';
								foreach($cart as $item) {
									require 'config.php';
									$sql = "CALL SP_GET_SHOE($item)";
									$res = mysqli_query($conn, $sql);
									$row = mysqli_fetch_assoc($res);
									mysqli_close($conn);

									$message .= '
									<tr>
										<td>'.$row["name"].'</td>
										<td>'.$row["brand_name"].'</td>
										<td>'.$row["type"].'</td>
										<td>'.$row["category"].'</td>
										<td>'.$row["size"].'</td>
										<td>'.$row["color"].'</td>
										<td>&#8369;'.$row["price"].'</td>
									</tr>';
									$total += $row['price'];
								}
								$tax = $total * 0.1;
				$message .=		   '<tr style="text-align:right">
										<td colspan="7">Subtotal: &#8369;'.$total.'</td>
									</tr>
									<tr style="text-align:right">
										<td  colspan="7">Estimated Shipping: &#8369;'.$tax.'</td>
									</tr>
									<tr style="text-align:right">
										<td  colspan="7"><b>Total</b>: &#8369;'.($total+$tax).'</td>
									</tr>
								</tbody>
							</table>

							<br>
							<h2>Customer Details</h2>
							<div style="text-align:left; border: 1px solid #121212; padding: 15px; width: 350px;">
								<b>Username:</b>&nbsp;'.$_SESSION["u_username"].'<br><br>
								<b>Email Address:</b>&nbsp;'.$_SESSION["u_email"].'<br><br>
								<b>First Name:</b>&nbsp;'.$_SESSION["u_firstname"].'<br><br>
								<b>Middle Name:</b>&nbsp;'.$_SESSION["u_middlename"].'<br><br>
								<b>Last Name:</b>&nbsp;'.$_SESSION["u_lastname"].'
							</div>
							<center>

							<br>
							<p style="color: #121212 !important">To shop with us again, <a href="localhost/Shoeversity/views/login.php">sign in to your account</a>.</p>

							<br><hr><br>

							<div style="text-align: left !important; line-height: 5px">
								<p style="color:#777">Regards,</p>
								<i style="color:#777">The Shoeversity Team</i>
							</div>
						</div>
					';
				
				$mail->Body = $message;

				if(!$mail->send()) {
				    echo 'Message could not be sent.';
				    echo 'Mailer Error: ' . $mail->ErrorInfo;
				} else {
				    echo 'Message has been sent';
				}

				# RESET SHOPPING CART
				$_SESSION['cart'] = array();

				header("Location: ../views/users/products.php?result=".md5("success")."&token=".$_SESSION['sessionToken']);
				exit();
			}else{
				$_SESSION['error_msg'] = "There seems to be a problem processing your order/s. Please try again!";
						header("Location: ../views/users/products.php?result=".md5("failed")."&token=".$_SESSION['sessionToken']);
			}
			
		}else{
			$_SESSION['error_msg'] = "There seems to be a problem with your transaction. Please try again!";
						header("Location: ../views/users/products.php?result=".md5("failed")."&token=".$_SESSION['sessionToken']);
		}
	}
		
?>