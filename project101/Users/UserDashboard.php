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
                          <p class="mb-4">
                            Kung gikapoy naka  <span class="fw-medium"> : ></span> unsa pay gihuwat? surrender na. 
                          <br><br>
                          -janlowi
                          </p>

                          <a href="javascript:;" class="btn btn-sm btn-outline-primary">View Badges</a>
                        </div>
                      </div>
                      <div class="col-sm-5 text-right text-sm-left">
                        <div class="card-body pb-10 px-0 px-md-8">
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

<div class="col-2 col-xl-8 col-md-6">
    <div class="card h-100">
      <div class="card-header d-flex align-items-right justify-content-between">
        <div class="card-title mb-0">
          <h5 class="m-0 me-2 text-uppercase"><?php echo $_SESSION['firstname']."'s", " ", "INFORMATION";?>. </h5>
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
      
      <div class="table-responsive">
        <table class="table table-borderless">
          <thead class="border-bottom">
            <tr>
              <th> </th>
              <th class="text-right"></th>
            </tr>
          </thead>
          <tbody>

            <tr>
              <td>
                <div class="d-flex justify-content-start align-items-right mt-lg-4">
                  <div class="d-flex flex-column">
                    <h6 class="mb-1 text-left  ">Id:</h6>
                  </div>
                </div>
              </td>
              <td class="text-end">
                <div class="user-progress mt-lg-4">
                  <h6 class="mb-1 text-start text-dark"><?= $row ['id']; ?></h6>
                </div>
              </td>
            </tr>


            <tr>
              <td>
                <div class="d-flex justify-content-start align-items-right mt-lg-4">
                  <div class="d-flex flex-column">
                    <h6 class="mb-1 text-truncate ">OJT Id :</h6>
                  </div>
                </div>
              </td>
              <td class="text-end">
                <div class="user-progress mt-lg-4">
                  <h6 class="mb-1 text-start text-dark"><?= $row ['ojt_id']; ?></h6>
                </div>
              </td>
            </tr>


            <tr>
              <td>
                <div class="d-flex justify-content-start align-items-right mt-lg-4">
                  <div class="d-flex flex-column">
                    <h6 class="mb-1 text-truncate   ">Firstname :</h6>
                  </div>
                </div>
              </td>
              <td class="text-end">
                <div class="user-progress mt-lg-4">
                  <h6 class="mb-1 text-start text-dark"><?= $row ['first_name']; ?></h6>
                </div>
              </td>
            </tr>

            <tr>
              <td>
                <div class="d-flex justify-content-start align-items-right mt-lg-4">
                  <div class="d-flex flex-column">
                    <h6 class="mb-1 text-truncate  ">Middlename :</h6>
                  </div>
                </div>
              </td>
              <td class="text-end">
                <div class="user-progress mt-lg-4">
                  <h6 class="mb-1 text-start text-dark"><?= $row ['middle_name']; ?></h6>
                </div>
              </td>
            </tr>

            <tr>
              <td>
                <div class="d-flex justify-content-start align-items-right mt-lg-4">
                  <div class="d-flex flex-column">
                    <h6 class="mb-1 text-truncate ">Lastname :</h6>
                  </div>
                </div>
              </td>
              <td class="text-end">
                <div class="user-progress mt-lg-4">
                  <h6 class="mb-1 text-start text-dark"><?= $row ['last_name']; ?></h6>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <div class="d-flex justify-content-start align-items-right mt-lg-4">
                  <div class="d-flex flex-column">
                    <h6 class="mb-1 text-truncate ">Age :</h6>
                  </div>
                </div>
              </td>
              <td class="text-end">
                <div class="user-progress mt-lg-4">
                  <h6 class="mb-1 text-start text-dark"><?= $row ['age']; ?></h6>
                </div>
              </td>
            </tr>

            <tr>
              <td>
                <div class="d-flex justify-content-start align-items-right mt-lg-4">
                  <div class="d-flex flex-column">
                    <h6 class="mb-1 text-truncate ">Sex :</h6>
                  </div>
                </div>
              </td>
              <td class="text-end">
                <div class="user-progress mt-lg-4">
                  <h6 class="mb-1 text-start text-dark"><?= $row ['sex']; ?></h6>
                </div>
              </td>
            </tr>

            <tr>
              <td>
                <div class="d-flex justify-content-start align-items-right mt-lg-4">
                  <div class="d-flex flex-column">
                    <h6 class="mb-1 text-truncate ">Contact No. :</h6>
                  </div>
                </div>
              </td>
              <td class="text-end">
                <div class="user-progress mt-lg-4">
                  <h6 class="mb-1 text-start text-dark"><?= $row ['contact_num']; ?></h6>
                </div>
              </td>
            </tr>

            <tr>
              <td>
                <div class="d-flex justify-content-start align-items-right mt-lg-4">
                  <div class="d-flex flex-column">
                    <h6 class="mb-1 text-truncate">Course :</h6>
                  </div>
                </div>
              </td>
              <td class="text-end">
                <div class="user-progress mt-lg-4">
                  <h6 class="mb-1 text-start  text-dark"><?= $row ['degree']; ?></h6>
                </div>
              </td>
            </tr>

            <tr>
              <td>
                <div class="d-flex justify-content-start align-items-right mt-lg-4">
                  <div class="d-flex flex-column">
                    <h6 class="mb-1 text-truncate text-dark">University :</h6>
                  </div>
                </div>
              </td>
              <td class="text-end">
                <div class="user-progress mt-lg-4">
                  <h6 class="mb-1 text-start text-dark"><?= $row ['university']; ?></h6>
                </div>
              </td>
            </tr>

            <tr>
              <td>
                <div class="d-flex justify-content-start align-items-right mt-lg-4">
                  <div class="d-flex flex-column">
                    <h6 class="mb-1 text-truncate ">Hours to render :</h6>
                  </div>
                </div>
              </td>
              <td class="text-end">
                <div class="user-progress mt-lg-4">
                  <h6 class="mb-1 text-start text-dark"><?= $row ['hours_to_render']; ?></h6>
                </div>
              </td>
            </tr>

            <tr>
              <td>
                <div class="d-flex justify-content-start align-items-right mt-lg-4">
                  <div class="d-flex flex-column">
                    <h6 class="mb-1 text-truncate ">Email:</h6>
                  </div>
                </div>
              </td>
              <td class="text-end">
                <div class="user-progress mt-lg-4">
                  <h6 class="mb-1 text-start text-dark"><?= $row ['email']; ?></h6>
                </div>
              </td>
            </tr>

            <tr>
              <td>
                <div class="d-flex justify-content-start align-items-right mt-lg-4">
                  <div class="d-flex flex-column">
                    <h6 class="mb-1 text-truncate ">Date started :</h6>
                  </div>
                </div>
              </td>
              <td class="text-end">
                <div class="user-progress mt-lg-4">
                  <h6 class="mb-1 text-start text-dark"><?= $row ['dos']; ?></h6>
                </div>
              </td>
            </tr>


          </tbody>
        </table>
      </div>
    </div>
  </div>





  
                    <!-- <th scope="row">OJT ID</th>
                    <th scope="row">Name</th>
                    <th scope="row">Age</th>
                    <th scope="row">Sex</th>
                    <th scope="row">Contact no.</th>
                    <th scope="row">Course</th>
                    <th scope="row">University</th>
                    <th scope="row">Hours to render</th> -->
                    <!-- <th scope="row">Date started</th> -->
                    <!-- <th scope="row">Department</th> -->

                    <!-- <th scope="row">Office</th> -->

                    <!-- <th scope="row">Email</th> -->
                    <!-- <th scope="row">Password</th>
                    <th scope="row">Usertype</th>
                    <th scope="row">Status</th> -->
                    <!-- <th scope="row">Operation</th> -->
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
 
                     <tr>
                        <!-- <td><?= $row ['ojt_id']; ?></td>
                        <td><?=  $row ['last_name'].","." ". $row['first_name']." ". $row['middle_name']; ?></td>;   
                        <td><?= $row ['age']; ?></td>;                  
                        <td><?= $row ['sex']; ?></td>
                        <td><?= $row ['contact_num']; ?></td>
                        <td><?= $row ['degree']; ?></td>
                        <td><?= $row ['university']; ?></td>
                        <td><?= $row ['hours_to_render']; ?></td> -->
                        <!-- <td><?= $row ['dos']; ?></td> -->
                        <!-- <td><?= $row ['department']; ?></td> -->
                        <!-- <td><?= $row ['office_assigned']; ?></td> -->
                        <!-- <td><?= $row ['email']; ?></td> -->
                        <!-- <td><?= $row ['password']; ?></td>
                        <td><?= $row ['user_type']; ?></td>

                       <td><span class="badge bg-label-primary me-1"><?= $row ['status']; ?></span></td> -->
                       <!-- <td>
                            <div class="menu">
                              <a class="item" href="../Admin/Update.php? update=<?= $row ['id']; ?>"
                                ><i class='bx bx-edit'>EDIT</i></a
                              >
                              <a class="item" href="javascript:void(0);"
                                ><i class="bx bx-trash me-2"></i></a
                              >
                            </div>

                        </td> -->
                      </tr> 
<?php
}
    }
?>
                    </tbody>
                  </table>
                </div>
              </div>
              <!--/ Bootstrap Dark Table -->








                                <!-- right layout -->
                                </div>
                  </div>
                </div>

            <!-- / Content -->
            <div class="content-backdrop fade"></div>
          <!-- </div> -->
        </div>
          <!-- Content wrapper -->