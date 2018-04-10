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
        $_SESSION['admin_fxn'] = "dashboard";

        $highlight = $_SESSION['admin_fxn'];

        // Check if user is authorized to access page
        include '../../database/check_access.php';
    ?>
</head>
<body>
    <!-- Include header -->
    <?php include "../../templates/admin/admin_header.php"; ?>

    <!-- Include sidebar -->
    <?php include "../../templates/admin/admin_sidebar.php"; ?>
    
    <!-- BEGIN MAIN CONTENT -->
    
        <div class="container" style="margin-top: 8vh;">
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