
<?php
include '../Layouts/main-user.php'; 
include '../Php/authenticate.php';

include '../Php/db_connect.php';
session_start();

?>





        <div class="table-responsive text-nowrap">
        <table class="table table-bordered border-secondary ">
          <thead class="border-bottom">

                                            <tr>
                                                <!-- <th scope="col">

                                                    <div class="d-flex flex-column justify-content-center align-items-center">
                                                        <p class="mb-1">ID </p>
                                                    </div>

                                                </th>
                                                <th scope="col">
                                                    

                                                    <div class="d-flex flex-column justify-content-center align-items-center">
                                                        <p class="mb-1 ">OJT ID </p>
                                                    </div>
                                             

                                                </th>
                                                <th scope="col">

                      
                                                    <div class="d-flex flex-column justify-content-center align-items-center">
                                                        <p class="mb-1 ">TIMESTAMP</p>
                                                    </div>
                         

                                                </th> -->
                                                <th scope="col">

                   
                                                    <div class="d-flex flex-column justify-content-center align-items-center">
                                                        <p class="mb-1 ">DEPARTMENT</p>
                                                    </div>
                                     

                                                </th>

                                                <th scope="col">

                   
                                                    <div class="d-flex flex-column justify-content-center align-items-center">
                                                        <p class="mb-1 ">START</p>
                                                    </div>


                                                </th>
                                                
                                                <th scope="col">

                   
                                                    <div class="d-flex flex-column justify-content-center align-items-center">
                                                        <p class="mb-1 ">END</p>
                                                    </div>


                                                </th>

                                                <th scope="col">

                   
                                                    <div class="d-flex flex-column justify-content-center align-items-center">
                                                        <p class="mb-1 ">SUMMARY</p>
                                                    </div>


                                                </th>

                                                <th scope="col">

                   
                                                    <div class="d-flex flex-column justify-content-center align-items-center">
                                                        <p class="mb-1 ">ACCOMPLISHMENTS</p>
                                                    </div>


                                                </th>

                                                <th scope="col">

                   
                                                    <div class="d-flex flex-column justify-content-center align-items-center">
                                                        <p class="mb-1 ">CHALLENGES</p>
                                                    </div>


                                                </th>

                                                <th scope="col">

                   
                                                    <div class="d-flex flex-column justify-content-center align-items-center">
                                                        <p class="mb-1 ">LEARNINGS</p>
                                                    </div>


                                                </th>
                                                <th scope="col">

                   
                                                    <div class="d-flex flex-column justify-content-center align-items-center">
                                                        <p class="mb-1 ">STATUS</p>
                                                    </div>


                                                </th>

                                            </tr>
                                        </thead>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $user_id= $_SESSION['user_id'];
    
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

?>

                                <tbody class="table-border-bottom-0">

                                <tr>
                                <td>

                                                                        
                                <div class="d-flex flex-column justify-content-center align-items-center">
                                    <p class="mb-1 "> <?= $_POST['department']; ?></p>
                                </div>



                                </td>
                                <td>

                                <div class="d-flex flex-column justify-content-center align-items-center">
                                    <p class="mb-1 "> <?= $_POST['start_date']; ?></p>
                                </div>


                                </td>
                                <td>

                                <div class="d-flex flex-column justify-content-center align-items-center">
                                    <p class="mb-1 "> <?=  $_POST['end_date']; ?></p>
                                </div>


                                </td>
                                <td>

                                <div class="d-flex flex-column justify-content-center align-items-center">
                                    <p class="mb-1 "> <?= $_POST['summary']; ?></p>
                                </div>


                                </td>
                                <td>

                                <div class="d-flex flex-column justify-content-center align-items-center">
                                    <p class="mb-1 "> <?= $_POST['accomplishments']; ?></p>
                                </div>


                                </td>
                                <td>

                                <div class="d-flex flex-column justify-content-center align-items-center">
                                    <p class="mb-1 "> <?= $_POST['challenges']; ?></p>
                                </div>


                                </td>
                                <td>

                                <div class="d-flex flex-column justify-content-center align-items-center">
                                    <p class="mb-1 "> <?=  $_POST['learning']; ?></p>
                                </div>


                                </td>


<?php }} ?>
                                <?php
                                        if(isset($_SESSION['report_saved'])&&$_SESSION['report_saved']===true){
                                        echo'
                                            <style>
                                                    #save {
                                                            display:none;
                                                    }
                                            </style>
                                        ';
                                }
                                ?>
                                        <td>
                                        <div class="d-flex flex-column justify-content-center align-items-center d-grid gap-2">


                                                <a href="../Biweekly/UpdateReports.php? update_report=<?= $_SESSION['user_id'] ?>" class="btn btn-warning btn-lg row-" id='save'>
                                            Draft
                                                </a>

                                                <a href="../Php/php-weekly-update.php? save_report=<?= $_SESSION['user_id'] ?>"  class="btn btn-success btn-lg row-" id='save' >
                                            Save
                                                </a>

                                            
                                        </div>


                                        </td>

                                        </tr> 
                                        </tbody>
                                    </table>
                    

        <!-- // $query = "INSERT INTO reports (user_id, dos, doe, assigned_dept, summary, accomplishment, challenges, learnings, status) VALUES (?, ?, ?, ?, ?, ?, ?,?, ?)";
        // $stmt = mysqli_prepare($connect, $query);
        // mysqli_stmt_bind_param($stmt, 'issssssss', $_SESSION['user_id'], $dos, $doe, $assigned_department, $summary, $accomplishments, $challenges, $learning, $status);
        // mysqli_stmt_execute($stmt);

        // Check if the query was successful -->
        <!-- if(mysqli_stmt_affected_rows($stmt) > 0) {
            $_SESSION['success']= "Report submitted successfully.";
            header("Location: ../Users/DisplayReports.php"); -->
        <!-- } else {
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
?> -->




