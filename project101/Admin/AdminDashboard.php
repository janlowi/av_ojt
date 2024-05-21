<?php 
session_start();
$title="Admin Dashboard";
include '../Php/authenticate.php'; 
include '../Layouts/main-admin.php'; 
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
           $ojt_ID = "AVOJT-001";
       }
       else
       {
           $ojt_ID = substr($last_id, 6);
           $ojt_ID = intval($ojt_ID);
           $ojt_ID = "AVOJT-00" . ($last_id + 1);
       }
   ?>
 


                       <!-- Modal -->
                       <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
                         <div class="modal-dialog modal-dialog-centered" role="document">
                           <div class="modal-content">
                             <div class="modal-header">
                               <h2 class="modal-title" id="modalCenterTitle">Register user.</h2>

                               <button
                                 type="button"
                                 class="btn-close"
                                 data-bs-dismiss="modal"
                                 aria-label="Close">
                               </button>
                             </div>
                                                        

                                               <div class="col-xl">
                                               <div class="card mb-4">
                                               <div class="card-body">

                                                                <div class="col-md-12">    
                                                                        <label for="usertype" class="form-label">Usertype</label>
                                                                        <select name="Usertype" id="usertype" class="form-select">
                                                                                <option value="">--Select Usertype--</option>
                                                                                <option value="Admin">Admin</option>
                                                                                <option value="Trainee">Trainee</option>
                                                                        </select>
                                                                        
                                                                </div><br>
                                                       <form method= 'Post' action="../Php/php-add.php" id="traineeForm"  style="display:none">

                                                       <div class="row g-3">
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
                                                                       <label for="inputLastname" class="form-label">Usertype</label>
                                                                       <input type="text" class="form-control" id="inputLastname"name = "Usertype" value="Trainee" readonly>
                                                               </div>

                                                               <div class="col-md-6">
                                                                       <label for="inputLastname" class="form-label">OJT-ID</label>
                                                                       <input type="text" class="form-control" id="inputLastname"name = "Ojtid" value="<?= $ojt_ID; ?>" readonly>
                                                               </div>

                                                               <div class="col-md-6">
                                                                       <label for="inputZip" class="form-label">Contact no.</label>
                                                                       <input type="number" class="form-control" id="inputZip"name = "Contact">
                                                               </div>

                                                               <div class="col-md-6">
                                                                       <label for="inputZip" class="form-label">Birthday</label>
                                                                       <input type="date" class="form-control" id="inputCity"name = "Birthday">
                                                               </div>

                                                               
                                                               <div class="col-md-4">    
                                                                       <label for="sex" class="form-label">Sex</label>
                                                                       <select name="Sex" id="sex" class="form-select">
                                                                               <option value="Male">Male</option>
                                                                               <option value="Female">Female</option>
                                                                       </select>
                                                               </div>
                                                            
                                                               <div class="col-md-6">    
                                                                       <label for="usertype" class="form-label">Department</label>
                                                                       <select name="Department" id="usertype" class="form-select">
                                                                               <option value="IT">IT</option>
                                                                               <option value="Accounitng">Accounitng</option>
                                                                               <option value="Finance">Finance</option>
                                                                               <option value="Admin">Admin</option>
                                                                               <option value="HR">HR</option>


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
                                                               <!-- <div class="col-md-12">
                                                                       <label for="password" class="form-label">Password</label>
                                                                       <input type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" class="form-control" id="password"name = "Password" data-bs-toggle="collapse" data-bs-target="#collapseExample">
                                                               </div>  
                                                               <div id="passwordHelpBlock" class="form-text">
                                                                  Your password must be 8-20 characters long, contains an UPPERCASE, a lowercase, a number and must have special characters.
                                                              </div> -->
                                                                              <!-- password must contain the following
                                                                              <div class="collapse" id="collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                                                                            <div class="card card-body" id="message">
                                                                                                <p>Password must contain the following characters:</p>
                                                                                                <p id="lower" class= "invalid">A lower case letter</p>
                                                                                                <p id="upper" class= "invalid">A capital (uppercase) letter</p>
                                                                                                <p id="number" class= "invalid">A number</p>
                                                                                                <p id="length" class= "invalid">Minimum of 8 characters</p>
                                                                                            </div>
                                                                                </div> -->

                                                               <!-- <div class="col-md-12">
                                                                       <label for="inputZip" class="form-label">Confirm Password</label>
                                                                       <input type="password" class="form-control" id="inputZip"name = "Confirm">
                                                               </div><br><br> -->

                                                              
                                                                <div class=" d-grid gap-2 col-6 mx-auto">
                                                                       <button id="register-btn" type="submit" name ="traineeSubmit"class="btn btn-dark">Register</button>
                                                               </div>
                                                             
                                                        </div>
                                               </form>


                                                        <form action="../Php/php-add.php" method="post" id="adminForm"  style="display:none"  class="row g-3">

                                                        <div class="row g-3">


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
                                                                       <label for="inputLastname" class="form-label">Usertype</label>
                                                                       <input type="text" class="form-control" id="inputLastname"name = "Usertype" value="Admin" readonly>
                                                                        </div>
                                                                        

                                                                        <div class="col-5">    
                                                                        <label for="usertype" class="form-label">Department</label>
                                                                        <select name="Department" id="usertype" class="form-select">
                                                                                <option value="IT">IT</option>
                                                                                <option value="Accounitng">Accounitng</option>
                                                                                <option value="Finance">Finance</option>
                                                                                <option value="Admin">Admin</option>
                                                                                <option value="HR">HR</option>


                                                                        </select>
                                                                        </div>

                                                                        <div class="col">    
                                                                        <select name="Status" id="status" class="form-select " hidden>
                                                                                <option value="Active" selected >Active</option>
                                                                                <option value="Deactivated">Deactivated</option>
                                                                        </select>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                        <label for="Office" class="form-label">Office Assigned</label>
                                                                        <select name="Office" id="office" class="form-select">
                                                                                <option value="Tayud">Tayud Office</option>
                                                                                <option value="Makati">Makati Office</option>
                                                                                <option value="NRA">NRA</option>
                                                                        </select>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                       <label for="inputZip" class="form-label">Birthday</label>
                                                                       <input type="date" class="form-control" id="inputCity"name = "Birthday">
                                                                         </div>

                                                                        
                                                                        <div class="col-md-4">    
                                                                                <label for="sex" class="form-label">Sex</label>
                                                                                <select name="Sex" id="sex" class="form-select">
                                                                                        <option value="Male">Male</option>
                                                                                        <option value="Female">Female</option>
                                                                                </select>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                        <label for="inputZip" class="form-label">Email</label>
                                                                        <input type="email" class="form-control" id="inputZip"name = "Email">
                                                                        </div>
                                                                        <!-- <div class="col-md-12">
                                                                        <label for="password" class="form-label">Password</label>
                                                                        <input type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" class="form-control" id="password"name = "Password" data-bs-toggle="collapse" data-bs-target="#collapseExample">
                                                                        </div>  
                                                                        <div id="passwordHelpBlock" class="form-text">
                                                                        Your password must be 8-20 characters long, contains an UPPERCASE, a lowercase, a number and must have special characters.
                                                                        </div> -->
                                                                                <!-- password must contain the following
                                                                                <div class="collapse" id="collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                                                                                <div class="card card-body" id="message">
                                                                                                        <p>Password must contain the following characters:</p>
                                                                                                        <p id="lower" class= "invalid">A lower case letter</p>
                                                                                                        <p id="upper" class= "invalid">A capital (uppercase) letter</p>
                                                                                                        <p id="number" class= "invalid">A number</p>
                                                                                                        <p id="length" class= "invalid">Minimum of 8 characters</p>
                                                                                                </div>
                                                                                        </div> -->

                                                                        <!-- <div class="col-md-12">
                                                                        <label for="inputZip" class="form-label">Confirm Password</label>
                                                                        <input type="password" class="form-control" id="inputZip"name = "Confirm">
                                                                        </div> -->
                                                                        <div>
                                                                        <div class=" d-grid gap-2 col-6 mx-auto ">
                                                                        <button id="register-btn" type="submit" name ="adminSubmit"class="btn btn-dark ">Register</button>
                                                                        </div>  
                                                                        </div>
                                                                </div>
                                                        </form>

                                            </div>
                                       </div>

                               </div>  

                             <div class="modal-footer">
                             </div>
                           </div>
                         </div>
                         </div>

                   <script src="../Assets/js/form.js"></script>




                             <!-- Content wrapper -->




                    <div class="col-lg-3   col-md-12 col-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                                
                          <div class="card-title d-flex align-items-start justify-content-between">

                              <i class="fa-solid fa-users"   alt="chart success">
                               </i>
                          </div>                          
                          <?php 
                                  $sql= "SELECT * FROM users";
                                  $result= mysqli_query($connect, $sql);
                                  $count= mysqli_num_rows($result )
                
                          ?>
                          <span class="card-title text-success"> NO. OF USERS</span>
                          <h3 class="card-title mb-2"><?php echo $count.' ',' ','Users' ?></h3>
                          <!-- <small class="text-success fw-medium"><i class="bx bx-up-arrow-alt"></i></small> -->
                        </div>
                      </div>
                    </div>
               


           
                   <div class="col-lg-3   col-md-12 col-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                                
                          <div class="card-title d-flex align-items-start justify-content-between">

                              <i class="fa-solid fa-users"   alt="chart success">
                               </i>
                          </div>

                          <?php 
                                  $sql= "SELECT * FROM users WHERE user_type='Trainee'";
                                  $result= mysqli_query($connect, $sql);
                                  $trainee_count= mysqli_num_rows($result )
                
                          ?>
                          <span class="card-title text-primary"> NO. OF TRAINEES</span>
                          <h3 class="card-title mb-2"><?php echo $trainee_count.' ',' ','Trainees' ?></h3>
                          <!-- <small class="text-success fw-medium"><i class="bx bx-up-arrow-alt"></i></small> -->
                        </div>
                      </div>
                    </div>
             

                    <div class="col-lg-3   col-md-12 col-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                                
                          <div class="card-title d-flex align-items-start justify-content-between">

                              <i class="fa-solid fa-users"   alt="chart success">
                               </i>
                          </div>
                          <?php 
                                  $sql= "SELECT * FROM users WHERE user_type='Admin'";
                                  $result= mysqli_query($connect, $sql);
                                  $admin_count= mysqli_num_rows($result )
                
                          ?>
                          <span class="card-title text-info"> NO. OF ADMINS</span>
                          <h3 class="card-title mb-2"><?php echo $admin_count.' ',' ','Admins' ?></h3>
                          <!-- <small class="text-success fw-medium"><i class="bx bx-up-arrow-alt"></i></small> -->
                        </div>
                      </div>
                    </div>
     
      



                <!-- trainee table -->
                <!-- Bootstrap Dark Table -->
  
    
        
                          <!-- Table -->

                          <button
                         type="button"
                         class="btn btn-success"
                         data-bs-toggle="modal"
                         data-bs-target="#modalCenter">
                         ADD USER
                       </button>
