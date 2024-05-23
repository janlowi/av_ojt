<?php 
session_start();
$title="Trainees";
include '../Php/authenticate.php';
include '../Layouts/main-admin.php'; 
 include '../Php/db_connect.php';


  ?>
                
                <style>
            .dt-layout-row .dt-paging, .dt-info {
                position: relative;

            }
        .dt-length{
            position: relative;
            padding: 10px;

        }
        .dt-length .dt-input{
            padding: 0 10px;
            border: none;
            outline: none;

        }
         
        .dt-search {
            display:flex;
            flex-direction: end;
            border: transparent ;
            outline:none;


        }
        .dt-search .dt-input{
            position: relative;
           height: 30px;
           outline: none;
           border:transparent;
           border-bottom: 1px solid var(--bs-secondary);
           padding: 0 0 5px 5px;


        }
        .dt-paging-button{
            padding-right: 12px;
            border-radius: 3px; 
        }
        .content-wrapper, .card {
            overflow-y: scroll
        }
    


</style>



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
     
     $sql= "SELECT us.*,
                    tr.ojt_id,
                    tr.degree,
                    tr.university


      FROM trainees tr, users us 
      WHERE us.id = tr.user_id
       ";
     $query =mysqli_query($connect, $sql);
    if(mysqli_num_rows($query)>0) {

     while ($row=mysqli_fetch_assoc($query))  {
        
        $defaultProfileImage = '../Assets/img/avatars/av.png';
        $profileImage = !empty($row['profile']) ? '../Assets/img/avatars/'.$row['profile'] : $defaultProfileImage;

        $name=$row ['last_name'].","." ". $row['first_name']." ". $row['middle_name']; 

        date_default_timezone_set('Asia/Manila');// local timezone

        $dateOfBirth =   date($row['dob']); // Example date of birth
        // Calculate age
        $today = new DateTime();
        $birthdate = new DateTime($dateOfBirth);
        $age = $birthdate->diff($today)->y;
            
      ?>
                  <tbody>
                     <tr>
                        <?php if($row['department']==='IT-Dept'): ?>
                                                    <tr class="table-info">
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
                                                     
                                                        <td><span class="badge bg-label-info me-1"><?=$row['department'] ?></span></td>
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
                                                <?php elseif ($row[	'department'] === 'HR'): ?>

                                                    <tr class="table-warning">
                                                        <td>
                                                        <i class='fas fa-user'></i>
                                                         <span class="fw-medium"><?= $row['ojt_id']?></span>
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
                                                     
                                                        <td><span class="badge bg-label-warning me-1"><?=$row['department'] ?></span></td>
                                                        <td><?= $row ['email']; ?></td>
                                                        <td>
                                                        <div class="dropdown">
                                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="../Admin/TraineeProfile.php?trainee_profile=<?=$row['id'] ?>"><i class='fa fa-user-circle'></i> View Profile</a>
                                                            <a class="dropdown-item" href="javascript:void(0);"
                                                                ><i class="bx bx-trash me-1"></i> Delete</a
                                                            >
                                                            </div>
                                                        </div>
                                                        </td>
                                                    </tr>
                                                <?php elseif($row['department'] === 'Admin'): ?>

                                                    <tr class="table-primary">
                                                        <td>
                                                        <i class='fas fa-user'></i>
                                                        <span class="fw-medium"><?= $row['ojt_id']?></span>
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
                                                            
                                                        <td><?= $age; ?></td>
                                                        <td><?= $row ['sex']; ?></td>
                                                     
                                                        <td><span class="badge bg-label-primary me-1"><?=$row['department'] ?></span></td>
                                                        <td><?= $row ['email']; ?></td>
                                                        <td>
                                                        <div class="dropdown">
                                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="../Admin/TraineeProfile.php?trainee_profile=<?=$row['id'] ?>">   <i class='fa fa-user-circle'></i> View Profile</a>

                                                            <a class="dropdown-item" href="javascript:void(0);"
                                                                ><i class="bx bx-trash me-1"></i> Delete</a
                                                            >
                                                            </div>
                                                        </div>
                                                        </td>
                                                    </tr>
                                                    <?php elseif($row['department'] === 'Finance'): ?>

                                                        <tr class="table-danger">
                                                            <td>
                                                            <i class='fas fa-user'></i>
                                                            <span class="fw-medium"><?= $row['ojt_id']?></span>
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
                                                        <td><?= $age; ?></td>
                                                        <td><?= $row ['sex']; ?></td>
                                                     
                                                        <td><span class="badge bg-label-danger me-1"><?=$row['department'] ?></span></td>
                                                        <td><?= $row ['email']; ?></td>
                                                            <td>
                                                            <div class="dropdown">
                                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="../Admin/TraineeProfile.php?trainee_profile=<?=$row['id'] ?>">  <i class='fa fa-user-circle'></i> View Profile</a>

                                                                <a class="dropdown-item" href="javascript:void(0);"
                                                                    ><i class="bx bx-trash me-1"></i> Delete</a
                                                                >
                                                                </div>
                                                            </div>
                                                            </td>
                                                        </tr>
                                                        <?php elseif($row['department'] === 'Accounting'): ?>

                                                        <tr class="table-success">
                                                            <td>
                                                            <i class='fas fa-user'></i>
                                                             <span class="fw-medium"><?= $row['ojt_id']?></span>
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
                                                        <td><?= $age; ?></td>
                                                        <td><?= $row ['sex']; ?></td>
                                                     
                                                        <td><span class="badge bg-label-success me-1"><?=$row['department'] ?></span></td>
                                                        <td><?= $row ['email']; ?></td>
                                                            <td>
                                                            <div class="dropdown">
                                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="../Admin/TraineeProfile.php?trainee_profile=<?=$row['id'] ?>">
                                                                <i class='fa fa-user-circle'></i> View Profile</a>
                                                                <a class="dropdown-item" href="javascript:void(0);"
                                                                    ><i class="bx bx-trash me-1"></i> Delete</a
                                                                >
                                                                </div>
                                                            </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <?php endif;?>
                                             </div>
                                        </div>
                                 <?php }} ?>

<script src="../Assets/js/jquery.js"></script>
<script src="../Assets/js/datatables.js"></script>
<script>
$(document).ready( function () {
    $('#dataTrainee').DataTable();

} );

</script>       
<script>
</script>
   <?php include '../Layouts/footer.php'; ?>