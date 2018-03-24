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
                            <img src="<?php echo "../".$shoe[5]; ?>"/>
    					</div>
    					<div class="details col-md-6">
                            <h3 class="product-title"><?php echo $shoe[0]; ?></h3>
    						<div class="rating">
    							<div class="stars">
    								<span class="fa fa-star checked"></span>
    								<span class="fa fa-star checked"></span>
    								<span class="fa fa-star checked"></span>
    								<span class="fa fa-star"></span>
    								<span class="fa fa-star"></span>
    							</div>
    							<span class="review-no">41 reviews</span>
    						</div>    
                            <h4>Posted by:
                                <span> <?php echo $shoe[6]; ?> </span>
                            </h4>
    						<p class="product-description"><?php echo $shoe[1]; ?></p>
    						<h4><p class="price">Price: <span><?php echo $shoe[4]; ?></span></p></h4>
    						<!-- <p class="vote"><strong>91%</strong> of buyers enjoyed this product! <strong>(87 votes)</strong></p> -->
    						<h5 class="sizes">Size:
                                <span class="size" data-toggle="tooltip" ><?php echo $shoe[3]; ?></span>
    						</h5>
                            <h5 class="colors">Colors:
                                <span class="color <?php echo $shoe[2]; ?>"></span>
                            </h5>
        
                            <br><hr class="line">

                            <form action="">
                                <!-- <h5 class="qty">Qty:
                                	<span style="margin-left:5px;"><input style="width: 15%; display: inline; " type="number" class="form-control text-center" min="1" max="10" name="qty" value="1"></span>
                                </h5> -->
                                                
                                <div class="row">
                                    <button class="add-to-cart btn btn-primary disabled" type="button">add to cart</button>
                                    <button class="like btn btn-default disabled" type="button"> Rate</button>
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
