
<?php
include 'db_connect.php';

// Check if user is logged in
if (!isset($_SESSION['logged_in_Admin']) || $_SESSION['logged_in_Admin'] !== true || $_SESSION['email'] === null) {
    // Redirect user to login page if not logged in
    header("Location: ../Login/index.php");
    exit();
}elseif(!isset($_SESSION['logged_in_Trainee']) || $_SESSION['logged_in_Trainee'] !== true || $_SESSION['email'] === null){
      header("Location: ../Login/index.php");
    exit();
}
?>