<?php
session_start();
$title = "Attendance Record";
include '../Php/db_connect.php';
include '../Layouts/navbar-user.php';
include '../Layouts/sidebar-user.php';
include '../Php/authenticate.php';
include '../Layouts/main-user.php';
?>
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <!-- Layout container -->
    <div class="layout-page">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Department</th>
                            <th>Date</th>
                            <th>Day</th>
                            <th>Time In</th>
                            <th>Time Out</th>
                            <th>Hours Worked</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $user_id = $_SESSION['user_id'];
                        $sql = "SELECT  ts.*, us.id, us.department, tr.user_id, tr.first_name, tr.middle_name, tr.last_name
                        FROM timesheet ts
                        INNER JOIN users us ON ts.user_id = us.id
                        INNER JOIN trainees tr ON tr.user_id = us.id
                        WHERE us.id='$user_id'
                        AND event_type IN ('In', 'Out')
                        ORDER BY timestamp";
                    

                        
                        $query = mysqli_query($connect, $sql);
                        $prev_row = null;
                        if ($query && mysqli_num_rows($query) > 0) {
                            
                            while ($row = mysqli_fetch_assoc($query)) {
                              
                                $date = date('Y-m-d', strtotime($row['timestamp']));
                                $event_type=$row['event_type'];
                                $today = date("D", strtotime($row['timestamp'])); 
                                $time = date('H:i:s', strtotime($row['timestamp']));
                                if ($prev_row && $prev_row['event_type'] !== $event_type && $date === date('Y-m-d', strtotime($prev_row['timestamp']))) {
                                ?>
                                 <tr>
                                <td><?php echo $prev_row['last_name'] . ", " . $prev_row['first_name'] . " " . $prev_row['middle_name']; ?></td>
                                <td><?php echo $prev_row['department']; ?></td>
                                <td><?php echo $date; ?></td>
                                <td><?php echo $today; ?></td>
                                <?php if ($prev_row['event_type'] === 'In') { ?>
                                    <td><?php echo date('H:i:s', strtotime($prev_row['timestamp'])); ?></td>
                                    <td><?php echo $time; ?></td>
                                <?php } else { ?>
                                    <td><?php echo $time; ?></td>
                                    <td><?php echo date('H:i:s', strtotime($prev_row['timestamp'])); ?></td>
                                <?php } ?>
                            
                                <td><?php echo $row['total_hours'];?></td>

                            </tr>
                        <?php
                            }
                            $prev_row = $row;
                        }
                    }

                   ?>
                    </tbody>
                </table>
                <!-- / Content -->
            </div>
        </div>
        <!-- Content wrapper -->
    </div>
</div>