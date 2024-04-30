<?php
include 'db_connect.php';
session_start();


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
                    reports rp 
                                SET
                                rp.dos = '$dos',
                                rp.doe = '$doe',
                                rp.assigned_dept = '$assigned_department',
                                rp.summary = '$summary',
                                rp.accomplishment = '$accomplishments',
                                rp.challenges = '$challenges',
                                rp.learnings = '$learning'
    
                                 WHERE rp.user_id ='$user_id'  
                                 AND rp.id='$report_id' 
                                 ";

    $query=mysqli_query($connect, $update);

    if($query==1){
        $_SESSION['update_success'] = "Report Updated Successfully";
        header('location: ../Biweekly/DisplayReports.php');
    }else {
        $_SESSION['update_error'] = "Report Failed Successfully";
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
    $status = $_SESSION['status'];

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
                    reports rp 
                                SET
                                rp.dos = '$dos',
                                rp.doe = '$doe',
                                rp.assigned_dept = '$assigned_department',
                                rp.summary = '$summary',
                                rp.accomplishment = '$accomplishments',
                                rp.challenges = '$challenges',
                                rp.learnings = '$learning'
    
                                 WHERE rp.user_id ='$user_id'  
                                 AND rp.id='$report_id' 
                                 ";

    $query=mysqli_query($connect, $update);

    if($query==1){
        $_SESSION['update_success'] = "Report Saved Successfully";
        header('location: ../Biweekly/DisplayReports.php');

    }else {
        $_SESSION['update_error'] = "Report Failed Successfully";
        header('location: ../Biweekly/DisplayReports.php');
    }
}


?>
