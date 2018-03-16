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
        $_SESSION['active_page'] = "products";
    ?>


</head>
<body>
    <!-- BEGIN HEADER -->
    <?php require "../templates/public_header.php"; ?>
    <!-- .END HEADER -->

    <!-- BEGIN MAIN CONTENT -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel" style="position: absolute; top: 0; margin-bottom: 100px; width: 100%; height: 100%;">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <div class="fill" style="background-image:url('https://www.metaslider.com/wp-content/uploads/2014/11/mountains1.jpg'); max-height: 100%;"></div>
                        <div class="carousel-caption">
                            <h1>WELCOME TO SHOEVERSITY</h1>
                            <h3>Your one stop for all shoe needs.</h3>
                        </div>
                </div>

                <div class="item">
                    <div class="fill" style="background-image:url('http://www.food4fuel.com/wp-content/uploads/2014/02/rebound-slider-2-bg.jpg');"></div>
                    <div class="carousel-caption">
                        <p><h3><em>Outfits aren't complete without them sneakas!</em></h3></p>
                    </div>
                </div>

                <div class="item">
                    <div class="fill" style="background-image:url('https://www.procloud.com.au/wp-content/uploads/2016/08/slider-dark-bg.jpg');">
                    <div class="carousel-caption">
                        <h3>Explore what we have to offer.</h3>
                        <p>We want to let you discover various brands' products and create your OOTD.</p>
                    </div>
                </div>
            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>        
    </div>

    <div class="container-fluid content-wrapper">
    </div>

    <div class="container">
        <!-- BEGIN PRODUCTS GRID -->
            <div class="col-md-12">
                <div class="col-md-3 col-sm-6">
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
                                <p><label class="lead"></label> </p>
                                <p><b>COLOR:</b></p>
                                <p><b>SIZE:</b></p>
                        <hr class="line">
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <p class="price">P</p>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <a href="">
                                <button class="btn-md btn-info pull-right" >BUY ITEM</button></a>
                           </div>
                            
                        </div>
                    </span>
                </div>
            </div>
        <!-- .END PRODUCTS GRID -->
    </div>
     <!-- .END MAIN CONTENT -->

    <!-- BEGIN FOOTER -->
    <?php //require "../templates/public_footer.php"; ?>
    <!-- .END FOOTER -->
    
    <!-- Include Javascript files -->
</body>
</html>