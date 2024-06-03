<?php
session_start();
include '../Php/authenticate.php';
checkLoggedIn();
// checkUserType();
$title = "Attendance Record";

include '../Php/db_connect.php';
include '../Layouts/main-admin.php'; 

?>

  
            <div class="card ">
            
              <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">User Id</th>
                            <th scope="col">Name</th> 
                            <th scope="col">Last Timestamp</th>
                            <th scope="col">Handle</th>
                            </tr>
                        </thead>
                     <tbody>

                         <?php 
                         $sql = "SELECT user_id, timestamp  
                         FROM timesheet WHERE DATE(timestamp) = DATE_SUB(CURDATE(), INTERVAL 1 DAY )
                         AND event_type = 'In' 
                         AND user_id NOT IN (SELECT user_id  FROM timesheet WHERE DATE(timestamp) = DATE_SUB(CURDATE(), INTERVAL 1 DAY)  AND event_type = 'Out')";
                         $result = mysqli_query($connect, $sql);
                         
                         if ($result) {
                             // Ste 3: Process the Results
                             if (mysqli_num_rows($result) > 0) {
                                 echo "Users who have failed to clock out yesterday:<br>";

                                
                                 while ($row = mysqli_fetch_assoc($result)) {
                                    $user_id = $row['user_id'];
                                    $_SESSION['failed_to_out'] = $row['user_id'];
                                     $yesterday_In_timestamp=$row['timestamp'];
                                     $_SESSION['last_timestamp']  =$yesterday_In_timestamp;

                                     $sql_names="SELECT * FROM users WHERE id= '$user_id'";
                                     $result_names = mysqli_query($connect, $sql_names);
                                     if ($result_names && mysqli_num_rows($result_names)>0 ) {
                                        while ($row_names = mysqli_fetch_assoc($result_names)) {
                                            $_SESSION['name']=$row_names['last_name'].','.' '.$row_names['first_name'].' '.$row_names['middle_name'];
                        
                         
                                 }
                                 }
                                 }
                         ?>
                        <tr>
                        <td> <?= $_SESSION['failed_to_out']; ?> </td>  
                        <td><?=  $_SESSION['name'];?></td>     
                         <td><?= $_SESSION['last_timestamp'];?> </td>


                            <td>
                                <form action="../Php/update-time.php" method="POST">
                                <div class="d-grid gap-2 col-lg-6 mx-auto"> 
                                <label for="logout">Update Log out time</label>    
                                <input type="datetime-local" id="logout" name="dateNtime" required class="form-control">
                                </div>
                                <input type="text" value ="<?= $_SESSION['failed_to_out']; ?>" name ="failed_to_out" hidden>
                                <input type="text" value ="<?= $_SESSION['last_timestamp']; ?>" name ="yesterday_In_timestamp" hidden>

                            <div class="d-grid gap-2 col-lg-6 mx-auto">
                               <button class="btn btn-info" name="update_time">Update</button>
                            </div>
                             </form>
                        </td>

                        </tr>
                        <?php
                       } else {
                        echo "No users have failed to clock out today.";
                    } 
                } else {
                    // Handle query execution error
                    echo "Error executing query: " . mysqli_error($connect);
                }
                
                        ?>
                    </tbody>
                </table><br>

                                <div class="row align-items-start">
                                    <div class="col">
                                          <input type="text" name="start_date" id="start_date" placeholder="Date Start" class="form-control" />
                                    </div>
                                    <div class="col">
                                    <input type="text" name="end_date" id="end_date" placeholder="Date End" class="form-control" />
                                    </div>
                                    <div class="col">
                                    <input type="button" name="filter" id="filter" value="Filter" class="btn btn-info" />
                                    <input type="button" name="reset" id="reset" value="Reset" class="btn btn-warning" />
                                    </div>
                                </div>   <br><br>  
                            <div class="table-responsive">
                            <table class="table table-borderless display-nowrap" id="attendanceRecord">
                                <thead   >
                                    <tr >
                                        <th class='bg-dark text-light' width="10%">ID</th>
                                        <th class='bg-dark text-light'>Name</th>
                                        <th class='bg-dark text-light'>Department</th>
                                        <?php 
                                         // Fetch all unique dates from the timestamp column
                                        $sql_dates = "SELECT DISTINCT DATE(timestamp) AS date FROM timesheet";
                                        $result_dates = mysqli_query($connect, $sql_dates);
                                        if ($result_dates && mysqli_num_rows($result_dates) > 0) {
                                            while ($row_date = mysqli_fetch_assoc($result_dates)) {
                                                echo "<th class='bg-dark text-light'>" . date("D M j", strtotime($row_date['date'])) . "</th>";
                                            
                                            }
                                        }
                                    
                                        ?>
                                    <th class='bg-dark text-light'   >Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                  $sql_trainees = "SELECT us.*, 
                                  tr.ojt_id,
                                  tr.user_id,
                                  dp.departments,
                                  dp.id AS department_id
                                        FROM users us
                                        INNER JOIN trainees tr ON tr.user_id = us.id
                                        INNER JOIN departments dp ON us.department_id=dp.id
                                        WHERE us.user_type = 'Trainee'
                                        ";
                                        $result_trainees = mysqli_query($connect, $sql_trainees);

                                  if ($result_trainees && mysqli_num_rows($result_trainees) > 0) {
                                      while ($row_trainee = mysqli_fetch_array($result_trainees)) {
                                          $user_total_hours = 0;
                                          echo "<tr >";
                                          echo "<td  class='bg-light text-dark '>" . $row_trainee['ojt_id'] . "</td>";
                                          echo "<td  class='bg-light text-dark '>" . $row_trainee['last_name'] . ", " . $row_trainee['first_name'] . " " . $row_trainee['middle_name'] . "</td>";
                                          echo "<td  class='bg-light text-dark '>" . $row_trainee['departments'] . "</td>";
                                        // Fetch total hours worked by trainee for each date
                                        $userId = $row_trainee['id'];
                                        // echo $userId;
                                        $result_dates = mysqli_query($connect, $sql_dates);
                                        if ($result_dates && mysqli_num_rows($result_dates) > 0) {
                                            while ($row_date = mysqli_fetch_assoc($result_dates)) {
                                                $date = $row_date['date'];
                                                $sql_total_hours = "SELECT SUM(total_hours) AS total_hours
                                                                    FROM timesheet
                                                                    WHERE user_id = $userId
                                                                    AND DATE(timestamp) = '$date'";
                                                $result_total_hours = mysqli_query($connect, $sql_total_hours);
                                                $total_hours_row = mysqli_fetch_assoc($result_total_hours);
                                                $user_total_hours += $total_hours_row['total_hours'];
                                                echo "<td  class='bg-light text-dark '>" . $total_hours_row['total_hours'] . "</td>";
                                    
                                            }
                                        }
                                        echo "<td  class='bg-dark text-light'>" .$user_total_hours. "</td>";
                                        echo "</tr>";
            }
        }
        ?>
        </tbody>
    </table>
                   
