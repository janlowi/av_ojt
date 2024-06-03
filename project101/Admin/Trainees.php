<?php 
session_start();
include '../Php/authenticate.php';
checkLoggedIn();
// checkUserType();
$title="Trainees";
include '../Layouts/main-admin.php'; 
 include '../Php/db_connect.php';


  ?>


        <div class="card ">              
                <h5 class="card-header">Trainees</h5>
                <div class="table-responsive text-nowrap">
                <table class="datatables-ajax table table-bordered my-2" id="dataTrainee">
                    <thead>
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
                            WHERE us.user_type = 'Trainee'  "; 

                            // Fetch data from the reports table
                            $query = mysqli_query($connect, $sql);
                            if(mysqli_num_rows($query) > 0) {
                            while ($row = mysqli_fetch_assoc($query)) {     
                            $defaultProfileImage = '../Assets/img/avatars/av.png';
                            $profileImage = !empty($row['profile']) ? '../Assets/img/avatars/'.$row['profile'] : $defaultProfileImage;
                            $name= $row['first_name'].' '.$row['middle_name'].' '.$row['last_name']; 
                            date_default_timezone_set('Asia/Manila');// local timezone

                            $dateOfBirth =   date($row['dob']); // Example date of birth
                            // Calculate age
                            $today = new DateTime();
                            $birthdate = new DateTime($dateOfBirth);
                            $age = $birthdate->diff($today)->y;
                                
                        ?>
  
                                                    <tr class="table-warning">
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
                                                            <div class="dropdown">
                                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                    <a class="dropdown-item" href="../Admin/TraineeProfile.php?trainee_profile=<?=$row['id'] ?>"><i class='fa fa-user-circle'></i> View Profile</a>
                                                                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
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

    });

} );

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