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
        $_SESSION['page_type'] = "User";
        $_SESSION['active_page'] = "";
    ?>
</head>
<body>
	<!-- Include header -->
	<?php include "../../templates/users/user_header.php"; ?>
	
    <div class="content-wrapper ">
	</div>

	<!-- Include Javascript files -->
    <script src="../../js/smooth-scroll.js"></script>
</body>
</html>