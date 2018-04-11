<?php
	require 'activity_check.php';
	require 'config.php';
	$brandId = $_GET['bId'];
	echo $brandId;

	$sql = "CALL SP_DELETE_BRAND(".$brandId.");";

	$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));

	$row = mysqli_fetch_assoc($result);

	if($row['result'] == "SUCCESS"){
		echo "<script>
			window.alert('Brand# ".$userId." has been deleted!');
		</script>";
		header("Location: ../views/admin/delete_brand.php");
	}else{
		echo "<script>
			window.alert('Something went wrong!');
		</script>";
		header("Location: ../views/admin/delete_brand.php");
	}
?>