<<<<<<< HEAD
=======
<?php 
session_start();

$title="View";
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
            display: flex;
            flex-direction: right;
            padding: 10px;

        }
        .dt-length .dt-input{
            padding: 0 45px;
            border: none;
            outline: none;

        }
         
        .dt-search {
            position: relative;
            border: none;
            outline:none;


        }
        .dt-search .dt-input{
            position: relative;
           height: 30px;
           outline: none;
           border:none;
           padding: 0 0 10px 5px;


        }
        .dt-paging-button{
            border: 1px solid dark;
            border-radius: 3px
        }
        .content-wrapper, .card {
            overflow-y: scroll
        }
    


</style>

<div class="col-2 col-xl-12 col-md-6" >
    <div class="card  p-4 " >
      <div class="card-header d-flex align-items-right justify-content-between">
        <div class="card-title mb-2">
          <h5 class="m-0 me-2 text-uppercase">Responses</h5>
        </div>
        </div>
        
        <div class="table-responsive text-nowrap  pt-5">
        <table class="table table-bordered border-secondary table-striped "id="dataTable" >
          <thead class="border-bottom">

                                            <tr>
                                                <th scope="col">

                                                    <div class="d-flex flex-column justify-content-center align-items-center">
                                                        <p class="mb-1">OJT ID </p>
                                                    </div>

                                                </th>
                                                <th scope="col">
                                                    

                                                    <div class="d-flex flex-column justify-content-center align-items-center">
                                                        <p class="mb-1 "> NAME</p>
                                                    </div>
                                             

                                                </th>
                                                <th scope="col">

                      
                                                    <div class="d-flex flex-column justify-content-center align-items-center">
                                                        <p class="mb-1 ">TIMESTAMP</p>
                                                    </div>
                         

                                                </th>
                                                <th scope="col">

                   
                                                    <div class="d-flex flex-column justify-content-center align-items-center">
                                                        <p class="mb-1 ">DEPARTMENT</p>
                                                    </div>
                                     

                                                </th>

                                                <th scope="col">

                   
                                                    <div class="d-flex flex-column justify-content-center align-items-center">
                                                        <p class="mb-1 ">START</p>
                                                    </div>


                                                </th>
                                                
                                                <th scope="col">

                   
                                                    <div class="d-flex flex-column justify-content-center align-items-center">
                                                        <p class="mb-1 ">END</p>
                                                    </div>


                                                </th>

                                              
                                                <th scope="col">

                   
                                                    <div class="d-flex flex-column justify-content-center align-items-center">
                                                        <p class="mb-1 ">STATUS</p>
                                                    </div>


                                                </th>

                                            </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                            <?php 
                                            $sql = "SELECT rp.*,
                                                            tr.ojt_id,
                                                            us.first_name,
                                                            us.last_name,
                                                            us.middle_name
                                            
                                            
                                                    FROM trainees tr, reports rp, users us

                                                    WHERE  us.id=rp.user_id 
                                                    AND us.id=tr.user_id
                                                    
                                                    
                
                                            "; // Fetch data from the reports table
                                            $query = mysqli_query($connect, $sql);
                                            if(mysqli_num_rows($query) > 0) {
                                                while ($row = mysqli_fetch_assoc($query)) { ?>
                                                    <tr>
                                                        <td>
                                                            
                                                            <div class="d-flex flex-column justify-content-center align-items-center">
                                                                <p class="mb-1 "><?= $row['ojt_id'];?></p>
                                                            </div>
                                                        
                                                        </td>
                                                        <td>

                                                            <div class="d-flex flex-column justify-content-center align-items-center">
                                                                <p class="mb-1 "> <?= $row['first_name']." ".$row['middle_name']." ".$row['last_name'];?></p>

                                                            </div>
                                                            </div>   
                                                        
                                                        </td>
                                                        <td>

                                                            <div class="d-flex flex-column justify-content-center align-items-center">
                                                                <p class="mb-1 "> <?= $row['timestamp']; ?></p>
                                                            </div>
                                                           
                                                        
                                                        </td>
                                                        <td>

                                           
                                                            <div class="d-flex flex-column justify-content-center align-items-center">
                                                                <p class="mb-1 "> <?= $row['assigned_dept']; ?></p>
                                                            </div>
                                                      


                                                        </td>
                                                        <td>

                                                            <div class="d-flex flex-column justify-content-center align-items-center">
                                                                <p class="mb-1 "> <?= $row['dos']; ?></p>
                                                            </div>


                                                        </td>
                                                        <td>

                                                            <div class="d-flex flex-column justify-content-center align-items-center">
                                                                <p class="mb-1 "> <?= $row['doe']; ?></p>
                                                            </div>


                                                        </td>

                                                   <td>
                                                            <div class="d-flex flex-column justify-content-center align-items-center d-grid gap-2">
                                    
                                         <?php
                                                if( $row['status']=='Pending'){

                                            echo'
                                            
                                            
                                                <style>
                                                        #save_'.$row['id'].' {
                                                                display:block;
                                                        }
                                                </style>
                                                
                                            ';
                                            }else{
                                                echo'
                                                <span class="badge bg-label-success me-1">Saved</span>
                                                <style>
                                                        #save_'.$row['id'].' {
                                                                display:none;
                                                        }
                                                </style>
                                            ';
                                            }
                                                  

                                            ?>

                                            <div class="d-flex flex-column justify-content-center align-items-center d-grid gap-2">
    
    
                                            <a href="../Biweekly/UpdateReports.php? update_report=<?= $_SESSION['user_id'] ?>" class="btn btn-warning btn-lg row-"id='save_<?= $row['id'] ?>'>
                                            Edit
                                                </a>
    
                                                    <a href="../Php/php-weekly-update.php? save_report=<?= $row['id'] ?>"  class="btn btn-success btn-lg row-"  id='save_<?= $row['id'] ?>' >
                                               Submit
                                                    </a>
    
                                                
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
            </div>
                  
