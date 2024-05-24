<?php
session_start();
$title = "Attendance Record";
include '../Php/authenticate.php';
include '../Php/db_connect.php';
include '../Layouts/main-admin.php'; ?>

  
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
                     <div>
                            <button id="exportButton" class="btn btn-outline-success btn-sm">Export Data</button>
                        </div>

                        
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


<form action="../Php/php-datepicker.php" method="POST">
                <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-info text-white" id="basic-addon1"><i
                                        class="fas fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control" id="start_date" name="start_date" placeholder="Start Date" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-info text-white" id="basic-addon1"><i
                                        class="fas fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control" id="end_date" name=" end_date" placeholder="End Date" readonly>
                        </div>
                    </div>
                </div>
                <div>
                    <button id="filter" type="submit" class="btn btn-outline-info btn-sm" name="submit">Filter</button>
                    <button id="reset" class="btn btn-outline-warning btn-sm">Reset</button>
                </div><br>
     </form>



            <div class="card">
                <table class=" table table-dark table-responsive">
                    <thead >
                      
                        <tr>
                            <th scope="col" >ID</th>
                            <th scope="col" >Name</th>
                            <th scope="col" >Department</th>
                     
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
                            <th scope='col' class="">Total</th>

                            </tr> 
                      
                        
                    </thead>
                    <tbody>
                    <?php
                            $sql_trainees = "SELECT us.*, 
                                        tr.ojt_id
                                FROM users us
                                INNER JOIN trainees tr ON tr.user_id = us.id
                                WHERE us.user_type = 'Trainee'";
                                 $result_trainees = mysqli_query($connect, $sql_trainees);

                                        if ($result_trainees && mysqli_num_rows($result_trainees) > 0) {
                                            while ($row_trainee = mysqli_fetch_assoc($result_trainees)) {
                                                $user_total_hours = 0;
                                                echo "<tr >";
                                                echo "<td  class='bg-light text-dark '>" . $row_trainee['ojt_id'] . "</td>";
                                                echo "<td  class='bg-light text-dark '>" . $row_trainee['last_name'] . ", " . $row_trainee['first_name'] . " " . $row_trainee['middle_name'] . "</td>";
                                                echo "<td  class='bg-light text-dark '>" . $row_trainee['department'] . "</td>";
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
    $(function() {
        $("#start_date").datepicker({
            "dateFormat": "yy-mm-dd"
        });
        $("#end_date").datepicker({
            "dateFormat": "yy-mm-dd"
        });
    });
    </script>

    <script>
    // // Fetch records

    // function fetch(start_date, end_date) {
    //     $.ajax({
    //         url: "records.php",
    //         type: "POST",
    //         data: {
    //             start_date: start_date,
    //             end_date: end_date
    //         },
    //         dataType: "json",
    //         success: function(data) {
    //             // Datatables
    //             var i = "1";

    //             $('#records').DataTable({
    //                 "data": data,
    //                 // buttons
    //                 "dom": "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'B><'col-sm-12 col-md-4'f>>" +
    //                     "<'row'<'col-sm-12'tr>>" +
    //                     "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
    //                 "buttons": [
    //                     'copy', 'csv', 'excel', 'pdf', 'print'
    //                 ],
    //                 // responsive
    //                 "responsive": true,
    //                 "columns": [{
    //                         "data": "id",
    //                         "render": function(data, type, row, meta) {
    //                             return i++;
    //                         }
    //                     },
    //                     {
    //                         "data": "name"
    //                     },
    //                     {
    //                         "data": "standard",
    //                         "render": function(data, type, row, meta) {
    //                             return `${row.standard}th Standard`;
    //                         }
    //                     },
    //                     {
    //                         "data": "percentage",
    //                         "render": function(data, type, row, meta) {
    //                             return `${row.percentage}%`;
    //                         }
    //                     },
    //                     {
    //                         "data": "result"
    //                     },
    //                     {
    //                         "data": "created_at",
    //                         "render": function(data, type, row, meta) {
    //                             return moment(row.created_at).format('DD-MM-YYYY');
    //                         }
    //                     }
    //                 ]
    //             });
    //         }
    //     });
    // }
    // fetch();

    // Filter

    // $(document).on("click", "#filter", function(e) {
    //     e.preventDefault();

    //     var start_date = $("#start_date").val();
    //     var end_date = $("#end_date").val();

    //     if (start_date == "" || end_date == "") {
    //         alert("both date required");
    //     } else {
    //         $('#records').DataTable().destroy();
    //         fetch(start_date, end_date);
    //     }
    // });

    // Reset

    $(document).on("click", "#reset", function(e) {
        e.preventDefault();

        $("#start_date").val(''); // empty value
        $("#end_date").val('');

        $('#records').DataTable().destroy();
        fetch();
    });
    </script>