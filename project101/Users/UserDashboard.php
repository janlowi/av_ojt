<?php 
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !==true){
  header('location: ../Login/index.php');
  exit();
}
$title="User Dashboard";
include '../Layouts/main-user.php'; 
 include '../Php/db_connect.php';
  ?>
  
                                              
                <div class="col-lg-12 mb-4 order-0 d-flex justify-content-center ">
                  <div class="card ">
                        <div class="card-body ">
                       
                                                
                                            <div class="row">
                                                <div class="col-sm-4">
                                                  <div class="card ">
                                                 
                                                    <div class="card-body ">
                                                      <?php
                                                        $user_id = $_SESSION['user_id'];
                                                        $sql = "SELECT SUM(total_hours) AS total_hours
                                                        FROM timesheet
                                                        WHERE user_id = '$user_id'
                                                        AND event_type IN ('In', 'Out')";
                                
                                                          $query = mysqli_query($connect, $sql);
                                                          $totalHours = 0;
                                          
                                                          if ($query && mysqli_num_rows($query) > 0) {
                                                              $row = mysqli_fetch_assoc($query);
                                                              $totalHours = $row['total_hours'];
                                                          }
                                                          ?>
                                                      <h4><span class="d-flex justify-content-center">Total Hours</span></h4>
                                                      <p class="card-text">This is the total hours you have rendered : </p>
                                                        <h4 id= "realTimeDisplay"></h4>
                                                      <h5 class="card-title d-flex justify-content-center"><i class="fa-regular fa-clock" style="color: var(--bs-success); font-size: 60px;"> <?php echo $totalHours ?></i></h5>
                                                     
                                                    </div>
                                                  </div>
                                                </div>
                                                      <?php
                                                        $user_id = $_SESSION['user_id'];
                                                      date_default_timezone_set('Asia/Manila'); // local timezone

                                                      $today=date('Y-m-d');
                                                      $currentTimeInRecord= " ";
                                                        $currentTImeIn="SELECT timestamp 
                                                        FROM timesheet
                                                        WHERE DATE(timestamp)='$today'
                                                        AND user_id='$user_id'
                                                        ";
                                                        $currentTImeIn_query=  mysqli_query($connect, $currentTImeIn);
                                                        if($currentTImeIn_query && mysqli_num_rows($currentTImeIn_query)>0){
                                                          $row=mysqli_fetch_assoc($currentTImeIn_query);
                                                          $currentTimeInRecord= date('Y-m-d H:i:s', strtotime($row['timestamp']));
                                                          $timeInValue = json_encode($currentTimeInRecord);
                                                        }
                                                        ?>
                                                <div class="col-sm-4">
                                                  <div class="card ">
                                                    <div class="card-body  text-center">
                                                    <h4 class="card-title">Attendance</h4>
                                                    <p class="card-text">Clocked In at :</p>
                                                    <h5 class="card-title  d-flex justify-content-center"><i class="fa-regular fa-clock" style="color: var(--bs-info); font-size: 16px;"> <?php if (mysqli_num_rows($currentTImeIn_query)>0)
                                                      {echo $currentTimeInRecord;}else{echo "No Record";} ?></i></h5>
                                                    <?php include '../Timesheet/TimeSystem.php'; ?>
                                                    </div>
                                                  </div>
                                                </div>
                                       
                                               <div class="col-sm-4">
                                                  <div class="card ">
                                                  <div class="card-body text-center">
                                                      <h4 class="card-title">Weekly Report</h4>
                                                        <p class="card-text mt-4">
                                                          PLease submit a response weekly of your weekly duties or reports.
                                                        </p>
                                                        <button
                                                          type="button"
                                                          class="btn "
                                                          style="background-color: var(--bs-teal); color: white; width: 200px;"
                                                          data-bs-toggle="modal"
                                                          data-bs-target="#modalReport">
                                                          Add report
                                                        </button>
                                                      </div>
                                                  </div>
                                                </div>
                                          </div>

                        </div>
                      </div>
                </div>
                 
    <!-- Modal  for report-->
    <div class="modal fade" id="modalReport" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h2 class="modal-title" id="modalCenterTitle">Write your weekly report.</h2>

                                              <button
                                                type="button"
                                                class="btn-close"
                                                data-bs-dismiss="modal"
                                                aria-label="Close">
                                              </button>
                                            </div>


                                            <div class="row">
                                               <div class="col-xl-20"   >
                                               <div class="card" >
                                               <div class="card-body" >

                                               <form class="row row-cols-14" id="reportForm" action="../Php/php-weekly.php" method="post">
                                                         

                                                          <label for="department">Assigned Department:</label><br>
                                                          <select id="department" name="department" required class="form-control">
                                                          <option value="">--Select Department--</option>
                                                          <?php $department = "SELECT * FROM departments";
                                                                                $department_query=mysqli_query($connect, $department);

                                                                                if($department_query && mysqli_num_rows($department_query)> 0){
                                                                                        while($department_row = mysqli_fetch_assoc($department_query)){

                                                                                                echo '
                                                                                                        <option value="'.$department_row['id'].'">'.$department_row['departments'].'</option>
                                                                                                ';
                                                                                        }
                                                                                }
                                                                        ?>
                                                          </select><br>

                                                          <label for="start_date">Assignment Period Start:</label>
                                                          <input type="date" id="start_date" name="start_date" required class="form-control">

                                                          <label for="end_date">Assignment Period End:</label>
                                                          <input type="date" id="end_date" name="end_date" required class="form-control" >
                                                          <br>

                                                          <label for="summary">Summary or Scope of Work:</label>
                                                          <textarea id="summary" name="summary" rows="4" required class="form-control"  minlength="30" maxlength="500"></textarea>

                                                          <label for="accomplishments">Accomplishments:</label><br>
                                                          <textarea id="accomplishments" name="accomplishments" rows="4" class="form-control"required minlength="30" maxlength="500"></textarea>

                                                          <label for="challenges">Challenges:</label>
                                                          <textarea id="challenges" name="challenges" rows="4" class="form-control"required minlength="30" maxlength="500"></textarea>

                                                          <label for="learning">Learning:</label>
                                                          <textarea id="learning" name="learning" rows="4" class="form-control"required minlength="30" maxlength="500"></textarea>
                                                          
                                                          <input type="text" value="<?= $_SESSION['user_id'] ?>" hidden>

                                                          <input type="submit" name="submit" value="Submit" class="btn btn-dark">
                                                      </form>

                                                      </div>
                                       </div>
                                    </div>
                               </div>  

                               
                               <div class="modal-footer">
                             </div>
                           </div>
                         </div>
                       </div>


        <!-- toast -->
   
        <?php

          if(isset($_SESSION['success'])){


        ?>
              <div
              class="bs-toast toast fade show toast-placement-ex m-2 bottom-0 end-0 bg-success"
                        role="alert"
                        aria-live="assertive"
                        aria-atomic="true">
                        <div class="toast-header">
                          <i class="bx bx-bell me-2"></i>
                          <div class="me-auto fw-medium">Success</div>

                          <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body">
                         <?= $_SESSION['success'] ?>
                        </div>
                      </div>
        <?php
              unset($_SESSION['success']);
          }
        ?>

              <?php

              if(isset($_SESSION['error'])){


              ?>
                  <div class="bs-toast toast fade show toast-placement-ex m-2 bottom-0 end-0 bg-danger"
                            role="alert"
                            aria-live="assertive"
                            aria-atomic="true">
                            <div class="toast-header">
                              <i class="bx bx-bell me-2"></i>
                              <div class="me-auto fw-medium">Error</div>
    
                              <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                            <div class="toast-body">
                            <?= $_SESSION['error'] ?>
                            </div>
                          </div>
              <?php
                  unset($_SESSION['error']);
              }
              ?>


              <!-- /toast -->

          <?php

