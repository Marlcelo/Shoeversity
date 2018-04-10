<?php

if(!isset($_SESSION)) {
	session_start();
}

$email = $_POST['email'];

// Validate email address supplied as user input
if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	$_SESSION['error_msg'] = "The email address you entered is invalid.";
	$errLoc = "../views/login.php?error=" . md5("invalidEmail");
    header("Location: $errLoc");
    exit();
}

// Validate if email address exists in database and is linked to a user
require 'config.php';
$sql = "CALL SP_GET_USER_FROM_EMAIL('$email')";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) > 0) {

}
else {
	$_SESSION['error_msg'] = "Uh oh! We can't seem to find your email address in our records. <a href='register.php' class='link'>Register here</a>.";
	$errLoc = "../views/login.php?error=" . md5("invalidEmail");
    header("Location: $errLoc");
    exit();
}

// If valid email address, send email
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
			<h2>Password Reset</h2>
		</div>
		<div style="height:auto; width: auto; padding: 80px 110px; background: #eee; color: #121212 !important; text-align: center;">

			<img src="cid:logo_shoeversity" style="border-radius: 50%">
			
			<h1 style="margin-top: 40px">Welcome to Shoeversity!</h1>

			<h3>Hi, '.$_POST['fname'].' '.$_POST['lname'].'! You'."'".'ve been registered as a <u>Site Administrator</u> by an existing Shoeversity Admin account.</h3>

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

?>