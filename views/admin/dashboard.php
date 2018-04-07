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
        $_SESSION['active_page'] = "dashboard";

        $highlight = $_SESSION['active_admin_fxn'];

        // Check if user is authorized to access page
        include '../../database/check_access.php';
    ?>

    <style>
        body {
            font-family: "Lato", sans-serif;
        }

        .sidenav {
            height: 100%;
            position: absolute;
            width: 207px;
            z-index: auto;
            top: 0;
            left: 0;
            background-color: #1e1e1e;
            overflow-x: hidden;
            padding-top: 60px;
            font-size: 20px;
            color: #818181;
        }

        .sidenav h3{
            padding-left: 10px;
            padding-top: 15px;
        }

        .main {
            margin-left: 207px; /* Same as the width of the sidenav */
        }

        @media screen and (max-height: 450px) {
          .sidenav {padding-top: 15px;}
          .sidenav a {font-size: 15px;}
        }
    </style>
</head>
<body>
    <!-- Include header -->
    <?php include "../../templates/admin/admin_header.php"; ?>
    <nav class=" navbar-inverse">
        <div class="sidenav">
            <ul class="nav nav-pills nav-stacked">
                <li <?php if($highlight == 'dashboard') echo "class='active'"; ?>><a href="dashboard.php"><i class="glyphicon glyphicon-home"></i>   Home</a></li>
                <h3>Management</h3>
                    <li <?php if($highlight == 'approve_brand') echo "class=''"; ?>><a href="approve_brand.php"><i class="glyphicon glyphicon-ok"></i>  Approve a Brand</a></li>
                    <li <?php if($highlight == 'view_logs') echo "class='active'"; ?>><a href="view_audit_logs.php"><i class="glyphicon glyphicon-folder-open"></i>   View Audit Logs</a></li>
                <h3>Users</h3>
                    <li <?php if($highlight == 'create_admin') echo "class='active'"; ?>><a href="register_admin.php"><i class="glyphicon glyphicon-plus"></i>  Create an Admin</a></li>
                    <li <?php if($highlight == 'delete_admin') echo "class='active'"; ?>><a href="delete_admin.php"><i class="glyphicon glyphicon-minus"></i>  Delete an Admin</a></li>
                    <li <?php if($highlight == 'delete_user') echo "class='active'"; ?>><a href="delete_user.php"><i class="glyphicon glyphicon-minus"></i>  Delete a User</a></li>
            </ul>   
        </div>
    </nav>
    <!-- BEGIN MAIN CONTENT -->
    
        <div class="container main" style="margin-top: 10vh;">
                <!-- BEGIN PRODUCTS GRID -->
                <div class="col-md-12">

                    <div class="col-sm-4">
                        <span class="thumbnail">
                            <img src="" alt="...">
                            <h4></h4>
                            <div class="ratings">
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star-empty"></span>
                            </div>
                                    <p><label class="lead">SHOE NAME</label></p>
                                    <p>A very nice shoe.</p>
                                    <p><b>COLOR:</b></p>
                                    <p><b>SIZE:</b></p>
                            <hr class="line">
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <p class="price">Php. 3,500</p>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <a href="admin_view_product.php"><button class="btn btn-md btn-info pull-right" >VIEW PRODUCT</button></a>
                               </div>
                                
                            </div>
                        </span>
                    </div>

                    <div class="col-sm-4">
                        <span class="thumbnail">
                            <img src="" alt="...">
                            <h4></h4>
                            <div class="ratings">
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star-empty"></span>
                            </div>
                                    <p><label class="lead">SHOE NAME</label></p>
                                    <p>A very nice shoe.</p>
                                    <p><b>COLOR:</b></p>
                                    <p><b>SIZE:</b></p>
                            <hr class="line">
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <p class="price">Php. 3,500</p>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <a href="admin_view_product.php"><button class="btn btn-md btn-info pull-right" >VIEW PRODUCT</button></a>
                               </div>
                                
                            </div>
                        </span>
                    </div>

                    <div class="col-sm-4">
                        <span class="thumbnail">
                            <img src="" alt="...">
                            <h4></h4>
                            <div class="ratings">
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star-empty"></span>
                            </div>
                                    <p><label class="lead">SHOE NAME</label></p>
                                    <p>A very nice shoe.</p>
                                    <p><b>COLOR:</b></p>
                                    <p><b>SIZE:</b></p>
                            <hr class="line">
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <p class="price">Php. 3,500</p>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <a href="admin_view_product.php"><button class="btn btn-md btn-info pull-right" >VIEW PRODUCT</button></a>
                               </div>
                                
                            </div>
                        </span>
                    </div>
                </div>
        </div>
    </section>
    <!-- BEGIN FOOTER -->
    
    <?php require "../../templates/admin/admin_footer.php"; ?>
    <!-- .END FOOTER -->
    <!-- Include Javascript files -->
    <!-- <script src="../../js/smooth-scroll.js"></script> -->
</body>
</html>