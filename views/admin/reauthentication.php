<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shoeversity</title>
    <link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">

    <?php
        // Include Bootstrap and main styles 
        include "../../templates/admin/admin_bs_styles.php";
        include "../../templates/admin/admin_shoeversity_styles.php";

        session_start();
        // Set active page
        $_SESSION['page_type'] = "Admin";
        $_SESSION['active_page'] = "dashboard";
        $_SESSION['admin_fxn'] = "view_logs";

        // CSRF Token
        if(!isset($_GET['token']) || 
           !isset($_SESSION['sessionToken']) ||
           (isset($_SESSION['sessionToken']) && $_GET['token'] != $_SESSION['sessionToken'])) {
            include '../modals/restricted_access.php';
    
            echo "<script> 
                window.stop();
                $('#restricted_access').modal('show');
                $('#restricted_access').on('hidden.bs.modal', function () { //go back to prev page
                   window.history.back();
                })
                </script>";
        }

        // Check if user is authorized to access page
        include '../../database/check_access.php';
    ?>

</head>
<body>
	<!-- Include header -->
	<?php include "../../templates/admin/admin_header.php"; ?>

    <!-- Include sidebar -->
    <?php include "../../templates/admin/admin_sidebar.php"; ?>
    
        <div class="container main">
             <div class="col-md" style=" width:700px; min-height: 350px; padding-left: 400px; padding-top: 100px">
                  
                  <br><br><br>
                  Before viewing the logs, please enter your password:

                  <form class="form-horizontal" method="POST" action="../../database/admin_authentication.php">
                    <!-- Password -->
                    <div class="input-group">
                      <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                      <input type="password" id="password" class="form-control" name="pword" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                    </div>

                    <button type="submit" name="btn_authenticate" class="btn btn-success" >View Logs</button>
                  </form>
                             
            </div>              
        </div>

	
	 <!-- BEGIN FOOTER -->
    <?php require "../../templates/admin/admin_footer.php"; ?>
    <!-- .END FOOTER -->
	
	<!-- Include Javascript files -->

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
</body>
</html>
