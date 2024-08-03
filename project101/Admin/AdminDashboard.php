<?php 
session_start();
$usertype = 'Admin';
include '../Php/authenticate.php'; 
checkLoggedIn();
$title="Admin Dashboard";

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
                                                                                <option value="Manager">Manager</option>
                                                                        </select>
                                                                        
                                                                </div><br>
                                                       <form method= 'Post' action="../Php/php-add.php" id="traineeForm"  style="display:none;">

                                                       <div class="row g-3">
                                                                <div class="col-md-6">
                                                                       <label for="inputFirstname" class="form-label">Firstname</label>
                                                                       <input type="text" class="form-control" id="inputFirstname1" name = "Firstname" required>
                                                               </div>
                                                               <div class="col-md-6">
                                                                       <label for="inputMiddlename" class="form-label">Middlename</label>
                                                                       <input type="text" class="form-control" id="inputMiddlename1" name = "Middlename" >
                                                               </div>
                                                               <div class="col-md-6">
                                                                       <label for="inputLastname" class="form-label">Lastname</label>
                                                                       <input type="text" class="form-control" id="inputLastname1" name = "Lastname" required>
                                                               </div>

                                                               <div class="col-md-6">
                                                                       <label for="inputUsertype" class="form-label">Usertype</label>
                                                                       <input type="text" class="form-control" id="inputUsertype1" name = "Usertype" value="Trainee" readonly>
                                                               </div>

                                                               <div class="col-md-6">
                                                                       <label for="inputOjtid" class="form-label">OJT-ID</label>
                                                                       <input type="text" class="form-control" id="inputOjtid" name = "Ojtid" value="<?= $ojt_ID; ?>" readonly>
                                                               </div>

                                                               <div class="col-md-6">
                                                                       <label for="inputContact" class="form-label">Contact no.</label>
                                                                       <input type="number" class="form-control" id="inputContact" name = "Contact" required>
                                                               </div>

                                                               <div class="col-md-6">
                                                                       <label for="inputBirthday" class="form-label">Birthday</label>
                                                                       <input type="date" class="form-control" id="inputBirthday"name = "Birthday" required>
                                                               </div>

                                                               
                                                               <div class="col-md-4">    
                                                                       <label for="sex" class="form-label">Sex</label>
                                                                       <select name="Sex" id="sex2" class="form-select" required>
                                                                                <option value="">--Select Gender--</option>
                                                                               <option value="Male">Male</option>
                                                                               <option value="Female">Female</option>
                                                                       </select>
                                                               </div>
                                                            
                                                               <div class="col-md-6">    
                                                                       <label for="Department" class="form-label">Department</label>
                                                                       <select name="Department" id="Department" class="form-select" required>
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
                                                                       </select>
                                                               </div>
                                                               <div class="col-md-6">    
                                                                       <select name="Status" id="status1" class="form-select" hidden>
                                                                                <option value="">--Select Office--</option>
                                                                               <option value="Active" selected >Active</option>
                                                                               <option value="Deactivated">Deactivated</option>
                                                                       </select>
                                                               </div>

                                                               <div class="col-12">
                                                                       <label for="inputCourse" class="form-label">Course/Degree</label>
                                                                       <input type="text" class="form-control" id="inputCourse" name = "Course" required>
                                                               </div>
                                                               <div class="col-12">
                                                                       <label for="inputUniversity" class="form-label">University</label>
                                                                       <input type="text" class="form-control" id="inputUniversity" name = "University" required>
                                                               </div>
                                                               <div class="col-md-4">
                                                                       <label for="inputHours" class="form-label">Hours to render</label>
                                                                       <input type="number" class="form-control" id="inputHours" name = "Hours" required>
                                                               </div>
                                                               <div class="col-md-4">
                                                                       <label for="inputDateStarted" class="form-label">Date started</label>
                                                                       <input type="date" class="form-control" id="inputDateStarted" name = "Dos" required>
                                                               </div>
                                                               <div class="col-md-4">
                                                                       <label for="Office" class="form-label">Office Assigned</label>
                                                                       <select name="Office" id="office1" class="form-select" required>
                                                                                 <option value="">--Select Office--</option>
                                                                               <option value="Tayud">Tayud Office</option>
                                                                               <option value="Makati">Makati Office</option>
                                                                               <option value="NRA">NRA</option>
                                                                       </select>
                                                               </div>
                                                               <div class="col-md-12">
                                                                       <label for="inputEmail" class="form-label">Email</label>
                                                                       <input type="email" class="form-control" id="inputEmail" name = "Email" required>
                                                               </div>
                                                              
                                                               <div class="col-md-4">
                                                                        <label for="inputRph" class="form-label">Rate per Hour</label>
                                                                        <input type="number" class="form-control" id="inputRph" name = "Rph" required>
                                                                        </div>
                                                                        
                                                                <div class=" d-grid gap-2 col-6 mx-auto">
                                                                       <button id="register-btn1" type="submit" name ="traineeSubmit"class="btn btn-dark">Register</button>
                                                               </div>
                                                             
                                                        </div>
                                               </form>


                                                        <form action="../Php/php-add.php" method="post" id="adminForm"  style="display:none;"  class="row g-3">

                                                        <div class="row g-3">


                                                                        <div class="col-md-6">
                                                                        <label for="inputFirstname2" class="form-label">Firstname</label>
                                                                        <input type="text" class="form-control" id="inputFirstname2" name = "Firstname" required>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                        <label for="inputMiddlename" class="form-label">Middlename</label>
                                                                        <input type="text" class="form-control" id="inputMiddlename2" name = "Middlename" >
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                        <label for="inputLastname" class="form-label">Lastname</label>
                                                                        <input type="text" class="form-control" id="inputLastname2" name = "Lastname" required>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                       <label for="inputUsertype" class="form-label">Usertype</label>
                                                                       <input type="text" class="form-control" id="inputUsertype2" name = "Usertype" value="Admin" readonly>
                                                                        </div>
                                                                        

                                                                        <div class="col-5">    
                                                                        <label for="usertype" class="form-label">Department</label>
                                                                        <select name="Department" id="Department1" class="form-select" required>
                                                                        <option value="">--Select Department--</option>
                                                                         <?php       
                                                                         $department_query=mysqli_query($connect, $department);

                                                                         if($department_query && mysqli_num_rows($department_query)> 0){
                                                                                 while($department_row = mysqli_fetch_assoc($department_query)){

                                                                                         echo '
                                                                                               
                                                                                                 <option value="'.$department_row['id'].'">'.$department_row['departments'].'</option>
                                                                                         ';
                                                                                 }
                                                                         }
                                                                 ?>


                                                                        </select>
                                                                        </div>

                                                                        <div class="col">    
                                                                        <select name="Status" id="status2" class="form-select " hidden>
                                                                                <option value="Active" selected >Active</option>
                                                                                <option value="Deactivated">Deactivated</option>
                                                                        </select>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                        <label for="Office" class="form-label">Office Assigned</label>
                                                                        <select name="Office" id="office2" class="form-select" required>
                                                                                <option value="">--Select Office--</option>
                                                                                <option value="Tayud">Tayud Office</option>
                                                                                <option value="Makati">Makati Office</option>
                                                                                <option value="NRA">NRA</option>
                                                                        </select>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                       <label for="inputBday" class="form-label">Birthday</label>
                                                                       <input type="date" class="form-control" id="inputBday" name = "Birthday" required>
                                                                         </div>

                                                                        
                                                                        <div class="col-md-4">    
                                                                                <label for="sex" class="form-label">Sex</label>
                                                                                <select name="Sex" id="sex" class="form-select" required>
                                                                                        <option value="">--Select Gender--</option>
                                                                                        <option value="Male">Male</option>
                                                                                        <option value="Female">Female</option>
                                                                                </select>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                        <label for="inputZip" class="form-label">Email</label>
                                                                        <input type="email" class="form-control" id="inputZip1"name = "Email" required>
                                                                        </div>
                                                                       
                                                                        <div>
                                                                        <div class=" d-grid gap-2 col-6 mx-auto ">
                                                                        <button id="register-btn2" type="submit" name ="adminSubmit"class="btn btn-dark ">Register</button>
                                                                        </div>  
                                                                        </div>

                                                                      
                                                                </div>
                                                        </form>

                                                        
                                                        <form action="../Php/php-add.php" method="post" id="managerForm"  style="display:none;"  class="row g-3">
                                                        <div class="row g-3">
                                                                        <div class="col-md-6">
                                                                        <label for="inputFirstname" class="form-label">Firstname</label>
                                                                        <input type="text" class="form-control" id="inputFirstname" name = "Firstname" required>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                        <label for="inputMiddlename" class="form-label">Middlename</label>
                                                                        <input type="text" class="form-control" id="inputMiddlename3"name = "Middlename" >
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                        <label for="inputLastname" class="form-label">Lastname</label>
                                                                        <input type="text" class="form-control" id="inputLastname3"name = "Lastname" required>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                       <label for="inputUsertype" class="form-label">Usertype</label>
                                                                       <input type="text" class="form-control" id="inputUsertype3"name = "Usertype" value="Manager" readonly>
                                                                        </div>
                                                                        

                                                                        <div class="col-5">    
                                                                        <label for="usertype" class="form-label">Department</label>
                                                                        <select name="Department" id="Department2" class="form-select" required>
                                                                        <option value="">--Select Department--</option>
                                                                         <?php       
                                                                         $department_query=mysqli_query($connect, $department);

                                                                         if($department_query && mysqli_num_rows($department_query)> 0){
                                                                                 while($department_row = mysqli_fetch_assoc($department_query)){

                                                                                         echo '
                                                                                               
                                                                                                 <option value="'.$department_row['id'].'">'.$department_row['departments'].'</option>
                                                                                         ';
                                                                                 }
                                                                         }
                                                                 ?>


                                                                        </select>
                                                                        </div>

                                                                        <div class="col">    
                                                                        <select name="Status" id="status3" class="form-select " hidden>
                                                                                <option value="Active" selected >Active</option>
                                                                                <option value="Deactivated">Deactivated</option>
                                                                        </select>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                        <label for="Office" class="form-label">Office Assigned</label>
                                                                        <select name="Office" id="office3" class="form-select" required>
                                                                                <option value="">--Select Office--</option>
                                                                                <option value="Tayud">Tayud Office</option>
                                                                                <option value="Makati">Makati Office</option>
                                                                                <option value="NRA">NRA</option>
                                                                        </select>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                       <label for="inputZip" class="form-label">Birthday</label>
                                                                       <input type="date" class="form-control" id="inputCity"name = "Birthday" required>
                                                                         </div>

                                                                        
                                                                        <div class="col-md-4">    
                                                                                <label for="sex" class="form-label">Sex</label>
                                                                                <select name="Sex" id="sex1" class="form-select" required>
                                                                                        <option value="">--Select Gender--</option>
                                                                                        <option value="Male">Male</option>
                                                                                        <option value="Female">Female</option>
                                                                                </select>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                        <label for="inputZip" class="form-label">Email</label>
                                                                        <input type="email" class="form-control" id="inputZip2" name = "Email" required>
                                                                        </div>
                                                                       
                                                                        <div>
                                                                        <div class=" d-grid gap-2 col-6 mx-auto ">
                                                                        <button id="register-btn3" type="submit" name ="managerSubmit"class="btn btn-dark ">Register</button>
                                                                        </div>  
                                                                        </div>

                                                                      
                                                                </div>
                                                        </form>

                                            </div>
                                       </div>

                               </div>  
                           </div>
                         </div>
                         </div>
