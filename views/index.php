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
    <!-- Begin Carousel -->
    <div id="shoeversityCarousel" class="carousel slide" data-ride="carousel" style="position: absolute; top: 0; margin-bottom: 100px; width: 100%; height: 100vh">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#shoeversityCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#shoeversityCarousel" data-slide-to="1"></li>
                <li data-target="#shoeversityCarousel" data-slide-to="2"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <div class="fill">
                        <img src="https://www.metaslider.com/wp-content/uploads/2014/11/mountains1.jpg" style="height: 100vh;">
                    </div>
                    <div class="carousel-caption">
                        <h1>WELCOME TO SHOEVERSITY</h1>
                        <h3>Your one stop for all shoe needs.</h3>
                    </div>
                </div>

                <div class="item">
                    <div class="fill">
                        <img src="http://www.food4fuel.com/wp-content/uploads/2014/02/rebound-slider-2-bg.jpg" style="height: 100vh;">
                    </div>
                    <div class="carousel-caption">
                        <p><h3><em>Outfits aren't complete without them sneakas!</em></h3></p>
                    </div>
                </div>

                <div class="item">
                    <div class="fill">
                        <img src="https://www.procloud.com.au/wp-content/uploads/2016/08/slider-dark-bg.jpg" style="height: 100vh;">
                    </div>
                    <div class="carousel-caption">
                        <h3>Explore what we have to offer.</h3>
                        <p>We want to let you discover various brands' products and create your OOTD.</p>
                    </div>
                </div>
            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#shoeversityCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#shoeversityCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>        
    </div>

    <div class="container" style="margin-top: 100vh;">
        <!-- BEGIN PRODUCTS GRID -->
        <div class="col-md-12">

            <?php include "../database/shoes_list_get.php"; ?>

            <?php foreach($_SESSION['shoes_list'] as $shoe) { ?>

                <div class="col-sm-4">
                    <span class="thumbnail">
                        <img src="<?php echo "../".$shoe[5]; ?>" alt="...">
                        <h4></h4>
                        <div class="ratings">
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star-empty"></span>
                        </div>
                                <p><label class="lead"><?php echo $shoe[0]; ?></label></p>
                                <p><?php echo $shoe[1]; ?></p>
                                <p><b>COLOR: <?php echo $shoe[2]; ?></b></p>
                                <p><b>SIZE: <?php echo $shoe[3]; ?></b></p>
                        <hr class="line">
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <p class="price"><?php echo $shoe[4]; ?></p>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <a href=""><button class="btn-md btn-info pull-right" >BUY ITEM</button></a>
                           </div>
                            
                        </div>
                    </span>
                </div>
    
            <?php } ?>
            
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