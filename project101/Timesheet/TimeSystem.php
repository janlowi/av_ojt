<?php   
$title="Time Tracking System";
include '../Layouts/main-user.php'; 
 include '../Php/db_connect.php';
  ?>

 

<?php
$user_id = $_SESSION['user_id'];

$sql = "SELECT event_type FROM timesheet WHERE user_id = '$user_id' ORDER BY timestamp DESC LIMIT 1";
$query = mysqli_query($connect, $sql);

if ($query && mysqli_num_rows($query) > 0) {
    $row = mysqli_fetch_assoc($query);
    $latest_event_type = $row['event_type'];

    if ($latest_event_type == 'In') {
        // If the latest event type is "In", display the "Out" button
        echo '
        <form action="../Php/time-in-out.php" method="POST">
            <input type="submit" name="Out" value="Out" class="btn btn-dark">
        </form>';
    } else {
        // If the latest event type is "Out", display the "In" button
        echo '
        <form action="../Php/time-in-out.php" method="POST">
            <input type="submit" name="In" value="In" class="btn btn-dark">
        </form>';
    }
} else {
    // If there are no events for the user, display the "In" button by default
    echo '
    <form action="../Php/time-in-out.php" method="POST">
        <input type="submit" name="In" value="In" class="btn btn-dark">
    </form>';
}
?>

                                        
                                          <div class="card-body">
                                            <h5 class="card-title">Time In/Out System</h5>
                                                        <div class="container">
                                                          <div class="display-date  ">
                                                            <span id="day">day</span>,
                                                            <span id="daynum" >00</span>
                                                            <span id="month" >month</span>
                                                            <span id="year" >0000</span>
                                                          </div>
                                                          <h3  id ="currentTime" class="badge bg-label-warning rounded-pill">	</h3>
                                                        </div>
                                          </div>



                      <!-- Show current time -->

                      <script src="../Assets/js/dateTime.js"> </script>
                      <!-- Show current time -->
