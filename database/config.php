<?php

$DB_HOST     = "localhost";
$DB_USERNAME = "root";
$DB_PASSWORD = "";
$DB_NAME     = "shoeversity";

/* Connect to MySQL Database */
$conn = mysqli_connect($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME); 

/* Set MySQL DB Character set to UTF-8 */
mysqli_set_charset($conn,"utf8");

?>