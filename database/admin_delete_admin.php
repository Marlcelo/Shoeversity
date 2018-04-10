<?php
	require 'activity_check.php';
	require 'config.php';
	$userId = $_GET['adId'];
	echo $userId;

	$sql = "CALL SP_DELETE_ADMIN(".$userId.");";

	$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));

	$row = mysqli_fetch_assoc($result);

	if($row['result'] == "SUCCESS"){
		echo "<script>
			window.alert('Admin# ".$userId." has been deleted!');
		</script>";
		header("Location: ../views/admin/delete_admin.php");
	}else{
		echo "<script>
			window.alert('Something went wrong!');
		</script>";
		header("Location: ../views/admin/delete_admin.php");
	}
?>