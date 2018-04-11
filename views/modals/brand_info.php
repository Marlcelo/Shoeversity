
<?php
    $shoeID = $_SESSION['pid'];

    require '../database/config.php';
    $sql = "CALL SP_GET_BRAND_PROFILE($posted_by_id)";
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    while($row = mysqli_fetch_assoc($result)) {

        $name  = $row['brand_name'];
        $username  = $row['b_username'];
        $email  = $row['b_email'];
        $location = $row['location'];
    }

    mysqli_close($conn);

?>
<!--posted by
    public  $shoe[6]
    user
    brand
    admin        

    $contact = $row['contact'];
        $linktype = $row['link_type'];
        $link  = $row['link'];-->

<div class="modal fade" id="brand_info_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-lg" style="width:600px;">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header" style="background: #3498DB  ; color: #fff; border-radius: 5px 5px 0 0">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Brand Profile
                </h4>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body" style="text-align: center;">
                <div class="col-md">
                    <span><h4>Brand Name: <?php echo $name ?></h4></span>
                    <span><h4>Username: <?php echo $username ?></h4></span>
                    <span><h4>Location: <?php echo $location ?></h4></span>
                    <hr>
                    <span><h4>Contact:</h4></span>
                    <span><h4><?php echo $email ?></h4></span>

                    <?php

                    require '../database/config.php';
                        $sql = "CALL SP_GET_BRAND_CONTACTS($posted_by_id)";
                        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

                        while($row = mysqli_fetch_assoc($result)) {
                            $contact = $row['contact']; ?>
                            <span><h4><?php echo $contact ?></h4></span>
                    <?php    } 

                        mysqli_close($conn);

                        require '../database/config.php';
                        $sql = "CALL SP_GET_BRAND_LINKS($posted_by_id)";
                        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));?>
                        <hr>
                        <span><h4>Find out more on:</h4></span>

                    <?php
                        while($row = mysqli_fetch_assoc($result)) {
                            $linktype = $row['link_type'];
                            $link  = $row['link'];   ?>
                            <span><h4><?php echo $linktype ?> - <?php echo $link ?></h4></span>
                    <?php    }

                        mysqli_close($conn); 
                    ?>
                    
               </div>
                
            </div>
            
            <!-- Modal Footer -->
            <div class="modal-footer" style="border-top: none">
                <button type="button" class="btn btn-info" data-dismiss="modal">
                    Go back
                </button>
            </div>

        </div>
    </div>
</div>
