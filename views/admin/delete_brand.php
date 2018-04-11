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
        $_SESSION['admin_fxn'] = "delete_brand";


        // Check if user is authorized to access page
        include '../../database/check_access.php';
        require '../../database/get_brands.php';

        if(isset ($_GET['deletebrand'])){
            $_SESSION['warning_msg'] = "Are you sure you want to remove this brand?";
            $_SESSION['target_page'] = "../../database/admin_delete_brand.php?bId=" . $_GET['deletebrand'];
            include '../modals/warning.php';
            echo "<script> 
            $('#warning_modal').modal('show');
            $('#warning_modal').on('hidden.bs.modal', function () { 
               window.location = 'delete_brand.php';
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
                <h1 class="text-center">Delete a Brand</h1>
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
                			echo "<tr>
                			<form method='GET'>
                			<td>".$brand['b_username']."</td>
                			<td>".$brand['brand_name']."</td>
                			<td>".$brand['b_email']."</td>
                			<td class='text-center'><button type='submit' class='btn btn-success btn-md' name='deletebrand' value=".$brand['uid']." >Delete Brand</button></td>
                			</form>  
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