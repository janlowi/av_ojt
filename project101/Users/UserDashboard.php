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
<<<<<<< HEAD

              <!-- Content wrapper
           <div class="content-wrapper"> -->
            <!-- Content --> 
          <!-- Layout container -->
          <!-- <div class="layout-page"> -->

          <!-- <div class="container-xxl flex-grow-1 container-p-y"> -->
                  <div class="row">
                    
 




               <!-- welcome
               <div class="col-lg-6 mb-4 order-1 ">
                  <div class="card">

 
                  </div>
                </div> -->

          <!-- welcome -->

  <!-- report -->
  
    
  <div class="dashboard">
            <div class="total-hours-box">
                <!-- <h2><?php echo $totalHours; ?></h2> -->
              
            </div>
            
=======
                                              
                <div class="col-lg-6 mb-4 order-0 d-flex justify-content-center ">
                  <div class="card ">
                        <div class="card-body ">
                       
                                                  s<?php
                                                      $user_id = $_SESSION['user_id'];
                                                      $sql = "SELECT  ts.*,
                                                                      us.id
                                                      FROM timesheet ts, users us
                                                      WHERE user_id=us.id
                                                      AND us.id= '$user_id'
                                                      AND event_type IN ('In', 'Out')
                                                      ORDER BY timestamp";


                                                      $query = mysqli_query($connect, $sql);
                                                      $totalHours = 0;
                                                      if ($query && mysqli_num_rows($query) > 0) {
                                                      while ($row = mysqli_fetch_assoc($query)) {
                                                      $totalHours += $row['total_hours'];
                                                    ?>
                                                <div class="row">
                                                <div class="col-sm-6">
                                                  <div class="card">
                                                 
                                                    <div class="card-body">
                                                    
                                                      <h5 class="card-title"><?= $totalHours ?></h5>
                                                      <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                                      <a href="#" class="btn btn-primary">Time In</a>
                                                    </div>
                                                  </div>
                                                </div>
                                                <div class="col-sm-6">
                                                  <div class="card">
                                                    <div class="card-body">
                                                      <h5 class="card-title">Special title treatment</h5>
                                                      <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                                      <a href="#" class="btn btn-primary">Total Hours</a>
                                                    </div>
                                                 
                                                  </div>
                                                </div>
                                              </div>
                                              <?php
                                                         }
                                                    }
                                                ?>
                        </div>
                      </div>
                </div>

         
  <!-- report -->
>>>>>>> d5aac13620f13fd4d2f15650065bee2e97bcf1c3
                <div class="col-md-0 col-xl-3 order-0">
                  <div class="card mb-0">
                    <!-- <img class="card-img-top" src="../assets/img/elements/18.jpg" alt="Card image cap" /> -->
                    <div class="card-body text-center">
                    <h4 class="card-title">Weekly report</h4>
                    <div class="d-grid gap-2">
                    <button
                         type="button"
                         class="btn btn-dark"
                         data-bs-toggle="modal"
                         data-bs-target="#modalReport">
                         Add report
                       </button>
                    </div>
                      <p class="card-text mt-4">
                        PLease submit a response weekly of your weekly duties.
                      </p>

                    </div>
                  </div>
                </div>
 <!--/ report -->


      <!-- time -->
      <div class="col-md-0 col-xl-3 order-0">
                  <div class="card mb-0">
                    <!-- <img class="card-img-top" src="../assets/img/elements/18.jpg" alt="Card image cap" /> -->
                    <div class="card-body text-center">
                    <h4 class="card-title">Attendance</h4>
                        <?php include '../Timesheet/TimeSystem.php'; ?>
                        </div>
                 </div>
<<<<<<< HEAD


         <!--/ time -->
=======
       
>>>>>>> 9c0377cc3fba3f0e80c8d4510f22d2cf3e16de02


                                 
         <?php


// Function to calculate total hours
function calculateTotalHours($connect, $user_id) {
    $totalHours = 0; // Initialize total hours variable
    
    // Prepare and execute SQL query
    $sql = "SELECT total_hours
            FROM timesheet
            WHERE user_id=? AND event_type IN ('In', 'Out')";
    $stmt = mysqli_prepare($connect, $sql);
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    // Fetch and sum total hours
    while ($row = mysqli_fetch_assoc($result)) {
        $totalHours += $row['total_hours'];
    }
    
    return $totalHours;
}
// Check connection
$user_id = $_SESSION['user_id'] ?? null; // Get user ID from session or set to null if not exists

if ($user_id) {

    // Call the function to calculate total hours
    $totalHours = calculateTotalHours($connect, $user_id);
    echo $totalHours;

?>








                 
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
                                                              <option value="">Select Department</option>
                                                              <option value="IT">Information Technology</option>
                                                              <option value="Accounting">Accounting</option>
                                                              <option value="Finance">Finance</option>
                                                              <option value="Admin">Admin</option>
                                                              <option value="Purchasing">Purchasing</option>
                                                              <option value="Warehouse">Warehouse</option>
                                                          </select><br>

                                                          <label for="start_date">Assignment Period Start:</label>
                                                          <input type="date" id="start_date" name="start_date" required class="form-control">

                                                          <label for="end_date">Assignment Period End:</label>
                                                          <input type="date" id="end_date" name="end_date" required class="form-control">
                                                          <br>

                                                          <label for="summary">Summary or Scope of Work:</label>
                                                          <textarea id="summary" name="summary" rows="4" required class="form-control"></textarea>

                                                          <label for="accomplishments">Accomplishments:</label><br>
                                                          <textarea id="accomplishments" name="accomplishments" rows="4" class="form-control"required></textarea>

                                                          <label for="challenges">Challenges:</label>
                                                          <textarea id="challenges" name="challenges" rows="4" class="form-control"required></textarea>

                                                          <label for="learning">Learning:</label>
                                                          <textarea id="learning" name="learning" rows="4" class="form-control"required></textarea>
                                                          
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

<<<<<<< HEAD
<<<<<<< HEAD
                                <!-- right layout -->
                                </div>
                  </div>
                </div>

   <!-- time tracking -->

   <?php include '../Timesheet/TimeTracking.php'; ?>
              
   
<!-- time tracking -->


            <!-- / Content -->
          </div>

        </div>
          <!-- Content wrapper -->

          <?php
} else {

}
?>
=======
 ?>
>>>>>>> 9c0377cc3fba3f0e80c8d4510f22d2cf3e16de02
=======
 ?>

 
>>>>>>> d5aac13620f13fd4d2f15650065bee2e97bcf1c3
