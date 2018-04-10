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
        $_SESSION['active_page'] = "dashboard";
        $_SESSION['admin_fxn'] = "delete_admin";

        // Check if user is authorized to access page
        include '../../database/check_access.php';
        require '../../database/get_admins.php';

        if(isset ($_GET['deleteadmin'])){
            $_SESSION['warning_msg'] = "Are you sure you want to delete this admin?";
            $_SESSION['target_page'] = "../../database/admin_delete_admin.php?adId=" . $_GET['deleteadmin'];
            include '../modals/warning.php';
            
            echo "<script> 
            $('#warning_modal').modal('show');
            $('#warning_modal').on('hidden.bs.modal', function () { 
               window.location = 'delete_admin.php';
           })
           </script>";
        }
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
	
    <?php include "../../templates/admin/admin_sidebar.php"; ?>

    <div class="container text-center main">
        <div class="col-md" style="margin-right: 40px; min-height: 350px;">
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
                      <form method='POST'>
                        <td>".$admin['username']."</td>
                        <td>".$admin['adName']."</td>
                        <td>".$admin['email']."</td>
                        <td>".$admin['gender']."</td>
                        <td><button type='submit' class='btn btn-danger btn-md' name='deleteadmin' value='".$admin['uid']."'>Delete</button></td>
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
