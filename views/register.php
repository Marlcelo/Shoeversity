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
        $_SESSION['active_page'] = "register";
    ?>
</head>
<body>
    <!-- BEGIN HEADER -->
    <?php require "../templates/public_header.php"; ?>
    <!-- .END HEADER -->

    <!-- BEGIN MAIN CONTENT -->
    <div class="container content-wrapper">
        <div class="col-md-12">
            <div class="col-md-2">  
            </div>

            <div class="col-md-8">
                <!-- Login Form Container -->
                <div class="panel panel-default panel-register">

                    <div class="text-center" style="margin-bottom: 10px solid black"> 
                        <img src="../images/logos/shoeversity-logo.jpg" height="200px" class="img-circle" alt="Shoeversity">
                        <h1 style="margin-top: 0px">Register</h1>
                    </div>

                    <hr>

                    <!-- Register Form -->
                    <div class="content">
                
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
</body>
</html>