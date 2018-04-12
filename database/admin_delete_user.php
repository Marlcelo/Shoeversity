<?php
	if(!isset($_SESSION)) {
		session_start();
	}
	$token = $_SESSION['sessionToken'];

	require 'activity_check.php';
	require 'config.php';
	$userId = $_GET['uId'];
	echo $userId;

	$sql = "CALL SP_DELETE_USER(".$userId.");";
	echo $sql;
	$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));

	$row = mysqli_fetch_assoc($result);

	if($row['result'] == "SUCCESS"){
		$_SESSION['success_msg'] = "User #$userId has been deleted!";

		require 'config.php';

		$query = "CALL SP_ADD_LOG(".$_SESSION['a_username'].",'Deleted User ".$userId."')";
		$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

		mysqli_close($conn);

		header("Location: ../views/admin/delete_user.php?delete=".md5('success')."&token=$token");
		exit();
	}else{
		$_SESSION['error_msg'] = "Oops! Something went wrong, this user account was not deleted.";
		header("Location: ../views/admin/delete_user.php?delete=".md5('failed')."&token=$token");
		exit();
	}
?>