<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shoeversity</title>

    <?php
        // Include Bootstrap and main styles 
        include "../../templates/users/user_bs_styles.php";
        include "../../templates/users/user_shoeversity_styles.php";

        session_start();
        // Set active page
        $_SESSION['active_page'] = "account";
    ?>
</head>
<body>
	<!-- Include header -->
	<?php include "../../templates/users/user_header.php"; ?>
	
    <div class="content-wrapper ">
        ACCOUNT
	</div>

	<!-- Include Javascript files -->
</body>
</html>