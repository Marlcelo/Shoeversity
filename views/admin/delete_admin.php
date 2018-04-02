<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shoeversity</title>

    <?php
        // Include Bootstrap and main styles 
        include "../../templates/admin/admin_bs_styles.php";
        include "../../templates/admin/admin_shoeversity_styles.php";

        session_start();
        // Set active page
        $_SESSION['page_type'] = "Admin";
        $_SESSION['active_page'] = "account";

        // Check if user is authorized to access page
        include '../../database/check_access.php';
        require '../../database/get_admins.php';

    ?>

    <link rel="stylesheet" type="text/css" href="../../css/dataTables.bootstrap.min.css">

    <script type="text/javascript">
      $(document).ready(function() {
        $('#admins').DataTable();
      } );
    </script>
</head>
<body>
	<!-- Include header -->
	<?php include "../../templates/admin/admin_header.php"; ?>
	
    <div class="container" style="margin-top: 0vh;">
        <div class="row">
            <!-- Centered Pills -->
            <ul class="nav nav-pills nav-justified">
                <li><a href="register_admin.php">Create an Admin Account</a></li>
                <li class="active"><a href="delete_admin.php">Delete an Admin Account</a></li>
                <li ><a href="delete_user.php">Delete a User Account</a></li>
            </ul>
        </div>
    </div>

    <div class="content-wrapper ">
        <div class="container text-center">
                <div class="col-md">
                    <h1>Delete an Admin Account</h1>
                                  <table id="admins" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Username</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Gender</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                      foreach ($admins as $admin) {
                                       echo "<tr>
                                          <form action='../../database/admin_delete_admin.php?adId=".$admin['uid']."' method='POST'>
                                            <td>".$admin['username']."</td>
                                            <td>".$admin['adName']."</td>
                                            <td>".$admin['email']."</td>
                                            <td>".$admin['gender']."</td>
                                            <td><input type='submit' class='btn btn-danger btn-md' name='delete' value='Delete'></td>
                                          </form>  
                                        </tr>";
                                      }

                                      // while ( <= 10) {
                                      //   echo "string";
                                      // }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Username</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Gender</th>
                                            <th>Delete</th>
                                        </tr>
                                    </tfoot>
                                </table>
                             
                </div>              
        </div>
    </div>
	
	 <!-- BEGIN FOOTER -->
    <?php require "../../templates/admin/admin_footer.php"; ?>
    <!-- .END FOOTER -->
	
<script src="../../js/dataTables.bootstrap.min.js"></script>
<script src="../../js/jquery-1.12.4.js"></script>
<script src="../../js/jquery.dataTables.min.js"></script>
	<!-- Include Javascript files -->
    <!-- <script src="../../js/smooth-scroll.js"></script> -->
</body>
</html>
