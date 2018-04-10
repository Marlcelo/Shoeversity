<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shoeversity</title>

    <?php
        // Include Bootstrap and main styles 
        include "../../templates/users/user_bs_styles.php";
        include "../../templates/users/user_shoeversity_styles.php";

        session_start();
        // Set active page
        $_SESSION['page_type'] = "User";
        $_SESSION['active_page'] = "products";

        // CSRF Token
        if(!isset($_GET['token']) || $_GET['token'] != $_SESSION['sessionToken']) {
            include '../modals/restricted_access.php';
    
            echo "<script> 
                window.stop();
                $('#restricted_access').modal('show');
                $('#restricted_access').on('hidden.bs.modal', function () { //go back to prev page
                   window.history.back();
                })
                </script>";
        }

        //IMPORTANT! : for displaying the query results in the grid
        if(isset($_SESSION['grid_sql']))
            $gridSQL = $_SESSION['grid_sql'];
        else
            $gridSQL = "SELECT * FROM shoes";

        // Check if user is authorized to access page
        include '../../database/check_access.php';

        // Check for errors
        if(isset($_GET['error'])) {
            if($_GET['error'] == md5('filter')) {
                include '../modals/error.php';

                echo "<script> 
                        $('#error_modal').modal('show');
                        $('#error_modal').on('hidden.bs.modal', function () { 
                            window.location = 'products.php';
                        })
                    </script>";
            }
        }
        if(isset($_GET['result'])) {
            if($_GET['result'] == md5('success')) {
                include '../modals/success.php';

                echo "<script> 
                        $('#success_modal').modal('show');
                        $('#success_modal').on('hidden.bs.modal', function () { 
                            window.location = 'products.php';
                        })
                    </script>";
            }else if($_GET['result'] == md5('failed')) {
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

    <link rel="stylesheet" type="text/css" href="../../css/filter-sidebar.css">
    <link rel="stylesheet" type="text/css" href="../../css/shopping-cart-sidebar.css">
</head>
<body>
    <!-- Include header -->
    <?php include "../../templates/users/user_header.php"; ?>
    
    <!-- BEGIN MAIN CONTENT -->
    <div class="container" style="height: 100px; margin-top: 0px; margin-bottom: -10px;">
        <h1 class="display-3 text-center">Browse Products</h1>
    </div>

    <!-- BEGIN FILTER SIDEBAR -->
    <div class="col-md-12" style="margin-top: 40px; margin-bottom: -100px; z-index: 1;">
        <?php include '../../templates/users/user_filter_sidebar.php'; ?>
    </div>
    <!-- .END FILTER SIDEBAR -->

    <div class="container" id="products-list" style="margin-top: 40px;">
    </div>

    <!-- BEGIN FOOTER -->
    <?php require "../../templates/users/user_footer.php"; ?>
    <!-- .END FOOTER -->

    <!-- Include Javascript files -->
    <script src="../../js/shopping-cart.js"></script>
    <script type="text/Javascript">
        /* Set the width of the side navigation to 250px */
        function openNav() {
            document.getElementById("mySidenav").style.left = "0px";
        }

        /* Set the width of the side navigation to 0 */
        function closeNav() {
            document.getElementById("mySidenav").style.left = "-350px";
        }

        // $(window).scroll(function() {
        //     if ($(this).scrollTop() > 60) {
        //         document.getElementById("btnToggle").style.position = "absolute";
        //     }
        //     else {
        //         document.getElementById("btnToggle").style.position = "fixed";
        //     }   
        // });

        $(document).ready(function(){
            /* Declare Global variables */
            var current_page_id = 1;
            var num_pages = 1;
            var records_per_page = 9;
            var sql_query = "<?php echo $gridSQL; ?>";
            
            get_num_pages(sql_query); // update num_pages
            load_data(current_page_id, sql_query); // initialize

            function load_data(page, query) {
                $.ajax({
                    url:"../../database/pagination/shoe_grid_show_users.php",
                    method:"POST",
                    data:{page:page, records:records_per_page, sql:query},
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

            function get_num_pages(query) {
                $.ajax({
                    url:"../../database/pagination/shoe_num_rows_users.php",
                    method:"POST",
                    data:{records:records_per_page, sql:query},
                    success:function(data){
                        num_pages = data;
                    }
                })
            }

            function load_prev_page(pageID) {
                setCurrentPageID(pageID - 1);
                load_data(pageID - 1, sql_query);
            }

            function load_next_page(pageID) {
                setCurrentPageID(pageID + 1);
                load_data(pageID + 1, sql_query);
            }

            function setCurrentPageID(pageID) {
                current_page_id = pageID;
            }

            /*********************************************/

            // Current Page Button
            $(document).on('click', '.pagination-link', function() {
                var page = $(this).attr("id");
                setCurrentPageID(parseInt(page));
                load_data(page, sql_query);
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