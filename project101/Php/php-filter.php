<?php 
include 'db_connect.php';

if (isset($_POST['start_date'], $_POST['end_date'])) {
   $startDate= $_POST['start_date'];
   $endDate=$_POST['end_date'];

    $startDate = mysqli_real_escape_string($connect, $startDate);
    $endDate = mysqli_real_escape_string($connect, $endDate);

    $sql = "SELECT DISTINCT DATE(timestamp) AS date  
            FROM timesheet 
            WHERE DATE(timestamp) BETWEEN '$startDate' AND '$endDate'
            ";
    $result = mysqli_query($connect, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        ?>
        <table class="table table-borderless display-nowrap" id="filteredData">
            <thead>
                <tr>
                    <th class="bg-dark text-light" width="10%">ID</th>
                    <th class="bg-dark text-light">Name</th>
                    <th class="bg-dark text-light">Department</th>
                    <?php 
                    while ($row = mysqli_fetch_assoc($result)) {
                        $date= date("Y-m-d", strtotime($row['date']));
                        echo '<th class="bg-dark text-light">' .date("D M j", strtotime($row['date'])). '</th>';
                    }
                    ?>
                    <th class="bg-dark text-light">Total</th>
                </tr>



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
                        echo "<tr>";
                        echo "<td class='bg-light text-dark'>" . $row_trainee['ojt_id'] . "</td>";
                        echo "<td class='bg-light text-dark'>" . $row_trainee['last_name'] . ", " . $row_trainee['first_name'] . " " . $row_trainee['middle_name'] . "</td>";
                        echo "<td class='bg-light text-dark'>" . $row_trainee['department'] . "</td>";

                        // Fetch total hours worked by trainee for each date
                        $userId = $row_trainee['id'];
                        $result = mysqli_query($connect, $sql);
                        $user_total_hours = 0;
                        if ($result && mysqli_num_rows($result) > 0) {
                            while ($row_date = mysqli_fetch_assoc($result)) {
                                $date=date("Y-m-d", strtotime($row_date['date']));
                                $sql_total_hours = "SELECT SUM(total_hours) AS total_hours
                                                    FROM timesheet
                                                    WHERE user_id = $userId
                                                    AND DATE(timestamp) = '$date'";
                                $result_total_hours = mysqli_query($connect, $sql_total_hours);
                                $total_hours_row = mysqli_fetch_assoc($result_total_hours);

                                $user_total_hours += $total_hours_row['total_hours'];
                                echo "<td class='bg-light text-dark'>" . $total_hours_row['total_hours'] . "</td>";
                            }
                        }
                        echo "<td class='bg-dark text-light'>" .$user_total_hours. "</td>";
                        echo "</tr>";
                    }
                }
                ?>
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
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
        }
    }
});
</script>