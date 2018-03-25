<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shoeversity</title>

    <?php
        // Include Bootstrap and main styles 
        include "../../templates/brands/brand_bs_styles.php";
        include "../../templates/brands/brand_shoeversity_styles.php";

        session_start();
        // Set active page
        $_SESSION['page_type'] = "Brand";
        $_SESSION['active_page'] = "products";

        // Check if user is authorized to access page
        include '../../database/check_access.php';

        // Check if request to add product was issued
        if(isset($_GET['addProduct'])) {
            // Call popup modal
            if($_GET['addProduct'] == md5('true')) {
                include '../modals/add_product.php';

                echo "<script> 
                        $('#add_product_modal').modal('show');
                        $('#add_product_modal').on('hidden.bs.modal', function () { 
                             window.location = 'products.php';
                        })
                      </script>";
            }

            // Product Added successfully
            if($_GET['addProduct'] == md5('success')) {
                include '../modals/success.php';

                echo "<script> 
                        $('#success_modal').modal('show');
                        $('#success_modal').on('hidden.bs.modal', function () { 
                             window.location = 'products.php';
                        })
                      </script>";
            }
            
            // Error occured while adding product
            if($_GET['addProduct'] == md5('failed')) {
                include '../modals/error.php';

                echo "<script> 
                        $('#error_modal').modal('show');
                        $('#error_modal').on('hidden.bs.modal', function () { 
                             window.location = 'products.php';
                        })
                      </script>";
            }
        }
    ?>
</head>
<body>
    <!-- Include header -->
    <?php include "../../templates/brands/brand_header.php"; ?>
    
    <!-- BEGIN MAIN CONTENT -->
    <div class="container" style="margin-top: 0vh;">
        <div class="row">
            <!-- Centered Pills -->
            <ul class="nav nav-pills nav-justified">
                <li><a href="products.php?addProduct=<?php echo md5('true');?>">Add a product</a></li>
            </ul>
        </div>
    </div>

    <div class="container" id="products-list" style="margin-top: 5vh;">
        <!-- BEGIN PRODUCTS GRID -->


        <div class="col-md-12">
            <div class="col-md-4">
                <span class="thumbnail">
                    <div class="row" style="float:right;">
                        <div class="col-md-8 col-sm-8">
                            <a href="edit_product.php"><button class="btn btn-md btn-info pull-right" ><i class="glyphicon glyphicon-edit"></i></button></a>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <a href="remove_product.php"><button class="btn btn-md btn-info pull-right" ><i class="glyphicon glyphicon-remove"></i></button></a>
                       </div> 
                    </div><br>
                    <img src="" alt="...">
                    <h4></h4>
                    <div class="ratings">
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star-empty"></span>
                    </div>
                            <p><label class="lead">SHOE NAME</label></p>
                            <p>A very nice shoe.</p>
                            <p><b>COLOR:</b></p>
                            <p><b>SIZE:</b></p>
                    <hr class="line">
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <p class="price">Php. 3,500</p>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <a href="brand_view_product.php"><button class="btn btn-md btn-info pull-right" >VIEW PRODUCT</button></a>
                       </div>
                        
                    </div>
                </span>
            </div>

        </div>
    </div>            

    <!-- BEGIN FOOTER -->
    <?php require "../../templates/brands/brand_footer.php"; ?>
    <!-- .END FOOTER -->

    <!-- Include Javascript files -->
    <!-- <script src="../../js/smooth-scroll.js"></script> -->
</body>
</html>