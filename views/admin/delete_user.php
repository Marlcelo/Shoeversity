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
        require '../../database/get_users.php';

    ?>

    <link rel="stylesheet" type="text/css" href="../../css/dataTables.bootstrap.min.css">

    <script type="text/javascript">
      $(document).ready(function() {
        $('#users').DataTable();
      } );
    </script>
</head>
<body>
	<!-- Include header -->
	<?php include "../../templates/admin/admin_header.php"; ?>
	
    <div class="content-wrapper ">
        <div class="container text-center">
                <div class="col-md-4">
                    <img class="img-circle" src="../IMAGES/USERS/dp.jpg" width="160px" alt="profilepic">
                    <br><br><br>
                    <label for="uname">Username: </label>
                    <br>
                    
                    <hr>
                    <label for="name">Name:
                    </label>
                    <br>
                    
                    <hr>
                    <label for="email">Email:</label>
                    <br>
                    
                    <hr>
                    <label for="gnder">Gender:</label>
                    <br>
                    
                    <hr><br><br>
                    <a href=""><button class="btn btn-md btn-info">Create an Admin Account</button></a><br>
                    <a href=""><button class="btn btn-md btn-info">Delete an Admin Account</button></a><br>
                    <a href=""><button class="btn btn-md btn-info">Delete a User Account</button></a>
                </div>
                <div class="col-md-8">
                    <h1>Delete a User Account</h1>
                                  <table id="users" class="table table-striped table-bordered" style="width:100%">
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
                                      foreach ($users as $user) {
                                       echo "<tr>
                                          <form action='../../database/admin_delete_user.php?uId=".$user['uid']."' method='POST'>
                                            <td>".$user['u_username']."</td>
                                            <td>".$user['uName']."</td>
                                            <td>".$user['u_email']."</td>
                                            <td>".$user['u_gender']."</td>
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
<script src="../../js/dataTables.bootstrap.min.js"></script>
<script src="../../js/jquery-1.12.4.js"></script>
<script src="../../js/jquery.dataTables.min.js"></script>
	<!-- Include Javascript files -->
    <!-- <script src="../../js/smooth-scroll.js"></script> -->
</body>
</html>