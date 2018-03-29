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

        // Check if delete product request was issued
        if(isset($_GET['delete'])) {
           if($_GET['delete'] == 'success') {
                include '../modals/success.php';

                echo "<script> 
                        $('#success_modal').modal('show');
                        $('#success_modal').on('hidden.bs.modal', function () { 
                             window.location = 'products.php';
                        })
                      </script>";
           }
           else if($_GET['delete'] == 'error') {
                include '../modals/error.php';

                echo "<script> 
                        $('#error_modal').modal('show');
                        $('#error_modal').on('hidden.bs.modal', function () { 
                             window.location = 'products.php';
                        })
                      </script>";
           }
           else {
                $_SESSION['warning_msg'] = "Are you sure you want to delete this product?";
                $_SESSION['target_page'] = "../../database/brand_delete_product.php?id=" . $_GET['delete'];
                include '../modals/warning.php';

                echo "<script> 
                        $('#warning_modal').modal('show');
                        $('#warning_modal').on('hidden.bs.modal', function () { 
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
    <!-- <script src="../../js/ajax-paginate-grid-brands.js"></script> -->
    <script type="text/Javascript">
        $(document).ready(function(){
            /* Declare Global variables */
            var current_page_id = 1;
            var num_pages = 1;
            var records_per_page = 6;

            get_num_pages(); // update num_pages
            load_data(current_page_id); // initialize

            // alert($num_pages);

            function load_data(page) {
                $.ajax({
                    url:"../../database/pagination/shoe_grid_show_brands.php",
                    method:"POST",
                    data:{page:page, records:records_per_page},
                    success:function(data){
                        $('#products-list').html(data);

                        var btnPrev = document.getElementById('prev-page');
                        var btnNext = document.getElementById('next-page');
                        var btnCurr = document.getElementById(page);

                        if(page == 1) {
                            btnPrev.disabled = true;
                            btnNext.disabled = false;
                        }
                        else if(page == num_pages) {
                            btnPrev.disabled = false;
                            btnNext.disabled = true;
                        }

                        btnCurr.classList.add('btn-primary');
                    }
                })
            }

            function get_num_pages() {
                $.ajax({
                    url:"../../database/pagination/shoe_num_rows_brands.php",
                    method:"POST",
                    data:{records:records_per_page},
                    success:function(data){
                        num_pages = data;
                    }
                })
            }

            function load_prev_page(pageID) {
                setCurrentPageID(pageID - 1);
                load_data(pageID - 1);
            }

            function load_next_page(pageID) {
                setCurrentPageID(pageID + 1);
                load_data(pageID + 1);
            }

            function setCurrentPageID(pageID) {
                current_page_id = pageID;
            }

            /*********************************************/

            // Current Page Button
            $(document).on('click', '.pagination-link', function() {
                var page = $(this).attr("id");
                setCurrentPageID(parseInt(page));
                load_data(page);
            });

            // Previous Button
            $(document).on('click', '#prev-page', function() {
                load_prev_page(current_page_id);
            });

            // Next Button
            $(document).on('click', '#next-page', function() {
                load_next_page(current_page_id);
            });
        });
    </script>
</body>
</html>