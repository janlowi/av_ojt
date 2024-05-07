
<?php
include 'db_connect.php';

// Check if user is logged in as Admin or Trainee
if (!isset($_SESSION['Admin']) && !isset($_SESSION['Trainee']) || !isset($_SESSION['email']) || !isset($_SESSION['user_id'])) {
    // Redirect user to login page if not logged in
    header("Location: ../Login/index.php");
    exit();
}
?>
