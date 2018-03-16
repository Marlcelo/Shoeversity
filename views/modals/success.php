<?php
$success_message = $_SESSION['success_msg'];
?>

<div class="modal fade" id="success_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-success">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header" style="background: #66BB6A; color: #fff; border-radius: 5px 5px 0 0">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Success
                </h4>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
                <?php echo $success_message ?> 
            </div>
            
            <!-- Modal Footer -->
            <div class="modal-footer" style="border-top: none">
                <button type="button" class="btn btn-info" data-dismiss="modal">
                    Go Back
                </button>
            </div>

        </div>
    </div>
</div>