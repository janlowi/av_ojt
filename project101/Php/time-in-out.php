<?php
    include 'db_connect.php';
    session_start();

?>

<?php

$user_id= $_SESSION['user_id'];

if(isset($_POST['In'])){

    $event_type = $_POST['In'];

    $sql = "INSERT INTO timesheet (event_type, user_id)
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

if(isset($_POST['Out'])){  

    $user_id = $_SESSION['user_id'];
    $event_type = $_POST['Out'];
    $current_time = date('H:i:s');


    $sql = "SELECT * FROM timesheet WHERE DATE(timestamp) = CURDATE() AND user_id = '$user_id'";
    $query = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($query);

        if ($row['event_type'] == 'In') {
            $timeIn = strtotime($row['timestamp']);
            $timeOut = strtotime($current_time);
        
            if ($timeOut > $timeIn) {

                $timeDifferenceSeconds = $timeOut - $timeIn;
        
                $totalHours = $timeDifferenceSeconds /3600;
                $totalHours = round($Hours, 2);
            } else {
                $totalHours = 0;
            }
        

        $sql2 = "INSERT INTO timesheet (event_type, user_id, total_hours) VALUES ('$event_type', '$user_id', $totalHours)";
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
        $_SESSION['error'] = "No corresponding 'In' entry found";
        header("location: ../Users/UserDashboard.php");
        exit;
    }
}
?>
