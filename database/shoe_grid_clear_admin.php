<?php

if(!isset($_SESSION)) {
	session_start();
	require 'activity_check.php';
}
$token = $_SESSION['sessionToken'];

// CLEAR FILTERS
$_SESSION['grid_sql'] = "SELECT * FROM shoes";

// CLEAR SEARCH
unset($_SESSION['grid_search_results']);

header("Location: ../views/admin/dashboard.php?token=$token");
exit();
?>