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

        // Check if user is authorized to access page
        include '../../database/check_access.php';
    ?>
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
                    
                    <hr>
                </div>
                <div class="col-md-8">
                    <h2>Recent Purchases</h2><hr>
                    
                </div>              
        </div>
	</div>

	<!-- Include Javascript files -->
</body>
</html>