<?php
function checkLoggedIn() {
    // Start session
  
    // Check if 'logged_in' key is not set or not true
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
        // Redirect to login page
        header('location: ../Login/index.php');
        exit();
    }
}
?>
        <!-- <script>
            windows.location.href= '../Login/index.php';
        </script> -->

<!-- //  function checkUserType(){
//      if(isset($_SESSION['usertype'])&& $_SESSION['usertype'] === 'Admin') {
//        header('location: ../Admin/AdminDashboard.php');
//         exit();
//   }elseif(isset($_SESSION['usertype'])&& $_SESSION['usertype'] === 'Trainee') {
//         header('location: ../Users/UserDashboard.php');
//          exit();
//     }
//  } -->
