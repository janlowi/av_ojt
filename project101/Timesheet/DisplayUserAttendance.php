<?php
session_start();
$usertype = 'Admin';
include '../Php/authenticate.php';
checkLoggedIn();
// checkUserType();
$title = " Attendance Record";
include '../Php/db_connect.php';
include '../Layouts/main-admin.php';

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
<div  class="d-flex justify-content-end" >
<a href="../Admin/Trainees.php">
       <button class="btn btn-dark">
         Back
       </button>
   </a>
</div>

   <?php
                $sql = "SELECT SUM(ts.total_hours) AS total_hours,
                        ts.user_id,
                        tr.user_id,
                        tr.hours_to_render
                    FROM timesheet ts
                    INNER JOIN trainees tr ON ts.user_id = tr.user_id
                    WHERE ts.user_id = '$trainee_id'
                    AND event_type IN ('In', 'Out')";
                
                $query = mysqli_query($connect, $sql);
                $totalHours = 0;
                $remainingHours = 0 ;
                
                if ($query && mysqli_num_rows($query) > 0) {
                    $row = mysqli_fetch_assoc($query);
                    $totalHours = $row['total_hours'];
                    $hoursToRender = $row['hours_to_render'];
                    $remainingHours = $hoursToRender - $totalHours;
                    
                    if ($totalHours != 0 && $hoursToRender != 0 ) {
                        $percent = ($totalHours / $hoursToRender) * 100;
                    } else {
                        $totalHours = 0;
                        $percent = 0;
                    }
                }
                ?>
<h4 class= ""> Current Progress </h4>
          <div class="progress" style="height: 35px;">
          <div class="progress-bar progress-bar-striped bg-info" role="progressbar"
           style="width: <?php if($totalHours != 0 && $hoursToRender != 0 ){
            echo ($totalHours / $hoursToRender) * 100 ;
          }else{
            echo 0;
          }
            ?>%" 
           aria-valuenow="<?php echo $totalHours ?>" 
           aria-valuemin="0" 
           aria-valuemax="<?php echo $hoursToRender ?>">

          
 <span data-bs-toggle="tooltip" 
 data-bs-placement="top" 
 title="<?php echo $totalHours," ", " Hours ","||"," ", number_format($percent, 2, '.', '' )?> %"> <?php echo $totalHours," ","Hours" ," - ","||"," ",number_format($percent, 2, '.', '' )?> %</span> <br>
        </div>
        </div>
        <div id="progressbar" class="text-center mt-2">
        Progress: <?php echo number_format($percent, 2, '.', '') ?>%
        Hours Rendered : <?php echo  $totalHours ." Hours " ?>
      </div>
   <br>

 <table class="table table-stripes" id ="userAttendance">
     <thead class="bg-success" >
         <tr>
             <th>Department</th>
             <th>Date</th>
             <th>Day</th>
             <th>Time In</th>
             <th>Time Out</th>
             <th>Date and Location</th>
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
                 $time = date('h:i:s a', strtotime($row['timestamp']));

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
                             <td><?php echo date('h:i:s a', strtotime($prev_row['timestamp'])); ?></td>
                             <td><?php echo $time; ?></td>
                         <?php } else { ?>
                             <td><?php echo $time; ?></td>
                             <td><?php echo date('h:i:s a', strtotime($prev_row['timestamp'])); ?></td>
                         <?php } ?>
                         <td>
                            <form action="ViewDateLocation.php" method="POST">
                                <input type="hidden" name="date" value="<?php echo $date; ?>" />
                                <input type="hidden" name="trainee_id" value="<?php echo $trainee_id; ?>" />
                        <button class= "btn btn-success" name="view_location">

                        <i class="fa-solid fa-eye"> </i>
                        </button>
                           
                            </a> 
                            </form>
                           
                         </td>

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
<?php  include '../Layouts/footer.php';?> 
<script>
new DataTable('#userAttendance', {
     responsive: true,
     order: [[0, 'desc']]
});
</script>
