<!DOCTYPE html>
<html lang="en">
<head>
    <title>Shoeversity</title>

    <?php
        // Include Bootstrap and main styles 
        include "../templates/public_bs_styles.php";
        include "../templates/public_shoeversity_styles.php";

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

        if(isset($_GET['error'])) {
        	if($_GET['error'] == md5('filter')) {
        		include 'modals/error.php';

        		echo "<script> 
                        $('#error_modal').modal('show');
                        $('#error_modal').on('hidden.bs.modal', function () { 
                            window.location = 'index.php';
                        })
                    </script>";
        	}
        }
    ?>
    <link rel="stylesheet" type="text/css" href="../css/filter-sidebar.css">
</head>
<body>
    <!-- BEGIN HEADER -->
    <?php require "../templates/public_header.php"; ?>
    <!-- .END HEADER -->

    <!-- BEGIN MAIN CONTENT -->
    <div class="quicklink"><a href="#products">
        <div class="promote-products" id="promote-products-link">
            <h4>Check out our products!</h4>
            <!-- <a href="#products-list"> -->
                <center>
                    <img src="../images/misc/down-arrow.png" alt="down">
                </center>
            <!-- </a> -->
        </div>

        <div class="arrow-left" id="promote-products-left-arrow"></div>
    </a></div>


    <!-- Begin Carousel -->
    <div id="shoeversityCarousel" class="carousel slide" data-ride="carousel" style="position: absolute; top: 0; margin-bottom: 100px; width: 100%; height: 100vh;">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#shoeversityCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#shoeversityCarousel" data-slide-to="1"></li>
                <li data-target="#shoeversityCarousel" data-slide-to="2"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <div class="fill">
                        <img src="https://www.metaslider.com/wp-content/uploads/2014/11/mountains1.jpg" style="height: 100vh;">
                    </div>
                    <div class="carousel-caption">
                        <h1>WELCOME TO SHOEVERSITY</h1>
                        <h3>Your one stop for all shoe needs.</h3>
                    </div>
                </div>

                <div class="item">
                    <div class="fill">
                        <img src="http://www.food4fuel.com/wp-content/uploads/2014/02/rebound-slider-2-bg.jpg" style="height: 100vh;">
                    </div>
                    <div class="carousel-caption">
                        <p><h3><em>Outfits aren't complete without them sneakas!</em></h3></p>
                    </div>
                </div>

                <div class="item">
                    <div class="fill">
                        <img src="https://www.procloud.com.au/wp-content/uploads/2016/08/slider-dark-bg.jpg" style="height: 100vh;">
                    </div>
                    <div class="carousel-caption">
                        <h3>Explore what we have to offer.</h3>
                        <p>We want to let you discover various brands' products and create your OOTD.</p>
                    </div>
                </div>
            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#shoeversityCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#shoeversityCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>        
    </div>
    <!-- end carousel -->

    <div class="row" style="margin-top: 90vh;" id="products">
        <div class="col-md-12">
        </div>
    </div>

    <!-- BEGIN FILTER SIDEBAR -->
    <div class="col-md-12" style="margin-top: 90px; margin-bottom: -100px; z-index: 1;">
        <?php include '../templates/public_filter_sidebar.php'; ?>
    </div>
    <!-- .END FILTER SIDEBAR -->

    <!-- BEGIN PRODUCTS GRID -->
    <div class="container" style="margin-top: 90px; padding-top: 0px" id="products-list">
    </div>
    <!-- .END PRODUCTS GRID -->
     <!-- .END MAIN CONTENT -->

    <!-- BEGIN FOOTER -->
    <?php require "../templates/public_footer.php"; ?>
    <!-- .END FOOTER -->
    
    <!-- Include Javascript files -->
    <script src="../js/animate-products-quicklink.js"></script>
    <script src="../js/smooth-scroll.js"></script>

    <script type="text/Javascript">
        /* Set the width of the side navigation to 250px */
		function openNav() {
		    document.getElementById("mySidenav").style.left = "0px";
		}

		/* Set the width of the side navigation to 0 */
		function closeNav() {
		    document.getElementById("mySidenav").style.left = "-350px";
		}

$(window).scroll(function() {
    if ($(this).scrollTop() > 60) {
        document.getElementById("btnToggle").style.position = "absolute";
    }
    else {
        document.getElementById("btnToggle").style.position = "fixed";
    }   
});

        $(document).ready(function(){
            /* Declare Global variables */
            var current_page_id = 1;
            var num_pages = 1;
            var records_per_page = 9;

            get_num_pages(); // update num_pages
            load_data(current_page_id); // initialize

            function load_data(page, sql) {
                $.ajax({
                    url:"../database/pagination/shoe_grid_show_public.php",
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
                    url:"../database/pagination/shoe_num_rows_public.php",
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