include '../Layouts/footer.php'; 

 ?>
<script>
        function validateDates() {
            var startDate = document.getElementById("start_date").value;
            var endDate = document.getElementById("end_date").value;

            if (startDate && endDate) {
                if (new Date(startDate) >= new Date(endDate)) {
                    alert("The start date must be before the end date.");
                    document.getElementById("end_date").value = "";
                }
            }

            if (startDate) {
                document.getElementById("end_date").setAttribute("min", startDate);
            }
        }

        window.onload = function() {
            document.getElementById("start_date").addEventListener("change", validateDates);
            document.getElementById("end_date").addEventListener("change", validateDates);
        };
    </script>
 <script>
// Function to update real-time total hours worked since clock-in
function updateTotalHoursSinceClockIn(clockInTimestamp) {
    // Calculate elapsed time since clock-in in seconds
    var currentTime = Math.floor(Date.now() / 1000);
    var elapsedTimeInSeconds = currentTime - clockInTimestamp;

    // Convert elapsed time to hours
    var elapsedTimeInHours = elapsedTimeInSeconds / 3600;

    // Update the displayed total hours
    var totalHoursElement = document.getElementById("realTimeDisplay");
    var totalHours = parseFloat(totalHoursElement.textContent); // Total hours initially fetched from the database
    totalHoursElement.textContent = (totalHours + elapsedTimeInHours).toFixed(2); // Update total hours
}

// Parse clock-in timestamp from PHP to JavaScript
var clockInTimestamp = <?php echo strtotime($currentTImeInRecord); ?>;
console.log(clockInTimestamp);
// Call the function initially and then set interval to update every second
updateTotalHoursSinceClockIn(clockInTimestamp);
setInterval(function() {
    updateTotalHoursSinceClockIn(clockInTimestamp);
}, 1000); 
</script>