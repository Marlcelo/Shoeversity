<?php

?>

<div class="modal fade" id="forgot_password_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
             <!-- Modal Header -->
            <div class="modal-header" style="background: #37474F; color: #fff; border-radius: 5px 5px 0 0">
                <button type="button" class="close" 
                   data-dismiss="modal" style="color: #fff">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Password Reset
                </h4>
            </div>

            <form action="../database/password_send_email.php" method="post">
                <div class="modal-body">
                    <p style="font-size: 14px">Enter the email address you use to sign in to Shoeversity and we'll send you a link to reset your password.<p>

                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                        <input type="text" class="form-control" name="email" placeholder="Enter your email address" required>
                    </div>
                </div>
                   
                <!-- Modal Footer -->
                <div class="modal-footer" style="border-top: none">
                    <button type="button" class="btn btn-default" style="background: #eee" data-dismiss="modal">
                        <strong>Cancel</strong>
                    </button>
                    &nbsp;
                    <button type="submit" name="submit" class="btn btn-info">
                        <strong>Submit</strong>
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>