<?php 

if(isset($_POST['records']) && isset($_POST['sql'])) {
	$records_per_page = $_POST['records'];
	$sql = $_POST['sql'];
}
else {
	$records_per_page = 9; //default
	$sql = "SELECT * FROM shoes";
}

# Query for total number of records
require '../config.php';

// $sql = "SELECT * FROM shoes";

$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

mysqli_close($conn);

$total_records = mysqli_num_rows($result);
$num_pages = ceil($total_records/$records_per_page);

echo $num_pages;

?>