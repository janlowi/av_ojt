<?php 
session_start();

$title="User Dashboard";
include '../Layouts/main-user.php'; 
 include '../Layouts/sidebar-user.php';
 include '../Layouts/navbar-user.php';
 include '../Php/db_connect.php';

  ?>


                             <!-- Content wrapper -->
                             <div class="content-wrapper">
            <!-- Content --> 
          <!-- Layout container -->
          <div class="layout-page">

          <div class="container-xxl flex-grow-1 container-p-y">
                  <div class="row">
                    


                  <?php 
     
     $sql= "SELECT * FROM trainees ";
     $query =mysqli_query($connect, $sql);
    if(mysqli_num_rows($query)>0) {

     while ($row=mysqli_fetch_assoc($query))  {

     
      ?>


                    <!-- welcome -->
                    <div class="col-lg-6 mb-4 order-0">
                  <div class="card">
                    <div class="d-flex align-items-end row">
                      <div class="col-sm-7">
                        <div class="card-body">
                          <h5 class="card-title text-primary">Welcome Trainee <?= $_SESSION['firstname'];?>! 🎉</h5>
                          <p class="mb-1">
                            Kung gikapoy naka  <span class="fw-medium"> : ></span> unsa pay gihuwat? surrender na. 
                          <br><br>
                          -janlowi
                          </p>
                        </div>
                      </div>
                      <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                          <img
                            src="../assets/img/illustrations/nice1.png"
                            height="140"
                            alt="View Badge User"
                            data-app-dark-img="illustrations/man-with-laptop-dark.png"
                            data-app-light-img="illustrations/man-with-laptop-light.png" />
                        </div>
                      </div>

                    </div>
                  </div>
                </div>

          <!-- welcome -->

  <!-- report -->
    
                <div class="col-md-0 col-xl-3">
                  <div class="card mb-3">
                  <button
                         type="button"
                         class="btn btn-dark"
                         href= "../Users/U"
                         data-bs-toggle="modal"
                         data-bs-target="#modalCenter">
                         Add report
                       </button>

                    <!-- <img class="card-img-top" src="../assets/img/elements/18.jpg" alt="Card image cap" /> -->
                    <div class="card-body">
                      <h5 class="card-title">Weekly report</h5>
                      <p class="card-text">
                        PLease submit a response weekly of your weekly duties.
                      </p>
                      <p class="card-text">
                        <small class="text-muted">...</small>
                      </p>
                    </div>
                  </div>
                </div>
              <!--/ report -->

               <!-- report -->
    
               <div class="col-md-0 col-xl-3">
                  <div class="card mb-3">`
              
                    <!-- <img class="card-img-top" src="../assets/img/elements/18.jpg" alt="Card image cap" /> -->
                    <div class="card-body">
                      <h5 class="card-title">Card title</h5>
                      <p class="card-text">
                        This is a wider card with supporting text below as a natural lead-in to additional content. This
                        content is a little bit longer.
                      </p>
                      <p class="card-text">
                        <small class="text-muted">Last updated 3 mins ago</small>
                      </p>
                    </div>
                  </div>
                </div>
              <!--/ report -->

    <!-- Modal  for report-->
    <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
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
                                               <div class="col-xl">
                                               <div class="card mb-4">
                                               <div class="card-body">

                                               <form class="row g-3" id="reportForm" action="../Php/php-weekly.php" method="post">
                                                         
                                               <div class="col-12">
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
                                               </div>
                                                          <label for="start_date">Assignment Period Start:</label>
                                                          <input type="date" id="start_date" name="start_date" required class="form-control">

                                                          <label for="end_date">Assignment Period End:</label>
                                                          <input type="date" id="end_date" name="end_date" required class="form-control">
                                                          <br>

                                                          <label for="summary">Summary or Scope of Work:</label>
                                                          <textarea id="summary" name="summary" rows="4" required class="form-control"></textarea>

                                                          <label for="accomplishments">Accomplishments:</label><br>
                                                          <textarea id="accomplishments" name="accomplishments" rows="4" class="form-control"></textarea>

                                                          <label for="challenges">Challenges:</label>
                                                          <textarea id="challenges" name="challenges" rows="4" class="form-control"></textarea>

                                                          <label for="learning">Learning:</label>
                                                          <textarea id="learning" name="learning" rows="4" class="form-control"></textarea>

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

<!-- /modal report -->


<div class="col-2 col-xl-12 col-md-6" >
    <div class="card h-70 p-4">
      <div class="card-header d-flex align-items-right justify-content-between">
        <div class="card-title mb-2">
          <h5 class="m-0 me-2 text-uppercase"><?php echo $_SESSION['firstname']."'s", " ", "INFORMATION";?> </h5>
        </div>
<!--         
        <div class="dropdown">
          <button class="btn p-0" type="button" id="popularInstructors" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="bx bx-dots-vertical-rounded"></i>
          </button>
          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="popularInstructors">
            <a class="dropdown-item" href="javascript:void(0);">Select All</a>
            <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
            <a class="dropdown-item" href="javascript:void(0);">Share</a>
          </div>
        </div> -->
      </div>
      
      <div class="table-responsive ">
        <table class="table table-bordered border-secondary">
          <thead class="border-bottom">
          </thead>
          <tbody>

            <!-- <tr>
              <th>
                <div class="d-flex justify-content-start align-items-right mt-lg-4">
                  <div class="d-flex flex-column">
                    <p class="mb-1 text-left  ">Id:</p>
                  </div>
                </div>
              </th>
              <th class="text-end">
                  <p class="mb-1 text-start"><?= $row ['id']; ?></p>
              </th>
            </tr> -->


            <tr>
              <th>
                <div class="d-flex justify-content-start align-items-right mt-lg-4">
                  <div class="d-flex flex-column">
                    <p class="mb-1 text-truncate ">OJT Id :</p>
                  </div>
                </div>
              </th>
              <th class="text-end">
                <div class="user-progress mt-lg-4">
                  <p class="mb-1 text-start"><?= $row ['ojt_id']; ?></p>
                </div>
              </th>
            </tr>


            <tr>
              <th>
                <div class="d-flex justify-content-start align-items-right mt-lg-4">
                  <div class="d-flex flex-column">
                    <p class="mb-1 text-truncate   ">Firstname :</p>
                  </div>
                </div>
              </th>
              <th class="text-end">
                <div class="user-progress mt-lg-4">
                  <p class="mb-1 text-start"><?= $row ['first_name']; ?></p>
                </div>
              </th>
            </tr>

            <tr>
              <th>
                <div class="d-flex justify-content-start align-items-right mt-lg-4">
                  <div class="d-flex flex-column">
                    <p class="mb-1 text-truncate  ">Middlename :</p>
                  </div>
                </div>
              </th>
              <th class="text-end">
                <div class="user-progress mt-lg-4">
                  <p class="mb-1 text-start"><?= $row ['middle_name']; ?></p>
                </div>
              </th>
            </tr>

            <tr>
              <th>
                <div class="d-flex justify-content-start align-items-right mt-lg-4">
                  <div class="d-flex flex-column">
                    <p class="mb-1 text-truncate ">Lastname :</p>
                  </div>
                </div>
              </th>
              <th class="text-end">
                <div class="user-progress mt-lg-4">
                  <p class="mb-1 text-start"><?= $row ['last_name']; ?></p>
                </div>
              </th>
            </tr>
            <tr>
              <th>
                <div class="d-flex justify-content-start align-items-right mt-lg-4">
                  <div class="d-flex flex-column">
                    <p class="mb-1 text-truncate ">Age :</p>
                  </div>
                </div>
              </th>
              <th class="text-end">
                <div class="user-progress mt-lg-4">
                  <p class="mb-1 text-start"><?= $row ['age']; ?></p>
                </div>
              </th>
            </tr>

            <tr>
              <th>
                <div class="d-flex justify-content-start align-items-right mt-lg-4">
                  <div class="d-flex flex-column">
                    <p class="mb-1 text-truncate ">Sex :</p>
                  </div>
                </div>
              </th>
              <th class="text-end">
                <div class="user-progress mt-lg-4">
                  <p class="mb-1 text-start"><?= $row ['sex']; ?></p>
                </div>
              </th>
            </tr>

            <tr>
              <th>
                <div class="d-flex justify-content-start align-items-right mt-lg-4">
                  <div class="d-flex flex-column">
                    <p class="mb-1 text-truncate ">Contact No. :</p>
                  </div>
                </div>
              </th>
              <th class="text-end">
                <div class="user-progress mt-lg-4">
                  <p class="mb-1 text-start"><?= $row ['contact_num']; ?></p>
                </div>
              </th>
            </tr>

            <tr>
              <th>
                <div class="d-flex justify-content-start align-items-right mt-lg-4">
                  <div class="d-flex flex-column">
                    <p class="mb-1 text-truncate">Course :</p>
                  </div>
                </div>
              </th>
              <th class="text-end">
                <div class="user-progress mt-lg-4">
                  <p class="mb-1 text-start "><?= $row ['degree']; ?></p>
                </div>
              </th>
            </tr>

            <tr>
              <th>
                <div class="d-flex justify-content-start align-items-right mt-lg-4">
                  <div class="d-flex flex-column">
                    <p class="mb-1 text-truncate">University :</p>
                  </div>
                </div>
              </th>
              <th class="text-end">
                <div class="user-progress mt-lg-4">
                  <p class="mb-1 text-start"><?= $row ['university']; ?></p>
                </div>
              </th>
            </tr>

            <tr>
              <th>
                <div class="d-flex justify-content-start align-items-right mt-lg-4">
                  <div class="d-flex flex-column">
                    <p class="mb-1 text-truncate ">Hours to render :</p>
                  </div>
                </div>
              </th>
              <th class="text-end">
                <div class="user-progress mt-lg-4">
                  <p class="mb-1 text-start"><?= $row ['hours_to_render']; ?></p>
                </div>
              </th>
            </tr>

            <tr>
              <th>
                <div class="d-flex justify-content-start align-items-right mt-lg-4">
                  <div class="d-flex flex-column">
                    <p class="mb-1 text-truncate ">Email:</p>
                  </div>
                </div>
              </th>
              <th class="text-end">
                <div class="user-progress mt-lg-4">
                  <p class="mb-1 text-start"><?= $row ['email']; ?></p>
                </div>
              </th>
            </tr>

            <tr>
              <th>
                <div class="d-flex justify-content-start align-items-right mt-lg-4">
                  <div class="d-flex flex-column">
                    <p class="mb-1 text-truncate ">Date started :</p>
                  </div>
                </div>
              </th>
              <th class="text-end">
                <div class="user-progress mt-lg-4">
                  <p class="mb-1 text-start"><?= $row ['dos']; ?></p>
                </div>
              </th>
            </tr>


          </tbody>
        </table>
      </div>
    </div>
  </div>


          
<?php
}
    }
?>

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
                          <small>11 mins ago</small>
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
                  <div
                  class="bs-toast toast fade show toast-placement-ex m-2 bottom-0 end-0 bg-danger"
                            role="alert"
                            aria-live="assertive"
                            aria-atomic="true">
                            <div class="toast-header">
                              <i class="bx bx-bell me-2"></i>
                              <div class="me-auto fw-medium">Error</div>
                              <small>11 mins ago</small>
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



                                <!-- right layout -->
                                </div>
                  </div>
                </div>

            <!-- / Content -->
            <div class="content-backdrop fade"></div>
          <!-- </div> -->
        </div>
          <!-- Content wrapper -->
