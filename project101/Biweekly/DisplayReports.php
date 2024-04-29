<?php 

session_start();

$title="Weekly Response";
include '../Layouts/main-user.php'; 
 include '../Layouts/sidebar-user.php';
 include '../Layouts/navbar-user.php';
 include '../Php/db_connect.php';

?>                             <!-- Content wrapper -->
<div class="content-wrapper">
  <!-- Content --> 
<!-- Layout container -->
<div class="layout-page">

<div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">


<div class="col-2 col-xl-12 col-md-6" >
    <div class="card h-70 p-4">
      <div class="card-header d-flex align-items-right justify-content-between">
        <div class="card-title mb-2">
          <h5 class="m-0 me-2 text-uppercase"><?php echo $_SESSION['firstname']."'s", " ", "INFORMATION";?> </h5>
        </div>


        <div class="table-responsive">
        <table class="table table-bordered border-secondary">
          <thead class="border-bottom">

                                            <tr>
                                                <th scope="col">

                                                    <div class="d-flex justify-content-start align-items-right mt-lg-4">
                                                    <div class="d-flex flex-column">
                                                        <p class="mb-1">ID </p>
                                                    </div>
                                                    </div>
                                                </th>
                                                <th scope="col">
                                                    
                                                    <div class="d-flex justify-content-start align-items-right mt-lg-4">
                                                    <div class="d-flex flex-column">
                                                        <p class="mb-1 ">OJT ID </p>
                                                    </div>
                                                    </div>

                                                </th>
                                                <th scope="col">

                                                   <div class="d-flex justify-content-start align-items-right mt-lg-4">
                                                    <div class="d-flex flex-column">
                                                        <p class="mb-1 ">TIMESTAMP</p>
                                                    </div>
                                                    </div>

                                                </th>
                                                <th scope="col">

                                                     <div class="d-flex justify-content-start align-items-right mt-lg-4">
                                                    <div class="d-flex flex-column">
                                                        <p class="mb-1 ">DEPARTMENT</p>
                                                    </div>
                                                    </div>

                                                </th>
                                                <th scope="col">Start</th>
                                                <th scope="col">End</th>
                                                <th scope="col">Summary</th>
                                                <th scope="col">Accomplishments</th>
                                                <th scope="col">Challenges</th>
                                                <th scope="col">Learnings</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                            <?php 
                                            $sql = "SELECT * FROM reports"; // Fetch data from the reports table
                                            $query = mysqli_query($connect, $sql);
                                            if(mysqli_num_rows($query) > 0) {
                                                while ($row = mysqli_fetch_assoc($query)) { ?>
                                                    <tr>
                                                        <td><?= $row['id']; ?></td>
                                                        <td><?= $row['Trainee_id']; ?></td>
                                                        <td><?= $row['timestamp']; ?></td>
                                                        <td><?= $row['assigned_dept']; ?></td>   
                                                        <td><?= $row['dos']; ?></td>                  
                                                        <td><?= $row['doe']; ?></td>
                                                        <td><?= $row['summary']; ?></td>
                                                        <td><?= $row['accomplishment']; ?></td>
                                                        <td><?= $row['challenges']; ?></td>
                                                        <td><?= $row['learnings']; ?></td>
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
                <small>11 mins ago</small>
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


</div>
</div>
</div>
</div>


