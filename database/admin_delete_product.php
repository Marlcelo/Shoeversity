<?php
session_start();
$token = $_SESSION['sessionToken'];
require 'activity_check.php';
$pid = $_GET['id'];

require 'config.php';
$sql = "CALL SP_GET_SHOE($pid);";
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
$row = mysqli_fetch_assoc($result);

$shoe_name = $row['name'];

mysqli_close($conn);

/**** DELETE SHOE ****/

require 'config.php';
$sql = "CALL SP_DEL_SHOE($pid);";
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
$row = mysqli_fetch_assoc($result);
mysqli_close($conn);

$message = $row['strreturn'];

if(!isset($_SESSION)) 
	session_start();

if($message == 'SUCCESS') {
	$_SESSION['success_msg'] = "The shoe '" . $shoe_name . "' was successfully deleted.";

	require 'config.php';

		$query = "CALL SP_ADD_LOG('".$_SESSION['a_username']."','Deleted Product ".$pid."')";
		$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

		mysqli_close($conn);

	header("Location: ../views/admin/dashboard.php?delete=success&token=$token");
	exit();
}
else if($message == 'FAILED') {
	$_SESSION['error_msg'] = "Uh oh! an error occurred.";
	header("Location: ../views/admin/dashboard.php?delete=error&token=$token");
	exit();
}

?>