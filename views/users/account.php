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
        $_SESSION['active_page'] = "account";

        // CSRF Token
        if(!isset($_GET['token']) || $_GET['token'] != $_SESSION['sessionToken']) {
            include '../modals/restricted_access.php';
    
            echo "<script> 
                window.stop();
                $('#restricted_access').modal('show');
                $('#restricted_access').on('hidden.bs.modal', function () { //go back to prev page
                   window.history.back();
                })
                </script>";
        }

        // Check if user is authorized to access page
        include '../../database/check_access.php';

        $user_uname = $_SESSION['u_username'];
        $user_email = $_SESSION['u_email'];    
        $user_gender = $_SESSION['u_gender'];
        $user_fname = $_SESSION['u_firstname'];
        $user_lname = $_SESSION['u_lastname'];
        $user_mname = $_SESSION['u_middlename'];
    ?>
    
    <link rel="stylesheet" type="text/css" href="../../css/shopping-cart-sidebar.css">
</head>
<body>
	<!-- Include header -->
	<?php include "../../templates/users/user_header.php"; ?>
	
    <div class="content-wrapper ">
        <div class="container text-center">
                <div class="col-md-4">
                    <img class="img-circle" src="../IMAGES/USERS/dp.jpg" width="160px" alt="profilepic">
                    <br><br><br>
                    <label for="uname">Username: </label>
                    <br>
                    <label class="lead"><?php echo $user_uname; ?></label>
                    <br>
                    
                    <hr>
                    <label for="name">Name:</label>
                    <br>
                    <label class="lead"><?php echo $user_fname ." ". $user_mname ." ". $user_lname; ?></label>
                    <br>
                    
                    <hr>
                    <label for="email">Email:</label>
                    <br>
                    <label class="lead"><?php echo $user_email; ?></label>
                    <br>
                    
                    <hr>
                    <label for="gnder">Gender:</label>
                    <br>
                    <label class="lead"><?php echo $user_gender; ?></label>
                    <br>
                    
                    <hr>
                </div>
                <div class="col-md-8">
                    <h2>Recent Purchases</h2><hr>
                    
                </div>              
        </div>
	</div>

    <!-- BEGIN FOOTER -->
    <?php require "../../templates/users/user_footer.php"; ?>
    <!-- .END FOOTER -->
    
	<!-- Include Javascript files -->
    <!-- <script src="../../js/smooth-scroll.js"></script> -->
    <script src="../../js/shopping-cart.js"></script>
</body>
</html>