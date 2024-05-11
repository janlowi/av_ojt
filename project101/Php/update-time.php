<?php 
session_start();
include 'db_connect.php';



// Connect to the database
// Include necessary files and initialize database connection

// Step 1: Query the Database

// Step 1: Disable Auto-Update
$disable_auto_update_sql = "ALTER TABLE timesheet MODIFY COLUMN timestamp TIMESTAMP";
mysqli_query($connect, $disable_auto_update_sql);

$sql = "SELECT user_id, timestamp  FROM timesheet WHERE DATE(timestamp) = DATE_SUB(CURDATE(), INTERVAL 1 DAY )
AND event_type = 'In' 
AND user_id 
NOT IN (SELECT user_id  FROM timesheet WHERE DATE(timestamp) = DATE_SUB(CURDATE(), INTERVAL 1 DAY)  AND event_type = 'Out')";

$result = mysqli_query($connect, $sql);

// Step 2: Execute the Query
if ($result) {
    // Ste 3: Process the Results
    if (mysqli_num_rows($result) > 0) {
        echo "Users who have failed to clock out yesterday:<br>";
        while ($row = mysqli_fetch_assoc($result)) {
            $user_id = $row['user_id'];
            $yesterday_In_timestamp=$row['timestamp'];

            // Additional processing or display logic here
            echo "User ID: $user_id<br>";
            echo "User ID:  $yesterday_In_timestamp<br>";

        }
        if (isset($_POST['submit'])){
            $date=$_POST['dateNtime'];
            $timeIn= strtotime($yesterday_In_timestamp);
            $timeOut = strtotime($date);

            // echo "Time In: " . date('Y-m-d H:i:s', $timeIn) . "<br>";
            // echo "Time Out: " . date('Y-m-d H:i:s', $timeOut) . "<br>";
            // echo "Time Out: " . date('Y-m-d H:i:s', $current_time) . "<br>";

            if ($timeOut >  $timeIn) {


                $timeDifferenceSeconds = $timeOut - $timeIn;
                $totalHours = $timeDifferenceSeconds/3600;
                $totalHours = round($totalHours, 2);


            
            $sql1= "INSERT INTO timesheet (user_id, timestamp, event_type, total_hours ) VALUES ('$user_id','$date', 'Out', '$totalHours' )";
            $query1=mysqli_query($connect,$sql1);

            if($query1==1){
                echo "User ID: $user_id has been clocked out successfully";
            }
        }


    }



            // Step 3: Re-enable Auto-Update
            $enable_auto_update_sql = "ALTER TABLE timesheet MODIFY COLUMN timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP";
            mysqli_query($connect, $enable_auto_update_sql);


    } else {
        echo "No users have failed to clock out today.";
    } 
} else {
    // Handle query execution error
    echo "Error executing query: " . mysqli_error($connect);
}

// Close database connection
// Perform any necessary cleanup

// Exit the script
?>

<form action="update-time.php" method = "POST">
  <label for="birthdaytime">Birthday (date and time):</label>
  <input type="datetime-local" id="birthdaytime" name="dateNtime">
  <input type="submit" name ='submit'>
</form>