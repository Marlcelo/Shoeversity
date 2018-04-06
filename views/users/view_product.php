<html>
	<head>
        <title>Shoeversity</title>

        <?php
            // Include Bootstrap and main styles 
            include "../../templates/users/user_bs_styles.php";
            include "../../templates/users/user_shoeversity_styles.php";

            session_start();
            // Set active page
            $_SESSION['page_type'] = "Public";
            $_SESSION['active_page'] = "products";
            $product = $_GET['pid'];
    
            include '../../database/user_get_shoe.php';

            if(isset($_GET['result'])) {
                if($_GET['result'] == md5('success')) {
                    include "../modals/success.php";

                    echo "<script> 
                            $('#success_modal').modal('show');
                            $('#success_modal').on('hidden.bs.modal', function () {
                                window.history.back();
                            })
                        </script>";
                }
                else if($_GET['result'] == md5('fail')) {
                    include "../modals/error.php";

                    echo "<script> 
                            $('#error_modal').modal('show');
                            $('#error_modal').on('hidden.bs.modal', function () {
                                window.history.back();
                            })
                        </script>";
                }
            }

        ?>
            
        <link rel="stylesheet" type="text/css" href="../../css/shopping-cart-sidebar.css">
    </head>
    <body>
        <!-- BEGIN HEADER -->
        <?php require "../../templates/users/user_header.php"; ?>
        <!-- .END HEADER -->

        <!-- BEGIN MAIN CONTENT -->
        <div class="container">
    		<div class="card">
    			<div class="container-fliud">
    				<div class="wrapper row">
    					<div class="preview col-md-6">
                            <img src="<?php echo "../".$photo; ?>"/>
    					</div>
    					<div class="details col-md-6">
                            <h3 class="product-title"><?php echo $name; ?></h3>
    						<div class="rating">
    							<div class="stars">
    								<span class="fa fa-star checked"></span>
    								<span class="fa fa-star checked"></span>
    								<span class="fa fa-star checked"></span>
    								<span class="fa fa-star"></span>
    								<span class="fa fa-star"></span>
    							</div>
                                <h4>Posted by:
                                    <span> <?php echo $posted; ?> </span>
                                </h4>
    							<span class="review-no">41 reviews</span>
    						</div>
    						<p class="product-description"><?php echo $description; ?></p>
    						<h4><p class="price">Price: <span>&#8369; <?php echo $price; ?></span></p></h4>
    						<!-- <p class="vote"><strong>91%</strong> of buyers enjoyed this product! <strong>(87 votes)</strong></p> -->
                            <h5 class="sizes">Type:
                                <span class="type" data-toggle="tooltip" ><?php echo $type; ?></span>
                            </h5>
                            <h5 class="sizes">Category:
                                <span class="category" data-toggle="tooltip" >
                                    <?php echo $category; ?>
                                </span>
                            </h5>
    						<h5 class="sizes">Size:
                                <span class="size" data-toggle="tooltip" >
                                    <?php echo $size; ?>
                                </span>
    						</h5>

                            
                                <!-- <h5 class="qty">Qty:
                                	<span style="margin-left:5px;"><input style="width: 15%; display: inline; " type="number" class="form-control text-center" min="1" max="10" name="qty" value="1"></span>
                                </h5> -->
                    
                                <h5 class="colors">Colors:
                                	<span class="color <?php echo $color; ?>"></span>
                                </h5>
                            <form action="../../database/user_add_to_cart.php" method="POST">
                                <div class="row">
                                    <button class="add-to-cart btn btn-primary" type="submit" name="add_to_cart">add to cart</button>
                                    <button class="like btn btn-default" type="button"> Rate</button>
                                </div>
                            </form>
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>

        <!-- BEGIN FOOTER -->
        <?php require "../../templates/users/user_footer.php"; ?>
        <!-- .END FOOTER -->
	</body>
    <!-- <script src="../../js/smooth-scroll.js"></script> -->
    <script src="../../js/shopping-cart.js"></script>

</html>
