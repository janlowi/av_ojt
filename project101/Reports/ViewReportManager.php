<?php 
session_start();
$usertype = 'Manager';
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
    <div  class=" d-flex justify-content-end">
    <a href="../Reports/AllReportsManager.php" class="btn btn-dark ">Back </a>
    </div>
      <div class="card-header d-flex align-items-right justify-content-between">

        </div>
        <div class="card-title  ">
          <h5 class="m-0 me-2 text-uppercase">Responses</h5>
        </div>
        <div class="row align-items-start">
            <div class="col">
                  <input type="text" name="start_date" id="start_date" placeholder="Date Start" class="form-control" />
            </div>
            <div class="col">
            <input type="text" name="end_date" id="end_date" placeholder="Date End" class="form-control" />
            </div>
        
            <div class="col">
            <input type="button" name="filter" id="filter" value="Filter" class="btn btn-info" />
            <input type="button" name="reset" id="reset" value="Reset" class="btn btn-warning" />
            </div>
            <div class="col">
            <select name="department" id="department" class="form-control" hidden>
            <option value="">Select Department</option>
                <?php $dp = "SELECT * FROM departments";
                      $dp_result = $connect->query($dp);
                    if($dp_result->num_rows > 0){
                        while($departments =$dp_result->fetch_assoc()){
                    ?>
                            <option value="<?= $departments['id'] ?>" <?php if($departments['id']==$_SESSION['department_id']) echo 'selected'?>><?= $departments['departments'] ?></option>
                    <?php
                     }
                    }
                ?>
                </select>
            </div>  
        </div>   <br><br>  
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
                                          echo '  <input type="text" name="start_date" value="' .$user_id. '" id="user_id" placeholder="Date Start" class="form-control" hidden />';
                                          $sql = "SELECT rp.*,
                                          tr.ojt_id,
                                          us.first_name,
                                          us.last_name,
                                          us.middle_name,
                                          us.office_assigned,
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
                                                    $timestamp =  date('Y-m-d h:i:s a', strtotime($row['timestamp']));;
                                                    $office = $row['office_assigned'];
                                                    $dos = $row['dos'];
                                                    $doe = $row['doe'];
                                                    $departments = $row['departments'];
                                                    $summary = $row['summary'];
                                                    $accomplishment = $row['accomplishment'];
                                                    $challenges = $row['challenges'];
                                                    $learnings = $row['learnings'];
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
                                                                <p class="mb-1 "> <?=  date('Y-m-d h:i:s a', strtotime($row['timestamp'])); ?></p>
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
                                                    
                                            <a href="#"  class="btn btn-success "data-bs-toggle="modal" data-bs-target="#modal_<?=$row['id']?> ">
                                       View
                                            </a>


<!-- Modal -->
<div class="modal fade" id="modal_<?=$row['id']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
<div class="modal-dialog modal-xl">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="staticBackdropLabel"></h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">

<div class="text-wrap"><strong><label for="Office">Office:</label></strong><p><?=$office?></p></div>
<div class="text-wrap"><strong><label for="timestamp">Timestamp:</label></strong><p><?=$timestamp?></p></div>
<div class="text-wrap"><strong><label for="Start">Start:</label></strong><p><?=$dos?></p></div>
<div class="text-wrap"><strong><label for="End">End:</label></strong><p><?=$doe?></p></div>
<div class="text-wrap"><strong><label for="Departments">Departments:</label></strong><p><?=$departments?></p></div>
<div class="text-wrap"><strong><label for="summary">Summary:</label></strong><p><?=$summary?></p></div>
<div class="text-wrap"><strong><label for="accomplishments">Accomplishments:</label></strong><p><?=$accomplishment?></p></div>
<div class="text-wrap"><strong><label for="challenges">Challenges:</label></strong><p><?=$challenges?></p></div>
<div class="text-wrap"><strong><label for="learnings">Learnings:</label></strong><p><?=$learnings?></p></div>

