<?php 
session_start();
$usertype = 'Manager';
include '../Php/authenticate.php';
checkLoggedIn();
// checkUserType();
$title="Trainees";
include '../Layouts/main-manager.php'; 
 include '../Php/db_connect.php';
$department_id = $_SESSION['department_id'];

  ?>


 <div class="card ">              
         <h5 class="card-header">Trainees</h5>
         <div class="table-responsive text-nowrap">
         <table class="table table-bordered my-2" id="dataTrainee">
             <thead class="table-dark" style = "color: white;">
         <tr>
             <th >OJT ID</th>
             <th>Name</th>
             <th >Profile</th>
             <th >Age</th>
             <th >Sex</th>
             <th >Department</th>
             <th >Email</th>
             <th >Actions</th>
         </tr>
     </thead>
 <?php 
     
 $sql = "SELECT us.*,
 tr.ojt_id,
 tr.university,
 dp.departments,
 dp.id AS department_id

     FROM users us
     INNER JOIN trainees tr ON tr.user_id = us.id
     INNER JOIN departments dp ON dp.id= us.department_id
     WHERE us.user_type = 'Trainee'  
     AND us.department_id = '$department_id'
     "; 

     // Fetch data from the reports table
     $query = mysqli_query($connect, $sql);
     if(mysqli_num_rows($query) > 0) {
     while ($row = mysqli_fetch_assoc($query)) {     
     $defaultProfileImage = '../Assets/img/avatars/av.png';
     $profileImage = !empty($row['profile']) ? '../Assets/img/avatars/'.$row['profile'] : $defaultProfileImage;
     $name= $row['first_name'].' '.$row['middle_name'].' '.$row['last_name']; 
     $_SESSION['user_name'] = $row['first_name'];
     date_default_timezone_set('Asia/Manila');// local timezone

     $dateOfBirth =   date($row['dob']); // Example date of birth
     // Calculate age
     $today = new DateTime();
     $birthdate = new DateTime($dateOfBirth);
     $age = $birthdate->diff($today)->y;
     
 ?>
  
 <tr class="table-white">
     <td>
     <i class='fas fa-user'></i>
         <span class="fw-medium"><?= $row['ojt_id'] ?></span>
     </td>
     <td><?= $name ?></td>
     <td>
         <div
         data-bs-toggle="tooltip"
         data-popup="tooltip-custom"
         data-bs-placement="top"
         class="avatar pull-up"
         title="<?= $name ?>">
         <img src="<?= $profileImage?>" alt="Avatar" class="rounded-circle" />
         </div>
     </td>

     <td><?= $age; ?></td>
     <td><?= $row ['sex']; ?></td>
  
     <td><span class="badge bg-label-info me-1"><?=$row['departments'] ?></span></td>
     <td><?= $row ['email']; ?></td>
     <td>
     <div class="row">
        <div class= "col" >
        <a class="dropdown-item" href="../Manager/TraineeProfileManager.php?trainee_profile=<?=$row['id'] ?>"> <button class= "btn btn-warning " data-bs-toggle="tooltip" data-bs-placement="top" title="View profile records"><i class='fa fa-user-circle'></i> </button></a>
        </div>
        <div class= "col">
        <a class="dropdown-item" href="../Timesheet/DisplayUserAttendanceManager.php?trainee_attendance=<?=$row['id'] ?>"> <button class= "btn btn-info " data-bs-toggle="tooltip" data-bs-placement="top" title="View attendance records"><i class="fa-regular fa-clipboard-user"></i></button></a>

        </div>
     </div>
    </td>
 </tr>
<?php }} ?>

<script src="../Assets/js/jquery.js"></script>
<script src="../Assets/js/datatables.js"></script>
<script>
$(document).ready( function () {
    $('#dataTrainee').DataTable({
        responsive: true,
        order: [[0, 'desc']] 
    });
});

</script> 
   <?php include '../Layouts/footer.php'; ?>
   
  
          
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