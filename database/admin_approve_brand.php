<?php
	require 'config.php';
	$brandId = $_GET['uId'];
	echo $brandId;

	$sql = "CALL SP_GET_ALL_BRANDSUV(".$brandId.");";

	$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));

	$row = mysqli_fetch_assoc($result);

	if($row['result'] == "SUCCESS"){
		echo "<script>
			window.alert('Brand# ".$brandId." has been deleted!');
		</script>";
		header("Location: ../views/admin/approve_brand.php");
	}else{
		echo "<script>
			window.alert('Something went wrong!');
		</script>";
		header("Location: ../views/admin/approve_brand.php");
	}
?>