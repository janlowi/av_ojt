<?php 
include '../Layouts/main.php';
include '../Layouts/navbar.php';
include '../Layouts/sidebar.php';
include '../Php/db_connect.php';

$errors = [];

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
    $assignment_period_start = $_POST['start_date'];
    $assignment_period_end = $_POST['end_date'];
    $summary = $_POST['summary'];
    $accomplishments = $_POST['accomplishments'];
    $challenges = $_POST['challenges'];
    $learning = $_POST['learning'];

    $query = "INSERT INTO users (assigned_department, assignment_period_start, assignment_period_end, summary, accomplishments, challenges, learning) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($connect, $query);
    mysqli_stmt_bind_param($stmt, 'sssssss', $assigned_department, $assignment_period_start, $assignment_period_end, $summary, $accomplishments, $challenges, $learning);
    mysqli_stmt_execute($stmt);

    // Check if the query was successful
    if(mysqli_stmt_affected_rows($stmt) > 0) {
        echo "Data inserted successfully.";
    } else {
        echo "Error inserting data.";
    }
} else {
  // Display errors
  foreach ($errors as $error) {
    echo $error . "<br>";
  }
}
    }
  
?>

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content --> 
          <!-- Layout container -->
          <div class="layout-page">

            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">

                    <h5 class="card-header">Weekly Report</h5>
                    <div class="table-responsive text-nowrap">
                   <table class="table table-success">
              <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Timestamp</th>
                    <th scope="col">Department</th>
                    <th scope="col">Start</th>
                    <th scope="col">End</th>
                    <th scope="col">Summary</th>
                    <th scope="col">Accomplishments</th>
                    <th scope="col">Challenges</th>
                    <th scope="col">Learnings</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
  <?php 
     
     $sql= "SELECT * FROM  users";
     $query =mysqli_query($connect, $sql);
    if(mysqli_num_rows($query)>0) {
     while ($row=mysqli_fetch_assoc($query))  { ?>

                    <tr>
                        <td><?= $row ['id'];?></td>
                        <td><?= $row ['timestamp']; ?></td>
                        <td><?= $row ['assigned_department'];?></td>   
                        <td><?= $row ['assignment_period_start']; ?></td>                  
                        <td><?= $row ['assignment_period_end']; ?></td>
                        <td><?= $row ['summary']; ?></td>
                        <td><?= $row ['accomplishments']; ?></td>
                        <td><?= $row ['challenges']; ?></td>
                        <td><?= $row ['learning']; ?></td>
                    </tr> 
<?php
}
    }
?>
                