
<?php
session_start();
include 'db_connect.php';
?>

<?php

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

        $query = "INSERT INTO reports (user_id, dos, doe, assigned_dept, summary, accomplishment, challenges, learnings, status) VALUES (?, ?, ?, ?, ?, ?, ?,?, ?)";
        $stmt= mysqli_prepare($connect, $query);
        mysqli_stmt_bind_param($stmt, 'iiissssss', $_SESSION['user_id'], $dos, $doe, $assigned_department, $summary, $accomplishments, $challenges, $learning, $status);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        // Check if the query was successful
        if(mysqli_stmt_affected_rows($stmt) > 0) {
            $_SESSION['success']= "Report submitted successfully.";
            header("Location: ../Biweekly/DisplayReports.php");
        } else {
            $_SESSION['error']= "Failed to submit.";
            header("Location: ../Users/UserDashboard.php");
        }
    } else {
        // Display errors
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }
}
?>




