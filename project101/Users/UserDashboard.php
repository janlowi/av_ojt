<?php 
session_start();
include '../Php/authenticate.php';
checkLoggedIn();
// checkUserType();
$title="User Dashboard";
include '../Layouts/main-user.php'; 

 include '../Php/db_connect.php';

  ?>

                              
<div class="row order-0 d-flex justify-content-center ">
  <div class="card ">
        <div class="card-body ">

 <div class="row">
    <div class="col-sm-4">
      <div class="card ">
     
        <div class="card-body ">
          <?php

            $user_id = $_SESSION['user_id'];
            $sql = "SELECT SUM(ts.total_hours) AS total_hours,
             ts.user_id,
             tr.user_id,
             tr.hours_to_render
            FROM timesheet ts
            INNER JOIN trainees tr ON ts.user_id = tr.user_id
            WHERE ts.user_id = '$user_id'
            AND event_type IN ('In', 'Out')";
                
              $query = mysqli_query($connect, $sql);
              $totalHours = 0;
                          
              if ($query && mysqli_num_rows($query) > 0) {
                  $row = mysqli_fetch_assoc($query);
                  $totalHours = $row['total_hours'];
                  $hoursToRender =$row['hours_to_render'];
                  $total_json = json_encode($totalHours);
                  $percent = $totalHours / $hoursToRender * 100;

              }
              ?>
          <h4><span class="d-flex justify-content-center">Total Hours</span></h4>
          <p class="card-text">Total hours rendered : </p>
            <h4 id= "realTime"></h4>
          <h5 class="card-title d-flex justify-content-center"><i class="fa-regular fa-clock" style="color: var(--bs-success); font-size: 60px;"> <?php echo $totalHours ?></i></h5>
         
       

       </div>
    </div>
  </div>

  <?php
    $user_id = $_SESSION['user_id'];
  date_default_timezone_set('Asia/Manila'); // local timezone

  $today=date('Y-m-d');
  $currentTimeInRecord= " ";
    $currentTImeIn="SELECT *
    FROM timesheet
    WHERE DATE(timestamp)='$today'
    AND user_id='$user_id'
    AND event_type IN ('In', 'Out')
    ORDER BY id DESC LIMIT 1
        ";
    $currentTImeIn_query=  mysqli_query($connect, $currentTImeIn);
    if($currentTImeIn_query && mysqli_num_rows($currentTImeIn_query)>0){
      $row=mysqli_fetch_assoc($currentTImeIn_query);
      $currentTimeInRecord= date('Y-m-d H:i:s', strtotime($row['timestamp']));
      $currentEventType = $row['event_type'];

     $currentEventType_json = json_encode($currentEventType);
      $timeInValue = json_encode($currentTimeInRecord);
 
    }
    ?>
