
<?php
include 'db_connect.php';

// Check if user is logged in as Admin or Trainee
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Redirect user to login page if not logged in
    header("Location: ../Login/index.php");
    exit();
// }elseif(isset($_SESSION['Admin']) || isset($_SESSION['Trainee']) || isset($_SESSION['email']) || isset($_SESSION['user_id'])){

}

// if (basename($_SERVER['PHP_SELF']) === 'index.php') {
//     // Redirect to dashboard
//     if(isset($_SESSION['Admin'])){
//         header('location: ../Admin/AdminDashboard.php');
//         exit();
//     }elseif(isset($_SESSION['Trainee'])) {
//         header('location: ../Users/UserDashboard.php');
//         exit();
//     }

// }
?>
