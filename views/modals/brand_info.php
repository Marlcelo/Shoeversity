
<?php
    $shoeID = $_SESSION['pid'];

    require '../database/config.php';
    $sql = "CALL SP_GET_BRAND_PROFILE($posted_by_id)";
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    while($row = mysqli_fetch_assoc($result)) {

        $name  = $row['brand_name'];
        $username  = $row['b_username'];
        $email  = $row['b_email'];
        $contact = $row['contact'];
        $linktype = $row['link_type'];
        $link  = $row['link'];
        $location = $row['location'];

    }

    mysqli_close($conn);

?>
<!--posted by
    public  $shoe[6]
    user
    brand
    admin-->

<div class="modal fade" id="brand_info_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header" style="background: #3498DB  ; color: #fff; border-radius: 5px 5px 0 0">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    <?php echo $name ?>
                </h4>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
                Your product has been added to your shopping cart.
            </div>
            
            <!-- Modal Footer -->
            <div class="modal-footer" style="border-top: none">
                <button type="button" class="btn btn-info" data-dismiss="modal">
                    Thanks!
                </button>
            </div>

        </div>
    </div>
</div>
