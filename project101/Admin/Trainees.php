<?php 
session_start();
$title="Trainees";
include '../Php/authenticate.php';
include '../Layouts/main-admin.php'; 
 include '../Php/db_connect.php';


  ?>
                



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
                    <th scope="col">OJT ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Profile</th>
                    <th scope="col">Age</th>
                    <th scope="col">Sex</th>
                    <th scope="col">Department</th>
                    <th scope="col">Email</th>
                    <th scope="col">Actions</th>
                    <!-- <th scope="col">Date started</th> -->
                    <!-- <th scope="col">Department</th> -->

                    <!-- <th scope="col">Office</th> -->

                    <!-- <th scope="col">Email</th> -->
                    <!-- <th scope="col">Password</th>
                    <th scope="col">Usertype</th>
                    <th scope="col">Status</th> -->
                    <!-- <th scope="col">Operation</th> -->
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
  <?php 
     
     $sql= "SELECT tr.*,
                    us.first_name,
                    us.middle_name,
                    us.last_name,
                    us.sex,
                    us.department,
                    us.dob

      FROM trainees tr, users us 
      WHERE us.id = tr.user_id
       ";
     $query =mysqli_query($connect, $sql);
    if(mysqli_num_rows($query)>0) {

     while ($row=mysqli_fetch_assoc($query))  {
      $name=$row ['last_name'].","." ". $row['first_name']." ". $row['middle_name']; 
 date_default_timezone_set('Asia/Manila');// local timezone

$dateOfBirth =   date($row['dob']); // Example date of birth
// Calculate age
$today = new DateTime();
$birthdate = new DateTime($dateOfBirth);
$age = $birthdate->diff($today)->y;
     
      ?>

                     <tr>

                        <!-- <td><?= $row ['id']; ?></td> -->
                        <!-- <td><?= $row ['ojt_id']; ?></td> -->

                        <!-- <td><?=  $row ['last_name'].","." ". $row['first_name']." ". $row['middle_name']; ?></td>;    -->
                        <!-- <td><?= $age; ?></td>;                   -->
                        <!-- <td><?= $row ['sex']; ?></td> -->
                        <!-- <td><?= $row ['contact_num']; ?></td> -->
                        <!-- <td><?= $row ['degree']; ?></td> -->
                        <!-- <td><?= $row ['university']; ?></td> -->
                        <!-- <td><?= $row ['hours_to_render']; ?></td> -->
                        <?php if($row['department']==='IT'): ?>
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
                                                                    <a class="dropdown-item" href="javascript:void(0);"><i class='fa fa-user-circle'></i> View Profile</a>
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
                                                        </ul>
                                                        </td>
                                                        <td><span class="badge bg-label-warning me-1"><?=$row['department'] ?></span></td>

                                                        <td>
                                                        <div class="dropdown">
                                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="javascript:void(0);"><i class='fa fa-user-circle'></i> View Profile</a>
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
                                                        </ul>
                                                        </td>
                                                        <td><span class="badge bg-label-primary me-1"><?=$row['department'] ?></span></td>

                                                        <td>
                                                        <div class="dropdown">
                                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="javascript:void(0);">   <i class='fa fa-user-circle'></i> View Profile</a>

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
                                                            </ul>
                                                            </td>
                                                            <td><span class="badge bg-label-danger me-1"><?=$row['department'] ?></span></td>

                                                            <td>
                                                            <div class="dropdown">
                                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="javascript:void(0);">  <i class='fa fa-user-circle'></i> View Profile</a>

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
                                                            </ul>
                                                            </td>
                                                            <td><span class="badge bg-label-success me-1"><?=$row['department'] ?></span></td>

                                                            <td>
                                                            <div class="dropdown">
                                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="javascript:void(0);">
                                                                <i class='fa fa-user-circle'></i> View Profile</a>
                                                                <a class="dropdown-item" href="javascript:void(0);"
                                                                    ><i class="bx bx-trash me-1"></i> Delete</a
                                                                >
                                                                </div>
                                                            </div>
                                                            </td>
                                                        </tr>
                                                <?php endif; ?>

                        <!-- <td><?= $row ['dos']; ?></td> -->
                        <!-- <td><?= $row ['department']; ?></td> -->

                        <!-- <td><?= $row ['office_assigned']; ?></td> -->
                        <!-- <td><?= $row ['email']; ?></td> -->
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