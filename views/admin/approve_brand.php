<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shoeversity</title>

    <?php
        // Include Bootstrap and main styles 
        include "../../templates/admin/admin_bs_styles.php";
        include "../../templates/admin/admin_shoeversity_styles.php";

        session_start();

        // Set active page
        $_SESSION['page_type'] = "Admin";
        $_SESSION['active_page'] = "dashboard";
        $_SESSION['admin_fxn'] = "approve_brand";


        // Check if user is authorized to access page
        include '../../database/check_access.php';
        require '../../database/get_brands.php';
    ?>
    
        <script type="text/javascript">
      $(document).ready(function() {
        $('#users').DataTable();
      } );
    </script>
</head>
<body>
	<!-- Include header -->
	<?php include "../../templates/admin/admin_header.php"; ?>

	<!-- Include sidebar -->
    <?php include "../../templates/admin/admin_sidebar.php"; ?>
    
        <div class="container text-center main">
            <div class="col-md">
                
    
            </div>              
        </div>
   

    <?php require "../../templates/admin/admin_footer.php"; ?>
	<!-- Include Javascript files -->
    <!-- <script src="../../js/smooth-scroll.js"></script> -->
</body>
</html>
