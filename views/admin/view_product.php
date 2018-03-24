<html>
	<head>
        <title>Shoeversity</title>

        <?php
            // Include Bootstrap and main styles 
            include "../../templates/admin/admin_bs_styles.php";
            include "../../templates/admin/admin_shoeversity_styles.php";

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
        <?php require "../../templates/admin/admin_header.php"; ?>
        <!-- .END HEADER -->

        <!-- BEGIN MAIN CONTENT -->
        <div class="container">
    		<div class="card">
    			<div class="container-fliud">
    				<div class="wrapper row">
    					<div class="preview col-md-6">
                            <img src=""/>
    					</div>
    					<div class="details col-md-6">
                            <div class="row" >
                                <div class="col-md">
                                <a href="remove_product.php"><button class="btn btn-md btn-info pull-right" style="height:45px; width: 70px;"><i class="glyphicon glyphicon-remove"></i></button></a><br>
                                </div>
                            </div>
                            <h3 class="product-title">SHOES</h3>
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
    						<p class="product-description">Buy my pretty shoes!</p>
    						<h4><p class="price">Price: <span>3,500</span></p></h4>
    						<p class="vote"><strong>91%</strong> of buyers enjoyed this product! <strong>(87 votes)</strong></p>
    						<h5 class="sizes">Size:
                                <span class="size" data-toggle="tooltip" ></span>
    						</h5>

                            <form action="">
                                <h5 class="qty">Qty:
                                	<span style="margin-left:5px;"><input style="width: 15%; display: inline; " type="number" class="form-control text-center" min="1" max="10" name="qty" value="1"></span>
                                </h5>
                    
                                <h5 class="colors">Colors:
                                	<span class="color blue"></span>
                                </h5>
                            </form>
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>

        <!-- BEGIN FOOTER -->
        <?php require "../../templates/admin/admin_footer.php"; ?>
        <!-- .END FOOTER -->
	</body>
    <!-- <script src="../../js/smooth-scroll.js"></script> -->

</html>
