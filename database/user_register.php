<?php
	if(isset($_POST['registerUser'])){
		session_start();

		$pass = $_POST['pword'];
		$cpass = $_POST['confirmpword'];

		if($pass == $cpass){
			echo "HERE!";
			require 'config.php';
			$uname = $_POST['uname'];
			$email = $_POST['email'];

			if (!(filter_var($email, FILTER_VALIDATE_EMAIL))) {
			    echo "Email address '$email' is considered valid.\n";
			    $error_msg .= "Email address '$email' is considered valid.\n";
				$_SESSION['error_msg'] = $error_msg;
				$error_path = "../views/register.php?register=" . md5('failed');
				header("Location: $error_path");
				exit();
			}

			//Check if username matches another accounts
			$query = "CALL SP_CHECK_UNAME_EMAIL_DUPLICATE('".$uname."','".$email."');"; 
			echo $query;

			$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

			$row = mysqli_fetch_assoc($result);
			var_dump($row);
			mysqli_close($conn);
			if($row['col'] == 'TRUE'){ //Same username/email as another account
				$error_msg .= "Sorry the username or/and email has already been taken!<br>Please try a different username or/and email.";
				$_SESSION['error_msg'] = $error_msg;
				$error_path = "../views/register.php?register=" . md5('failed');
				header("Location: $error_path");
				exit();
			}else{
				//Unique username has been inputted
				require 'config.php';
				$fname = $_POST['fname'];
				$mname = $_POST['mname'];
				$lname = $_POST['lname'];
				

				$gender = $_POST['gender'];

				$query = "CALL SP_ADD_NEWUSER('".$uname."','".$pass."','".$email."','".$gender."', '".$fname."','".$mname."','".$lname."');";

				echo $query;

				$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

				$row = mysqli_fetch_assoc($result);
				var_dump($row);

				if($row['col'] == 'SUCCESS')
					echo "STORED USER INFORMATION";
				else
					echo "ERROR";	// For Checking purposes

		//********************************************************
		// STORE TO SITE_USERS TABLE
		//********************************************************
				mysqli_close($conn);
				require 'config.php';

				$query = "CALL SP_ADD_SITE_USER('User','".$uname."',FN_GET_HASHEDPASSWORD('".$pass."'));";

				echo "$query";

				$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

				$row = mysqli_fetch_assoc($result);
				var_dump($row);

				if($row['col'] == 'SUCCESS')
					echo "STORED USER SITE USER";
				else
					echo "ERROR";

				mysqli_close();

				
				$_SESSION['username'] = $uname;
				$_SESSION['password'] = $pass;
				header("Location:user_authenticate.php");
				}

		//********************************************************
		// SEND EMAIL TO NEW USER
		//********************************************************
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
				$mail->addAddress($_POST['email']);               
				$mail->IsHTML(true);  
				$mail->AddEmbeddedImage('../images/logos/shoeversity-logo.jpg', 'logo_shoeversity');

				$mail->Subject = 'Welcome to Shoeversity!';
				$message = '
						<div style="position: fixed; top: 0px; height: auto; width: auto; padding: 7px 15px; background: #10263e; color: #fff">
							<h2>My Account: '.$_POST['uname'].'</h2>
						</div>
						<div style="height:auto; width: auto; padding: 80px 110px; background: #eee; color: #121212 !important; text-align: center;">

							<img src="cid:logo_shoeversity" style="border-radius: 50%">
							
							<h1 style="margin-top: 40px">Welcome to Shoeversity!</h1>

							<h3>Hi, '.$_POST['fname'].' '.$_POST['lname'].'! Thank you for registering with us.</h3>

							<p style="color: #121212 !important">To get started, sign in to your account <a href="localhost/Shoeversity/views/login.php">here</a>.</p>

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
				// $mail->send();
			
		}
	}

?>