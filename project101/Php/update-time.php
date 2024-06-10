<?php 
session_start();
include 'db_connect.php';



// Connect to the database
// Include necessary files and initialize database connection

$disable_auto_update_sql = "ALTER TABLE timesheet MODIFY COLUMN timestamp TIMESTAMP";
mysqli_query($connect, $disable_auto_update_sql);


        if (isset($_POST ['update_time'])){
            $user_id=$_POST['failed_to_out'];
            $date=$_POST['dateNtime'];
            $yesterday_In_timestamp=$_POST['yesterday_In_timestamp'];
            $department=$_POST['department_id'];
            $timeIn= strtotime($yesterday_In_timestamp);
            $timeOut = strtotime($date);
            // echo "Time In: " . date('Y-m-d H:i:s', $timeIn) . "<br>";
            // echo "Time Out: " . date('Y-m-d H:i:s', $timeOut) . "<br>";
            // echo "Time Out: " . date('Y-m-d H:i:s', $current_time) . "<br>";

            if ($timeOut >  $timeIn) {

                $timeDifferenceSeconds = $timeOut - $timeIn;
                $totalHours = $timeDifferenceSeconds/3600;
                $totalHours = round($totalHours, 2);

            $sql1= "INSERT INTO timesheet (user_id, department_id, timestamp, event_type, total_hours ) VALUES ('$user_id', '$department', '$date', 'Out', '$totalHours' )";
            $query1=mysqli_query($connect,$sql1);

            if($query1==1){
                $_SESSION['success']= "User ID: $user_id has been clocked out successfully";
                header('location: ../Timesheet/DisplayAdmin.php');
                exit();
            }
        }


    }



            // Step 3: Re-enable Auto-Update
            $enable_auto_update_sql = "ALTER TABLE timesheet MODIFY COLUMN timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP";
            mysqli_query($connect, $enable_auto_update_sql);


   

?>

