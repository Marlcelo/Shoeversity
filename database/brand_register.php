<?php
if(isset($_POST['registerBrand'])){
	$pass = $_POST['pword'];
	$cpass = $_POST['confirmpword'];

	if($pass == $cpass){
		require 'config.php';
		session_start();

		$uname = $_POST['uname'];
		$email = $_POST['email'];

		$uname = trim($uname);
		$email = trim($email);

		if (strlen($pass) < 8 || strlen($uname) < 8 || (!preg_match("#[0-9]+#", $uname) &&  !preg_match("#[a-zA-Z]+#", $uname) && !preg_match("#[0-9]+#", $pass) && !preg_match("#[a-zA-Z]+#", $pass) && !preg_match("#[!,%,&,@,#,$,^,*,?,_,~,.]+#", $pass))) {
	    	$error_msg .= "Invalid format! Try again!.";
	    	$_SESSION['error_msg'] = $error_msg;
			$error_path = "../views/register.php?register=" . md5('failed');
			header("Location: $error_path");
	        exit();
	    }

		if (!(filter_var($email, FILTER_VALIDATE_EMAIL))) {
			echo "Email address '$email' is considered invalid.\n";
			$error_msg .= "Email address '$email' is considered valid.\n";
			$_SESSION['error_msg'] = $error_msg;
			$error_path = "../views/register.php?register=" . md5('failed');
			header("Location: $error_path");
			exit();
		}

//Check if username matches another accounts
		$query = "CALL SP_CHECK_UNAME_EMAIL_DUPLICATE('".filter_var($uname,FILTER_SANITIZE_STRING)."','".filter_var($email,FILTER_SANITIZE_STRING)."');"; 
		echo $query;

		$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

		$row = mysqli_fetch_assoc($result);
		var_dump($row);
		mysqli_close();

if($row['col'] == 'TRUE'){ //Same username/email as another account
	$error_msg .= "Sorry the username and/or email has already been taken!<br>Please try a different username and/or email.";
	$_SESSION['error_msg'] = $error_msg;
	$error_path = "../views/register.php?register=" . md5('failed');
	header("Location: $error_path");
	exit();
}else{
	$brandname = $_POST['brandname'];

	$numbers = array();
	array_push($numbers, $_POST['number1']);
	$locations = array();
	array_push($locations, $_POST['location1']);

	$counter = 2;
	$flag = true;

	while ($flag) {
		if(isset($_POST['number'.$counter])){
			array_push($numbers, $_POST['number'.$counter]);
			$counter++;
		}else
		$flag = false;
	}

	$counter = 2;
	$flag = true;

	while ($flag) {
		if(isset($_POST['location'.$counter])){
			array_push($locations, $_POST['location'.$counter]);
			$counter++;
		}else
		$flag = false;
	}

//************************************************************
//		ADD BRAND INFO
//************************************************************
	require 'config.php';

	$query = "CALL SP_ADD_BRAND_INFO('".filter_var($brandname,FILTER_SANITIZE_STRING)."','".filter_var($uname,FILTER_SANITIZE_STRING)."','".filter_var($pass,FILTER_SANITIZE_STRING)."','".$email."');";

	echo "$query";

	$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

	$row = mysqli_fetch_assoc($result);
	var_dump($row);

	if($row['result'] == 'SUCCESS'){
		echo "STORED BRAND INFO";

		mysqli_close($conn);
	require 'config.php';
	//**********************************************************
	//		GET REGISTERED BRAND UID
	//***********************************************************

	$query = "CALL SP_GET_BRAND('".filter_var($brandname,FILTER_SANITIZE_STRING)."','".filter_var($email,FILTER_SANITIZE_STRING)."','".filter_var($uname,FILTER_SANITIZE_STRING)."');";

	echo "$query";

	$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

	$row = mysqli_fetch_assoc($result);
	var_dump($row);
	$uid = $row['uid'];
	$username = $row['b_username'];
	$pass = $row['b_password'];

	//**********************************************************
	//		ADD BRAND CONTACTS 	
	//**********************************************************

	for ($i=0; $i < sizeof($numbers); $i++) { 
		mysqli_close($conn);
		require 'config.php';
		$numbers[$i] = trim($numbers[$i]);
	$query = "CALL SP_ADD_BRAND_CONTACT('".$uid."', '".filter_var($numbers[$i],FILTER_SANITIZE_STRING)."')"; // Add brand contact numbers

	echo "$query";

	$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

	$row = mysqli_fetch_assoc($result);
	var_dump($row);				
	}
	//*****************************************************
	//		ADD LOCATIONS
	//*****************************************************
	for ($i=0; $i < sizeof($locations); $i++) { 
		mysqli_close($conn);
		require 'config.php';
		$locations[$i] = trim($locations[$i]);
	$query = "CALL SP_ADD_BRAND_LOCATION('".$uid."', '".filter_var($locations[$i],FILTER_SANITIZE_STRING)."')"; // Add brand contact numbers

	echo "$query";

	$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

	$row = mysqli_fetch_assoc($result);
	var_dump($row);

	if($row['col'] == "SUCCESS")
		echo "STORED LOCATION <BR>";


	}

	//*****************************************************
	//		ADD LINKS
	//*****************************************************
	mysqli_close($conn);

	$website = $_POST['website'];
	$facebook = $_POST['facebook'];
	$twitter = $_POST['twitter'];
	$instagram = $_POST['instagram'];

	$website	= trim($website);
	$facebook	= trim($facebook);
	$twitter	= trim($twitter ); 
	$instagram	= trim($instagram ); 

	if(isset($website) && trim($website) != ''){
		require 'config.php';

		$query = "CALL SP_ADD_BRAND_LINK('".$uid."','website','".filter_var($website,FILTER_SANITIZE_STRING)."');";

		echo "$query";

		$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

		$row = mysqli_fetch_assoc($result);
		var_dump($row);

		if($row['col'] == "SUCCESS")
			echo "Stored WEBSITE LINK <BR>";
		else
			echo "ERROR <br>";

		mysqli_close($conn);

	}
	if(isset($facebook) && trim($facebook) != ''){
		require 'config.php';

		$query = "CALL SP_ADD_BRAND_LINK('".$uid."','facebook','".filter_var($facebook,FILTER_SANITIZE_STRING)."');";

		echo "$query";

		$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

		$row = mysqli_fetch_assoc($result);
		var_dump($row);

		if($row['col'] == "SUCCESS")
			echo "Stored FACEBOOK LINK <BR>";
		else
			echo "ERROR <br>";

		mysqli_close($conn);
	}
	if(isset($twitter) && trim($twitter) != ''){
		require 'config.php';

		$query = "CALL SP_ADD_BRAND_LINK('".$uid."','twitter','".filter_var($twitter,FILTER_SANITIZE_STRING)."');";

		echo "$query";

		$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

		$row = mysqli_fetch_assoc($result);
		var_dump($row);

		if($row['col'] == "SUCCESS")
			echo "Stored TWITTER LINK <BR>";
		else
			echo "ERROR <br>";

		mysqli_close($conn);
	}
	if(isset($instagram) && trim($instagram) != ''){
		require 'config.php';

		$query = "CALL SP_ADD_BRAND_LINK('".$uid."','instagram','".filter_var($instagram,FILTER_SANITIZE_STRING)."');";

		echo "$query";

		$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

		$row = mysqli_fetch_assoc($result);
		var_dump($row);

		if($row['col'] == "SUCCESS")
			echo "Stored INSTAGRAM LINK <BR>";
		else
			echo "ERROR <br>";

		mysqli_close($conn);
	}

	//*****************************************************
	//		ADD TO SITE_USERS
	//*****************************************************

	require 'config.php';

	$query = "CALL SP_ADD_SITE_USER('Brand','".filter_var($username,FILTER_SANITIZE_STRING)."','".filter_var($pass,FILTER_SANITIZE_STRING)."');";

	echo "$query";

	$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

	$row = mysqli_fetch_assoc($result);
	var_dump($row);

	if($row['col'] == "SUCCESS")
		echo "Stored SITE USER AS BRAND <BR>";
	else
		echo "ERROR <br>";

	mysqli_close($conn);

	$_SESSION['success_msg'] = "Thank you for registering to Shoeversity, ".$uname.".<br> Please wait for your account to be verified before you can log in.";

	$success_path = "../views/index.php?register=" . md5('success');
	header("Location: $success_path");
	//header("Location: ../views/index.php"); //Since brand isnt verifed yet, must be redirected BACK TO GUEST LANDING PAGE
	}else{// error storing data to database
		$error_msg .= "Inputs have errors. Please try again.";
		$_SESSION['error_msg'] = $error_msg;
		$error_path = "../views/register.php?register=" . md5('failed');
		header("Location: $error_path");
		xit();
	}
}//if same user/email as other account
}else{//if pass != cpass
		$error_msg .= "Your passwords do not match! Please try again.";
		$_SESSION['error_msg'] = $error_msg;
		$error_path = "../views/register.php?register=" . md5('failed');
		header("Location: $error_path");
		exit();
	}


//********************************************************
// SEND EMAIL TO NEW BRAND
//********************************************************
// require '../libs/PHPMailer/PHPMailerAutoload.php';

// $mail = new PHPMailer;

// // $mail->SMTPDebug = 4;                              // Enable verbose debug output

// $mail->isSMTP();                                      // Set mailer to use SMTP
// $mail->Host = 'smtp.gmail.com';  					  // Specify main SMTP servers
// $mail->SMTPAuth = true;                               // Enable SMTP authentication
// $mail->Username = 'shoeversityofficial@gmail.com';    // SMTP username
// $mail->Password = 'FlashByte';                        // SMTP password
// $mail->SMTPSecure = 'ssl';                            // Enable SSL encryption
// $mail->Port = 465;                                    // TCP port to connect to for SSL

// $mail->setFrom('shoeversityofficial@gmail.com', 'Shoeversity Official');
// $mail->addAddress($_POST['email']);               
// $mail->IsHTML(true);  
// $mail->AddEmbeddedImage('../images/logos/shoeversity-logo.jpg', 'logo_shoeversity');

// $mail->Subject = 'Welcome to Shoeversity!';
// $message = '
// <div style="position: fixed; top: 0px; height: auto; width: auto; padding: 7px 15px; background: #10263e; color: #fff">
// <h2>My Account: '.$_POST['uname'].'</h2>
// </div>
// <div style="height:auto; width: auto; padding: 80px 110px; background: #eee; color: #121212 !important; text-align: center;">

// <img src="cid:logo_shoeversity" style="border-radius: 50%">

// <h1 style="margin-top: 40px">Welcome to Shoeversity!</h1>

// <h3>Hi, '.$_POST['brandname'].'! Thank you for registering your brand with us.</h3>

// <p style="color: #121212 !important">You'."'".'re one step closer to posting your products for sale on our platform! Unfortunately, your brand registration hasn'."'".'t been verified with our <u>Site Administrators</u> yet. Don'."'".'t worry, though. We'."'".'ll send you an email once you can <a href="localhost/Shoeversity/views/login.php">sign in</a>. Cheers!</p>

// <br><hr><br>

// <div style="text-align: left !important; line-height: 5px">
// <p style="color:#777">Regards,</p>
// <i style="color:#777">The Shoeversity Team</i>
// </div>
// </div>
// ';

// $mail->Body = $message;

// if(!$mail->send()) {
// 	echo 'Message could not be sent.';
// 	echo 'Mailer Error: ' . $mail->ErrorInfo;
// } else {
// 	echo 'Message has been sent';
// }
}

?>