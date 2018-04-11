<?php
	if(!isset($_SESSION)) {
		session_start();
	}
	$token = $_SESSION['sessionToken'];

	require 'activity_check.php';
	require 'config.php';
	$brandId = $_GET['bId'];
	echo $brandId;

	$sql = "CALL SP_DELETE_BRAND(".$brandId.");";

	$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));

	$row = mysqli_fetch_assoc($result);

	if($row['result'] == "SUCCESS"){
		$_SESSION['success_msg'] = "This brand account was successfully deleted.";
		header("Location: ../views/admin/delete_brand.php?delete=".md5('success')."&token=$token");
		exit();
	}else{
		$_SESSION['error_msg'] = "Oops! Something went wrong, this brand account was not deleted.";
		header("Location: ../views/admin/delete_brand.php?delete=".md5('failed')."&token=$token");
		exit();
	}
?>