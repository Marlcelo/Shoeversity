 <?php 
/**
 * [callErrorModal displays the Unauthorized Access modal depending on which page the user is trying
 * to access]
 * @return [void] 
 */
function callUnauthorizedAccessModal() {
    include '../modals/unauthorized_access.php';
    
    echo "<script> 
        window.stop();
        $('#unauthorized_access').modal('show');
        $('#unauthorized_access').on('hidden.bs.modal', function () { //reload login form
           window.location = '../login.php';
        })
        </script>";
}

/**
 * [callErrorModal displays the Restricted Access modal depending on which page the user is trying
 * to access]
 * @return [void] 
 */
function callRestrictedAccessModal() {
    include '../modals/restricted_access.php';
    
    echo "<script> 
        window.stop();
        $('#restricted_access').modal('show');
        $('#restricted_access').on('hidden.bs.modal', function () { //go back to prev page
           window.history.back();
        })
        </script>";
}


/***************************************************/
/*                  END FUNCTIONS                  */
/***************************************************/

 // Check if user is authorized to access page
if(isset($_SESSION['access_granted'])) {
    if($_SESSION['access_granted'] == 'Admin') {
        if($_SESSION['page_type'] != 'Admin') {
            callRestrictedAccessModal();
        }
    }
    else if($_SESSION['access_granted'] == 'Brand') {
        if($_SESSION['page_type'] != 'Brand') {
            callRestrictedAccessModal();
        }
    }
    else if($_SESSION['access_granted'] == 'User') {
        if($_SESSION['page_type'] != 'User') {
            callRestrictedAccessModal();
        }
    }
}
else { // User has not logged in
    callUnauthorizedAccessModal();
}

?>