<html>
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
    ?>


</head>
<body>
    <!-- BEGIN HEADER -->
    <?php require "../templates/users/user_header.php"; ?>
    <!-- .END HEADER -->

    <!-- BEGIN MAIN CONTENT -->

    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-10 col-md-offset-1">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Total</th>
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody>
                         <!-- Product in cart-->
                        <tr>
                            <td class="col-sm-8 col-md-6">
                                <div class="media">
                                    <a class="thumbnail pull-left" href="#"><img class="media-object" src="" style="width: 72px; height: 72px;"> </a>
                                    <div class="media-body">
                                        <h4 class="media-heading" style="padding-left: 10px;"><a href="">SHOE NAME</a></h4>
                                    </div>
                                </div>
                            </td>
                            <td class="col-sm-1 col-md-1" style="text-align: center">
                                <input type="number" class="form-control text-center" value="1">
                            </td>
                            <td class="col-sm-1 col-md-1 text-center">
                                <strong>Php.3,000</strong>
                            </td>    
                            <td class="col-sm-1 col-md-1 text-center">
                                <strong>3,000</strong>
                            </td>
                            <td class="col-sm-1 col-md-1">
                                <button type="button" class="btn btn-danger">
                                    <span class="glyphicon glyphicon-remove"></span> Remove
                                </button>
                            </td>
                        </tr>
                        <!-- End of Product in cart-->
                        <!-- Product in cart-->
                        <tr>
                            <td class="col-sm-8 col-md-6">
                                <div class="media">
                                    <a class="thumbnail pull-left" href="#"><img class="media-object" src="" style="width: 72px; height: 72px;"> </a>
                                    <div class="media-body">
                                        <h4 class="media-heading" style="padding-left: 10px;"><a href="">SHOE NAME</a></h4>
                                    </div>
                                </div>
                            </td>
                            <td class="col-sm-1 col-md-1" style="text-align: center">
                                <input type="number" class="form-control text-center" value="1">
                            </td>
                            <td class="col-sm-1 col-md-1 text-center">
                                <strong>Php.3,000</strong>
                            </td>    
                            <td class="col-sm-1 col-md-1 text-center">
                                <strong>3,000</strong>
                            </td>
                            <td class="col-sm-1 col-md-1">
                                <button type="button" class="btn btn-danger">
                                    <span class="glyphicon glyphicon-remove"></span> Remove
                                </button>
                            </td>
                        </tr>
                        <!-- End of Product in cart-->
                        <tr>
                            <td>   </td>
                            <td>   </td>
                            <td>   </td>
                            <td><h5>Subtotal</h5></td>
                            <td class="text-right"><h5><strong>3,000</strong></h5></td>
                        </tr>
                        <tr>
                            <td>   </td>
                            <td>   </td>
                            <td>   </td>
                            <td><h5>Estimated shipping</h5></td>
                            <td class="text-right"><h5><strong>120</strong></h5></td>
                        </tr>    
                        <tr>
                            <td>   </td>
                            <td>   </td> <!--Leave these blank-->
                            <td>   </td>
                            <td><h3>Total</h3></td>
                            <td class="text-right"><h3><strong>Php.3,120</strong></h3></td>
                        </tr>                    
                        <tr>
                            <td>   </td>
                            <td>   </td> <!--Leave these blank-->
                            <td>   </td>
                            <td>
                                <button type="button" class="btn btn-default">
                                    <span class="glyphicon glyphicon-shopping-cart"></span> Continue Shopping
                                </button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-success">
                                    Checkout <span class="glyphicon glyphicon-play"></span>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    

    <!-- .END MAIN CONTENT -->

	</body>
    <!-- <script src="../js/smooth-scroll.js"></script> -->

</html>