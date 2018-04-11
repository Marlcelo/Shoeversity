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
        $_SESSION['admin_fxn'] = "approve_brand";

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
        else {
            $token = $_SESSION['sessionToken'];
        }

        // Check if user is authorized to access page
        include '../../database/check_access.php';
        require '../../database/get_unverified_brands.php';

        if(isset ($_GET['approvebrand'])){
            $_SESSION['warning_msg'] = "Are you sure you want to approve this brand?";
            $_SESSION['target_page'] = "../../database/admin_approve_brand.php?bId=" . $_GET['approvebrand'];
            include '../modals/warning.php';
            echo "<script> 
            $('#warning_modal').modal('show');
            $('#warning_modal').on('hidden.bs.modal', function () { 
               window.location = 'approve_brand.php?token=".$token."';
           })
           </script>";
        }

        
        if(isset ($_GET['deletebrand'])){
            $_SESSION['warning_msg'] = "Are you sure you want to remove this brand?";
            $_SESSION['target_page'] = "../../database/admin_delete_brand.php?bId=" . $_GET['deletebrand'];
            include '../modals/warning.php';
            echo "<script> 
            $('#warning_modal').modal('show');
            $('#warning_modal').on('hidden.bs.modal', function () { 
               window.location = 'approve_brand.php?token=".$token."';
           })
           </script>";
        }

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
    
    <div class="container main">
        <div class="col-md" style="min-height: 350px; padding-right: 25px;">
                <h1 class="text-center">Approve a Brand</h1>
                <br>
                <table id="brands" class="table table-striped table-bordered table-hover" style="width:100%;">
                	<thead style="background: #eee">
                		<tr>
                			<th>Username</th>
                			<th>Brand Name</th>
                			<th>Email</th>
                			<th>Action</th>
                		</tr>
                	</thead>
                	<tbody>
                		<?php
                		foreach ($brands as $brand) {
                            $approveLoc = "window.location.href='approve_brand.php?approvebrand=".$brand['uid']. "&token=$token";
                            $deleteLoc = "window.location.href='approve_brand.php?deletebrand=".$brand['uid']. "&token=$token";
                            $approveLoc = "hello";

                			echo "<tr>
                			<td>".$brand['b_username']."</td>
                			<td>".$brand['brand_name']."</td>
                			<td>".$brand['b_email']."</td>
                			<td class='text-center'>
                                <button type='button' class='btn btn-success btn-md' onclick='alert("."hello".")'>Approve Brand
                                </button>   
                                <button type='button' class='btn btn-danger btn-md' onclick='$deleteLoc'>Delete Brand
                                </button>
                            </td>
                			</tr>";
                		}

						// while ( <= 10) {
						//   echo "string";
						// }
                		?>
                	</tbody>
                	<!-- <tfoot>
                		<tr>
                			<th>Username</th>
                			<th>Brand Name</th>
                			<th>Email</th>
                			<th>Approve?</th>
                		</tr>
                	</tfoot> -->
                </table>
                         
            <!-- </div>               -->

        </div>              
    </div>
   

    <?php require "../../templates/admin/admin_footer.php"; ?>
	<!-- Include Javascript files -->
    <!-- <script src="../../js/dataTables.bootstrap.min.js"></script>
    <script src="../../js/jquery-1.12.4.js"></script>
    <script src="../../js/jquery.dataTables.min.js"></script> -->

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
</body>
</html>
