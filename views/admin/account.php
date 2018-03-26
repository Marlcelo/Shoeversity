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

        // Check if user is authorized to access page
        include '../../database/check_access.php';
    ?>
</head>
<body>
	<!-- Include header -->
	<?php include "../../templates/admin/admin_header.php"; ?>
	
    <div class="content-wrapper ">
        <div class="container text-center">
                <div class="col-md-4">
                    <img class="img-circle" src="../IMAGES/USERS/dp.jpg" width="160px" alt="profilepic">
                    <br><br><br>
                    <label for="uname">Username: </label>
                    <br>
                    
                    <hr>
                    <label for="name">Name:
                    </label>
                    <br>
                    
                    <hr>
                    <label for="email">Email:</label>
                    <br>
                    
                    <hr>
                    <label for="gnder">Gender:</label>
                    <br>
                    
                    <hr><br>
                    <a href="register_admin.php"><button class="btn btn-md btn-info">Create an Admin Account</button></a><br><br>
                    <a href="delete_admin.php"><button class="btn btn-md btn-info">Delete an Admin Account</button></a><br><br>
                    <a href="delete_user.php"><button class="btn btn-md btn-info">Delete a User Account</button></a>
                </div>
                <div class="col-md-8">
                    <h2>List of Admins</h2><hr><br>

                    <br><br>
                    <h2>Recent Transactions</h2><hr><br>

                    <br><br>
                    <h2>Recent B</h2><hr><br>
        
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
