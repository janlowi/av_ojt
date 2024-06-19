<?php 
session_start();
$usertype = 'Admin';
include '../Php/authenticate.php';
checkLoggedIn();
// checkUserType();
$title="Update";
include '../Layouts/main-admin.php'; 
 include '../Php/db_connect.php';



 if(isset($_GET['update'])) 
 
 $user_id= $_GET['update'];
         $sql = "SELECT us.*
        FROM users us
        INNER JOIN departments dp ON dp.id = department_id
        WHERE us.id = '$user_id' 
        ";      

         $result = $connect->query($sql);

       if ($result->num_rows>0 ) {
        $row=$result->fetch_assoc();
        $firstname = $row["first_name"];
        $middlename = $row["middle_name"];
        $lastname = $row["last_name"];
        $dob =  $row["dob"];
        $sex = $row["sex"];
        $office = $row["office_assigned"];
        $email = $row["email"];
        $usertype = $row["user_type"];
        $status = $row["status"];
        $department_id = $row["department_id"];

                   
                  
       }
                

  ?>


<div class="card ">
<div class="card-body">
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
                     
                 <div class="modal-header">
                         <h2 class="modal-title" id="modalCenterTitle">Update User Information.</h2>
                             <a href="AdminDashboard.php">
                         <button
                             type="button"
                             class="btn-close"
                             data-bs-dismiss="modal"
                             aria-label="Close">
                         </button>
                         </a>
                  </div>
<div class="row">
        <div class="col-xl">
        <div class="card mb-4">
        <div class="card-body">
                <form class="row g-3" method= 'Post' action="../Php/php-update.php";>


                        <div class="col-md-6">
                                <label for="inputEmail4" class="form-label">Firstname</label>
                                <input type="text" class="form-control" id="inputEmail4" name = "Firstname" value = "<?php echo $firstname?>">
                        </div>
                        <div class="col-md-6">
                                <label for="inputMiddlename" class="form-label">Middlename</label>
                                <input type="text" class="form-control" id="inputMiddlename"name = "Middlename" value = "<?php echo $middlename?>">
                        </div>
                        <div class="col-md-6">
                                <label for="inputLastname" class="form-label">Lastname</label>
                                <input type="text" class="form-control" id="inputLastname"name = "Lastname"  value = "<?php echo $lastname?>">
                        </div>

                        <!-- <div class="col-md-6">
                                <label for="inputZip" class="form-label">Contact no.</label>
                                <input type="number" class="form-control" id="inputZip"name = "Contact"  value = "<?php echo $contact?>">
                        </div> -->

                        <div class="col-md-2">
                                <label for="inputZip" class="form-label">Birthday</label>
                                <input type="date" class="form-control" id="inputZip"name = "Birthday"  value = "<?php echo $dob;?>">
                        </div>

                        
                        <div class="col-md-4">    
                                <label for="sex" class="form-label">Sex</label>
                                <select name="Sex" id="sex" class="form-select">
                                        <option value="Male" <?php if ($sex == 'Male' ) {
                                         echo 'selected'; }?> >Male</option  >
                                        <option value="Female" <?php if ($sex == 'Female  ' ) {
                                         echo 'selected'; }?>>Female</option>
                                </select>
                        </div>
                        <div class="col-md-6">    
                                <label for="usertype" class="form-label">Usertype</label>
                                <select name="Usertype" id="usertype" class="form-select">
                                        <option value="Admin" <?php if ($usertype == 'Admin' ) {
                                         echo 'selected'; }?>>Admin</option>
                                        <option value="Trainee" <?php if ($usertype == 'Trainee' ) {
                                         echo 'selected'; }?>>Trainee</option>
                                          <option value="Manager" <?php if ($usertype == 'Manager' ) {
                                         echo 'selected'; }?>>Manager</option>
                                </select>
                        </div>
                        <div class="col-md-6">    
                                <label for="usertype" class="form-label">Department</label>
                                <select name="Department" id="usertype" class="form-select">
                                        
                         <?php 
                                 $sql_dept = "SELECT * FROM departments";
                                 $result_dept = $connect->query($sql_dept);

                                 if ($result_dept->num_rows > 0) {
                                         while ($row_dept = $result_dept->fetch_assoc()) {
                                             echo '<option value="' . $row_dept['id'] . '"';
                                             if ($department_id == $row_dept['id']) {
                                                 echo ' selected';
                                             }
                                             echo '>' . $row_dept['departments'] . '</option>';
                                         }
                                     }
                                 ?>   
                                </select>
                        </div>

                        <div class="col-md-6">
                                <label for="Office" class="form-label">Office Assigned</label>
                                <select name="Office" id="office" class="form-select">
                                        <option value="Tayud" <?php if ($office == 'Tayud' ) {
                                         echo 'selected'; }?>>Tayud Office</option>
                                        <option value="Makati" <?php if ($office == 'Makati' ) {
                                         echo 'selected'; }?>>Makati Office</option>
                                        <option value="NRA" <?php if ($office == 'NRA' ) {
                                         echo 'selected'; }?>>NRA</option>
                                </select>
                        </div>
                        <div class="col-md-6">
                                <label for="inputZip" class="form-label">Email</label>
                                <input type="email" class="form-control" id="inputZip"name = "Email" value = "<?php echo $email?>">
                        </div>   
                         <!-- id to edit -->
                         <input type="text" name = "edit_id" value = "<?php echo $user_id?>" hidden>

                 <div class="row mt-3">
                        <div class=" d-grid gap-2 col-6 mx-auto">
                         <button name="update" type="submit" class="btn btn-dark btn-lg">Update</button>
                        </div>
                 </div>
        </form>
  
        <?php include '../Layouts/realfooter.php'; ?>      
  <?php include '../Layouts/footer.php';?>                      
