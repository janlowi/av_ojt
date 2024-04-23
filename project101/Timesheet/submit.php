<?php
include('../Php/db_connect.php');


if(isset($_POST['event_type'])) {
  
    $event_type = $_POST['event_type'];
    
    if ($connect->connect_error) {
        die("Connection failed: " . $connect->connect_error);
    }
    
    
    $stmt = $connect->prepare("INSERT INTO timesheet (event_type, timestamp) VALUES (?, NOW())");
    $stmt->bind_param("i", $event_type);
    
    
    if ($stmt->execute() === TRUE) {
        echo "Time " . ($event_type == 'In' ? 'In' : 'Out') . " recorded.";
    } else {
        echo "Error: " . $stmt->error;
    }
    
    
    $stmt->close();
    $connect->close();
} else {
    echo "Error: Event type not set.";
}
?>