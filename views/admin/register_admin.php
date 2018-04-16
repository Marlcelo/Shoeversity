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
        else {
            $token = $_SESSION['sessionToken'];
        }

        if(isset($_GET['register'])) {
            // Call popup modal
            if($_GET['register'] == md5('failed')) {
                include '../modals/error.php';

                echo "<script> 
                        $('#error_modal').modal('show');
                        $('#error_modal').on('hidden.bs.modal', function () { 
                            window.location = 'register_admin.php?token=$token';
                        })
                    </script>";
            }

            if($_GET['register'] == md5('success')){
                include '../modals/success.php';

                echo "<script> 
                        $('#success_modal').modal('show');
                        $('#success_modal').on('hidden.bs.modal', function () { 
                            window.location = 'register_admin.php?token=$token';
                        })
                    </script>";
            }
        }

        // Set active page
        $_SESSION['page_type'] = "Admin";
        $_SESSION['active_page'] = "dashboard";
        $_SESSION['admin_fxn'] = "create_admin";


        // Check if user is authorized to access page
        include '../../database/check_access.php';
    ?>
    <link rel="stylesheet" type="text/css" href="../../css/passwordchecker.css">
    <script src="../../js/passwordcheck.js"></script><!-- Include Your jQUery file here-->
</head>
<body>
	<!-- Include header -->
	<?php include "../../templates/admin/admin_header.php"; ?>

	<!-- Include sidebar -->
    <?php include "../../templates/admin/admin_sidebar.php"; ?>
    
        <div class="container text-center main">
                <div class="col-md" style="min-height: 350px;">
                    <h1>Create an Admin Account</h1> 
                    <div class="content">
                                
                                <form class="form-horizontal" name="register_user" id="register" action="../../database/admin_register.php" method="POST">
                                    <div class="input-group">
                                             <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                           <input type="text" class="form-control" name="uname" placeholder="Username" pattern="[A-Za-z0-9].{8,}" title="Must be atleast 8 characters or more" required>
                                    </div><br>
                                   <div class="input-group">
                                           <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                           <input type="password" class="form-control" name="pword" id="password" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!,%,&,@,#,$,^,*,?,_,~,.]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, a special character, and at least 8 or more characters" required>                    
                                   </div><span id="result"></span><br>
                                   <div class="input-group">
                                           <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                           <input type="password" class="form-control" name="confirmpword" placeholder="Confirm Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!,%,&,@,#,$,^,*,?,_,~,.]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                                   </div><br>
                                   <div class="input-group">
                                           <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></i></span>
                                           <input type="email" class="form-control" name="email" placeholder="Email" required>
                                    </div><br>
                                   <div class="input-group">
                                           <span class="input-group-addon">First name</span>
                                           <input type="text" class="form-control" name="fname" placeholder="Mary Jane"  pattern="(?=.*[a-z])(?=.*[A-Z]){1,35}" title="Must not have any special characters or numbers" maxlength="35" required>
                                    </div><br>
                                    <div class="input-group">
                                             <span class="input-group-addon">Middle name</span>
                                             <input type="text" class="form-control" name="mname" placeholder="Terrence"  pattern="(?=.*[a-z])(?=.*[A-Z]){1,35}" title="Must not have any special characters or numbers" maxlength="35" required>
                                    </div><br>
                                     <div class="input-group">
                                              <span class="input-group-addon">Last name</span>
                                              <input type="text" class="form-control" name="lname" placeholder="Doe"  pattern="(?=.*[a-z])(?=.*[A-Z]){1,35}" title="Must not have any special characters or numbers" maxlength="35" required>
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
   

    <?php require "../../templates/admin/admin_footer.php"; ?>
	<!-- Include Javascript files -->
    <!-- <script src="../../js/smooth-scroll.js"></script> -->
</body>
</html>
