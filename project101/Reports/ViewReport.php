<?php 
session_start();
$title="View";
include '../Php/authenticate.php';
include '../Layouts/main-admin.php'; 
 include '../Php/db_connect.php';

?>     
<style>
            .dt-layout-row .dt-layout-length, .dt-layout-row .dt-layout-search .dt-info {
                position: relative;
                margin-bottom: 0 0 20px 5px;
                display:flex;
                flex-direction: start;

            }
            
           
        .dt-length{
            position: relative;
            display: flex;
            flex-direction: right;
            padding: 10px;

        }
        .dt-length .dt-input{
            padding: 0 10px;
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
           border:transparent;
           border-bottom: 2px solid var(--bs-secondary);



        }
        .dt-paging-button{
            border: 1px solid var(--bs-secondary);
            padding-right: 12px;
            border-radius: 3px; 

        }
        .content-wrapper, .card {
            overflow-y: scroll
        }
    


</style>

<div class="col-2 col-xl-12 col-md-12" >
    <div class="card  p-4  " >
      <div class="card-header d-flex align-items-right justify-content-between">

        </div>
        <div class="card-title  ">
          <h5 class="m-0 me-2 text-uppercase">Responses</h5>
        </div>
        <a href="../Reports/AllReports.php" class="d-flex justify-content-end">
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
                                                    
                                                <span class="badge bg-label-success me-1"><?= $row['status']; ?></span>
                                                    <a href="../Reports/AdminView.php?view=<?= $row['id'] ?>"  class="btn btn-success btn-md row-">
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

    });

} );
</script> 
<?php include '../Layouts/footer.php';?>