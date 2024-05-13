<?php 
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: ../Login/index.php");
    exit();
}
$title="Trainee's Responses";
include '../Layouts/main.php'; 
 include '../Layouts/sidebar.php';
 include '../Layouts/navbar.php';
 include '../Php/db_connect.php';

?>  