<?php
$warning_message = $_SESSION['warning_msg'];
$redirect = $_SESSION['target_page'];
?>

<div class="modal fade" id="warning_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-warning">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header" style="background: #FFCA28; color: #fff; border-radius: 5px 5px 0 0">
                <button type="button" class="close"
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Confirm Action
                </h4>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
                <?php echo $warning_message ?> 
            </div>
            
            <!-- Modal Footer -->
            <div class="modal-footer" style="border-top: none">
                <div style="display: inline">
                    <button type="button" class="btn btn-default" style="background: #eee" data-dismiss="modal">
                        Cancel
                    </button>
                    <button type="button" class="btn btn-info" onclick="window.location='<?php echo $redirect;?>'">
                        Proceed
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>