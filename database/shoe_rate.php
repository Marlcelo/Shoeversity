<?php

require 'config.php';

if(!isset($_SESSION)){
	session_start();
	require 'activity_check.php';
}

// get values from AJAX call
if(isset($_POST['rating']))
	$rating = $_POST['rating'];
else
	$rating = 0;

$shoeID = $_SESSION['pid'];
$userID = $_SESSION['u_id'];

$sql = "CALL SP_ADD_RATING($shoeID, $userID, $rating)";

$result = mysqli_query($conn, $sql);

// set modal success message
$_SESSION['success_msg'] = "Your rating has been saved.";

echo $_SESSION['success_msg'];

?>