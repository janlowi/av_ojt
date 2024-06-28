<?php
        $servername = "localhost";
        $username = "db_user";
        $password = "RibZ09_0yKPxl8BI";
        $database = "avojt101";
        
    $connect = new mysqli ($servername, $username, $password, $database);
    if($connect->connect_error) {
       die("Connection failed: " . $connect->connect_error);
    } else {
        // echo "connected successfuly.";
    }

?>