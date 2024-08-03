<?php
session_start();
include 'db_connect.php';
;


$user_id =$_SESSION['user_id'];

if($_SERVER['REQUEST_METHOD']=='POST') {

    $assigned_department = mysqli_real_escape_string($connect, $_POST['department']);
    $dos = mysqli_real_escape_string($connect, $_POST['start_date']);
    $doe = mysqli_real_escape_string($connect, $_POST['end_date']);
    $summary = mysqli_real_escape_string($connect, $_POST['summary']);
    $accomplishments = mysqli_real_escape_string($connect, $_POST['accomplishments']);
    $challenges = mysqli_real_escape_string($connect, $_POST['challenges']);
    $learning = mysqli_real_escape_string($connect, $_POST['learning']);
    $report_id=mysqli_real_escape_string($connect, $_POST['report_id']);

    if (!empty($assigned_department) &&
    !empty($dos) &&
    !empty($doe) &&
    !empty($summary) &&
    !empty($accomplishments) &&
    !empty($challenges) &&
    !empty($learning)
) {
    $update = "UPDATE reports 
               SET dos = '$dos',
                   doe = '$doe',
                   department_id = '$assigned_department',
                   summary = '$summary',
                   accomplishment = '$accomplishments',
                   challenges = '$challenges',
                   learnings = '$learning'
               WHERE user_id ='$user_id'  
               AND id='$report_id'";

    $query = mysqli_query($connect, $update);

    if ($query === false) {
        // Log MySQL error
        error_log("MySQL Error: " . mysqli_error($connect));
        $_SESSION['error'] = "Report update failed";
        header('location: ../Reports/DisplayReports.php');
        exit(); // Stop execution
    } else {
        $_SESSION['success'] = "Report updated successfully";
        header('location: ../Reports/DisplayReports.php');
        exit(); // Stop execution
    }
} else {
    $_SESSION['error'] = "Please fill in all fields";
    header('location: ../Reports/DisplayReports.php');
    exit(); // Stop execution
}
}


?>

    <?php
    $user_id =$_SESSION['user_id'];
  
    if(isset($_GET['save_report'])) {
        $report_id = $_GET['save_report'];

        $status = 'Submitted';
        $update= "UPDATE 
                        reports 
                                    SET

                                    status= '$status'
                            
        
                                    WHERE user_id ='$user_id'  
                                    AND id='$report_id' 
                                    ";

        $query=mysqli_query($connect, $update);

        if($query==1){
            $_SESSION['success'] = "Report Saved Successfully";
            $_SESSION['report_saved'] = true;
            header('location: ../Reports/DisplayReports.php');

        }else {
            $_SESSION['error'] = "Report Failed Successfully";
            header('location: ../Reports/DisplayReports.php');
        }
    }


    ?>
