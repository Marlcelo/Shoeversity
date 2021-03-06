<?php

if(!isset($_SESSION)) {
	session_start();
	require 'activity_check.php';
}

# GET INPUT FROM SEARCH BAR
$search = $_POST['search-product'];
$search = trim($search);
$search = filter_var($search,FILTER_SANITIZE_STRING);

$search_msg = "<strong>Showing search results for: &nbsp; ".'"'."<span class='text-primary' style='text-decoration: underline'>$search</span>".'"'."</strong>";
$sql = "SELECT * FROM shoes WHERE name LIKE '%" . $search . "%'";

# RETURN SQL STATEMENT
$_SESSION['grid_sql'] = $sql;
$_SESSION['grid_search_results'] = $search_msg;
$_SESSION['grid_applied_filters'] = '';

# Redirect back to display.php to display filtered results
header("Location: ../views/users/products.php?token=".$_SESSION['sessionToken']);
exit();

?>