<script src="../Assets/js/jquery.js"></script>
<script src="../Assets/js/datatables.js"></script>
<script>
new DataTable('#dataTable');
</script>        
<!-- Modal -->

   <!-- Contextual Classes -->
  
   <div class="card">
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>OJT ID</th>
                        <th>Name</th>
                        <th>Profile</th>
                        <th>Department</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                                      
                    <tbody class="table-border-bottom-0">

                                             <?php 
                                            $sql = "SELECT rp.*,
                                                            tr.ojt_id,
                                                            us.first_name,
                                                            us.last_name,
                                                            us.middle_name,
                                                            us.department,
                                                            us.profile
                                            
                                            
                                                    FROM trainees tr, reports rp, users us

                                                    WHERE  us.id=rp.user_id 
                                                    AND us.id=tr.user_id
                                                    
                                                    
                
                                            "; // Fetch data from the reports table
                                            $query = mysqli_query($connect, $sql);
                                            if(mysqli_num_rows($query) > 0) {
                                                while ($row = mysqli_fetch_assoc($query)) {     
                                                    $defaultProfileImage = '../Assets/img/avatars/av.png';
                                                    $profileImage = !empty($row['profile']) ? $row['profile'] : $defaultProfileImage;
                                                   $name= $row['first_name'].' '.$row['middle_name'].' '.$row['last_name']; 
                                                    ?>
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

                                                        <td><span class="badge bg-label-info me-1"><?=$row['department'] ?></span></td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                    <a class="dropdown-item" href="javascript:void(0);"><i class='fa fa-files-o'></i> View Reports</a>
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
                                                            <a class="dropdown-item" href="javascript:void(0);"><i class='fa fa-files-o'></i> View Reports</a>
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
                                                            <a class="dropdown-item" href="javascript:void(0);"><i class='fa fa-files-o'></i> View Reports</a>
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
                                                                <a class="dropdown-item" href="javascript:void(0);"><i class='fa fa-files-o'></i> View Reports</a>
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
                                                                <a class="dropdown-item" href="javascript:void(0);"><i class='fa fa-files-o'></i> View Reports</a>
                                                                <a class="dropdown-item" href="javascript:void(0);"
                                                                    ><i class="bx bx-trash me-1"></i> Delete</a
                                                                >
                                                                </div>
                                                            </div>
                                                            </td>
                                                        </tr>
                                                <?php endif; ?>

<?php }} ?>
                                    <!--/ Contextual Classes -->


                <?php

if(isset($_SESSION['success'])){


?>
    <div
    class="bs-toast toast fade show toast-placement-ex m-2 bottom-0 end-0 bg-success"
              role="alert"
              aria-live="assertive"
              aria-atomic="true">
              <div class="toast-header">
                <i class="bx bx-bell me-2"></i>
                <div class="me-auto fw-medium">Success</div>

                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
              </div>
              <div class="toast-body">
               <?= $_SESSION['success'] ?>
              </div>
            </div>
<?php
    unset($_SESSION['success']);
}
?>

<?php

if(isset($_SESSION['error'])){


?>
    <div
    class="bs-toast toast fade show toast-placement-ex m-2 bottom-0 end-0 bg-success"
              role="alert"
              aria-live="assertive"
              aria-atomic="true">
              <div class="toast-header">
                <i class="bx bx-bell me-2"></i>
                <div class="me-auto fw-medium">Success</div>

                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
              </div>
              <div class="toast-body">
               <?= $_SESSION['error'] ?>
              </div>
            </div>
<?php
    unset($_SESSION['error']);
}
?>


<?php

if(isset($_SESSION['update_success'])){


?>
    <div
    class="bs-toast toast fade show toast-placement-ex m-2 bottom-0 end-0 bg-success"
              role="alert"
              aria-live="assertive"
              aria-atomic="true">
              <div class="toast-header">
                <i class="bx bx-bell me-2"></i>
                <div class="me-auto fw-medium">Success</div>
    
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
              </div>
              <div class="toast-body">
               <?= $_SESSION['update_success'] ?>
              </div>
            </div>
<?php
    unset($_SESSION['update_success']);
}
?>

<?php

if(isset($_SESSION['saved_success'])){


?>
    <div
    class="bs-toast toast fade show toast-placement-ex m-2 bottom-0 end-0 bg-success"
              role="alert"
              aria-live="assertive"
              aria-atomic="true">
              <div class="toast-header">
                <i class="bx bx-bell me-2"></i>

                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
              </div>
              <div class="toast-body">
               <?= $_SESSION['saved_success'] ?>
              </div>
            </div>
<?php
    unset($_SESSION['saved_success']);
}
?>

   
<?php include '../Layouts/footer.php'; ?>
>>>>>>> 9c0377cc3fba3f0e80c8d4510f22d2cf3e16de02
