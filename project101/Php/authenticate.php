<?php


if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {

    header("Location: ../Login/index.php");
    exit();
} else {

    if (isset($_SESSION['Admin'])===true) {
        header("Location: ../Admin/AdminDashboard.php");
        exit();
    } elseif (isset($_SESSION['Trainee'])===true) {
        header("Location: ../Users/UserDashboard.php");
        exit();
    }
}

header("Location: ../Login/index.php");
exit();

?>
