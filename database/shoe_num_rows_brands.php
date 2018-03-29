<?php 

if(!isset($_SESSION)) {
	session_start();
}
$brandID = $_SESSION['b_id'];

if(isset($_POST['records'])) 
	$records_per_page = $_POST['records'];
else 
	$records_per_page = 9; //default

# Query for total number of records
require 'config.php';

$sql = "SELECT * FROM shoes WHERE posted_by = " . $brandID;

$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

mysqli_close($conn);

$total_records = mysqli_num_rows($result);
$num_pages = ceil($total_records/$records_per_page);

echo $num_pages;

?>