<?php
    $highlight = $_SESSION['admin_fxn'];
?>


<nav class=" navbar-inverse">
        <div class="sidenav">
            <ul class="nav nav-pills nav-stacked">
                <li <?php if($highlight == 'dashboard') echo "class='active'"; ?>><a href="dashboard.php"><i class="glyphicon glyphicon-home"></i>   Home</a></li>
                <h3>Management</h3>
                    <li <?php if($highlight == 'approve_brand') echo "class=''"; ?>><a href="approve_brand.php"><i class="glyphicon glyphicon-ok"></i>  Approve a Brand</a></li>
                    <li <?php if($highlight == 'view_logs') echo "class='active'"; ?>><a href="view_audit_logs.php"><i class="glyphicon glyphicon-folder-open"></i>   View Audit Logs</a></li>
                <h3>Users</h3>
                    <li <?php if($highlight == 'create_admin') echo "class='active'"; ?>><a href="register_admin.php"><i class="glyphicon glyphicon-plus"></i>  Create an Admin</a></li>
                    <li <?php if($highlight == 'delete_admin') echo "class='active'"; ?>><a href="delete_admin.php"><i class="glyphicon glyphicon-minus"></i>  Delete an Admin</a></li>
                    <li <?php if($highlight == 'delete_user') echo "class='active'"; ?>><a href="delete_user.php"><i class="glyphicon glyphicon-minus"></i>  Delete a User</a></li>
            </ul>   
        </div>
 </nav>