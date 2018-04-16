<?php
    if(!isset($_SESSION))
        session_start();

    $displayError = false;
    if(isset($_SESSION['authLogPassFail'])) {
        $displayError = true;
        unset($_SESSION['authLogPassFail']);
    }
?>

<div class="modal fade" id="reauth_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width: 80%">
        <div class="modal-content">
             <!-- Modal Header -->
            <div class="modal-header" style="background: #37474F; color: #fff; border-radius: 5px 5px 0 0; margin-right: 0px">
                <button type="button" class="close" 
                   data-dismiss="modal" style="color: #fff">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    <span class="glyphicon glyphicon-lock"></span> &nbsp;Reauthentication Required
                </h4>
            </div>
            
            <form action="../../database/reauthenticate.php" method="post">
            <div class="modal-body">
                <div style="height: 70vh">
                    <div class="alert alert-info">
                        <b>Notice:</b> You won't be able to see the content of this page until you provide your valid Administrative Password.
                    </div>
                    <br>

                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <h4>Password</h4>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password here" required>

                        <?php if($displayError): ?>
                        <div class="alert alert-danger alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            An error occurred during authentication! Try again.
                        </div>
                        <?php endif;?>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer" style="border-top: none">
                <button type="button" class="btn bnt-default" style="background: #eee" data-dismiss="modal">
                    <strong>Cancel</strong>
                </button>
                &nbsp;
                <!-- <a href=""> -->
                <!-- <form class="form-horizontal" method="POST" action="../../database/.php"> -->
                    <button type="submit" class="btn btn-info">
                        <strong>Submit</strong>
                    </button>
                <!-- </form> -->
            </div>
            </form>

        </div>
    </div>
</div>