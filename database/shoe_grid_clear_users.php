<?php

if(!isset($_SESSION)) {
	session_start();
	require 'activity_check.php';
}

// CLEAR FILTERS
$_SESSION['grid_sql'] = "SELECT * FROM shoes";

// CLEAR SEARCH
unset($_SESSION['grid_search_results']);

header("Location: ../views/users/products.php");
exit();
?>