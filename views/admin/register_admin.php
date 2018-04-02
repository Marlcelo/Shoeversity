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

        if(isset($_GET['register'])) {
            // Call popup modal
            if($_GET['register'] == md5('failed')) {
                include '../modals/error.php';

                echo "<script> 
                        $('#error_modal').modal('show');
                        $('#error_modal').on('hidden.bs.modal', function () { 
                            window.location = 'register_admin.php';
                        })
                    </script>";
            }

            if($_GET['register'] == md5('success')){
                include '../modals/success.php';

                echo "<script> 
                        $('#success_modal').modal('show');
                        $('#success_modal').on('hidden.bs.modal', function () { 
                            window.location = 'register_admin.php';
                        })
                    </script>";
            }
        }

        // Set active page
        $_SESSION['page_type'] = "Admin";
        $_SESSION['active_page'] = "account";

        // Check if user is authorized to access page
        include '../../database/check_access.php';
    ?>
    <link rel="stylesheet" type="text/css" href="../../css/passwordchecker.css">
    <script src="../../js/passwordcheck.js"></script><!-- Include Your jQUery file here-->
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
                    <h1>Create an admin account</h1> 
                    <div class="content">
                                
                                <form class="form-horizontal" name="register_user" id="register" action="../../database/admin_register.php" method="POST">
                                    <div class="input-group">
                                             <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                           <input type="text" class="form-control" name="uname" placeholder="Username" required>
                                    </div><br>
                                   <div class="input-group">
                                           <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                           <input type="password" class="form-control" name="pword" id="password" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>                    
                                   </div><span id="result"></span><br>
                                   <div class="input-group">
                                           <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                           <input type="password" class="form-control" name="confirmpword" placeholder="Confirm Password" required>
                                   </div><br>
                                   <div class="input-group">
                                           <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></i></span>
                                           <input type="text" class="form-control" name="email" placeholder="Email" required>
                                    </div><br>
                                   <div class="input-group">
                                           <span class="input-group-addon">First name</span>
                                           <input type="text" class="form-control" name="fname" placeholder="Mary Jane" required>
                                    </div><br>
                                    <div class="input-group">
                                             <span class="input-group-addon">Middle name</span>
                                             <input type="text" class="form-control" name="mname" placeholder="Terrence" required>
                                    </div><br>
                                     <div class="input-group">
                                              <span class="input-group-addon">Last name</span>
                                              <input type="text" class="form-control" name="lname" placeholder="Doe" required>
                                    </div><br>
                                    <div class="radio">
                                            <label><input type="radio" name="gender" value="m" checked>Male</label>
                                            <label><input type="radio" name="gender" value="f">Female</label>
                                    </div><br>

                                    <div class="form-group">
                                            <div class="col-sm-12 controls">
                                                    <input type="submit" value="Register Admin" name="registerAdmin" class="btn btn-primary pull-right btn-block"/>
                                            </div>
                                    </div>
                                </form>
                              
                            </div>
        
                </div>              
        </div>
    </div>

	<!-- Include Javascript files -->
    <!-- <script src="../../js/smooth-scroll.js"></script> -->
</body>
</html>