<div class="col-sm-4">
  <div class="card ">
    <div class="card-body  text-center">
    <h4 class="card-title">Attendance</h4>
    <h5 class="card-title  d-flex justify-content-center"><i class="fa-regular fa-clock" style="color: var(--bs-info); font-size: 16px;"> <?php if (mysqli_num_rows($currentTImeIn_query)>0)
      {
        if($currentEventType === "In"){
        echo 'Clocked In : ';
        echo $currentTimeInRecord;

          echo ' 
          <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#timeInView"> 
          <i class="fa-solid fa-eye"> </i>
          </button> 
          '; 
        } elseif($currentEventType === "Out"){
          echo 'Clocked Out :  ';
          echo $currentTimeInRecord;
          echo ' 
          <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#timeInView"> 
          <i class="fa-solid fa-eye"> </i>
          </button> 
          '; 
        }
  }else{echo "No Record";} ?></i></h5>
 <!-- Modal -->
  <!-- //leaflet -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>

    <div class="modal fade" id="timeInView" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content overflow-auto">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Daily Timesheet Record</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <?php
                 $currentTImeIn_query=  mysqli_query($connect, $currentTImeIn);
                if($currentTImeIn_query && mysqli_num_rows($currentTImeIn_query)>0){
                   $row=mysqli_fetch_assoc($currentTImeIn_query);
                   $image=$row['image'];
                   $location=$row['location'];
                   $location_array=explode(",", $location);
                   $lat=$location_array[0];
                   $long=$location_array[1];
                   $lat_json = json_encode($lat);
                   $long_json = json_encode($long);

                  }?>
                  <div class="modal-body">
                  <div class="card" >
                  <img src="../Php/<?=$image?>" class="rounded mx-auto d-block"  alt="...">
                  </div>
                  <div id="map" style="width: 600px; height: 540px;"></div>
                  <div id="location"> </div>
                  </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

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


          <h4 class= ""> Current Progress </h4>
          <div class="progress" style="height: 35px;">
          <div class="progress-bar progress-bar-striped bg-info" role="progressbar"
           style="width: <?php echo ($totalHours / $hoursToRender) * 100 ?>%" 
           aria-valuenow="<?php echo $totalHours ?>" 
           aria-valuemin="0" 
           aria-valuemax="<?php echo $hoursToRender ?>">

          <span> <?php echo number_format($percent, 2, '.', '' )?> %</span> 

           </div>
        </div>
      <!-- Progress Bar Label -->
      <div id="progressbar" class="text-center mt-2">
        Progress: <?php echo number_format($percent, 2, '.', '') ?>%
      </div>

      </div>
    </div>
 </div>
                 
    <!-- Modal  for report-->
    <div class="modal fade" id="modalReport" tabindex="-1" aria-hidden="true">
 <div class="modal-dialog modal-lg" role="document">
   <div class="modal-content">
     <div class="modal-header">
       <h2 class="modal-title" id="modalCenterTitle">Submit your weekly report.</h2>

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
    // Display current date and time
    function realTimeDisplay(){


  const currentTime = new Date();
  const currentTimeStamp =  new Date(<?php echo  $timeInValue; ?>);
  currentTime.toLocaleString('en-US', { timeZone: 'Asia/Manila' })
  currentTimeStamp.toLocaleString('en-US', { timeZone: 'Asia/Manila' })


  const elapsedTime = currentTime - currentTimeStamp ;
      
  const hours = Math.floor(elapsedTime / (1000 * 60 * 60));
  const minutes = Math.floor((elapsedTime % (1000 * 60 * 60)) / (1000 * 60));
  const seconds = Math.floor((elapsedTime % (1000 * 60)) / 1000);

  document.getElementById('realTime').innerText = `${hours} hours, ${minutes} minutes, ${seconds} seconds`;
  }
  function startRealTimeDisplay() {
    realTimeDisplay();
    intervalId = setInterval(realTimeDisplay, 1000);
  }
function stopRealTimeDisplay(){
  clearInterval(intervalId);
}
const currentEventType = <?php echo $currentEventType_json ?>;
if(currentEventType === "Out"){
  stopRealTimeDisplay();
}else if(currentEventType === "In"){
  startRealTimeDisplay();
}

  </script>


<script>
document.getElementById("timeInView").addEventListener("shown.bs.modal", function () {
  const map = L.map('map'); 

    const latValue= <?php echo $lat_json; ?>;

    const longValue= <?php echo $long_json ?>;


map.setView([latValue, longValue], 13); 
// Sets initial coordinates and zoom level

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '© OpenStreetMap'
}).addTo(map); 
// Sets map data source and associates with map

let marker, circle, zoomed;
let popup = L.popup();

if (marker) {
        map.removeLayer(marker);
        map.removeLayer(circle);
    }
    // Removes any existing marker and circule (new ones about to be set)

    marker = L.marker([latValue, longValue]).addTo(map);
    circle = L.circle([latValue, longValue]).addTo(map);
    // Adds marker to the map and a circle for accuracy

    if (!zoomed) {
        zoomed = map.fitBounds(circle.getBounds()); 
    }
function onMapClick(e) {
    popup
        .setLatlong(e.latValuelongValue)
        .setContent("You clicked the map at " + e.latValuelongValue.toString())
        .openOn(map);
}
map.on('click', onMapClick);

    document.getElementById('location').innerHTML = "Latitude: " + latValue + ", Longitude: " + longValue;

});

</script>
