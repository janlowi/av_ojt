<?php
include('../Php/db_connect.php');


if(isset($_POST['event_type'])) {
    $event_type = $_POST['event_type'];
    
   
    $current_timestamp = time();
    
    $query = "SELECT timestamp FROM timesheet WHERE event_type = 'In' ORDER BY timestamp DESC LIMIT 1";
    $result = $connect->query($query);
    
    if ($result && $result->num_rows > 0) {
        
        $row = $result->fetch_assoc();
        $last_timestamp = strtotime($row['timestamp']);
        
        
        $duration_hours = ($current_timestamp - $last_timestamp) / 3600;
    } else {
        
        $duration_hours = 0;
    }
    
    
  $stmt = $connect->prepare("INSERT INTO timesheet (event_type, timestamp, total_hours,trainee_id) VALUES (?, NOW(), ?,1)");
$stmt->bind_param("ss", $event_type,  $duration_hours);



    
    if ($stmt->execute() === TRUE) {

        echo "Time " . ($event_type == 'In' ? 'In' : 'Out') . " recorded.";
    } else {
        echo "Error: ". $stmt->error;
    }
    
  $stmt->close();
} else {
    echo "Error: Event type not set.";
}
?>