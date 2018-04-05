<div class="modal fade" id="login_redirect_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">

        	<!-- Modal Header -->
            <div class="modal-header" style="background: #37474F; color: #fff; border-radius: 5px 5px 0 0">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Information
                </h4>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
                You must be logged in to perform this action.
                <br>
                If you have an account, <a class="link" href="../views/login.php">login here</a>.
            </div>
            
            <!-- Modal Footer -->
            <div class="modal-footer" style="border-top: none">
                <div style="display: inline">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Cancel
                    </button>
                    <button type="button" class="btn btn-info" onclick="window.location='../views/login.php'">
                        Login
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>