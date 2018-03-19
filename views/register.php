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
        $_SESSION['active_page'] = "register";

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
    ?>
    <script type="text/javascript" src="../js/jquery-fxns.js"></script>
</head>
<body>
    <!-- BEGIN HEADER -->
    <?php require "../templates/public_header.php"; ?>
    <!-- .END HEADER -->

    <!-- BEGIN MAIN CONTENT -->
    <div class="container content-wrapper" style="margin-top: 50px">
        <div class="col-md-12">
            <div class="col-md-2">  
            </div>

            <div class="col-md-8">
                <!-- Login Form Container -->
                <div class="panel panel-default panel-register" style="padding-top: 10px">

                    <div class="text-center" style="margin-bottom: 10px solid black"> 
                        <img src="../images/logos/shoeversity-logo.jpg" height="200px" class="img-circle" alt="Shoeversity">
                        <h1 style="margin-top: 0px">Register</h1>
                    </div>

                    <hr>

                    <!-- Register Form -->
                    <div style="padding: 7px;">
                
                        <ul class="nav nav-tabs nav-justified" data-tabs="tabs">
                            <li class="active"> <a data-toggle="tab" href="#user_reg">Customer</a> </li>
                            <li> <a data-toggle="tab" href="#brand_reg">Brand</a> </li>
                        </ul>
                        <br>
                        <div class="tab-content">
                            <div class="tab-pane active" id="user_reg">
                                <?php include 'register_user.php'; ?>
                            </div>
                            <div  class="tab-pane" id="brand_reg">
                                <?php include 'register_brand.php'; ?>
                            </div>
                        </div>
                            
                    </div>

                    <!-- Login Link -->
                    <div class="row">
                        <div class="col-md-12 text-center">
                            Already have an account?
                            <a href="../views/login.php">Sign in</a>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-md-2">  
            </div>
        </div>
    </div>
     <!-- .END MAIN CONTENT -->

    <!-- BEGIN FOOTER -->
    <?php require "../templates/public_footer.php"; ?>
    <!-- .END FOOTER -->
    
    <!-- Include Javascript files -->
    <script src="../js/smooth-scroll.js"></script>
</body>
</html>