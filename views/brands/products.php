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

        // Check if edit product request was issued
        if(isset($_GET['edit'])) {
            //if($_GET['edit'] == md5('true')) {
                $_SESSION['shoeID'] = $_GET['edit'];
                include '../modals/edit_product.php';

                echo "<script> 
                        $('#edit_product_modal').modal('show');
                        $('#edit_product_modal').on('hidden.bs.modal', function () { 
                             window.location = 'products.php';
                        })
                      </script>";
            //}
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

        <!-- I need to ajax this - dan  -->
        
        <div class="col-md-12">
           
            <?php
                if(!isset($_SESSION)) {
                    session_start();
                }
                require '../../database/config.php';
                $sql = "CALL SP_GET_SHOE_FROM(" . $_SESSION['b_id'] . ")";
                $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                while($row = mysqli_fetch_assoc($result)) {
                    $shoeID    = $row['uid'];
                    $shoeName  = $row['name'];
                    $shoeDesc  = $row['description'];
                    $shoeType  = $row['type'];
                    $shoeCateg = $row['category'];
                    $shoePrice = $row['price'];
                    $shoeSize  = $row['size'];
                    $shoeColor = $row['color'];
                    $shoeImg   = "../".$row['photo_url'];
            ?>

            <div class="col-md-4">
                <span class="thumbnail">
                    <div class="row" style="float:right;">
                        <!-- EDIT PRODUCT -->
                        <div class="col-md-8 col-sm-8">
                            <a href="products.php?edit=<?php echo $shoeID; //echo md5('true')?>"><button class="btn btn-md btn-info pull-right" ><i class="glyphicon glyphicon-edit"></i></button></a>
                        </div>
                        <!-- DELETE PRODUCT -->
                        <div class="col-md-4 col-sm-4">
                            <a href="remove_product.php"><button class="btn btn-md btn-info pull-right" ><i class="glyphicon glyphicon-remove"></i></button></a>
                       </div> 
                    </div><br>

                    <img src="<?php echo $shoeImg; ?>" alt="...">

                    <h4></h4>
                    <div class="ratings">
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star-empty"></span>
                    </div>
                            <p><label class="lead"> <?php echo $shoeName; ?> </label></p>
                            <p> <?php echo $shoeDesc; ?> </p>
                            <p><b>COLOR:</b> <?php echo $shoeColor; ?> </p>
                            <p><b>SIZE:</b> <?php echo $shoeSize; ?> </p>
                    <hr class="line">
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <p class="price"> <?php echo $shoePrice; ?> </p>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <a href="brand_view_product.php"><button class="btn btn-md btn-info pull-right" >VIEW PRODUCT</button></a>
                       </div>
                        
                    </div>
                </span>
            </div>
            <?php
                }
            ?>

        </div>
    </div>            

    <!-- BEGIN FOOTER -->
    <?php require "../../templates/brands/brand_footer.php"; ?>
    <!-- .END FOOTER -->

    <!-- Include Javascript files -->
    <script src="../../js/ajax-paginate-grid-brands.js"></script>
</body>
</html>