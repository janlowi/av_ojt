<?php 
session_start();
include '../Php/authenticate.php';
checkLoggedIn();
// checkUserType();
$title="View";
include '../Layouts/main-manager.php'; 
 include '../Php/db_connect.php';
 $usertype = $_SESSION['usertype'];
?>     

<div class="col-2 col-xl-12 col-md-12" >
    <div class="card  p-4  " >
      <div class="card-header d-flex align-items-right justify-content-between">

        </div>
        <div class="card-title  ">
          <h5 class="m-0 me-2 text-uppercase">Responses</h5>
        </div>
        <a href="../Reports/AllReportsManager.php" class="d-flex justify-content-end ">
                               <button
                                 type="button"
                                class="btn btn-dark d-flex"
                                 data-bs-dismiss="modal"
                                 aria-label="Close">
                                    Back
                               </button>
                               </a>
        <div class="table-responsive text-nowrap ">
        <table class="table table-bordered border-secondary table-striped my-2" id="dataTable" >
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
                                                <th scope="col">

                   
                                                <div class="d-flex flex-column justify-content-center align-items-center">
                                                    <p class="mb-1 ">ACTION</p>
                                                </div>


                                                </th>



                                            </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                            <?php 
                                            if(isset($_GET['view_report'])){

                                          $user_id=$_GET['view_report'];
                                          $sql = "SELECT rp.*,
                                          tr.ojt_id,
                                          us.first_name,
                                          us.last_name,
                                          us.middle_name,
                                          dp.departments,
                                          dp.id as department_id
                                   FROM  reports rp
                                   JOIN departments dp ON rp.department_id = dp.id
                                   JOIN trainees tr ON tr.user_id = rp.user_id
                                   JOIN users us ON us.id = rp.user_id
                                   WHERE us.id = '$user_id'
                                  ";
                                            $query = mysqli_query($connect, $sql);
                                            if(mysqli_num_rows($query) > 0) {
                                                while ($row = mysqli_fetch_assoc($query)) { 
                                                    $_SESSION['reportname']= $row['first_name'];
                                                    $_SESSION['user_report_id']= $user_id;
                                                    ?>
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
                                                                <p class="mb-1 "> <?= $row['departments']; ?></p>
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
                                                              <?php  if( $row['status']==='Submitted') { ?>

                                                            <span class="badge bg-label-success me-1"><?= $row['status']; ?></span>
                                                           <?php } else if( $row['status']==='Pending') {?>   
                                                            <span class="badge bg-label-warning me-1"><?= $row['status']; ?></span>  
                                                            <?php } ?> 
                                                            </div>


                                                        </td>

                                                   <td>
                                                           
                                            <div class="d-flex flex-column justify-content-center align-items-center d-grid gap-2">
                                                    
                                            
                                                    <a href="../Reports/ManagerView.php?view=<?= $row['id'] ?>"  class="btn btn-success btn-md row-">
                                              View
                                                    </a>      
                                            </div>
    
    
                                            </td>
                                         
                                                    </tr> 
                                            <?php

                                                }
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
$(document).ready( function () {
    $('#dataTable').DataTable({
        responsive:true,
        "order": [[ 0, "desc" ]]
    });

} );
</script> 
<?php include '../Layouts/footer.php';?>