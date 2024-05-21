<?php 
session_start();
$title="Update";
include '../Layouts/main-admin.php'; 
include '../Php/authenticate.php';
 include '../Php/db_connect.php';



 if(isset($_GET['update'])) 
 
 $user_id= $_GET['update'];
         $sql = "SELECT us.*,
                        tr.id,
                        tr.ojt_id,
                        tr.contact_num,
                        tr.degree,
                        tr.university,
                        tr.hours_to_render,
                        tr.dos
         
          FROM users us
        INNER JOIN trainees tr ON tr.user_id = us.id
          WHERE us.id = '$user_id' 
           ";
         $result = mysqli_query($connect, $sql);
         $row = mysqli_fetch_assoc($result);
       if ($row>0 ) {
        $id = $row['id'];
        $ojtid = $row["ojt_id"];
        $firstname = $row["first_name"];
         $middlename = $row["middle_name"];
          $lastname = $row["last_name"];
          $dob =  $row["dob"];
           $sex = $row["sex"];
             $course = $row["degree"];
             $university = $row["university"];
              $hours = $row["hours_to_render"];
               $dos = $row["dos"];
                $office = $row["office_assigned"];
                 $email = $row["email"];
                 $password = $row["password"];
                 $confirm_pass = $row["password"];
                   $usertype = $row["user_type"];
                   $contact= $row["contact_num"];
                   $status = $row["status"];
                   $department = $row["department"]; 
                   date_default_timezone_set('Asia/Manila');// local timezone

                   $dateOfBirth =   date($row['dob']);
                   $dateOfStart =   date($row['dos']);
                   $start = new DateTime($dateOfStart);
                   // Calculate age
                   $today = new DateTime();
                   $birthdate = new DateTime($dateOfBirth);
                
                   $age = $birthdate->diff($today)->y;
    
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
                                    <h2 class="modal-title" id="modalCenterTitle">Update account for trainee.</h2>
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
                                                               <div class="col-md-6">
                                                                       <label for="inputLastname" class="form-label">OJT-ID</label>
                                                                       <input type="text" class="form-control" id="inputLastname"name = "Ojtid"  value = "<?php echo $ojtid?>" readonly>
                                                               </div>

                                                               <div class="col-md-6">
                                                                       <label for="inputZip" class="form-label">Contact no.</label>
                                                                       <input type="number" class="form-control" id="inputZip"name = "Contact"  value = "<?php echo $contact?>">
                                                               </div>

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
                                                                       </select>
                                                               </div>
                                                               <div class="col-md-6">    
                                                                       <label for="usertype" class="form-label">Department</label>
                                                                       <select name="Department" id="usertype" class="form-select">
                                                                               <option value="IT" <?php if ($department == 'IT' ) {
                                                                                echo 'selected'; }?>>IT</option>
                                                                               <option value="Accounitng" <?php if ($department == 'Accounting' ) {
                                                                                echo 'selected'; }?>>Accounting</option>
                                                                               <option value="Finance" <?php if ($department == 'Finance' ) {
                                                                                echo 'selected'; }?>>Finance</option>
                                                                               <option value="Admin" <?php if ($department == 'Admin' ) {
                                                                                echo 'selected'; }?>>Admin</option>
                                                                               <option value="HR" <?php if ($department == 'HR' ) {
                                                                                echo 'selected'; }?>>HR</option>


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
                                                                       <input type="text" class="form-control" id="inputCourse" name = "Course" value = "<?php echo $course?>">
                                                               </div>
                                                               <div class="col-12">
                                                                       <label for="inputAddress2" class="form-label">University</label>
                                                                       <input type="text" class="form-control" id="inputAddress2"name = "University" value = "<?php echo $university?>">
                                                               </div>
                                                               <div class="col-md-4">
                                                                       <label for="inputCity" class="form-label">Hours to render</label>
                                                                       <input type="number" class="form-control" id="inputCity"name = "Hours" value = "<?php echo $hours?>">
                                                               </div>
                                                               <div class="col-md-4">
                                                                       <label for="inputCity" class="form-label">Date started</label>
                                                                       <input type="date" class="form-control" id="inputCity"name = "Dos" value = "<?php echo $dos?>">
                                                               </div>
                                                               <div class="col-md-4">
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
                                                               <div class="col-md-12">
                                                                       <label for="inputZip" class="form-label">Email</label>
                                                                       <input type="email" class="form-control" id="inputZip"name = "Email" value = "<?php echo $email?>">
                                                               </div>
                                                               <!-- <div class="col-md-12">
                                                                       <label for="password" class="form-label">Password</label>
                                                                       <input type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" class="form-control" id="password"name = "Password" value = "<?php echo $password?>">
                                                               </div>   -->
                                                               <!-- <div id="passwordHelpBlock" class="form-text">
                                                                  Your password must be 8-20 characters long, contains an UPPERCASE, a lowercase, a number and must have special characters.
                                                              </div>
                                                                              password must contain the following

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
                                                                       <input type="password" class="form-control" id="inputZip"name = "Confirm" value = "<?php echo $confirm_pass?>">
                                                               </div> -->
                                                               <div class="col-md-12">
                                                                       <label for="inputGroupFile04" class="form-label"> Profile</label>
                                                                       <input type="file" class="form-control" id="inputGroupFile04"  aria-label="Upload" name='Profile'>
                                                               </div>

                                                                        
                                                                <!-- id to edit -->

                                                                <input type="text" name = "edit_id" value = "<?php echo $id?>" hidden>

                                                        <div class="row mt-3">
                                                               <div class=" d-grid gap-2 col-6 mx-auto">
                                                                <button name="update" type="submit" class="btn btn-dark btn-lg">Update</button>
                                                               </div>
                                                        </div>
                                               </form>
                                         
                        
  <?php include '../Layouts/footer.php';?>                      
