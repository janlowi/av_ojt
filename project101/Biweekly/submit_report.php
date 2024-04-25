<?php
include 'db_conn.php';
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Define the filename for storing form data
    // $filename = "index.php";

    // Extract form data
    $department = $_POST['department'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $summary = $_POST['summary'];
    $accomplishments = $_POST['accomplishments'];
    $challenges = $_POST['challenges'];
    $learning = $_POST['learning'];

    // Prepare the data to be written to the file
    // $data = "Department: $department\n";
    // $data .= "Start Date: $start_date\n";
    // $data .= "End Date: $end_date\n";9883
    // $data .= "Summary: $summary\n";
    // $data .= "Accomplishments: $accomplishments\n";
    // $data .= "Challenges: $challenges\n";
    // $data .= "Learning: $learning\n\n";

    // Write the data to the file
    // file_put_contents($filename, $data, FILE_APPEND);
    $sql= "INSERT INTO users(assigned_department, assignment_period_start, assignment_period_end, summary, accomplishments, challenges, learning) 
    VALUES ('$department','$start_date','$end_date','$summary','$accomplishments','$challenges','$learning')";

    if(!empty($department) && !empty($start_date) && !empty($end_date) && !empty($summary) && !empty($accomplishments) && !empty($challenges) && !empty($learning))
    {
    
    $query= mysqli_query($conn,$sql);
    // $query = mysqli_query ($conn,$sql);
   echo " submitted successfully.";
    // Redirect back to the form page with a success message    
    // header("Location: index.php?status=success");
} else {
    // If the form is not submitted, redirect back to the form page
    header("Location: submit_report.php");
    exit;
}
}
?>