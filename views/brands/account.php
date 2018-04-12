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
        }
        else {
            $token = $_SESSION['sessionToken'];
        }

        // Check if user is authorized to access page
        include '../../database/check_access.php';
         
        $brand_uname = $_SESSION['b_username'];
        $brand_name = $_SESSION['b_name'];    
        $brand_email = $_SESSION['b_email'];  
    ?>
</head>
<body>
	<!-- Include header -->
	<?php include "../../templates/brands/brand_header.php"; ?>
	
    <div class="content-wrapper ">
        <div class="container text-center">
                <div class="col-md-12">
                    <img class="img-circle" src="../../images/logos/shoeversity-logo.jpg" width="160px" alt="profilepic">
                    <br><br><br>
                    <label for="uname">Username: </label>
                    <br>
                    <label class="lead"><?php echo $brand_uname;  ?></label>
                    <br>
                    
                    <hr>
                    <label for="name">Name:</label>
                    <br>
                    <label class="lead"><?php echo $brand_name;  ?></label>
                    <br>
                    
                    <hr>
                    <label for="email">Email:</label>
                    <br>
                    <label class="lead"><?php echo $brand_email ?></label>
                    <br>    
                    <hr>
                </div>
                <!-- <div class="col-md-8">
                    <h2>Your shoes for sale</h2><hr><br>

                    <br><br>
                    <h2>Recent Transactions</h2><hr><br>

                    <br><br>
                    <h2>Recent Buyers</h2><hr><br>
        
                </div>             -->  
        </div>
	</div>

    <!-- BEGIN FOOTER -->
        <?php require "../../templates/brands/brand_footer.php"; ?>
    <!-- .END FOOTER -->
    
	<!-- Include Javascript files -->
    <!-- <script src="../../js/smooth-scroll.js"></script> -->
</body>
</html>