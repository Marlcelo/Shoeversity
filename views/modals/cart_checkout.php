<?php

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
                <div class="container">
                    <div class="row">
                        <!-- <div class="col-md-12"> -->
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th class="text-center">Price</th>
                                        <th class="text-center">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     <!-- Product in cart-->
                                    <tr>
                                        <td>
                                            <img src="">
                                            SHOE NAME
                                        </td>
                                        <td class="text-center">
                                            <strong>3,000</strong>
                                        </td>
                                        <td class="">
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
                                    
                                </tbody>
                            </table>
                        <!-- </div> -->
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer" style="border-top: none">
                <button type="button" class="btn bnt-default" style="background: #eee" data-dismiss="modal">
                    <span class="glyphicon glyphicon-shopping-cart"></span> <strong>Continue shopping</strong>
                </button>
                &nbsp;
                <!-- <a href=""> -->
                <button type="submit" name="submit" class="btn btn-success">
                    <strong>Check out</strong> <span class="glyphicon glyphicon-play"></span>
                </button>
                <!-- </a> -->
            </div>

        </div>
    </div>
</div>