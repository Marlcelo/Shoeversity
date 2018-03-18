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
        $_SESSION['active_page'] = "products";

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
</head>
<body>
    <!-- BEGIN HEADER -->
    <?php require "../templates/public_header.php"; ?>
    <!-- .END HEADER -->

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
                                <a href=""><button class="btn-md btn-info pull-right" >BUY ITEM</button></a>
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
                                <a href=""><button class="btn-md btn-info pull-right" >BUY ITEM</button></a>
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
                                <a href=""><button class="btn-md btn-info pull-right" >BUY ITEM</button></a>
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
                                <a href=""><button class="btn-md btn-info pull-right" >BUY ITEM</button></a>
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
                                <a href=""><button class="btn-md btn-info pull-right" >BUY ITEM</button></a>
                           </div>
                            
                        </div>
                    </span>
                </div>
            </div>
            
        <!-- .END PRODUCTS GRID -->
    </div>
     <!-- .END MAIN CONTENT -->

    <!-- BEGIN FOOTER -->
    <?php require "../templates/public_footer.php"; ?>
    <!-- .END FOOTER -->
    
    <!-- Include Javascript files -->
</body>
</html>