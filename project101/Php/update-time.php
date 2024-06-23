<?php 
session_start();
include 'db_connect.php';
$usertype = $_SESSION['usertype'];
include 'authenticate.php';


// Connect to the database
// Include necessary files and initialize database connection

$disable_auto_update_sql = "ALTER TABLE timesheet MODIFY COLUMN timestamp TIMESTAMP";
mysqli_query($connect, $disable_auto_update_sql);


        if (isset($_POST ['update_time'])){
            date_default_timezone_set('Asia/Manila'); // local timezone
            $user_id=$_POST['failed_to_out'];
            $date=$_POST['dateNtime'];
            $department_id=$_POST['department_id'];
            $yesterday_In_timestamp=$_POST['yesterday_In_timestamp'];
            $yesterday_date = date('Y-m-d', strtotime($yesterday_In_timestamp));
            $timestamp = $yesterday_date.' '.$date;

            $timeIn= strtotime($yesterday_In_timestamp);
            $timeOut = strtotime($timestamp);

            // echo "Time In: " . date('Y-m-d H:i:s', $timeIn) . "<br>";
            // echo "Time Out: " . date('Y-m-d H:i:s', $timeOut) . "<br>";
            // echo "Time Out: " . date('Y-m-d H:i:s', $current_time) . "<br>";

            if ($timeOut >  $timeIn) {

                $timeDifferenceSeconds = $timeOut - $timeIn;
                $totalHours = $timeDifferenceSeconds/3600;
                $totalHours = round($totalHours, 2);
                if ($timeDifferenceSeconds < (2 * 3600)) {
                    $_SESSION['error'] = "You cannot time out within 2 hours of your last time in.";
                    $redirect_url = ($usertype === 'Admin') ? '../Timesheet/DisplayAdmin.php' : '../Timesheet/DisplayManager.php';
                    header("location: $redirect_url");
                    exit();
                }else{

                    $sql1= "INSERT INTO timesheet (user_id, timestamp, event_type, total_hours ) VALUES ('$user_id',  FROM_UNIXTIME($timeOut), 'Out', '$totalHours' )";
                    $query1=mysqli_query($connect,$sql1);
        
                    if($query1==1){
                        $status = [
                            "Admin" => 4,
                            "Manager" => 5,
                      
                          ];
                          $comment_status = $status[$usertype];
                          $sql = "UPDATE notifications SET comment_status = ? WHERE user_id = ? AND department_id = ? AND comment_status = 0";
                          $stmt = mysqli_prepare($connect, $sql);
                          mysqli_stmt_bind_param($stmt, "iii", $comment_status, $user_id, $department_id);
                          $result = mysqli_stmt_execute($stmt);
                          mysqli_stmt_close($stmt);


                        $_SESSION['success']= "User ID: $user_id has been clocked out successfully";
                        $redirect_url = ($usertype === 'Admin') ? '../Timesheet/DisplayAdmin.php' : '../Timesheet/DisplayManager.php';
                        header("location: $redirect_url");
                        exit();
                    }
                }  $_SESSION['error'] = "Update failed.";
                $redirect_url = ($usertype === 'Admin') ? '../Timesheet/DisplayAdmin.php' : '../Timesheet/DisplayManager.php';
                header("location: $redirect_url");
                exit();
        
              
                }
                $_SESSION['error'] = "Time out should be greater than time in.";
                $redirect_url = ($usertype === 'Admin') ? '../Timesheet/DisplayAdmin.php' : '../Timesheet/DisplayManager.php';
                header("location: $redirect_url");
                exit();
          
    }
    $redirect_url = ($usertype === 'Admin') ? '../Timesheet/DisplayAdmin.php' : '../Timesheet/DisplayManager.php';
    header("location: $redirect_url");
    exit();


            // Step 3: Re-enable Auto-Update
            $enable_auto_update_sql = "ALTER TABLE timesheet MODIFY COLUMN timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP";
            mysqli_query($connect, $enable_auto_update_sql);


   

?>

