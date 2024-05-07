<?php
session_start();
include '../Php/db_connect.php';


if(!isset($_SESSION['id'])){
    header('location: ../Login/index.php');

    exit;
}
$_SESSION['logged_in'] = true;


 
session_destroy();

?>