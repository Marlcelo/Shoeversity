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

            include '../../database/log_restricted.php';
        }
        else {
            $token = $_SESSION['sessionToken'];
        }

        //IMPORTANT! : for displaying the query results in the grid
        if(isset($_SESSION['grid_sql']))
            $gridSQL = $_SESSION['grid_sql'];
        else
            $gridSQL = "SELECT * FROM shoes";

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
                             window.location = 'products.php?token=".$token."';
                        })
                      </script>";
            }

            // Product Added successfully
            if($_GET['addProduct'] == md5('success')) {
                include '../modals/success.php';

                echo "<script> 
                        $('#success_modal').modal('show');
                        $('#success_modal').on('hidden.bs.modal', function () { 
                             window.location = 'products.php?token=".$token."';
                        })
                      </script>";
            }
            
            // Error occured while adding product
            if($_GET['addProduct'] == md5('failed')) {
                include '../modals/error.php';

                echo "<script> 
                        $('#error_modal').modal('show');
                        $('#error_modal').on('hidden.bs.modal', function () { 
                             window.location = 'products.php?token=".$token."';
                        })
                      </script>";
            }
        }

        // Check if edit product request was issued
        if(isset($_GET['edit'])) {
            $_SESSION['shoeID'] = $_GET['edit'];
            include '../modals/edit_product.php';

            echo "<script> 
                    $('#edit_product_modal').modal('show');
                    $('#edit_product_modal').on('hidden.bs.modal', function () { 
                         window.location = 'products.php?token=".$token."';
                    })
                  </script>";
        }

        // Check if delete product request was issued
        if(isset($_GET['delete'])) {
           if($_GET['delete'] == 'success') {
                include '../modals/success.php';

                echo "<script> 
                        $('#success_modal').modal('show');
                        $('#success_modal').on('hidden.bs.modal', function () { 
                             window.location = 'products.php?token=".$token."';
                        })
                      </script>";
           }
           else if($_GET['delete'] == 'error') {
                include '../modals/error.php';

                echo "<script> 
                        $('#error_modal').modal('show');
                        $('#error_modal').on('hidden.bs.modal', function () { 
                             window.location = 'products.php?token=".$token."';
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
                             window.location = 'products.php?token=".$token."';
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
                <li><a href="products.php?addProduct=<?php echo md5('true')."&token=".$token;?>">Add a product</a></li>
            </ul>
        </div>
    </div>

    <div class="container" id="products-list" style="margin-top: 5vh;">
        <!-- BEGIN PRODUCTS GRID -->
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