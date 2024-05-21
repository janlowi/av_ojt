<?php

<include ('../LOGIN/index.php')
<?php
if(ISSET($_POST['login'])){
    require 'conn.php';
    $username=$_POST['username'];
    $password=$_POST['password'];
    $query=mysqli_query($conn, "SELECT * FROM `user` WHERE `username`='$username' AND `password`='$password'") or die(mysqli_error());
    if($row > 0){
        echo "<center><label class='text-success'>Login success!</label></center>";
    }else{
        if(!ISSET($_SESSION['attempt'])){
            $_SESSION['attempt'] = 0;
        }
        $_SESSION['attempt'] += 1;
        if($_SESSION['attempt'] === 3){
            $_SESSION['msg'] = "disabled";
        }
        echo "<center><label class='text-danger'>Invalid username or password</label></center>";
    }
}
?>