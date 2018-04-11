<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shoeversity</title>
    <link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
    <?php
        // Include Bootstrap and main styles 
        include "../../templates/users/user_bs_styles.php";
        include "../../templates/users/user_shoeversity_styles.php";

        session_start();
        // Set active page
        $_SESSION['page_type'] = "User";
        $_SESSION['active_page'] = "account";

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

        $user_uname = $_SESSION['u_username'];
        $user_email = $_SESSION['u_email'];    
        $user_gender = $_SESSION['u_gender'];
        $user_fname = $_SESSION['u_firstname'];
        $user_lname = $_SESSION['u_lastname'];
        $user_mname = $_SESSION['u_middlename'];
    ?>
    
    <link rel="stylesheet" type="text/css" href="../../css/shopping-cart-sidebar.css">
    <script type="text/javascript">
      $(document).ready(function() {
        $('#users').DataTable();
      } );
    </script>
</head>
<body>
	<!-- Include header -->
	<?php include "../../templates/users/user_header.php";
            include "../../database/user_get_purchases.php"; ?>
	
    <div class="content-wrapper">
        <div class="container ">
                <div class="col-md-2 text-center">
                    <img class="img-circle" src="../IMAGES/USERS/dp.jpg" width="160px" alt="profilepic">
                    <br><br><br>
                    <label for="uname">Username: </label>
                    <br>
                    <label class="lead"><?php echo $user_uname; ?></label>
                    <br>
                    
                    <hr>
                    <label for="name">Name:</label>
                    <br>
                    <label class="lead"><?php echo $user_fname ." ". $user_mname ." ". $user_lname; ?></label>
                    <br>
                    
                    <hr>
                    <label for="email">Email:</label>
                    <br>
                    <label class="lead"><?php echo $user_email; ?></label>
                    <br>
                    
                    <hr>
                    <label for="gnder">Gender:</label>
                    <br>
                    <label class="lead"><?php echo $user_gender; ?></label>
                    <br>
                    
                    <hr>
                </div>
                <div class="col-md-10">
                    
                      <h1 class='text-center'>Purchases History</h1>
                      <br>
                      <table id="users" class="table table-striped table-bordered table-hover" style="width:100%;">
                        <thead style="background: #eee">
                            <tr>
                                <th>Item</th>
                                <th>Brand</th>
                                <th>Size</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Color</th>
                                <th>Date of Purchase</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php
                          foreach ($purchased as $shoe) {
                            $timeStamp = strtotime($shoe['time_stamp']);
                            $date = gmdate("m/d/Y", $timeStamp);
                           echo "<tr>
                                <td>".$shoe['name']."</td>
                                <td>".$shoe['brand_name']."</td>
                                <td>".$shoe['size']."</td>
                                <td>".$shoe['category']."</td>
                                <td>".$shoe['price']."</td>
                                <td>".$shoe['color']."</td>
                                <td>".$date."</td> 
                            </tr>";
                          }

                          // while ( <= 10) {
                          //   echo "string";
                          // }
                            ?>
                        </tbody>
                  <!--   <tfoot>
                        <tr>
                            <th>Username</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Gender</th>
                            <th>Delete</th>
                        </tr>
                    </tfoot> -->
                </table>
                             
                          
            </div>              
       
	   </div>
    </div>

    <!-- BEGIN FOOTER -->
    <?php require "../../templates/users/user_footer.php"; ?>
    <!-- .END FOOTER -->
    
	<!-- Include Javascript files -->
    <!-- <script src="../../js/smooth-scroll.js"></script> -->
    <script src="../../js/shopping-cart.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
</body>
</html>