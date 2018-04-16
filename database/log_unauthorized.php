<?php

require 'config.php';

$query = "CALL SP_ADD_LOG('Unknown user','Failed login attempt')";
$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

mysqli_close($conn);

?>