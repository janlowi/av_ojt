<?php
session_start();
$title = "Attendance Record";
include '../Php/authenticate.php';
include '../Php/db_connect.php';
include '../Layouts/main-admin.php'; ?>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }
    </style>


  
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

                                     $sql_names="SELECT * FROM trainees WHERE user_id= '$user_id'";
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
                </table>
<div></div>

            <div class="card">
                <table class="table table-responsive">
                    <thead class="bg-success">
                      
                        <tr>
                            <th scope="col" class="sticky">ID</th>
                            <th scope="col"  class="sticky">Name</th>
                            <th scope="col"  class="sticky">Department</th>
                     
                            <?php 
                             // Fetch all unique dates from the timestamp column
                                $sql_dates = "SELECT DISTINCT DATE(timestamp) AS date FROM timesheet";
                                $result_dates = mysqli_query($connect, $sql_dates);
                                if ($result_dates && mysqli_num_rows($result_dates) > 0) {
                                    while ($row_date = mysqli_fetch_assoc($result_dates)) {
                                        echo "<th scope='col'>" . date("D M j", strtotime($row_date['date'])) . "</th>";
                                       
                                    }
                                }
                              
                                ?>
                            <th scope='col' class="bg-dark text-light sticky">Total</th>

                            </tr> 
                      
                        
                    </thead>
                    <tbody>
                    <?php
                            $sql_trainees = "SELECT us.*, 
                                        tr.first_name,
                                        tr.last_name,
                                        tr.middle_name,
                                        tr.ojt_id
                                FROM users us
                                INNER JOIN trainees tr ON tr.user_id = us.id
                                WHERE us.user_type = 'Trainee'";
                                 $result_trainees = mysqli_query($connect, $sql_trainees);

                                        if ($result_trainees && mysqli_num_rows($result_trainees) > 0) {
                                            while ($row_trainee = mysqli_fetch_assoc($result_trainees)) {
                                                $user_total_hours = 0;
                                                echo "<tr>";
                                                echo "<td>" . $row_trainee['ojt_id'] . "</td>";
                                                echo "<td>" . $row_trainee['last_name'] . ", " . $row_trainee['first_name'] . " " . $row_trainee['middle_name'] . "</td>";
                                                echo "<td>" . $row_trainee['department'] . "</td>";
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
                        echo "<td>" . $total_hours_row['total_hours'] . "</td>";
               
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