</div>
<?php include '../Layouts/footer.php'; ?>
<script>

$(document).ready(function(){
    $.datepicker.setDefaults({
        dateFormat: 'yy-mm-dd'
    });

    $("#start_date").datepicker({
        onSelect: function(selectedDate) {
            $("#end_date").datepicker("option", "minDate", selectedDate);
            // validateDates(); // Call validation function when start date is selected
        }
    });
    $("#end_date").datepicker();

    $('#filter').click(function(){
    var start_date = $('#start_date').val();
    var end_date = $('#end_date').val();

    if(start_date )
    if(start_date != '' && end_date != '') {
        $.ajax({
            url: "../Php/php-filter.php",
            method: "POST",
            data: { start_date: start_date, end_date: end_date },
            success: function(data) {
                $('#attendanceRecord').html(data);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    } else {
        alert("Please select both start and end dates.");
    }
});

window.onload = function() {
            document.getElementById("start_date").addEventListener("change", validateDates);
            document.getElementById("end_date").addEventListener("change", validateDates);
        };

$('#reset').click(function(){
        // Reset start and end date inputs
        $('#start_date').val('');
        $('#end_date').val('');

        // Reload default table content
        var defaultContent = `
                        <div class="table-responsive">
                             <table class="table table-borderless display-nowrap" id="attendanceRecord">
                                <thead   >
                                    <tr >
                                        <th class='bg-dark text-light' width="10%">ID</th>
                                        <th class='bg-dark text-light'>Name</th>
                                        <th class='bg-dark text-light'>Department</th>
                                        <?php 
                                         // Fetch all unique dates from the timestamp column
                                        $sql_dates = "SELECT DISTINCT DATE(timestamp) AS date FROM timesheet";
                                        $result_dates = mysqli_query($connect, $sql_dates);
                                        if ($result_dates && mysqli_num_rows($result_dates) > 0) {
                                            while ($row_date = mysqli_fetch_assoc($result_dates)) {
                                                echo "<th class='bg-dark text-light'>" . date("D M j", strtotime($row_date['date'])) . "</th>";
                                            
                                            }
                                        }
                                    
                                        ?>
                                    <th class='bg-dark text-light'   >Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                 $sql_trainees = "SELECT us.*, 
                                 tr.ojt_id,
                                 tr.user_id,
                                 dp.departments,
                                 dp.id AS department_id
                                       FROM users us
                                       INNER JOIN trainees tr ON tr.user_id = us.id
                                       INNER JOIN departments dp ON us.department_id=dp.id
                                       WHERE us.user_type = 'Trainee'
                                       ";
                                       $result_trainees = mysqli_query($connect, $sql_trainees);

                                 if ($result_trainees && mysqli_num_rows($result_trainees) > 0) {
                                     while ($row_trainee = mysqli_fetch_array($result_trainees)) {
                                         $user_total_hours = 0;
                                         echo "<tr >";
                                         echo "<td  class='bg-light text-dark '>" . $row_trainee['ojt_id'] . "</td>";
                                         echo "<td  class='bg-light text-dark '>" . $row_trainee['last_name'] . ", " . $row_trainee['first_name'] . " " . $row_trainee['middle_name'] . "</td>";
                                         echo "<td  class='bg-light text-dark '>" . $row_trainee['departments'] . "</td>";
                                        // Fetch total hours worked by trainee for each date
                                        $userId = $row_trainee['id'];
                                        // echo $userId;
                                        $result_dates = mysqli_query($connect, $sql_dates);
                                        if ($result_dates && mysqli_num_rows($result_dates) > 0) {
                                            while ($row_date = mysqli_fetch_assoc($result_dates)) {
                                                $date = $row_date['date'];
                                                $sql_total_hours = "SELECT SUM(total_hours) AS total_hours
                                                                    FROM timesheet
                                                                    WHERE user_id = $userId
                                                                    AND DATE(timestamp) = '$date'";
                                                $result_total_hours = mysqli_query($connect, $sql_total_hours);
                                                $total_hours_row = mysqli_fetch_assoc($result_total_hours);
                                                $user_total_hours += $total_hours_row['total_hours'];
                                                echo "<td  class='bg-light text-dark '>" . $total_hours_row['total_hours'] . "</td>";
                                    
                                            }
                                        }
                                        echo "<td  class='bg-dark text-light'>" .$user_total_hours. "</td>";
                                        echo "</tr>";
                                }
                            }
                            ?>
                                </tbody>
                            </table>
                                        
                        </div>
        `;
        $('#attendanceRecord').html(defaultContent);
    });
});

</script>

