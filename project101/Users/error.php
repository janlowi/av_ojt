<?php

session_start();  

include '../Login/index.php';

if (isset($_POST['login'])) {
    require 'db_connect.php';
    
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    
    $stmt = $connect->prepare("SELECT * FROM `user` WHERE `username`=? AND `password`=?");
    $stmt->bind_param("sss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        echo "<center><label class='text-success'>Login success!</label></center>";
    } else {
        if (!isset($_SESSION['attempt'])) {
            $_SESSION['attempt'] = 0;
        }
        $_SESSION['attempt'] += 1;
        
        if ($_SESSION['attempt'] === 3) {
            $_SESSION['msg'] = "disabled";
        }
        
        echo "<center><label class='text-danger'>Invalid username or password</label></center>";
    }
}
?>