<?php

require 'config.php';
session_start();
/* Note that checking for empty field input is done on the Client side (Login Form) */


if(isset($_SESSION['username']) && isset($_SESSION['password'])){// if a new user registers, will automatically log in
	$username = $_SESSION['username'];
	$password = $_SESSION['password'];

	if (strlen($password) < 8 || 
		strlen($username) < 8 ||  
		(!preg_match("#[0-9]+#", $username) ||  
			!preg_match("#[a-zA-Z]+#", $username) || 
			!preg_match("#[0-9]+#", $password) || 
			!preg_match("#[a-zA-Z]+#", $password) || 
			!preg_match("#\W+#", $password))) {

        //header("Location: ../views/login.php?auth=error");
        exit();
    }
	echo "Here at Session";

	$username = trim($username);
	$password = trim($password);

	$username = filter_var($username, FILTER_SANITIZE_STRING);
	$password = filter_var($password, FILTER_SANITIZE_STRING);
	echo $username ." ". $password;
}else{
	/* Store user input from login.php */
	$username = $_POST['username'];
	$password = $_POST['password'];

	if (strlen($password) < 8 || 
		strlen($username) < 8 ||  
		(!preg_match("#[0-9]+#", $username) ||  
			!preg_match("#[a-zA-Z]+#", $username) || 
			!preg_match("#[0-9]+#", $password) || 
			!preg_match("#[a-zA-Z]+#", $password) || 
			!preg_match("#\W+#", $password))) {

		require 'config.php';

		$query = "CALL SP_ADD_LOG('".$username."','Failed Login Attempt')";
		$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

		mysqli_close($conn);

        header("Location: ../views/login.php?auth=error");
        exit();
    }

	$username = trim($username);
	$password = trim($password);

	$username = filter_var($username, FILTER_SANITIZE_STRING);
	$password = filter_var($password, FILTER_SANITIZE_STRING);
}
$username = strtolower($username); //converts string to lowerase
/* Issue query on database */
$sql = "CALL SP_GET_AUTHUSER('$username', 
							  FN_GET_HASHEDPASSWORD('$password'));";	/* Check hashed password */

$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

/* Stores a String indicating if the user exists in the database or not */
$message = mysqli_fetch_assoc($result);

/* Check if user, brand, or admin already exists in database */
if($message['strreturn'] == 'SUCCESS') {
	session_destroy();
	require 'config.php';

		$query = "CALL SP_ADD_LOG('".$username."','Successfully Logged In')";
		$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

		mysqli_close($conn);
	header("Location: user_save_session.php?user=$username");
	require 'activity_check.php';
	exit();
}
else if($message['strreturn'] == 'FAILED') {
	// Redirect back to the login page and display the error modal
	if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
        // last request was more than 30 minutes ago
        session_unset();     // unset $_SESSION variable for the run-time 
        session_destroy();   // destroy session data in storage
    }
    
	if(isset($_SESSION['attempt'])){
		$_SESSION['attempt']++;
	}else{
		$_SESSION['attempt'] = 1;
	}


	if($_SESSION['attempt'] == 5){
		$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
	}

	require 'config.php';

	$query = "CALL SP_ADD_LOG('".$username."','Failed Login Attempt')";
	$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

	mysqli_close($conn);

	header("Location: ../views/login.php?auth=error");
	exit();
}

?>
