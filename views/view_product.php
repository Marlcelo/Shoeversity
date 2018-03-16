<html>
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
    <div class="container">
		<div class="card">
			<div class="container-fliud">
				<div class="wrapper row">
					<div class="preview col-md-6">
                        <img src=""/>
					</div>
					<div class="details col-md-6">
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
						<h4 class="price">Price: <span>PHP 2,350</span></h4>
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
                            
                            <div class="action">
                                <button class="add-to-cart btn btn-primary" type="submit">add to cart</button>
                                <button class="like btn btn-default" type="button"><span class="fa fa-star"></span> Rate</button>
                            </div>
                        </form>
					</div>
				</div>
			</div>
		</div>
	</div>

    <!-- .END MAIN CONTENT -->

	</body>

</html>