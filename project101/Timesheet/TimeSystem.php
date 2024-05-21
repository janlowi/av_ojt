<?php   
include '../Php/authenticate.php';
$title="Time Tracking System";
 include '../Php/db_connect.php';
  ?>

 

<?php
$user_id = $_SESSION['user_id'];

$sql = "SELECT event_type FROM timesheet WHERE DATE(timestamp) = CURDATE() AND user_id = '$user_id' ORDER BY timestamp DESC LIMIT 1";
$query = mysqli_query($connect, $sql);

if ($query && mysqli_num_rows($query) > 0) {
    $row = mysqli_fetch_assoc($query);
    $latest_event_type = $row['event_type'];

    if ($latest_event_type == 'In') {
        // If the latest event type is "In", display the "Out" button
        echo '
        <div class="card-body text-center">               
        <form action="../Php/time-in-out.php" method="POST">
        <div class="d-grid gap-2">
            <input type="submit" name="Time_Out" value="Out" class="btn btn-info">
            </div>
        </form>

        <p class="card-text mt-2">
            Dont forget to time Out.
        </p>

        </div> 
        ';
    } else {
        // If the latest event type is "Out", display the "In" button
        echo '
        <div class="card-body text-center">
           
        <form action="../Php/time-in-out.php" method="POST">
        <div class="d-grid gap-2">
            <input type="submit" name="Time_In" value="In" class="btn btn-success" >
            </div>
        </form>

        <p class="card-text mt-2">
            Dont forget to time In.
        </p>

        </div>  
        ';
    }

} else {
    // If there are no events for the user, display the "In" button by default
    echo '
    <div class="card-body text-center">       
    <form action="../Php/time-in-out.php" method="POST">
    <div class="d-grid gap-2">
        <input type="submit" name="Time_In" value="In" class="btn btn-info">
        </div>
    </form>
    
  
    <p class="card-text mt-2">
        Dont forget to time Out.

    </p>

    </div>
    ';
    
}
?>
             <br>               
          <!-- Show current time -->
      <script src="../Assets/js/dateTime.js"> </script>
    <!-- Show current time -->
