<html>
	<head>
        <title>Shoeversity</title>

        <?php
            // Include Bootstrap and main styles 
            include "../../templates/brands/brand_bs_styles.php";
            include "../../templates/brands/brand_shoeversity_styles.php";

            session_start();
            // Set active page
            $_SESSION['page_type'] = "Brand";
            $_SESSION['active_page'] = "products";

            $product = $_GET['pid'];

            // Check if user is authorized to access page
            include '../../database/check_access.php';

            include '../../database/brand_get_shoe.php';

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

            include "../modals/product_rating.php";
            
        ?>
    </head>
    <body>
        <!-- BEGIN HEADER -->
        <?php require "../../templates/brands/brand_header.php"; ?>
        <!-- .END HEADER -->

        <!-- BEGIN MAIN CONTENT -->
        <div class="container">
    		<div class="card">
    			<div class="container-fliud">
    				<div class="wrapper row">
    					<div class="preview col-md-6">
                            <a href="products.php#products-list"><button class="btn btn-md btn-info pull-left" style="width:30%;">< Back</button></a>
                            <img src="<?php echo "../".$photo; ?>"/>
    					</div>
    					<div class="details col-md-6">
                            <div class="row" >
                                <div class="col-md-10 col-sm-10">
                                <a href="edit_product.php"><button class="btn btn-md btn-info pull-right" style="height:45px; width: 70px;"><i class="glyphicon glyphicon-edit"></i></button></a>
                                </div>
                                <div class="col-md-2 col-sm-2">
                                <a href="remove_product.php"><button class="btn btn-md btn-info pull-right" style="height:45px; width: 70px;"><i class="glyphicon glyphicon-remove"></i></button></a><br>
                                </div>
                            </div>
                            <br>
                            <h3 class="price"><?php echo $name; ?></h3>

                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Posted by:
                                        <span><?php echo $posted ?> </span>
                                    </h4>
                                </div>
                                <div class="col-md-6">
                                    <h4>Price: <span> <?php echo $price; ?></span></p></h4>
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

    					</div>
    				</div>
    			</div>
    		</div>
    	</div>

        <!-- BEGIN FOOTER -->
        <?php require "../../templates/brands/brand_footer.php"; ?>
        <!-- .END FOOTER -->
	</body>
    <!-- <script src="../../js/smooth-scroll.js"></script> -->

</html>
