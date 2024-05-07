<?php
session_start();
    include 'db_connect.php';
    include 'authenticate.php';

?>

<?php

$user_id= $_SESSION['user_id'];

if(isset($_POST['Time_In'])){
    date_default_timezone_set('Asia/Manila');// local timezone

$event_type = $_POST['Time_In'];
    $sql = "INSERT INTO timesheet (event_type, user_id )
             VALUES ('$event_type', '$user_id')

     ";

    $query= mysqli_query($connect, $sql);
    if($query==1){

            
        $_SESSION['success'] = "Time In Succesfully";
         header("location: ../Users/UserDashboard.php");
    }else {

        $_SESSION['error'] = "Failed to time in";
        header("location: ../Users/UserDashboard.php");
    }
}

?>

        <?php

    if(isset($_POST['Time_Out'])){  
        date_default_timezone_set('Asia/Manila'); // local timezone

        $user_id = $_SESSION['user_id'];
        $event_type = $_POST['Time_Out'];

        $sql = "SELECT timestamp, event_type FROM timesheet WHERE DATE(timestamp) = CURDATE() AND user_id = '$user_id'";
        $query = mysqli_query($connect, $sql);
        $row = mysqli_fetch_assoc($query);

        if ($row) {
            $current_time = time();
            $timeIn = strtotime(($row['timestamp']));
            $timeOut = $current_time;

            // echo "Time In: " . date('Y-m-d H:i:s', $timeIn) . "<br>";
            // echo "Time Out: " . date('Y-m-d H:i:s', $timeOut) . "<br>";
            // echo "Time Out: " . date('Y-m-d H:i:s', $current_time) . "<br>";

            if ($timeOut > $timeIn) {


                $timeDifferenceSeconds = $timeOut - $timeIn;
                $totalHours = $timeDifferenceSeconds/3600;
                $totalHours = round($totalHours, 2);
            
                // echo "Time Difference (Seconds): " . $timeDifferenceSeconds . "<br>";
                if ($timeDifferenceSeconds < (2 * 3600)) {
                    $_SESSION['error'] = "You cannot time out within 2 hours of your last time in.";
                    header("location: ../Users/UserDashboard.php");
                    exit;
                }
                $sql2 = "INSERT INTO timesheet (event_type, user_id, total_hours) VALUES ('$event_type', '$user_id', '$totalHours')";
                $query2 = mysqli_query($connect, $sql2);

                if ($query2) {
                    $_SESSION['success'] = "Time Out Successfully";
                    header("location: ../Users/UserDashboard.php"); 
                    exit;
                } else {
                    $_SESSION['error'] = "Failed to time out";
                    header("location: ../Users/UserDashboard.php");
                    exit;
                }
            } else {
                $_SESSION['error'] = "Invalid time out. Time out cannot be before time in.";
                header("location: ../Users/UserDashboard.php");
                exit;
            }
        } else {
            $_SESSION['error'] = "No corresponding 'In' entry found";
            header("location: ../Users/UserDashboard.php");
            exit;
        }
    }
