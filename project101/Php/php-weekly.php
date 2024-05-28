
<?php
session_start();
include 'db_connect.php';
$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    // Check if required fields are not empty
    if (empty($_POST['department'])) {
        $errors[] = "Department is required.";
    }
    if (empty($_POST['start_date'])) {
        $errors[] = "Start date is required.";
    }
    if (empty($_POST['end_date'])) {
        $errors[] = "End date is required.";
    }
    if (empty($_POST['summary'])) {
        $errors[] = "Summary is required.";
    }
    if (empty($_POST['accomplishments'])) {
        $errors[] = "Accomplishments is required.";
    }
    if (empty($_POST['challenges'])) {
        $errors[] = "Challenges is required.";
    }
    if (empty($_POST['learning'])) {
        $errors[] = "Learning is required.";
    }

    // If there are no errors, proceed with insertion
    if (empty($errors)) {
        $assigned_department = $_POST['department'];
        $dos = $_POST['start_date'];
        $doe = $_POST['end_date'];
        $summary = $_POST['summary'];
        $accomplishments = $_POST['accomplishments'];
        $challenges = $_POST['challenges'];
        $learning = $_POST['learning'];
        $status = "Pending";

        if($dos >= $doe){
            $error= "Start date must be before end date.";
            $_SESSION['error']= $error;
            header("Location: ../Users/UserDashboard.php");
            exit();
        }else {

        $query = "INSERT INTO reports (user_id, dos, doe, assigned_dept, summary, accomplishment, challenges, learnings, status) VALUES (?, ?, ?, ?, ?, ?, ?,?, ?)";
        $stmt = mysqli_prepare($connect, $query);
        mysqli_stmt_bind_param($stmt, 'issssssss', $_SESSION['user_id'], $dos, $doe, $assigned_department, $summary, $accomplishments, $challenges, $learning, $status);
        mysqli_stmt_execute($stmt);

        // Check if the query was successful
        if(mysqli_stmt_affected_rows($stmt) > 0) {
            $_SESSION['success']= "Report submitted successfully.";
            header("Location: ../Reports/DisplayReports.php");
            exit();
        } else {
            $_SESSION['error']= "Failed to submit.";
            header("Location: ../Reports/DisplayReports.php");
            exit();
        }
    } 
}else {
    // Display errors
    foreach ($errors as $error) {
        $_SESSION['error']= $error;
        header("Location: ../Users/UserDashboard.php");
         exit();
    }
}
}
?>




