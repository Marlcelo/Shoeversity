<html>
	<head>
        <title>Shoeversity</title>

        <?php
            // Include Bootstrap and main styles 
            include "../../templates/admin/admin_bs_styles.php";
            include "../../templates/admin/admin_shoeversity_styles.php";

            session_start();
            // Set active page

            $_SESSION['page_type'] = "Admin";
            $_SESSION['active_page'] = "dashboard";
            
             if(isset($_GET['delete'])) {
           if($_GET['delete'] == 'success') {
                include '../modals/success.php';

                echo "<script> 
                        $('#success_modal').modal('show');
                        $('#success_modal').on('hidden.bs.modal', function () { 
                             window.location = 'dashboard.php';
                        })
                      </script>";
           }
           else if($_GET['delete'] == 'error') {
                include '../modals/error.php';

                echo "<script> 
                        $('#error_modal').modal('show');
                        $('#error_modal').on('hidden.bs.modal', function () { 
                             window.location = 'dashboard.php';
                        })
                      </script>";
           }
           else {
                $_SESSION['warning_msg'] = "Are you sure you want to delete this product?";
                $_SESSION['target_page'] = "../../database/admin_delete_product.php?id=" . $_GET['delete'];
                include '../modals/warning.php';

                echo "<script> 
                        $('#warning_modal').modal('show');
                        $('#warning_modal').on('hidden.bs.modal', function () { 
                             window.location = 'dashboard.php';
                        })
                      </script>";
           }
        }
            
            $product = $_GET['pid'];

            if(isset($_GET['pid'])) {
                $shoe_id = $_GET['pid'];
                $_SESSION['pid'] = $shoe_id;
                include '../../database/shoe_get.php';

                $shoe = array();
                $shoe = $_SESSION['selected_shoe_details'][0];
            }else {
                echo "<h1>Oops! Something went wrong.</h1>";
                echo "<script>window.stop()</script>";
            }



            require "../../database/shoe_get.php";
            $shoe = $_SESSION['selected_shoe_details'];
        ?>


    </head>
    <body>
        <!-- BEGIN HEADER -->
        <?php 
        require "../../templates/admin/admin_header.php"; 
        ?>
        <!-- .END HEADER -->

        <!-- BEGIN MAIN CONTENT -->
        <div class="container">
            
            <div class="card">
                <div class="container-fliud">
                    <div class="wrapper row">
                        <div class="preview col-md-6">
                            <a href="index.php#products-list"><button class="btn btn-md btn-info pull-left" style="width:30%;">< Back</button></a>
                            <img src="<?php echo "../".$shoe[0][5]; ?>"/>
                        </div>
                        <div class="details col-md-6">
                            <div class="col-md-12 col-md-12 pull-right">
                                <a href="view_product.php?pid=<?php echo $product; ?>&delete=<?php echo $product; ?>">
                                    <button class="btn btn-md btn-info pull-right" style="height: 45px; width: 70px;"><i class="glyphicon glyphicon-remove"></i></button></a><br>
                            </div>
                            <h3 class="price"><?php echo $shoe[0][0]; ?></h3><br>
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Posted by:
                                        <span> <?php echo $shoe[0][6]; ?> </span>
                                    </h4>
                                </div>
                                <div class="col-md-6">
                                    <h4>Price:
                                        <span><?php echo $shoe[0][4]; ?> </span>
                                    </h4>
                                </div>
                            </div>

                            <p class="product-description"><?php echo $shoe[0][1]; ?></p>

                            <div class="row" style="margin-left: 0px">
                                <?php include "../../database/shoe_ratings_get.php" ?>

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
                                    <span class="type" data-toggle="tooltip" ><?php echo $shoe[0][7]; ?></span>
                                </h5>
                                <!-- <p class="vote"><strong>91%</strong> of buyers enjoyed this product! <strong>(87 votes)</strong></p> -->
                                </div>
                                <div class="col-md-6">
                                    <h5 class="sizes">Size:
                                        <span class="size" data-toggle="tooltip" ><?php echo $shoe[0][3]; ?></span>
                                    </h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="sizes">Category:
                                        <span class="category" data-toggle="tooltip" >
                                            <?php echo $shoe[0][8]; ?>
                                        </span>
                                    </h5>
                                </div>
                                <div class="col-md-6">
                                    <h5 class="colors">Colors:
                                        <span class="color <?php echo $shoe[0][2]; ?>"></span>
                                    </h5>
                                </div>
                            </div>

        
                            <hr class="line">
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