<script>
        document.getElementById('usertype').addEventListener('change', function() {
    var userType = this.value;
    if (userType === 'Admin') {
        document.getElementById('traineeForm').style.display = 'none';
        document.getElementById('adminForm').style.display = 'block';
        document.getElementById('managerForm').style.display = 'none';
        disableFields('traineeForm'); 
        disableFields('managerForm'); 
        enableFields('adminForm');   
        
    } else if (userType === 'Trainee') {
        document.getElementById('traineeForm').style.display = 'block';
        document.getElementById('managerForm').style.display = 'none';
        document.getElementById('adminForm').style.display = 'none';
        enableFields('traineeForm');  
        disableFields('managerForm'); 
        disableFields('adminForm');   

    } else if(userType === 'Manager'){
        document.getElementById('traineeForm').style.display = 'none';
        document.getElementById('managerForm').style.display = 'block';
        document.getElementById('adminForm').style.display = 'none';
        disableFields('traineeForm'); 
        enableFields('managerForm'); 
        disableFields('adminForm');   
    }
});

function enableFields(formId) {
    var form = document.getElementById(formId);
    var inputs = form.querySelectorAll('input, select, textarea');
    inputs.forEach(function(input) {
        input.disabled = false;
    });
}

function disableFields(formId) {
    var form = document.getElementById(formId);
    var inputs = form.querySelectorAll('input, select, textarea');
    inputs.forEach(function(input) {
        input.disabled = true;
    });
}
</script>
        <!-- Content wrapper -->
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
     
                    <div class="col-lg-3   col-md-12 col-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                                
                          <div class="card-title d-flex align-items-start justify-content-between">

                              <i class="fa-solid fa-users"   alt="chart success">
                               </i>
                          </div>
                          <?php 
                                  $sql= "SELECT * FROM users WHERE user_type='Manager'";
                                  $result= mysqli_query($connect, $sql);
                                  $manager_count= mysqli_num_rows($result )
                
                          ?>
                          <span class="card-title text-warning"> NO. OF MANAGERS</span>
                          <h3 class="card-title mb-2"><?php echo $manager_count.' ',' ','Managers' ?></h3>
                          <!-- <small class="text-success fw-medium"><i class="bx bx-up-arrow-alt"></i></small> -->
                        </div>
                      </div>
                    </div>



                <!-- trainee table -->
                <!-- Bootstrap Dark Table -->
  
    
        
                          <!-- Table -->

