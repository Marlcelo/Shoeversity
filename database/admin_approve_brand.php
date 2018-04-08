<?php
	require 'config.php';
	$brandId = $_GET['bId'];
	echo $brandId;

	$sql = "CALL SP_APPROVE_BRAND(".$brandId.");";

	$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));

	$row = mysqli_fetch_assoc($result);

	if($row['result'] == "SUCCESS"){
		echo "<script>
			window.alert('Brand# ".$brandId." has been approved!');
		</script>";
		header("Location: ../views/admin/approve_brand.php");
	}else{
		echo "<script>
			window.alert('Something went wrong!');
		</script>";
		header("Location: ../views/admin/approve_brand.php");
	}
?>