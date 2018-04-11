<html>
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

            $product = $_GET['pid'];

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

            if(isset($_GET['pid'])) {
                $shoe_id = $_GET['pid'];
                $_SESSION['pid'] = $shoe_id;
                include '../database/shoe_get.php';

                $shoe = array();
                $shoe = $_SESSION['selected_shoe_details'][0];
            }
            else {
                echo "<h1>Oops! Something went wrong.</h1>";
                echo "<script>window.stop()</script>";
            }

            // Check for errors
            if(isset($_GET['req'])) {
                if($_GET['req'] = md5('login')) {
                    $_SESSION['error_msg'] = "You must be logged in";
                    include "modals/login_redirect.php";

                    echo "<script> 
                            $('#login_redirect_modal').modal('show');
                            $('#login_redirect_modal').on('hidden.bs.modal', function () {
                                window.history.back();
                            })
                        </script>";
                }
            }

            if(isset($_GET['brandinfo'])){
                include "modals/brand_info_public.php";

                echo "<script> 
                            $('#brand_info_modal').modal('show');
                            $('#brand_info_modal').on('hidden.bs.modal', function () {
                                window.history.back();
                            })
                        </script>";

            }

            $redirectError = md5('login');
        ?>


    </head>
    <body>
        <!-- BEGIN HEADER -->
        <?php require "../templates/public_header.php"; ?>
        <!-- .END HEADER -->

        <!-- BEGIN MAIN CONTENT -->
        <div class="container">
    		
            <div class="card">
    			<div class="container-fliud">
    				<div class="wrapper row">
    					<div class="preview col-md-6">
                            <a href="index.php#products-list"><button class="btn btn-md btn-info pull-left" style="width:30%;">< Back</button></a>
                            <img src="<?php echo $shoe[5]; ?>"/>
    					</div>
    					<div class="details col-md-6">
                            <h3 class="price"><?php echo $shoe[0]; ?></h3><br>
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Posted by:
                                        <span><a href = "view_product.php?pid=<?php echo $product; ?>&brandinfo=<?php echo $product; ?>"> <?php echo $shoe[6]; ?> </span></a>
                                    </h4>
                                </div>
                                <div class="col-md-6">
                                    <h4>Price:
                                        <span><?php echo $shoe[4]; ?> </span>
                                    </h4>
                                </div>
                            </div>

    						<p class="product-description"><?php echo $shoe[1]; ?></p>

    						<div class="row" style="margin-left: 0px">
                                <?php include "../database/shoe_ratings_get.php" ?>

                                <p><h5 style="display: inline">RATING:</h5>
                                &nbsp;
                                <?php if(isset($rating)): ?>
                                    <div class="rating" style="display: inline; margin-bottom: -70px">
                                    <?php 
                                        for($i = 1; $i <= 5; $i++) {
                                            if($i <= $rating) {
                                                echo '<span class="glyphicon glyphicon-star"></span>';
                                            }
                                            else {
                                                echo '<span class="glyphicon glyphicon-star-empty"></span>';
                                            }
                                        }
                                    ?>
                                    </div>
                                <?php else: ?>
                                    <span class="text-info">This product has not been rated yet.</span></p>
                                <?php endif; ?>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                <h5 class="sizes">Type:
                                    <span class="type" data-toggle="tooltip" ><?php echo $shoe[7]; ?></span>
                                </h5>
        						<!-- <p class="vote"><strong>91%</strong> of buyers enjoyed this product! <strong>(87 votes)</strong></p> -->
                                </div>
                                <div class="col-md-6">
                                    <h5 class="sizes">Size:
                                        <span class="size" data-toggle="tooltip" ><?php echo $shoe[3]; ?></span>
                                    </h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
            						<h5 class="sizes">Category:
                                        <span class="category" data-toggle="tooltip" >
                                            <?php echo $shoe[8]; ?>
                                        </span>
                                    </h5>
                                </div>
                                <div class="col-md-6">
                                    <h5 class="colors">Colors:
                                        <span class="color <?php echo $shoe[2]; ?>"></span>
                                    </h5>
                                </div>
                            </div>

        
                            <hr class="line">

                            <form action="">
                                <!-- <h5 class="qty">Qty:
                                	<span style="margin-left:5px;"><input style="width: 15%; display: inline; " type="number" class="form-control text-center" min="1" max="10" name="qty" value="1"></span>
                                </h5> -->
                                                
                                <div class="row">
                                    <button class="add-to-cart btn btn-primary" onclick="location.href='<?php echo $_SERVER['REQUEST_URI']."&req=".$redirectError; ?>'" type="button">add to cart</button>
                                    <button class="like btn btn-default" onclick="location.href='<?php echo $_SERVER['REQUEST_URI']."&req=".$redirectError; ?>'" type="button">Rate</button>
                                </div>
                            </form>
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>

        <!-- BEGIN FOOTER -->
        <?php require "../templates/public_footer.php"; ?>
        <!-- .END FOOTER -->
	</body>
    <!-- <script src="../js/smooth-scroll.js"></script> -->

</html>
