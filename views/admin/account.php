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
        $_SESSION['active_page'] = "account";

        // CSRF Token
        if(!isset($_GET['token']) || 
           !isset($_SESSION['sessionToken']) ||
           (isset($_SESSION['sessionToken']) && $_GET['token'] != $_SESSION['sessionToken'])) {
            include '../modals/restricted_access.php';
    
            echo "<script> 
                window.stop();
                $('#restricted_access').modal('show');
                $('#restricted_access').on('hidden.bs.modal', function () { //go back to prev page
                   window.history.back();
                })
                </script>";

            include '../../database/log_restricted.php';
        }

        // Check if user is authorized to access page
        include '../../database/check_access.php';          
        $admin_uname = $_SESSION['a_username'];     
        $admin_email = $_SESSION['a_email'];         
        $admin_gender = $_SESSION['a_gender'];       
        $admin_fname = $_SESSION['a_firstname'];   
        $admin_lname = $_SESSION['a_lastname'];     
        $admin_mname = $_SESSION['a_middlename'];   

        // Require reauthentication for viewing logs
        $_SESSION['authLog'] = 0;
    ?>
</head>
<body style="margin-left: 0px !important">
	<!-- Include header -->
	<?php include "../../templates/admin/admin_header.php"; ?>
	
    <div class="content-wrapper ">
        <div class="container text-center">
                <div class="col-md-12">
                    <img class="img-circle" src="../../images/logos/shoeversity-logo.jpg" width="160px" alt="profilepic">
                    <br><br><br>
                    <label for="uname">Username: </label>
                    <br>
                    <label class="lead"><?php echo $admin_uname; ?> </label>    
                    <br>
                    
                    <hr>
                    <label for="name">Name: </label>
                     <br>
                    <label class="lead"><?php echo $admin_fname . " " . $admin_mname . " " . $admin_lname   ; ?> </label>
                    <br>
                    
                    <hr>
                    <label for="email">Email:</label>
                     <br>
                    <label class="lead"><?php echo $admin_email; ?> </label>
                    <br>
                    
                    <hr>
                    <label for="gnder">Gender:</label>
                     <br>
                    <label class="lead"><?php echo $admin_gender; ?> </label>
                    <br>
                    
                    <hr>
                </div>
                 
        </div>
    </div>
	
	<!-- BEGIN FOOTER -->
    	<?php require "../../templates/admin/admin_footer.php"; ?>
    	<!-- .END FOOTER -->
	
	<!-- Include Javascript files -->
    <!-- <script src="../../js/smooth-scroll.js"></script> -->
</body>
</html>
