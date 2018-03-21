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

        if(!isset($_SESSION['active_paginate']))
            $_SESSION['active_paginate'] = 1;
        $page = 0;
        $per_page = 3;
        if(isset($_POST['page'])) {
            $page = $_POST['page'];
            $_SESSION['active_paginate'] = $page;
            $page = ($page * $per_page) - $per_page;
        }
        if(isset($_POST['prev'])) {
            if($_SESSION['active_paginate'] > 1) {
                $_POST['page'] = $_POST['page'] - 1;
                header("Location: index.php#products-list");
                exit();
            }
        }
        if(isset($_POST['next'])) {

        }
    ?>
</head>
<body>
    <!-- BEGIN HEADER -->
    <?php require "../templates/public_header.php"; ?>
    <!-- .END HEADER -->

    <!-- BEGIN MAIN CONTENT -->
    <div class="quicklink"><a href="#products-list">
        <div class="promote-products" id="promote-products-link">
            <h4>Check out our products!</h4>
            <!-- <a href="#products-list"> -->
                <center>
                    <img src="../images/misc/down-arrow.png" alt="down">
                </center>
            <!-- </a> -->
        </div>

        <div class="arrow-left" id="promote-products-left-arrow"></div>
    </a></div>


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

    <div class="container" style="margin-top: 100vh; padding-top: 100px" id="products-list">
        <!-- BEGIN PRODUCTS GRID -->
        <div class="col-md-12">

            <?php 
                //include "../database/shoes_list_get.php";
                $_SESSION['shoes_list'] = array();

                require '../database/config.php';

                // change this to a stored proc
                $sql = "SELECT * FROM shoes LIMIT ".$page.",".$per_page;
                $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

                while($row = mysqli_fetch_row($result)) {
                    $name = $row[2];
                    $description = $row[3];
                    $color = $row[8];
                    $size = $row[6];
                    $price = $row[7];
                    $imgpath = $row[9];
                    // get other details
                    
                    $shoeDetails = array($name, $description, $color, $size, $price, $imgpath);
                    array_push($_SESSION['shoes_list'], $shoeDetails);
                }

                mysqli_close($conn);

                $colCounter = 1;
            ?>

            <?php foreach($_SESSION['shoes_list'] as $shoe): ?>

                <?php if($colCounter % 3 == 0) echo "<div class='row'>"; ?>

                <div class="col-sm-4">
                    <span class="thumbnail">
                        <img src="<?php echo "../".$shoe[5]; ?>" alt="...">
                        <!-- <h4></h4> -->
                        <div class="ratings">
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star-empty"></span>
                        </div>
                                <label class="lead"><h2 style="margin-bottom: 0"><?php echo $shoe[0]; ?></h2></label>
                                <p><?php echo $shoe[1]; ?></p>
                                <p class="colors"><b>COLOR:</b> 
                                    <!-- <div style="height: 15px; width: 15px; background: <?php echo $shoe[2]; ?>"></div> -->
                                    <span class="color <?php echo $shoe[2]; ?>" style="border: 1px solid #aaa;"></span>
                                </p>
                                <p><b>SIZE:</b> <?php echo $shoe[3]; ?></p>
                        <hr class="line">
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <p class="price"> &#8369; <?php echo $shoe[4]; ?></p>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <a href="view_product.php"><button class="btn btn-info pull-right">VIEW ITEM</button></a>
                           </div>
                            
                        </div>
                    </span>
                </div>

                <?php 
                    if($colCounter % 3 == 0) {
                        echo "</div>"; 
                        // $i++;
                    } 
                    $colCounter++;
                ?>
    
            <?php endforeach; ?>


            <?php
                require '../database/config.php';
                $sql = "SELECT * FROM shoes";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
                $a = $count/$per_page;
                $a = ceil($a);
                echo "<br><br>";
            ?>
            <form method="post" action="index.php#products-list" class="text-center">
                <input type="submit" class="btn btn-default" name="prev" style="width: 37px; height: 37px;" value="&laquo;">
                <?php
                for($b=1; $b<=$a;$b++) {
                    ?>
                    <input type="submit" 
                        class="btn <?php if($b==$_SESSION['active_paginate']) echo 'btn-primary'; else echo 'btn-default';?>" 
                        style="width: 37px; height: 37px; margin: 0" value="<?php echo $b;?>" 
                        name="page">
                <?php } ?>
                <input type="submit" class="btn btn-default" name="next" style="width: 37px; height: 37px;" value="&raquo;">
            </form>

<!--             <div class="row">
                <?php include "../database/shoes_list_get.php"; ?>

                <?php 
                    $counter = 0;

                    foreach($_SESSION['shoes_list'] as $shoe) { 

                        $counter = $counter+1; ?>
                    <div class="col-sm-4">
                        <span class="thumbnail">
                            <img src="<?php echo "../".$shoe[5]; ?>" alt="...">
                            <!-- <h4></h4> -->
                            <div class="ratings">
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star-empty"></span>
                            </div>
                                    <label class="lead"><h2 style="margin-bottom: 0"><?php echo $shoe[0]; ?></h2></label>
                                    <p><?php echo $shoe[1]; ?></p>
                                    <p><b>COLOR:</b> 
                                        <div style="height: 15px; width: 15px; background: <?php echo $shoe[2]; ?>"></div>
                                    </p>
                                    <p><b>SIZE:</b> <?php echo $shoe[3]; ?></p>
                            <hr class="line">
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <p class="price"> &#8369; <?php echo $shoe[4]; ?></p>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <a href="view_product.php"><button class="btn-md btn-info pull-right" >BUY ITEM</button></a>
                               </div>
                                
                            </div>
                        </span>
                    </div> 

                    <?php if($counter ==3){ ?>
                        <div class="clearfix"></div>
                    
                    <?php }
                           
                 } ?>
            </div>   -->

            <!-- <div class="row text-center" style="background: #eee">
                <ul class="pagination pagination-lg">
                    <li><a href="#">&laquo;</a></li>
                    <li class="active"><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li><a href="#">&raquo;</a></li>
                </ul>
            </div>  -->
            
        </div>
        <!-- .END PRODUCTS GRID -->
    </div>
     <!-- .END MAIN CONTENT -->

    <!-- BEGIN FOOTER -->
    <?php require "../templates/public_footer.php"; ?>
    <!-- .END FOOTER -->
    
    <!-- Include Javascript files -->
    <script src="../js/animate-products-quicklink.js"></script>
    <script src="../js/smooth-scroll.js"></script>
    
</body>
</html>