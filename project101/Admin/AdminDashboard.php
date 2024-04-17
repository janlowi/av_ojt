<?php 
session_start();

include '../Layouts/main.php'; 
 include '../Layouts/sidebar.php';
 include '../Layouts/navbar.php';
 include '../Php/db_connect.php';


  ?>
   

<?php

error_reporting (0);
       $query = "SELECT * FROM trainees ORDER BY id DESC LIMIT 1";
       $result= mysqli_query($connect,$query);
       $row = mysqli_fetch_array($result);
       $last_id = $row['id'];
       if ($last_id == "")
       {
           $ojt_ID = "AVOJT0001";
       }
       else
       {
           $ojt_ID = substr($last_id, 6);
           $ojt_ID = intval($ojt_ID);
           $ojt_ID = "AVOJT-00" . ($last_id + 1);
       }
   ?>
                       <!-- Button trigger modal -->
                       <button
                         type="button"
                         class="btn btn-primary"
                         data-bs-toggle="modal"
                         data-bs-target="#modalCenter">
                         Launch modal
                       </button>

                       <!-- Modal -->
                       <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
                         <div class="modal-dialog modal-dialog-centered" role="document">
                           <div class="modal-content">
                             <div class="modal-header">
                               <h2 class="modal-title" id="modalCenterTitle">Create account for trainee.</h2>

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
                                                       <form class="row g-3" method= 'Post' action="../Php/php-add.php";>
                                                               <div class="col-md-6">
                                                                       <label for="inputEmail4" class="form-label">Firstname</label>
                                                                       <input type="text" class="form-control" id="inputEmail4" name = "Firstname">
                                                               </div>
                                                               <div class="col-md-6">
                                                                       <label for="inputMiddlename" class="form-label">Middlename</label>
                                                                       <input type="text" class="form-control" id="inputMiddlename"name = "Middlename">
                                                               </div>
                                                               <div class="col-md-6">
                                                                       <label for="inputLastname" class="form-label">Lastname</label>
                                                                       <input type="text" class="form-control" id="inputLastname"name = "Lastname">
                                                               </div>
                                                               <div class="col-md-6">
                                                                       <label for="inputLastname" class="form-label">OJT-ID</label>
                                                                       <input type="text" class="form-control" id="inputLastname"name = "Ojtid" value="<?= $ojt_ID; ?>" readonly>
                                                               </div>

                                                               <div class="col-md-6">
                                                                       <label for="inputZip" class="form-label">Contact no.</label>
                                                                       <input type="number" class="form-control" id="inputZip"name = "Contact">
                                                               </div>

                                                               <div class="col-md-2">
                                                                       <label for="inputZip" class="form-label">Age</label>
                                                                       <input type="number" class="form-control" id="inputZip"name = "Age">
                                                               </div>

                                                               
                                                               <div class="col-md-4">    
                                                                       <label for="sex" class="form-label">Sex</label>
                                                                       <select name="Sex" id="sex" class="form-select">
                                                                               <option value="Male">Male</option>
                                                                               <option value="Female">Female</option>
                                                                       </select>
                                                               </div>
                                                               <div class="col-md-6">    
                                                                       <label for="usertype" class="form-label">Usertype</label>
                                                                       <select name="Usertype" id="usertype" class="form-select">
                                                                               <option value="Admin">Admin</option>
                                                                               <option value="Trainee">Trainee</option>
                                                                       </select>
                                                               </div>
                                                               <div class="col-md-6">    
                                                                       <select name="Status" id="status" class="form-select" hidden>
                                                                               <option value="Active" selected >Active</option>
                                                                               <option value="Deactivated">Deactivated</option>
                                                                       </select>
                                                               </div>

                                                               <div class="col-12">
                                                                       <label for="inputCourse" class="form-label">Course/Degree</label>
                                                                       <input type="text" class="form-control" id="inputCourse" name = "Course">
                                                               </div>
                                                               <div class="col-12">
                                                                       <label for="inputAddress2" class="form-label">University</label>
                                                                       <input type="text" class="form-control" id="inputAddress2"name = "University">
                                                               </div>
                                                               <div class="col-md-4">
                                                                       <label for="inputCity" class="form-label">Hours to render</label>
                                                                       <input type="number" class="form-control" id="inputCity"name = "Hours">
                                                               </div>
                                                               <div class="col-md-4">
                                                                       <label for="inputCity" class="form-label">Date started</label>
                                                                       <input type="date" class="form-control" id="inputCity"name = "Dos">
                                                               </div>
                                                               <div class="col-md-4">
                                                                       <label for="Office" class="form-label">Office Assigned</label>
                                                                       <select name="Office" id="office" class="form-select">
                                                                               <option value="Tayud">Tayud Office</option>
                                                                               <option value="Makati">Makati Office</option>
                                                                               <option value="NRA">NRA</option>
                                                                       </select>
                                                               </div>
                                                               <div class="col-md-12">
                                                                       <label for="inputZip" class="form-label">Email</label>
                                                                       <input type="email" class="form-control" id="inputZip"name = "Email">
                                                               </div>
                                                               <div class="col-md-12">
                                                                       <label for="inputZip" class="form-label">Password</label>
                                                                       <input type="password" class="form-control" id="inputZip"name = "Password">
                                                               </div>  
                                                               <div class="col-md-12">
                                                                       <label for="inputZip" class="form-label">Confirm Password</label>
                                                                       <input type="password" class="form-control" id="inputZip"name = "Confirm">
                                                               </div>
                                                               <!-- <div class="col-md-12">
                                                                       <label for="inputGroupFile04" class="form-label"> Profile</label>
                                                                       <input type="file" class="form-control" id="inputGroupFile04"  aria-label="Upload" name='Profile'>
                                                               </div> -->
                                                               <div class=" d-grid gap-2 col-6 mx-auto">
                                                                       <button id="register-btn" type="submit" name = "submit"class="btn btn-dark">Register</button>
                                                               </div>
                                               </form>
                                            </div>
                                       </div>
                                    </div>
                               </div>  

                             <div class="modal-footer">
                               <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                 Close
                               </button>
                             </div>
                           </div>
                         </div>
                       </div>
                     </div>
                   </div>


          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content --> 
          <!-- Layout container -->
          <div class="layout-page">

            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col-lg-8 mb-4 order-0">
                  <div class="card">
                    <div class="d-flex align-items-end row">
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
                                
                                
              <button
                         type="button"
                         class="btn btn-dark"
                         data-bs-toggle="modal"
                         data-bs-target="#modalCenter">
                         ADD TRAINEE
                       </button>
                <h5 class="card-header">Trainees</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table table-dark">
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
                    <th scope="col">Date started</th>
                    <th scope="col">Office</th>

                    <th scope="col">Email</th>
                    <th scope="col">Password</th>
                    <th scope="col">Usertype</th>
                    <th scope="col">Status</th>
                    <th scope="col">Operation</th>
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
                        <td><?= $row ['dos']; ?></td>
                        <td><?= $row ['office_assigned']; ?></td>
                        <td><?= $row ['email']; ?></td>
                        <td><?= $row ['password']; ?></td>
                        <td><?= $row ['user_type']; ?></td>

                       <td><span class="badge bg-label-primary me-1"><?= $row ['status']; ?></span></td>
                       <td>
                            <div class="menu">
                              <a class="item" href="javascript:void(0);"
                                ><i class='bx bx-edit'></i></a
                              >
                              <a class="item" href="javascript:void(0);"
                                ><i class="bx bx-trash me-2"></i></a
                              >
                            </div>

                        </td>
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
                    </div>
                  </div>
                </div>


            <!-- / Content -->
            <div class="content-backdrop fade"></div>
          </div>
        </div>
          <!-- Content wrapper -->
          