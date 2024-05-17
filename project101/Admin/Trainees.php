<?php 
session_start();
$title="Trainees";
include '../Php/authenticate.php';
include '../Layouts/main-admin.php'; 
 include '../Php/db_connect.php';


  ?>
                
                <div class="col-lg-8 mb-4 order-0">
                  <div class="card">
                    <div class="d-flex align-items-end row">

           <!--   center layout -->

                      <div class="col-sm-7">
                        <div class="card-body">
                          <h5 class="card-title text-primary">Congratulations John! 🎉</h5>
                          <p class="mb-4">
                            You have done <span class="fw-medium">72%</span> more sales today. Check your new badge in
                            your profile.
                          </p>

                          <a href="javascript:;" class="btn btn-sm btn-outline-primary">View Badges</a>
                        </div>
                      </div>



                      <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                          <img
                            src="../assets/img/illustrations/man-with-laptop-light.png"
                            height="140"
                            alt="View Badge User"
                            data-app-dark-img="illustrations/man-with-laptop-dark.png"
                            data-app-light-img="illustrations/man-with-laptop-light.png" />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>


                <!-- trainee table -->
                <!-- Bootstrap Dark Table -->
  
              <div class="card ">
              <?php 
                               if(isset($_SESSION['success']))
                                {
                                  ?>

                                        <div class="alert alert-success alert-dismissible" role="alert">
                                                  <?=$_SESSION['success']?>
                                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                <?php
                                  unset($_SESSION['success']);
                                  
                      }
                    ?>

              <?php 
                               if(isset($_SESSION['error']))
                                {
                                  ?>

                                        <div class="alert alert-danger alert-dismissible" role="alert">
                                                  <?=$_SESSION['error']?>
                                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                <?php
                                  unset($_SESSION['error']);
                      }
                    ?>
                                
                <h5 class="card-header">Trainees</h5>
                <div class="table-responsive text-nowrap">
                <table class="datatables-ajax table table-bordered">
                    <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">OJT ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Age</th>
                    <th scope="col">Sex</th>
                    <th scope="col">Contact no.</th>
                    <th scope="col">Course</th>
                    <th scope="col">University</th>
                    <th scope="col">Hours to render</th>
                    <!-- <th scope="col">Date started</th> -->
                    <!-- <th scope="col">Department</th> -->

                    <!-- <th scope="col">Office</th> -->

                    <th scope="col">Email</th>
                    <!-- <th scope="col">Password</th>
                    <th scope="col">Usertype</th>
                    <th scope="col">Status</th> -->
                    <!-- <th scope="col">Operation</th> -->
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
  <?php 
     
     $sql= "SELECT * FROM trainees ";
     $query =mysqli_query($connect, $sql);
    if(mysqli_num_rows($query)>0) {

     while ($row=mysqli_fetch_assoc($query))  {

     
      ?>

                     <tr>

                        <td><?= $row ['id']; ?></td>
                        <td><?= $row ['ojt_id']; ?></td>

                        <td><?=  $row ['last_name'].","." ". $row['first_name']." ". $row['middle_name']; ?></td>;   
                        <td><?= $row ['age']; ?></td>;                  
                        <td><?= $row ['sex']; ?></td>
                        <td><?= $row ['contact_num']; ?></td>
                        <td><?= $row ['degree']; ?></td>
                        <td><?= $row ['university']; ?></td>
                        <td><?= $row ['hours_to_render']; ?></td>
                        <!-- <td><?= $row ['dos']; ?></td> -->
                        <!-- <td><?= $row ['department']; ?></td> -->

                        <!-- <td><?= $row ['office_assigned']; ?></td> -->
                        <td><?= $row ['email']; ?></td>
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

   <script src="../Assets/js/tables-datatables-advanced.js"></script>
   <?php include '../Layouts/footer.php'; ?>