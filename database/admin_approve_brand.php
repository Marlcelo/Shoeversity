<?php
	if(!isset($_SESSION)) {
		session_start();
	}
	$token = $_SESSION['sessionToken'];

	require 'activity_check.php';
	require 'config.php';
	$brandId = $_GET['bId'];
	echo $brandId;

	$sql = "CALL SP_APPROVE_BRAND(".$brandId.");";

	$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));

	$row = mysqli_fetch_assoc($result);
	mysqli_close($conn);

	if($row['result'] == "SUCCESS"){
		$_SESSION['success_msg'] = "This brand can now post products for sale on Shoeversity.";

		# SEND EMAIL
		require 'config.php';
		$sql = "SELECT b_email FROM brands WHERE uid = $brandId";
		$res = mysqli_query($conn, $sql);
		$rowE = mysqli_fetch_assoc($res);
		$bEmail = $rowE['b_email'];
		mysqli_close($conn);

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
		$mail->addAddress($bEmail);               
		$mail->IsHTML(true);  
		$mail->AddEmbeddedImage('../images/logos/shoeversity-logo.jpg', 'logo_shoeversity');

		$mail->Subject = 'Brand Registration';
		$message = '
				<div style="position: fixed; top: 0px; height: auto; width: auto; padding: 7px 15px; background: #10263e; color: #fff">
					<h2>Shoeversity Brand Registration</h2>
				</div>
				<div style="height:auto; width: auto; padding: 80px 110px; background: #eee; color: #121212 !important; text-align: center;">

					<img src="cid:logo_shoeversity" style="border-radius: 50%">

					<h3 style="margin-top: 40px">Congratulations! Your brand registration has been approved by our Site Administrators.</h3>

					<p style="color: #121212 !important">You can sign in to your newly registred account <a href="localhost/Shoeversity/views/login.php">here</a>.</p>

					<br><hr><br>

					<div style="text-align: left !important; line-height: 5px">
						<p style="color:#777">Regards,</p>
						<i style="color:#777">The Shoeversity Team</i>
					</div>
				</div>
			';

		$mail->Body = $message;

		if(!$mail->send()) {
		    $_SESSION['success_msg'] .= "";
		} else {
		    $_SESSION['success_msg'] .= " An email has been sent to $bEmail notifying them of your approval.";
		}

		header("Location: ../views/admin/approve_brand.php?approved=".md5('success')."&token=$token");
		exit();

	}else{
		$_SESSION['error_msg'] = "Oops! Something went wrong, this Brand account was not approved.";
		header("Location: ../views/admin/approve_brand.php?approved=".md5('failed')."&token=$token");
		exit();
	}
?>