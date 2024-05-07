<?php 

session_start();
$title="Weekly Response";
include '../Php/authenticate.php';
include '../Layouts/main-user.php'; 
 include '../Layouts/sidebar-user.php';
 include '../Layouts/navbar-user.php';
 include '../Php/db_connect.php';

?>     

<!-- Content wrapper -->
<div class="content-wrapper">
  <!-- Content --> 
<!-- Layout container -->
<div class="layout-page">

<div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">

     


<div class="col-2 col-xl-12 col-md-6" >
    <div class="card  p-4">
      <div class="card-header d-flex align-items-right justify-content-between">
        <div class="card-title mb-2">
          <h5 class="m-0 me-2 text-uppercase"><?php echo $_SESSION['firstname']."'s", " ", "Response";?> </h5>
        </div>
        </div>



        <div class="table-responsive text-nowrap">
        <table class="table table-bordered border-secondary ">
          <thead class="border-bottom">

                                            <tr>
                                                <th scope="col">

                                                    <div class="d-flex flex-column justify-content-center align-items-center">
                                                        <p class="mb-1">ID </p>
                                                    </div>

                                                </th>
                                                <th scope="col">
                                                    

                                                    <div class="d-flex flex-column justify-content-center align-items-center">
                                                        <p class="mb-1 ">OJT ID </p>
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
                                                        <p class="mb-1 ">SUMMARY</p>
                                                    </div>


                                                </th>

                                                <th scope="col">

                   
                                                    <div class="d-flex flex-column justify-content-center align-items-center">
                                                        <p class="mb-1 ">ACCOMPLISHMENTS</p>
                                                    </div>


                                                </th>

                                                <th scope="col">

                   
                                                    <div class="d-flex flex-column justify-content-center align-items-center">
                                                        <p class="mb-1 ">CHALLENGES</p>
                                                    </div>


                                                </th>

                                                <th scope="col">

                   
                                                    <div class="d-flex flex-column justify-content-center align-items-center">
                                                        <p class="mb-1 ">LEARNINGS</p>
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
                                                            tr.ojt_id
                                            
                                            
                                                    FROM trainees tr, reports rp, users us

                                                    WHERE  us.id=rp.user_id 
                                                    AND us.id=$_SESSION[user_id] 
                                                    AND us.id=tr.user_id
                                                    
                                                    
                
                                            "; // Fetch data from the reports table
                                            $query = mysqli_query($connect, $sql);
                                            if(mysqli_num_rows($query) > 0) {
                                                while ($row = mysqli_fetch_assoc($query)) { ?>
                                                    <tr>
                                                        <td>
                                                            
                                                            <div class="d-flex flex-column justify-content-center align-items-center">
                                                                <p class="mb-1 "><?=  $row['id']; ?></p>
                                                            </div>
                                                        
                                                        </td>
                                                        <td>

                                                            <div class="d-flex flex-column justify-content-center align-items-center">
                                                                <p class="mb-1 "> <?= $row['ojt_id']; ?></p>
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

                                                            <div class="d-flex flex-column justify-content-center align-items-center">
                                                                <p class="mb-1 "> <?= $row['summary']; ?></p>
                                                            </div>


                                                        </td>
                                                        <td>

                                                            <div class="d-flex flex-column justify-content-center align-items-center">
                                                                <p class="mb-1 "> <?= $row['accomplishment']; ?></p>
                                                            </div>


                                                        </td>
                                                        <td>

                                                            <div class="d-flex flex-column justify-content-center align-items-center">
                                                                <p class="mb-1 "> <?= $row['challenges']; ?></p>
                                                            </div>


                                                        </td>
                                                        <td>

                                                            <div class="d-flex flex-column justify-content-center align-items-center">
                                                                <p class="mb-1 "> <?= $row['learnings']; ?></p>
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
    
    
                                                 Edit
                                                    </a>
    
                                                    <a href="../Php/php-weekly-update.php? save_report=<?= $row['id'] ?>"  class="btn btn-success btn-lg row-"  id='save_<?= $row['id'] ?>' >
                                               Submit
                                                    </a>
    
                                                
                                            </div>
    
    
                                            </td>
                                         
                                                    </tr> 
                                            <?php

                                                        $_SESSION['id'] = $row['id'];
                                                        $_SESSION['ojt_id'] = $row['ojt_id'];
                                                        $_SESSION['timestamp'] = $row['timestamp'];
                                                        $_SESSION['assigned_dept'] = $row['assigned_dept'];
                                                        $_SESSION['dos'] = $row['dos'];
                                                        $_SESSION['doe'] = $row['doe'];
                                                        $_SESSION['summary'] = $row['summary'];
                                                        $_SESSION['accomplishment'] = $row['accomplishment'];
                                                        $_SESSION['challenges'] = $row['challenges'];
                                                        $_SESSION['learnings'] = $row['learnings'];
                                                        $_SESSION['status'] = $row['status'];
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
                <small>11 mins ago</small>
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
                <small>11 mins ago</small>
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
                <div class="me-auto fw-medium">Success</div>
                <small>11 mins ago</small>
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

</div>
</div>
</div>
</div>


