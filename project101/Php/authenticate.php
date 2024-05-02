
<?php
include 'db_connect.php';

// Check if user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || $_SESSION['email'] === null) {
    // Redirect user to login page if not logged in
    header("Location: ../Login/index.php");
    exit();
}
?>