<?php 
session_start();

$title="View";
include '../Php/authenticate.php';
include '../Layouts/main-admin.php'; 
 include '../Php/db_connect.php';

?>     

</style>


   <!-- Contextual Classes -->
  
   <div class="card position-relative   ">
                <div class="table-responsive text-nowrap">
                  <table class="datatables-ajax table table-bordered my-2" id="dataReport">
                    <thead>
                      <tr>
                        <th>OJT ID</th>
                        <th>Name</th>
                        <th>Profile</th>
                        <th>Department</th>
                        <th>University</th>
                        <th>Actions</th>
                      </tr>
                    </thead>             
                    <tbody class="table-border-bottom-0">

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
                                            
                                            if($query && mysqli_num_rows($query) > 0) {
                                                while ($row= mysqli_fetch_assoc($query)) {     
                                                    $defaultProfileImage = '../Assets/img/avatars/av.png';
                                                    $profileImage = !empty($row['profile']) ? '../Assets/img/avatars/'.$row['profile'] : $defaultProfileImage;
                                                   $name= $row['first_name'].' '.$row['middle_name'].' '.$row['last_name']; 
                                                 
                                                    ?>
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

                                                        <td><span class="badge bg-label-info me-1"><?=$row['departments'] ?></span></td>
                                                        <td><?=  $row['university'] ?></td>

                                                        <td>
                                                            <div class="dropdown">
                                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                    <a class="dropdown-item" href="../Reports/ViewReport.php?view_report=<?=$row['id']?>"><i class='fa fa-files-o'></i> View Reports</a>
                                                                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

<?php }
} 
?>

<script src="../Assets/js/jquery.js"></script>
<script src="../Assets/js/datatables.js"></script>
<script>
            $(document).ready(function() {
    $('#dataReport').DataTable({
        responsive: true,
        order: [[0, 'desc']] // Sort by the first column (index 0) in descending order
    });
});
</script>


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