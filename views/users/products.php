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
        $_SESSION['active_page'] = "products";

        // Check if user is authorized to access page
        include '../../database/check_access.php';
    ?>
</head>
<body>
    <!-- Include header -->
    <?php include "../../templates/users/user_header.php"; ?>
    
    <!-- BEGIN MAIN CONTENT -->
    
    <div class="container" style="margin-top: 10vh;">
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
                                <a href="user_view_product.php"><button class="btn btn-md btn-info pull-right" >BUY PRODUCT</button></a>
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
                                <a href="user_view_product.php"><button class="btn btn-md btn-info pull-right" >BUY PRODUCT</button></a>
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
                                <a href="user_view_product.php"><button class="btn btn-md btn-info pull-right" >BUY PRODUCT</button></a>
                           </div>
                            
                        </div>
                    </span>
                </div>
            </div>
    </div>

    <!-- BEGIN FOOTER -->
    <?php require "../../templates/users/user_footer.php"; ?>
    <!-- .END FOOTER -->

    <!-- Include Javascript files -->
    <!-- <script src="../../js/smooth-scroll.js"></script> -->
</body>
</html>