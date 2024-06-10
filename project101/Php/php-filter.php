<?php 
include 'db_connect.php';

if (isset($_POST['start_date'], $_POST['end_date'], $_POST['department'] )) {
    $startDate = mysqli_real_escape_string($connect, $_POST['start_date']);
    $endDate = mysqli_real_escape_string($connect, $_POST['end_date']);
    $department = mysqli_real_escape_string($connect, $_POST['department']);
    $sql_dates = "SELECT DISTINCT DATE(ts.timestamp) AS date
                  FROM timesheet ts
                  WHERE DATE(timestamp) BETWEEN '$startDate' AND '$endDate'
                  AND department_id = '$department' ";
    $result_dates = mysqli_query($connect, $sql_dates);

    if ($result_dates && mysqli_num_rows($result_dates) > 0) {
        $dateColumns = [];
        while ($row = mysqli_fetch_assoc($result_dates)) {
            $dateColumns[] = date("D M j", strtotime($row['date']));
        }

        ?>
        <table class="table table-borderless text-nowrap" id="filteredData">
            <thead>
                <tr>
                    <th class="bg-dark text-light" width="10%">ID</th>
                    <th class="bg-dark text-light">Name</th>
                    <th class="bg-dark text-light">Department</th>
                    <?php foreach ($dateColumns as $dateColumn) {
                        echo '<th class="bg-dark text-light">' . $dateColumn . '</th>';
                    } ?>
                    <th class="bg-dark text-light">Total</th>
                    <th class="bg-success text-dark">Rate</th>
                </tr>
            </thead>
            <tbody>
                <?php
                 $department = mysqli_real_escape_string($connect, $_POST['department']);
                $sql_trainees = "SELECT 
                                us.id AS user_id, 
                                us.rph,
                                us.first_name,
                                us.middle_name,
                                us.last_name,
                                us.department_id,
                                us.user_type,
                                tr.ojt_id,
                                tr.user_id,
                                dp.departments,
                                dp.id 
                                FROM users us
                                INNER JOIN trainees tr ON tr.user_id = user_id
                                INNER JOIN departments dp ON us.department_id=dp.id
                                WHERE us.department_id = '$department'
                                AND us.user_type = 'Trainee'
                                AND us.status = 'Active'
                                ";

                $result_trainees = mysqli_query($connect, $sql_trainees);

                if ($result_trainees && mysqli_num_rows($result_trainees) > 0) {
                    while ($row_trainee = mysqli_fetch_array($result_trainees)) {
                        $user_total_hours = 0;
                        $rate_per_hour = 0; 

                        echo "<tr>";
                        echo "<td class='bg-light text-dark'>" . $row_trainee['ojt_id'] . "</td>";
                        echo "<td class='bg-light text-dark'>" . $row_trainee['last_name'] . ", " . $row_trainee['first_name'] . " " . $row_trainee['middle_name'] . "</td>";
                        echo "<td class='bg-light text-dark'>" . $row_trainee['departments'] . "</td>";
                        $traineeId = $row_trainee['user_id'];
                        echo $traineeId;
                        foreach ($dateColumns as $dateColumn) {
                            $date = date("Y-m-d", strtotime($dateColumn));
                     
                            $department = intval($_POST['department']) ;
                            echo $department;
                            $sql_hours = " SELECT SUM(total_hours) AS total_hours
                                            FROM timesheet
                                            WHERE department_id = '$department'
                                            AND user_id = '$traineeId'
                                            AND DATE(timestamp) = '$date'
                                            
  
                                                ";
                            $result_hours= $connect -> query($sql_hours);
                            if ($result_hours && $result_hours->num_rows > 0) {
                                $total_hours_row = mysqli_fetch_assoc($result_hours );
                                $user_total_hours += $total_hours_row['total_hours'];
                                echo "<td class='bg-light text-dark'>" . $total_hours_row['total_hours'] . "</td>";
                            } else {
                                echo "<td class='bg-light text-dark'>0</td>";
                            }
                    }
                        echo "<td class='bg-dark text-light'>" . $user_total_hours . "</td>";
                        $rate_per_hour = number_format($user_total_hours * $row_trainee['rph'], 2);
                        echo "<td class='bg-dark text-light'>" . $rate_per_hour . "</td>";  
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
        <?php
    } else {
        echo "No data found for the selected date range.";
    }
} else {
    echo "Invalid request.";
}
?>
<script>
new DataTable('#filteredData', {
    layout: {
        topStart: {
            buttons: [
                {
                    extend: 'excel',
                    text: 'Export to Excel',
                    exportOptions: {
                        modifier: {
                            page: 'current'
                        }
                    }
                }, 
                
                {
                    extend: 'print',
                    text: 'Print current page',
                    exportOptions: {
                        modifier: {
                            page: 'current'
                        }
                    }
                }
            ]
        }
    }
});
</script>
