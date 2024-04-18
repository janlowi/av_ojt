<?php
include ('../Php/db_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $time_out = $_POST['time_out'];
    $time_in = '8:00'; 
    
    $sql= "SELECT * 
    FROM timesheet 
    WHERE id = '$id'";

    $result = $connect->query($sql); 

    if ($result) { 

        $row = $result->fetch_assoc();

        if ($row) { 
            $time_in = $row['time_in'];
        
            if ($time_in) {
                $time_in_stamp = strtotime($time_in);
                $time_out_stamp = strtotime($time_out);
                $duration = $time_out_stamp - $time_in_stamp;
                $result_hours = abs(floor($duration / 3600));
                echo $result_hours;
            }
        } else {
            echo "No matching record found.";
        }

    } else {
        echo "Error: " . $sql . "<br>" . $connect->error; 
    }

    $connect->close(); 
}
?>