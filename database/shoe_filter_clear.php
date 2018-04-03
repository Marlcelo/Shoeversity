<?php

if(!isset($_SESSION)) {
	session_start();
}

// CLEAR FILTERS
$_SESSION['grid_sql'] = "SELECT * FROM shoes";

header("Location: ../views/index.php#products");
exit();
?>