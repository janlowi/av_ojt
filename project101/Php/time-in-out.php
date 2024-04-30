<?php
    include 'db_connect.php';
    session_start();

?>

<?php

$user_id= $_SESSION['user_id'];

if(isset($_POST['time_in'])){

    $time_in = $_POST['time_in'];
    $sql = "INSERT INTO timesheet event_type ='$time_in' user_id='$user_id' 
            WHERE user_id = '$user_id'
     ";
}

?>

