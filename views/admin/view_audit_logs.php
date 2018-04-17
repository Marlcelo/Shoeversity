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

            include '../../database/log_restricted.php';
        }
        else {
          $token = $_SESSION['sessionToken'];
        }

        // Check if user is authorized to access page
        include '../../database/check_access.php';
        require '../../database/get_logs.php';

        // Require admin re-authentication
        if(isset($_SESSION['authLog']) && $_SESSION['authLog'] == 0) {
          include '../modals/reauthenticate.php';
          echo "<script> 
                  $('#reauth_modal').modal({
                       backdrop: 'static',
                       keyboard: false
                  });
                  $('#reauth_modal').on('hidden.bs.modal', function () { //go back to prev page
                     window.location='dashboard.php?token=".$token."';
                  })
            </script>";
        }
        else {
          // Require reauthentication for viewing logs
          //$_SESSION['authLog'] = 0;
        }
    ?>

    <link rel="stylesheet" type="text/css" href="../../css/dataTables.bootstrap.min.css">

    <script type="text/javascript">
      $(document).ready(function() {
        $('#users').DataTable({
            "order":[[0, "desc"]]
        });
      } );
    </script>
</head>
<body>
	<!-- Include header -->
	<?php include "../../templates/admin/admin_header.php"; ?>

    <!-- Include sidebar -->
    <?php include "../../templates/admin/admin_sidebar.php"; ?>
    
        <div class="container main">
             <div class="col-md" style=" min-height: 350px; padding-right: 25px;">
                  <h1 class='text-center'>View System Audit Logs</h1>
                  <br>
                  <table id="users" class="table table-striped table-bordered table-hover" style="width:100%;">
                    <thead style="background: #eee">
                        <tr>
                            <th>Log ID</th>
                            <th>Committed by</th>
                            <th>Action</th>
                            <th>Timestamp</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php
                      foreach ($logs as $log) {
                       echo "<tr>
                              <td>".$log['uid']."</td>
                              <td>".$log['username']."</td>
                              <td>".$log['log_action']."</td>
                              <td>".$log['time_stamp']."</td>
                            </tr>";
                      }
                        ?>
                    </tbody>
                </table>
                
                <br>
                <form action="../../database/logs_download.php" method="post">
                  <button class="btn btn-success pull-right" type="submit">
                      <span class="glyphicon glyphicon-download-alt"></span> &nbsp; <strong>Download Logs</strong>
                  </button>   
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
