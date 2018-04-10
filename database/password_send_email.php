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
	$row = mysqli_fetch_assoc($result);
	$fname = $row['first_name'];
	$lname = $row['last_name'];
	$user = $fname . " " . $lname;
}
else {
	$_SESSION['error_msg'] = "Uh oh! We can't seem to find your email address in our records. <a href='register.php' class='link'>Register here</a>.";
	$errLoc = "../views/login.php?error=" . md5("invalidEmail");
    header("Location: $errLoc");
    exit();
}

/****************************************************************/
/*						IMPORTANT!								*/
/*		Set Password Reset Token to protect against CSRF 		*/
/****************************************************************/
# Example format: "2018-04-09|11:56:51|<random integer, no limit>"
$passwordToken = date("Y-m-d") . "|" . date("h:i:s") . "|" . mt_rand();
$passwordToken = hash("sha256", $passwordToken);
// STORE IN SESSION FOR CHECKING UPON REDIRECT
$_SESSION['resetPasswordToken'] = $passwordToken;


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

$mail->Subject = 'Password Reset';
$message = '
		<div style="position: fixed; top: 0px; height: auto; width: auto; padding: 7px 15px; background: #10263e; color: #fff">
			<h2>Password Reset</h2>
		</div>
		<div style="height:auto; width: auto; padding: 80px 110px; background: #eee; color: #121212 !important; text-align: center;">

			<img src="cid:logo_shoeversity" style="border-radius: 50%">

			<h3 style="margin-top: 40px">Hi, '.$user.'! You told us you forgot your password. Let'."'".'s get you a new one.</h3>

			<form action="localhost/Shoeversity/views/password_reset.php" method="post">
				<input type="text" value="'.$passwordToken.'" name="passwordToken" style="display:none">

				<button type="submit" style="background-color: #0288D1; padding: 15px 25px; color: #fff; border-radius: 5px; cursor: pointer">
					<span style="font-size: 14px"><strong>Reset your password</strong></span>
				</button>
			</form>

			<p style="color: #121212 !important">If you didn'."'".'t mean to reset your password, you can ignore this email; your password won'."'".'t change.</p>

			<br><hr><br>

			<div style="text-align: left !important; line-height: 5px">
				<p style="color:#777">Regards,</p>
				<i style="color:#777">The Shoeversity Team</i>
			</div>
		</div>
	';

$mail->Body = $message;

if(!$mail->send()) {
    $_SESSION['error_msg'] = "Uh oh! We couldn't send you an email for some reason.";
	$errLoc = "../views/login.php?error=" . md5("mailError");
    header("Location: $errLoc");
    exit();
} else {
    $_SESSION['success_msg'] = "We've sent you an email with instructions to reset your password.";
	$successLoc = "../views/login.php?success=" . md5("mailSuccess");
    header("Location: $successLoc");
    exit();
}

?>