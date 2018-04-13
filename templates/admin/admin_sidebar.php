<?php
    if(!isset($_SESSION)) {
        session_start();
    }
    $token = $_SESSION['sessionToken'];
    $highlight = $_SESSION['admin_fxn'];
?>


<nav class=" navbar-inverse">
    <div class="sidenav">
        <ul class="nav nav-pills nav-stacked">
            <li <?php if($highlight == 'dashboard') echo "class='active'"; ?>><a href="dashboard.php?token=<?php echo $token ?>">
                <i class="glyphicon glyphicon-home"></i>&nbsp;   Home</a>
            </li>

            <h3>Management</h3>
                <li <?php if($highlight == 'approve_brand') echo "class='active'"; ?>>
                    <a href="approve_brand.php?token=<?php echo $token ?>"><i class="glyphicon glyphicon-ok"></i>&nbsp;  Approve a Brand</a>
                </li>
                <li <?php if($highlight == 'view_logs') echo "class='active'"; ?>>
                    <a href="reauthentication.php?token=<?php echo $token ?>"><i class="glyphicon glyphicon-folder-open"></i>&nbsp;  View Audit Logs</a>
                </li>

            <h3>Users</h3>
                <li <?php if($highlight == 'create_admin') echo "class='active'"; ?>>
                    <a href="register_admin.php?token=<?php echo $token ?>"><i class="glyphicon glyphicon-plus"></i>&nbsp;  Create an Admin</a>
                </li>
                <li <?php if($highlight == 'delete_admin') echo "class='active'"; ?>>
                    <a href="delete_admin.php?token=<?php echo $token ?>"><i class="glyphicon glyphicon-minus"></i>&nbsp; Delete an Admin</a>
                </li>
                <li <?php if($highlight == 'delete_brand') echo "class='active'"; ?>>
                    <a href="delete_brand.php?token=<?php echo $token ?>"><i class="glyphicon glyphicon-minus"></i>&nbsp; Delete a Brand</a>
                </li>
                <li <?php if($highlight == 'delete_user') echo "class='active'"; ?>>
                    <a href="delete_user.php?token=<?php echo $token ?>"><i class="glyphicon glyphicon-minus"></i>&nbsp;  Delete a User</a>
                </li>
        </ul>   
    </div>
 </nav>