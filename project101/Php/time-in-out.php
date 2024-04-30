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

            $sql2 = "SELECT TIME_FORMAT(timestamp, '%H:%i'),
                            event_type,
            FROM timesheet
            WHERE date(timestamp) = CURDATE()
            AND user_id = '$user_id'

            ";
            $query2= mysqli_query($connect, $sql2);
            $row = mysqli_fetch_array($query2);
            $time = $row['TIME_FORMAT(timestamp, \'%H:%i\')'];
            $In = $row['event_type'];


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
            $event_type = $_POST['Out'];

            $sql = "INSERT INTO timesheet (event_type, user_id)
            VALUES ('$event_type', '$user_id')
                ";

            $query= mysqli_query($connect, $sql);
            if($query==1){

                $_SESSION['success'] = "Time Out Succesfully";
                    header("location: ../Users/UserDashboard.php");
            }else {

                $_SESSION['error'] = "Failed to time out";
                header("location: ../Users/UserDashboard.php");
            }
        }

?>