<div class="card ">
                                       
                <h5 class="card-header">Users</h5>
                <div class=" table-responsive    text-nowrap">
                  <table class="table table-dark">
                    <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Sex</th>
                    <th scope="col">Date started</th>
                    <th scope="col">Department</th>
                    <th scope="col">Office</th>
                    <th scope="col">Email</th>
                    <!-- <th scope="col">Password</th> -->
                    <th scope="col">Usertype</th>
                    <th scope="col">Status</th>
                    <th scope="col">Operation</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
            <?php 
    
    $sql= "SELECT  us.*,
                   tr.dos

           FROM    users us, 
                   trainees tr
                   
           WHERE   us.id=tr.user_id ";
    $query =mysqli_query($connect, $sql);
  

   if( $count = mysqli_num_rows($query)>0) {
   
    while ($row=mysqli_fetch_assoc($query))  {
   
  

     ?>


                     <tr>

                        <td><?= $row ['id']; ?></td>
                        <td><?=  $row ['last_name'].","." ". $row['first_name']." ". $row['middle_name']; ?></td>;                     
                        <td><?= $row ['sex']; ?></td>
                        <td><?= $row ['dos']; ?></td>
                        <td><?= $row ['department']; ?></td>
                        <td><?= $row ['office_assigned']; ?></td>
                        <td><?= $row ['email']; ?></td>
                        <!-- <td><?= $row ['password']; ?></td> -->
                        <td><?= $row ['user_type']; ?></td>
                       <td><?php  
                            $status = $row ['status'];
                            if($status==='Active') {

                                echo ' <a class="item" href="../Php/php-status.php? deactivate='.$row['id'].'"
                                ><button class= "btn btn-danger">Deactivate</button></i></a
                              > ';
                            }elseif($status==='Deactivated'){
                                echo ' <a class="item" href="../Php/php-status.php? activate= '.$row['id'].'"
                                ><button class= "btn btn-success">Acivate</button></i></a
                              > ';
                            }else{
                                echo ' <a class="item" href="../Php/php-status.php? deactivate='.$row['id'].'"
                                ><button class= "btn btn-danger">Deactivate</button></i></a
                              > ';
                            }
                            ?>
                            </td>
                                <td>
                            <a class="item" href="../Admin/Update.php? update=<?= $row ['id']; ?>"
                                ><button class= "btn btn-info">Update</button></i></a
                              >


                        </td>
                      </tr> 
<?php
}
    }
?>
                      </tbody>
                  </table>

              <!--/ Bootstrap Dark Table -->
  </div>



    <?php

include '../Layouts/footer.php'; 

 ?>