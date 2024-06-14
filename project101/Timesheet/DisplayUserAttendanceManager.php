<?php
session_start();
$usertype = 'Manager';
include '../Php/authenticate.php';
checkLoggedIn();
// checkUserType();
$title = " Attendance Record";
include '../Php/db_connect.php';
include '../Layouts/main-manager.php';

?>

    <div class="card table-responsive">
        <br>
        <?php 
        if(isset($_GET['trainee_attendance'])){
            $trainee_id=$_GET['trainee_attendance'];

            $sql = "SELECT first_name FROM users WHERE id=?";
            $stmt = $connect->prepare($sql);
            $stmt->bind_param('i', $trainee_id);
            $stmt->execute();
            $stmt->bind_result($trainee_name);
            $stmt->store_result();
            if ($stmt->fetch()) {
        ?>
            <h4><?= $trainee_name . "'s Attendance Records" ?></h4>
        <?php
            }
        ?>

    <a href="../Manager/TraineesManager.php" class="d-flex justify-content-end">
       <button class="btn btn-dark">
         Back
       </button>
   </a>
   <br>
 <table class="table table-stripes" id ="userAttendance">
     <thead class="bg-success" >
         <tr>
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
         $sql = "SELECT ts.*, 
         us.department_id,  
         us.first_name,
         dp.departments,
         dp.id AS department_id

             FROM timesheet ts 
             INNER JOIN users us ON ts.user_id = us.id  
             INNER JOIN departments dp ON us.department_id = dp.id  
             WHERE us.id='$trainee_id'
             AND event_type IN ('In', 'Out')
             ORDER BY timestamp";

         $query = mysqli_query($connect, $sql);
         $prev_row = null;
         $totalHours = 0; // Initialize total hours variable

         if ($query && mysqli_num_rows($query) > 0) {

             while ($row = mysqli_fetch_assoc($query)) {
                $trainee_name = $row['first_name'];
                 $date = date('Y-m-d', strtotime($row['timestamp']));
                 $event_type = $row['event_type'];
                 $today = date("D", strtotime($row['timestamp']));
                 $time = date('H:i:s', strtotime($row['timestamp']));

                 // Add the total hours for each record to the total
                 $totalHours += $row['total_hours'];

                 // Check if the previous row exists and if the current row's event type is different from the previous one
                 if ($prev_row && $prev_row['event_type'] !== $event_type && $date === date('Y-m-d', strtotime($prev_row['timestamp']))) {
                     ?>
                     <tr>
                         <td><?php echo $prev_row['departments']; ?></td>
                         <td><?php echo $date; ?></td>
                         <td><?php echo $today; ?></td>
                         <?php if ($prev_row['event_type'] === 'In') { ?>
                             <td><?php echo date('H:i:s', strtotime($prev_row['timestamp'])); ?></td>
                             <td><?php echo $time; ?></td>
                         <?php } else { ?>
                             <td><?php echo $time; ?></td>
                             <td><?php echo date('H:i:s', strtotime($prev_row['timestamp'])); ?></td>
                         <?php } ?>

                         <td><?php echo $row['total_hours']; ?></td>
                     </tr>
                         <?php
                 }
                 $prev_row = $row;
             }
         }
        }
         ?>
         </tbody>
         <!-- Display total hours row outside the loop -->
         <tr style="text-align: right;">
             <td colspan="5"><strong>Total Hours:</strong></td>
             <td colspan="5"  ><?php echo $totalHours; ?></td>
         </tr>


         </table>
 </div>
<?php include '../Layouts/realfooter.php';?>
<?php  include '../Layouts/footer.php';?> 
<script>
new DataTable('#userAttendance', {
     responsive: true,
     order: [[0, 'desc']]
});
</script>