<div class="card ">
<div class="card-body">
                        <button
                         type="button"
                         class="btn btn-success"
                         data-bs-toggle="modal"
                         data-bs-target="#modalCenter">
                         ADD USER
                       </button>
                                       
                <!-- <h5 class="card-header">Users</h5> -->
                <div class=" table-responsive    text-nowrap">
                  <table class="table table-dark" id="allUsers">
                    <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Sex</th>
                    <!-- <th scope="col">Date started</th> -->
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
    
    $sql = "SELECT us.*,
                        dp.departments,
                        dp.id AS department_id
                        FROM users us
                        INNER JOIN departments dp ON dp.id= us. department_id ";


    $query =mysqli_query($connect, $sql);
   if( $count = mysqli_num_rows($query)>0) {
    while ($row=mysqli_fetch_assoc($query))  {
     ?>
                     <tr>
                        <td><?= $row ['id']; ?></td>
                        <td><?=  $row ['last_name'].","." ". $row['first_name']." ". $row['middle_name']; ?></td>                 
                        <td><?= $row ['sex']; ?></td>
                        <!-- <td><?= $row ['dos']; ?></td> -->
                        <td><?= $row ['departments']; ?></td>
                        <td><?= $row ['office_assigned']; ?></td>
                        <td><?= $row ['email']; ?></td>
                        <!-- <td><?= $row ['password']; ?></td> -->
                        <td><?= $row ['user_type']; ?></td>
                       <td><?php  
                            $status = $row ['status'];
                            if($status==='Active') {

                                echo ' <a class="item" href="../Php/php-status.php? deactivate='.$row['id'].'"
                                ><button class= "btn btn-xs  btn-danger">Deactivate</button></i></a
                              > ';
                            }elseif($status==='Deactivated'){
                                echo ' <a class="item" href="../Php/php-status.php? activate= '.$row['id'].'"
                                ><button class= "btn btn-xs btn-success">Acivate</button></i></a
                              > ';
                            }else{
                                echo ' <a class="item" href="../Php/php-status.php? deactivate='.$row['id'].'"
                                ><button class= "btn btn-xs btn-danger">Deactivate</button></i></a
                              > ';
                            }
                            ?>
                            </td>
                                <td>
                        <div class="col-md-12">
                            <a class="item" href="../Admin/Update.php? update=<?= $row ['id']; ?>"
                                ><button class= "btn btn-info">Update</button></i></a>
                            <a class="btn btn-warning" href="../Php/php-changepass.php?reset_pass=<?= $row ['id']; ?>">Reset Password</a>
                        </div>
                        </td>
                      </tr> 
<?php
}
    }
?>
                      </tbody>
                  </table>
 
<script src="../Assets/js/jquery.js"></script>
<script src="../Assets/js/datatables.js"></script>
<script>
$(document).ready( function () {
    $('#allUsers').DataTable({
        responsive: true,
        order: [[0, 'desc']] 
    });
});
</script> 
              </div>      
              
  </div>
  <?php include '../Layouts/realfooter.php'; ?>
    <?php
include '../Layouts/footer.php'; 

 ?>
 