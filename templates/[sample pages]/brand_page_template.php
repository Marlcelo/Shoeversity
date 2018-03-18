<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shoeversity</title>

    <?php
        // Include Bootstrap and main styles 
        include "../../templates/brands/brand_bs_styles.php";
        include "../../templates/brands/brand_shoeversity_styles.php";

        session_start();
        // Set active page
        $_SESSION['page_type'] = "Brand";
        $_SESSION['active_page'] = "";
    ?>
</head>
<body>
	<!-- Include header -->
	<?php include "../../templates/brands/brand_header.php"; ?>
	
    <div class="content-wrapper ">
	</div>

	<!-- Include Javascript files -->
</body>
</html>