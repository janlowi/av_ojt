<?php
include('../Php/db_connect.php');


<<<<<<< HEAD


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if event_type is set and not empty
    if (isset($_POST["event_type"]) && !empty($_POST["event_type"])) {
        $event_type = $_POST["event_type"];
        
      
        $sql = "INSERT INTO timesheet (event_type, timestamp) VALUES ('$event_type', NOW())";
        
        if (mysqli_query($conn, $sql)) {
            echo "Record added successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Error: Event type not provided";
    }
}
=======
>>>>>>> 22ec3338ac300e6731f213d7e136e4f1c6efa336
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
<<<<<<< HEAD
    //echo "Error: Event type not set.";
=======
    echo "Error: Event type not set.";
>>>>>>> 22ec3338ac300e6731f213d7e136e4f1c6efa336
}
?>