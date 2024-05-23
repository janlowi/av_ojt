<?php 
session_start();
$title="Weekly Response";
include '../Php/authenticate.php';
include '../Layouts/main-user.php'; 
 include '../Php/db_connect.php';

?>     
<style>
            .dt-layout-row .dt-paging, .dt-info {
                position: relative;
                display: flex;
                flex-direction: row-reverse;
            }
           
        .dt-length{
            position: relative;
            display: flex;
            flex-direction: row-reverse;
            top: -10px;

        }
        .dt-length .dt-input{
            padding: 0 20px 0 58px;
            border: none;
            outline: none;

        }
         
        .dt-search {
            position: relative;
            display: flex;
            justify-content: flex-end;
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
       
      
    


</style>

     


<div class="col-2 col-xl-12 col-md-6" >
    <div class="card  p-4">
      <div class="card-header d-flex align-items-right justify-content-between">
        <div class="card-title mb-2">
          <h5 class="m-0 me-2 text-uppercase"><?php echo $_SESSION['firstname']."'s", " ", "Response";?> </h5>
        </div>
        </div>



        <div class="table-responsive text-nowrap  pt-5">
        <table class="table table-bordered border-secondary " id="dataTable">
          <thead class="border-bottom">

                                            <tr>
                                                <th scope="col">

                                                    <div class="d-flex flex-column justify-content-center align-items-center">
                                                        <p class="mb-1">ID </p>
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


                                                </th>  <th scope="col">

                   
                                                    <div class="d-flex flex-column justify-content-center align-items-center">
                                                        <p class="mb-1 ">OPERATION</p>
                                                    </div>


                                                    </th>

                                            </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                            <?php 
                                            $user_id= $_SESSION['user_id'];
                                            $sql = "SELECT rp.*,
                                            tr.ojt_id,
                                            us.first_name,
                                            us.last_name,
                                            us.middle_name
                            
                            
                                            FROM trainees tr, reports rp, users us

                                            WHERE  us.id=rp.user_id 
                                            AND us.id=tr.user_id
                                            AND us.id='$user_id'
                                            
                                                    
                                                    
                
                                            "; // Fetch data from the reports table
                                            $query = mysqli_query($connect, $sql);
                                            if(mysqli_num_rows($query) > 0) {
                                                while ($row = mysqli_fetch_assoc($query)) { 
                                                    $_SESSION['reportname']= $row['first_name'];
                                                    $_SESSION['user_report_id']= $user_id;
                                                    ?>
                                               
                                                    <tr>
                                                        <td>
                                                            
                                                            <div class="d-flex flex-column justify-content-center align-items-center">
                                                                <p class="mb-1 "><?=  $row['id']; ?></p>
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
                                                                <?php if($row['status']=='Pending') { ?>
                                                                    <span class="badge bg-label-warning me-1"><?= $row['status']; ?></span>
                                                                <?php } elseif($row['status']=='Submitted') { ?>
                                                                    <span class="badge bg-label-success me-1"><?= $row['status']; ?></span>
                                                                <?php } else { ?>
                                                                    <span class="badge bg-label-warning me-1"><?= $row['status']; ?></span>
                                                                <?php } ?>
                                                            </div>
                                                        </td>


                                                   <td>                                    
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
                                                <div class="d-grid gap-2">                                    
                                                    <a href="../Reports/UserView.php?view_report='.$row['id'].'"  class="btn btn-success ">
                                               View
                                                    </a>

                                                </div>
                                                <style>
                                                        #save_'.$row['id'].' {
                                                                display:none;
                                                        }
                                                </style>
                                            ';
                                            }
                                                  

                                            ?>

                                        <div class="d-grid gap-2">

                                            <a href="../Reports/UpdateReports.php?update_report=<?= $row['id'] ?>" class="btn btn-warning "id='save_<?= $row['id'] ?>'>
                                            Edit
                                                </a>
    
                                                    <a href="../Php/php-weekly-update.php?save_report=<?= $row['id'] ?>"  class="btn btn-success "  id='save_<?= $row['id'] ?>' >
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


    <!-- filter data -->
                        <script>
                        new DataTable('#dataTable');
                        </script>
                        <!-- filter data -->
<?php include '../Layouts/footer.php'; ?>