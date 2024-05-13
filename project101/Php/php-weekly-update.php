<?php
session_start();
include 'db_connect.php';
;


$user_id =$_SESSION['user_id'];

if($_SERVER['REQUEST_METHOD']=='POST') {

    $assigned_department = $_POST['department'];
    $dos = $_POST['start_date'];
    $doe = $_POST['end_date'];
    $summary = $_POST['summary'];
    $accomplishments = $_POST['accomplishments'];
    $challenges = $_POST['challenges'];
    $learning = $_POST['learning'];
    $report_id=$_POST['report_id'];

if(!empty($assigned_department) && 
    !empty($dos) &&
    !empty($doe) &&
    !empty($summary) &&
    !empty($accomplishments) &&
    !empty($challenges) &&
    !empty($learning)
    ) {
    $update= "UPDATE 
                    reports 
                                SET
                                dos = '$dos',
                                doe = '$doe',
                                assigned_dept = '$assigned_department',
                                summary = '$summary',
                                accomplishment = '$accomplishments',
                                challenges = '$challenges',
                                learnings = '$learning'
    
                                 WHERE user_id ='$user_id'  
                                 AND id='$report_id' 
                                 ";

    $query=mysqli_query($connect, $update);

    if($query==1){
        $_SESSION['success'] = "Report Updated Successfully";
        header('location: ../Biweekly/DisplayReports.php');
    }else {
        $_SESSION['error'] = "Report Failed Successfully";
        header('location: ../Biweekly/DisplayReports.php');
    }
}

}

?>

    <?php
    $user_id =$_SESSION['user_id'];
    $report_id = $_GET['save_report'];

    if(isset($_GET['save_report'])) {



        $assigned_department = $_SESSION['assigned_dept'];
        $dos =   $_SESSION['dos'];
        $doe =  $_SESSION['doe'];
        $summary =  $_SESSION['summary'];
        $accomplishments = $_SESSION['accomplishment'] ;
        $challenges =  $_SESSION['challenges'];
        $learning =  $_SESSION['learnings'];
        $status = 'Saved';

    if(!empty($assigned_department) && 
        !empty($dos) &&
        !empty($doe) &&
        !empty($summary) &&
        !empty($accomplishments) &&
        !empty($challenges) &&
        !empty($learning)
        ) {
        
            }
        $update= "UPDATE 
                        reports 
                                    SET
                                    assigned_dept = '$assigned_department',
                                    dos = '$dos',
                                    doe = '$doe',
                                    summary = '$summary',
                                    accomplishment = '$accomplishments',
                                    challenges = '$challenges',
                                    learnings = '$learning',
                                    status= '$status'
                            
        
                                    WHERE user_id ='$user_id'  
                                    AND id='$report_id' 
                                    ";

        $query=mysqli_query($connect, $update);

        if($query==1){
            $_SESSION['success'] = "Report Saved Successfully";
            $_SESSION['report_saved'] = true;
            header('location: ../Biweekly/DisplayReports.php');

        }else {
            $_SESSION['error'] = "Report Failed Successfully";
            header('location: ../Biweekly/DisplayReports.php');
        }
    }


    ?>
