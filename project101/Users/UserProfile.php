<?php 
session_start();

$title=$_SESSION['firstname']." ". "Profile";
include '../Php/authenticate.php';

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
      <?php 
      $user_id = $_SESSION['user_id'];
     $sql = "SELECT tr.*,
                    us.id 
     
     FROM trainees tr,
          users us
                          
                           WHERE tr.user_id = us.id AND us.id= '$user_id' ";
     $query =mysqli_query($connect, $sql);
    if(mysqli_num_rows($query)>0) {

     while ($row=mysqli_fetch_assoc($query))  {

     
      ?>

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




                  <!-- right layout -->

                    </div>
                  </div>
                </div>

            <!-- / Content -->
            <div class="content-backdrop fade"></div>
          <!-- </div> -->
        </div>
          <!-- Content wrapper -->
