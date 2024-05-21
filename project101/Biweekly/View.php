<?php 
session_start();
$title="View";
include '../Php/authenticate.php';
include '../Layouts/main-user1.php'; 
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

    <?php 
            if(isset($_GET['view_report'])){

                $view_id=$_GET['view_report'];
             
            }
    ?>


<div class="col-2 col-xl-12 col-md-6" >
    <div class="card  p-4">

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-m-0-p-0">
              <div class="row">

                               <!-- <h2 class="modal-title" id="modalCenterTitle">Responses</h2> -->
                               <a href="../Biweekly/DisplayReports.php" class="d-flex justify-content-end">
                               <button
                                 type="button"
                                class="btn btn-dark d-flex"
                                 data-bs-dismiss="modal"
                                 aria-label="Close">
                                    Back
                               </button>
                               </a>

      <div class="card-header d-flex align-items-right justify-content-between">
        <div class="card-title mb-2">
          <h5 class="m-0 me-2 text-uppercase"><?php echo $_SESSION['firstname']."'s", " ", "Response";?> </h5>
        </div>
        </div>



        <div class="table-responsive text-nowrap  pt-5">
        <table class="table table-bordered border-secondary " >
          <thead class="border-bottom bg-dark">

                                            <tr>
     
                                             
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
                                            

                                            </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                            <?php 
                                            $sql = "SELECT rp.*,
                                                            tr.ojt_id
                                            
                                            
                                                    FROM trainees tr, reports rp, users us

                                                    WHERE  rp.id='$view_id' 
                                                    AND us.id=$_SESSION[user_id] 
                                                    AND us.id=tr.user_id
                                                    
                                                    
                
                                            "; // Fetch data from the reports table
                                            $query = mysqli_query($connect, $sql);
                                            if(mysqli_num_rows($query) > 0) {
                                                while ($row = mysqli_fetch_assoc($query)) { ?>
                                                    <tr>
                                                    
                                                      
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


 
<?php include '../Layouts/footer.php'; ?>