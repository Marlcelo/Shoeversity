<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shoeversity</title>

    <?php
        // Include Bootstrap and main styles 
        include "../../templates/brands/brand_bs_styles.php";
        include "../../templates/brands/brand_shoeversity_styles.php";

        session_start();
        // Set active page
        $_SESSION['active_page'] = "products";
    ?>
</head>
<body>
    <!-- Include header -->
    <?php include "../../templates/brands/brand_header.php"; ?>
    
    <!-- BEGIN MAIN CONTENT -->
    <div class="container" style="margin-top: 0vh;">
        <div class="row">
            <!-- Centered Pills -->
            <ul class="nav nav-pills nav-justified">
                <li><a href="add_prodct.jsp">Add a product</a></li>
                <li><a href="edit_product.jsp">Edit a product</a></li>
                <li><a href="delete_product.jsp">Delete a product</a></li>
            </ul>
        </div>
    </div>

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
                                <a href=""><button class="btn-md btn-info pull-right" >BUY PRODUCT</button></a>
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
                                <a href=""><button class="btn-md btn-info pull-right" >BUY PRODUCT</button></a>
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
                                <a href=""><button class="btn-md btn-info pull-right" >BUY PRODUCT</button></a>
                           </div>
                            
                        </div>
                    </span>
                </div>
            </div>
    </div>

    <!-- BEGIN FOOTER -->
    <?php require "../../templates/brands/brand_footer.php"; ?>
    <!-- .END FOOTER -->

    <!-- Include Javascript files -->
</body>
</html>