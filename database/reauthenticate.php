<?php

if(!isset($_SESSION))
	session_start();

$token = $_SESSION['sessionToken'];

$authAdmin = $_SESSION['a_username'];
$authPass  = $_POST['password'];

require 'config.php';
$sql = "CALL SP_GET_AUTHUSER('$authAdmin', FN_GET_HASHEDPASSWORD('$authPass'));";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if($row['strreturn'] == 'SUCCESS') {
	$_SESSION['authLog'] = 1;
	header("Location: ../views/admin/view_audit_logs.php?token=$token");
	exit();
}
else {
	$_SESSION['authLog'] = 0;
	$_SESSION['authLogPassFail'] = 1;
	header("Location: ../views/admin/view_audit_logs.php?token=$token");
	exit();
}

?>