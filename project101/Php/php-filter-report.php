<?php 
session_start();
include 'db_connect.php';
?>
 
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
 if (isset($_POST['start_date'], $_POST['end_date'], $_POST['department'])) {
    $startDate = mysqli_real_escape_string($connect, $_POST['start_date']);
    $endDate = mysqli_real_escape_string($connect, $_POST['end_date']);
    $department = mysqli_real_escape_string($connect, $_POST['department']);
    $user_id = mysqli_real_escape_string($connect, $_POST['user_id']);
    $sql = "SELECT rp.*,
            tr.ojt_id,
            us.first_name,
            us.last_name,
            us.middle_name,
            us.office_assigned,
            dp.departments,
            dp.id as department_id
            FROM reports rp
            JOIN departments dp ON rp.department_id = dp.id
            JOIN trainees tr ON tr.user_id = rp.user_id
            JOIN users us ON us.id = rp.user_id
            WHERE us.id = '$user_id'
            AND rp.dos BETWEEN '$startDate' AND '$endDate'
            AND rp.department_id = '$department'
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
        </div>
    </div>

