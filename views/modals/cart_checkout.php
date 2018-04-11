<?php
    require '../../database/user_get_cart_items.php';

    if(isset ($_GET['removeShoe'])){
        $_SESSION['warning_msg'] = "Are you sure you want to delete this product?";
        $_SESSION['target_page'] = "../../database/user_checkout_remove_product.php?id=" . $_GET['removeShoe'];
        include '../modals/warning.php';

        echo "<script> 
        $('#warning_modal').modal('show');
        $('#warning_modal').on('hidden.bs.modal', function () { 
           window.location = 'products.php';
       })
       </script>";
                  }
?>

<div class="modal fade" id="cart_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
             <!-- Modal Header -->
            <div class="modal-header" style="background: #37474F; color: #fff; border-radius: 5px 5px 0 0">
                <button type="button" class="close" 
                   data-dismiss="modal" style="color: #fff">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    <span class="glyphicon glyphicon-shopping-cart"></span> My Shopping Cart
                </h4>
            </div>

            <div class="modal-body">
                
                        <!-- <div class="col-md-12"> -->
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th class="text-center">Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     <!-- Product in cart-->
                                     <?php foreach ($items as $shoe) {
                                         // commence display of shoe
                                     ?>
                                    <tr>
                                        <td>
                                            <img src="<?php echo "../".$shoe[0]; ?>" height = 80px width = 80px>
                                           <?php echo $shoe[1]; ?>
                                        </td> 
                                        <td class="text-center">
                                            <strong>₱<?php echo $shoe[2]; ?></strong>
                                        </td>
                                        <td class="">
                                            <form method="GET">
                                                <!-- action="../../database/user_checkout_remove_product.php" -->
                                                <button type="submit" class="btn btn-danger btn-sm" name="removeShoe" value="<?php echo $shoe[3] ?>">
                                                <span class="glyphicon glyphicon-remove"></span> Remove
                                            </button>
                                            </form>
                                            
                                        </td>
                                    </tr>
                                    <!-- End of Product in cart-->
                                    <?php } ?>
                                    <tr>
                                        <td>   </td>
                                        <td>   </td>
                                        <td>   </td>
                                        <td><h5>Subtotal</h5></td>
                                        <td class="text-right"><h5>₱<strong><?php echo $subtotal; ?></strong></h5></td>
                                    </tr>
                                    
                                    <tr>
                                        <td>   </td>
                                        <td>   </td>
                                        <td>   </td>
                                        <td><h5>Estimated shipping</h5></td>
                                        <td class="text-right"><h5>₱<strong><?php echo $total - $subtotal; ?></strong></h5></td>
                                    </tr>    
                                    <tr>
                                        <td>   </td>
                                        <td>   </td> <!--Leave these blank-->
                                        <td>   </td>
                                        <td><h3>Total</h3></td>
                                        <td class="text-right"><h3>₱<strong><?php echo $total; ?></strong></h3></td>
                                    </tr>                    
                                    
                                </tbody>
                            </table>
                        <!-- </div> -->
                    </div>
               

            <!-- Modal Footer -->
            <div class="modal-footer" style="border-top: none">
                <button type="button" class="btn bnt-default" style="background: #eee" data-dismiss="modal">
                    <span class="glyphicon glyphicon-shopping-cart"></span> <strong>Continue shopping</strong>
                </button>
                &nbsp;
                <!-- <a href=""> -->
                <form class="form-horizontal" method="POST" action="../../database/user_checkout.php">
                    <div class="col-md-4">
                        <p>Confirm password to finalize your purchase</p> 
                        <div class="input-group">

                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input type="password" id="password1" class="form-control" name="pword" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                        </div>
                    </div>
                    <button type="submit" name="btn_checkout" class="btn btn-success" >
                        <strong>Check out</strong> <span class="glyphicon glyphicon-play"></span>
                    </button>
                </form>
                
                <!-- </a> -->
            </div>

        </div>
    </div>
</div>