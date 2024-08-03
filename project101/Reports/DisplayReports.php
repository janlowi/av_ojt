<?php 
session_start();
$usertype = 'Trainee';
include '../Php/authenticate.php';
checkLoggedIn();
// checkUserType();
$title="Weekly Response";
include '../Layouts/main-user.php'; 
 include '../Php/db_connect.php';

?>     

<div class="col-2 col-xl-12 col-md-6" >
    <div class="card  p-4">
        
      <div class="card-header d-flex align-items-right justify-content-between">
        <div class="card-title mb-2">
          <h5 class="m-0 me-2 text-uppercase"><?php echo $_SESSION['firstname']."'s", " ", "Response";?> </h5>
        </div>
        </div>

        <div class="row align-items-start">
            <div class="col">
                  <input type="text" name="start_date" id="start_date" placeholder="Date Start" class="form-control" />
            </div>
            <div class="col">
            <input type="text" name="end_date" id="end_date" placeholder="Date End" class="form-control" />
            </div>
            <input type="text" id = "user_id" value = "<?= $_SESSION['user_id'] ?>" hidden>
            <div class="col">
            <select name="department" id="department" class="form-control">
            <option value="">Select Department</option>
                <?php $dp = "SELECT * FROM departments";
                      $dp_result = $connect->query($dp);
                    if($dp_result->num_rows > 0){
                        while($departments =$dp_result->fetch_assoc()){
                    ?>
                            <option value="<?= $departments['id'] ?>"><?= $departments['departments'] ?></option>
                    <?php
                     }
                    }
                ?>
                </select>
            </div>  
            <div class="col">
            <input type="button" name="filter" id="filter" value="Filter" class="btn btn-info" />
            <input type="button" name="reset" id="reset" value="Reset" class="btn btn-warning" />
            </div>
        </div>   <br><br>  

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
                                            $user_id= $_SESSION['user_id'];
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
                                     ORDER BY rp.id DESC";
                                     
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
        <h5 class="modal-title" id="staticBackdropLabel"></h5>
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
                                            ?>
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
<script>
$(document).ready(function(){
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
                                            $user_id= $_SESSION['user_id'];
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
                                     ORDER BY rp.id DESC";
                                     
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
        <h5 class="modal-title" id="staticBackdropLabel"></h5>
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
     ?>
        </tbody>
    </table>
</div>

        `;
        $('#dataTable').html(defaultContent);
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

<?php include '../Layouts/realfooter.php';?>
<?php include '../Layouts/footer.php'; ?>