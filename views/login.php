<!DOCTYPE html>
<html lang="en">
<head>
    <title>Shoeversity</title>

    <?php
        // Include Bootstrap and main styles 
        include "../templates/public_bs_styles.php";
        include "../templates/public_shoeversity_styles.php";

        session_start();
        // Set active page
        $_SESSION['page_type'] = "Public";
        $_SESSION['active_page'] = "login";

        // Check if a user is already logged in. If yes, redirect to their dashboard.
        if(isset($_SESSION['a_username'])) {
            header("Location: admin/dashboard.php");
            exit();
        } else if(isset($_SESSION['b_username'])) {
            header("Location: brands/products.php");
            exit();
        } else if(isset($_SESSION['u_username'])) {
            header("Location: users/products.php");
            exit();
        }

        if(isset($_GET['auth'])) {
            // Wrong username or password
            if($_GET['auth'] == "error") {
                include "modals/failed_login.php";

                echo "<script> 
                        $('#failed_login_modal').modal('show');
                        $('#failed_login_modal').on('hidden.bs.modal', function () {    //reload login form
                            window.location = 'login.php';
                        })
                    </script>";
            }

            // Unverified Brand login attempt
            if($_GET['auth'] == "unverified") {
                include "modals/error.php";

                echo "<script> 
                        $('#error_modal').modal('show');
                        $('#error_modal').on('hidden.bs.modal', function () {    //reload login form
                            window.location = 'login.php';
                        })
                    </script>";

                $_SESSION['error_msg'] = "";    // reset
            }
        }
    ?>
</head>
<body>
    <!-- BEGIN HEADER -->
    <?php require "../templates/public_header.php"; ?>
    <!-- .END HEADER -->

    <!-- BEGIN MAIN CONTENT -->
    <div class="container content-wrapper" style="margin-top: 50px">
        <div class="col-md-12">
            <div class="col-md-3">  
            </div>

            <div class="col-md-6">
                <!-- Login Form Container --> 
                <div class="panel panel-default panel-login" style="padding-top: 10px">

                    <div class="text-center" style="margin-bottom: 10px solid black"> 
                        <img src="../images/logos/shoeversity-logo.jpg" height="200px" class="img-circle" alt="Shoeversity">
                        <h1 style="margin-top: 0px">Login</h1>
                    </div>

                    <hr>

                    <!-- Login Form -->
                    <div class="panel-body">
                        <form action='../database/user_authenticate.php' method='post'>
                            <!-- Username -->
                            <div class="input-group" style="margin-bottom: 16px">
                                <!-- <span class="input-group-addon"><img src="../../images/icons/ic_person_black_24dp.png" style="height: 20px"></span> -->
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input type='text' name='username' class='form-control' placeholder="Username" required>
                            </div>

                            <!-- Password -->
                            <div class="input-group" style="margin-bottom: 16px">
                                <!-- <span class="input-group-addon"><img src="../../images/icons/ic_lock_black_24dp.png" style="height: 20px"></span> -->
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input type='password' name='password' class='form-control' placeholder="Password" required>
                            </div>

                            <div class="input-group pull-right" style="margin-bottom: 24px">
                                <div class="">
                                    <a href="" class="link">Forgot your password?</a>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary" style="padding: 7px; width: 100%">
                                <img src="../images/icons/login.png" alt="" style="width: 24px;">
                                <strong>Login</strong>
                            </button>
                        </form>
                    </div>

                    <!-- Register Link -->
                    <div class="row">
                        <div class="col-md-12 text-center">
                            Don't have an account yet?
                            <a href="../views/register.php">Register here</a>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-md-3">  
            </div>
        </div>
    </div>
     <!-- .END MAIN CONTENT -->

    <!-- BEGIN FOOTER -->
    <?php require "../templates/public_footer.php"; ?>
    <!-- .END FOOTER -->
    
    <!-- Include Javascript files -->
</body>
</html>