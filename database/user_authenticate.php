<?php

require 'config.php';

/* Note that checking for empty field input is done on the Client side (Login Form) */

/* Store user input */
$username = $_POST['username'];
$password = $_POST['password'];

/* Issue query on database */
$sql = "CALL SP_GET_AUTHUSER('$username', 
							  FN_GET_HASHEDPASSWORD('$password'));";	/* Check hashed password */

$result = mysqli_query($conn, $sql) or die(mysql_error());

/* Stores a String indicating if the user exists in the database or not */
$message = mysqli_fetch_assoc($result);

/* Check if Admin or Bus Marshal already exists in database */
if($message['strreturn'] == 'SUCCESS') {
	header("Location: user_save_session.php?user=$username");
	exit();
}
else if($message['strreturn'] == 'FAILED') {
	// Redirect back to the login page and display the error modal
	header("Location: ../views/login.php?auth=error");
	exit();
}

?>
