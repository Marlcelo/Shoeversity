<html>
	<head>
        <title>Shoeversity</title>

        <?php
            // Include Bootstrap and main styles 
            include "../../templates/users/user_bs_styles.php";
            include "../../templates/users/user_shoeversity_styles.php";

            session_start();
            // Set active page
            $_SESSION['page_type'] = "User";
            $_SESSION['active_page'] = "products";
            $product = $_GET['pid'];

            // CSRF Token
            if(!isset($_GET['token']) || 
               !isset($_SESSION['sessionToken']) ||
               (isset($_SESSION['sessionToken']) && $_GET['token'] != $_SESSION['sessionToken'])) {
                include '../modals/restricted_access.php';
        
                echo "<script> 
                    window.stop();
                    $('#restricted_access').modal('show');
                    $('#restricted_access').on('hidden.bs.modal', function () { //go back to prev page
                       window.history.back();
                    })
                    </script>";
            }
            else {
                $token = $_SESSION['sessionToken'];
            }
    
            // Check if user is authorized to access page
            include '../../database/check_access.php';

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

            if(isset($_GET['brandinfo'])){
                include "../modals/brand_info_users.php";

                echo "<script> 
                            $('#brand_info_modal').modal('show');
                            $('#brand_info_modal').on('hidden.bs.modal', function () {
                                window.history.back();
                            })
                        </script>";

            }

            
            // include rating modal & success modal
            include "../modals/product_rating.php";
            // include "../modals/success.php";
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
                            <a href="products.php?token=<?php echo $_SESSION['sessionToken'] ?>"><button class="btn btn-md btn-info pull-left" style="width:30%;">< Back</button></a>
                            <img src="<?php echo "../".$photo; ?>"/>
    					</div>
                        <div class="details col-md-6">
                            <h3 class="price"><?php echo $name; ?></h3>

                            <div class="row">
                                <div class="col-md-6">
                                 <h4>Posted by:
                                    <span><a href = "view_product.php?pid=<?php echo $product; ?>&brandinfo=<?php echo $product; ?>&token=<?php echo $token?>"> <?php echo $posted; ?> </span></a>
                                </h4>
                                </div>
                                <div class="col-md-6">
                                    <h4>Price:  &#8369;<span> <?php echo $price; ?></span></p></h4>
                                </div>
                            </div>

    						<p class="product-description"><?php echo $description; ?></p>

                            <div class="row" style="margin-left: 0px">
                                <?php include "../../database/shoe_ratings_get.php" ?>

                                <p><h4 style="display: inline">Rating:</h4>
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

    						
    						<!-- <p class="vote"><strong>91%</strong> of buyers enjoyed this product! <strong>(87 votes)</strong></p> -->

                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="sizes">Type:
                                        <span class="type" data-toggle="tooltip" ><?php echo $type; ?></span>
                                    </h5>
                                </div>
                                <div class="col-md-6">
                                    <h5 class="sizes">Size:
                                        <span class="size" data-toggle="tooltip" >
                                            <?php echo $size; ?>
                                        </span>
                                    </h5>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="sizes">Category:
                                        <span class="category" data-toggle="tooltip" >
                                            <?php echo $category; ?>
                                        </span>
                                    </h5>
                                </div>
                                <div class="col-md-6">
                                    <h5 class="colors">Colors:
                                        <span class="color <?php echo $color; ?>"></span>
                                    </h5>
                                </div>
                            </div>

                            <form action="../../database/user_add_to_cart.php" method="POST">
                                <div class="row">
                                    <button class="add-to-cart btn btn-primary" type="submit" name="add_to_cart">add to cart</button>
                                    <button class="like btn btn-default" type="button" onclick="rateProduct();"> Rate</button>
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
    <script src="../../js/rate-shoe.js"></script>

</html>
