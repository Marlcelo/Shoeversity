<?php
	require 'config.php';
	$userId = $_GET['uId'];
	echo $userId;

	$sql = "CALL SP_DELETE_USER(".$userId.");";
	echo $sql;
	$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));

	$row = mysqli_fetch_assoc($result);

	if($row['result'] == "SUCCESS"){
		echo "<script>
			window.alert('User# ".$userId." has been deleted!');
		</script>";
		header("Location: ../views/admin/delete_user.php");
	}else{
		echo "<script>
			window.alert('Something went wrong!');
		</script>";
		header("Location: ../views/admin/delete_user.php");
	}
?>