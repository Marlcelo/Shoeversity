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
        $_SESSION['admin_fxn'] = "approve_brand";


        // Check if user is authorized to access page
        include '../../database/check_access.php';
        require '../../database/get_unverified_brands.php';
    ?>

    <link rel="stylesheet" type="text/css" href="../../css/dataTables.bootstrap.min.css">

    <script type="text/javascript">
      $(document).ready(function() {
        $('#brands').DataTable();
      } );
    </script>
</head>
<body>
	<!-- Include header -->
	<?php include "../../templates/admin/admin_header.php"; ?>

	<!-- Include sidebar -->
    <?php include "../../templates/admin/admin_sidebar.php"; ?>
    
        <div class="container text-center main">
            <div class="col-md" style="min-height: 400px;">
                <div class="col-md" style="margin-right: 40px;">
                    <h1>Approve a Brand</h1>
                      <table id="brands" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Brand Name</th>
                                <th>Email</th>
                                <th>Approve?</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php
                          foreach ($brands as $brand) {
                           echo "<tr>
                              <form action='../../database/admin_approve_brand.php?bId=".$brand['uid']."' method='POST'>
                                <td>".$brand['b_username']."</td>
                                <td>".$brand['brand_name']."</td>
                                <td>".$brand['b_email']."</td>
                                <td><input type='submit' class='btn btn-success btn-md' name='approve' value='Approve'></td>
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
                                <th>Brand Name</th>
                                <th>Email</th>
                                <th>Approve?</th>
                            </tr>
                        </tfoot>
                    </table>
                             
                </div>              
    
            </div>              
        </div>
   

    <?php require "../../templates/admin/admin_footer.php"; ?>
	<!-- Include Javascript files -->
    <!-- <script src="../../js/smooth-scroll.js"></script> -->
</body>
</html>
