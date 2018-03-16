<?php
//get session variables
$ondexid    = $_SESSION['activeuser_OndexID'];
$cid        = $_SESSION['activeuser_CID'];
$role       = $_SESSION['activeuser_Role'];
$fname      = $_SESSION['activeuser_Firstname'];
$mname      = $_SESSION['activeuser_Middlename'];
$lname      = $_SESSION['activeuser_Lastname'];
$addedon    = $_SESSION['activeuser_AddedOn'];
$lastaccess = $_SESSION['activeuser_LastAccess'];
$page       = $_SESSION['activeuser_Page'];
?>

<div class="modal fade" id="user_info_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-info modal-sm" style="margin-top: 15%;">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header" style="background: #5bc0de; color: #fff; border-radius: 5px 5px 0 0">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    User Information
                </h4>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
                <!-- Profile Picture -->
                <img class="square-img-admin profile-admin" 
                     style="width: 100px; height: 100px"
                     src="http://mysite.onsemi.com/User%20Photos/Profile%20Pictures/<?php echo $ondexid; ?>_LThumb.jpg" 
                     onError="this.error=null;this.src='../../images/misc/default-profile.png'" 
                     alt="No image found">

                <br>

                <table class="table">
                    <tr>
                        <td scope="col">
                            <strong>Name</strong>
                        </td>
                        <td scope="col">
                            <?php echo $fname . ' ' . $mname . ' ' . $lname; ?>
                        </td>
                    </tr>

                    <tr>
                        <td scope="col">
                            <strong>Role</strong>
                        </td>
                        <td scope="col">
                            <?php echo $role; ?>
                        </td>
                    </tr>

                    <tr>
                        <td scope="col">
                            <strong>Ondex ID</strong>
                        </td>
                        <td scope="col">
                            <?php echo $ondexid; ?>
                        </td>
                    </tr>

                    <tr>
                        <td scope="col">
                            <strong>CID</strong>
                        </td>
                        <td scope="col">
                            <?php echo $cid; ?>
                        </td>
                    </tr>

                    <tr>
                        <td scope="col">
                            <strong>Added On</strong>
                        </td>
                        <td scope="col">
                            <?php echo $addedon; ?>
                        </td>
                    </tr>
                </table>

                <div class="text-default" style="font-style: none">
                    User last seen on 
                    <u><?php echo $lastaccess; ?></u>
                    at
                    <i><a href="<?php echo $_SESSION['activeuser_Page']; ?>" class="link">
                        <?php echo $page; ?>
                    </a></i>
                </div>
            </div>

        </div>
    </div>
</div>