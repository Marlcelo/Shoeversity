<?php
	if(!isset($_SESSION)) {
		session_start();
	}
	$token = $_SESSION['sessionToken'];

	require 'activity_check.php';
	require 'config.php';
	$userId = $_GET['adId'];
	echo $userId;

	$sql = "CALL SP_DELETE_ADMIN(".$userId.");";

	$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));

	$row = mysqli_fetch_assoc($result);

	if($row['result'] == "SUCCESS"){
		$_SESSION['success_msg'] = "Admin account successfully deleted.";

		require 'config.php';

		$query = "CALL SP_ADD_LOG(".$_SESSION['a_username'].",'Deleted Admin ".$userId."')";
		$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

		mysqli_close($conn);

		header("Location: ../views/admin/delete_admin.php?delete=".md5('success')."&token=$token");
		exit();
	}else{
		$_SESSION['error_msg'] = "Oops! Something went wrong, this Admin account was not deleted.";
		header("Location: ../views/admin/delete_admin.php?delete=".md5('failed')."&token=$token");
		exit();
	}
?>