</div>
</div>    
</div>
</div>
</div>      
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
$(document).ready(function(){
    $('#dataTable').DataTable({
        responsive:true,
        "order": [[ 0, "desc" ]]
    });
    $.datepicker.setDefaults({
        dateFormat: 'yy-mm-dd'
    });

    $("#start_date").datepicker({
        onSelect: function(selectedDate) {
            $("#end_date").datepicker("option", "minDate", selectedDate);
        }
    });
    $("#end_date").datepicker();
    $('#filter').click(function(){

    var start_date = $('#start_date').val();
    var end_date = $('#end_date').val();
    var department = $('#department').val();
    var user_id = $('#user_id').val();

    if(start_date != '' && end_date != '' && department != '') {
        $.ajax({
            url: "../Php/php-filter-report.php",
            method: "POST",
            data: { start_date: start_date, end_date: end_date, department: department, user_id: user_id },
            success: function(data) {
                $('#dataTable').html(data);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    } else {
        alert("All fields are required. ");
    }
});

$('#reset').click(function(){
        // Reset start and end date inputs
        $('#start_date').val('');
        $('#end_date').val('');
        $('#department').val('');

        // Reload default table content
        var defaultContent = `
    
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
                                     

                                                </th> <th scope="col">

                   
                                                    <div class="d-flex flex-column justify-content-center align-items-center">
                                                        <p class="mb-1 ">OFFICE</p>
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
                                             if(isset($_GET['view_report'])){

                                                $user_id=$_GET['view_report'];
                                                $sql = "SELECT rp.*,
                                                tr.ojt_id,
                                                us.first_name,
                                                us.last_name,
                                                us.middle_name,
                                                us.office_assigned,
                                                dp.departments,
                                                dp.id as department_id
                                         FROM  reports rp
                                         JOIN departments dp ON rp.department_id = dp.id
                                         JOIN trainees tr ON tr.user_id = rp.user_id
                                         JOIN users us ON us.id = rp.user_id
                                         WHERE us.id = '$user_id'
                                        ";
                                     
                                     // Fetch data from the reports table
                                            $query = mysqli_query($connect, $sql);
                                            if(mysqli_num_rows($query) > 0) {
                                                while ($row = mysqli_fetch_assoc($query)) { 
                                                    $timestamp =  date('Y-m-d h:i:s a', strtotime($row['timestamp']));;
                                                    $office = $row['office_assigned'];
                                                    $dos = $row['dos'];
                                                    $doe = $row['doe'];
                                                    $departments = $row['departments'];
                                                    $summary = $row['summary'];
                                                    $accomplishment = $row['accomplishment'];
                                                    $challenges = $row['challenges'];
                                                    $learnings = $row['learnings'];
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
                                                                <p class="mb-1 "> <?= date('Y-m-d h:i:s a', strtotime($row['timestamp'])); ?></p>
                                                            </div>
                                                           
                                                        
                                                        </td>
                                                        <td>

                                           
                                                            <div class="d-flex flex-column justify-content-center align-items-center">
                                                                <p class="mb-1 "> <?= $row['departments']; ?></p>
                                                            </div>
                                                      


                                                        </td>
                                                         <td>

                                           
                                                            <div class="d-flex flex-column justify-content-center align-items-center">
                                                                <p class="mb-1 "> <?= $row['office_assigned']; ?></p>
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
                                                    <a href="#"  class="btn btn-success "data-bs-toggle="modal" data-bs-target="#modal_'.$row['id'].' ">
                                               View
                                                    </a>


<!-- Modal -->
<div class="modal fade" id="modal_'.$row['id'].'" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

<div class="text-wrap"><strong><label for="Office">Office:</label></strong><p>' .$office.'</p></div>
<div class="text-wrap"><strong><label for="timestamp">Timestamp:</label></strong><p>'.$timestamp.'</p></div>
<div class="text-wrap"><strong><label for="Start">Start:</label></strong><p>'.$dos.'</p></div>
<div class="text-wrap"><strong><label for="End">End:</label></strong><p>'.$doe.'</p></div>
<div class="text-wrap"><strong><label for="Departments">Departments:</label></strong><p>'.$departments.'</p></div>
<div class="text-wrap"><strong><label for="summary">Summary:</label></strong><p>'.$summary.'</p></div>
<div class="text-wrap"><strong><label for="accomplishments">Accomplishments:</label></strong><p>'.$accomplishment.'</p></div>
<div class="text-wrap"><strong><label for="challenges">Challenges:</label></strong><p>'.$challenges.'</p></div>
<div class="text-wrap"><strong><label for="learnings">Learnings:</label></strong><p>'.$learnings.'</p></div>

</div>
      </div>    
    </div>
  </div>
</div>

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
    }
     ?>
        </tbody>
    </table>
</div>

        `;
        $('#dataTable').html(defaultContent);
    });
});

</script> 
<?php include '../Layouts/realfooter.php';?>
<?php include '../Layouts/footer.php';?>