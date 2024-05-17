<?php 

session_start();
$title="Trainee's Responses";
include '../Php/authenticate.php';
include '../Layouts/main.php'; 
 include '../Php/db_connect.php';

?>  
    
 <!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content --> 
    <!-- Layout container -->
    <!-- <div class="layout-page">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="content-wrapper">
                <div class="row mb-3">
                    <div class="col-6 text-start"> -->
            <div class="col-md-12 text-end">
                <div style="margin-top: 20px;"></div> <!-- Empty div with margin -->
                    <a class="btn btn-block btn-secondary" href="../biweekly/DisplayReports.php">Back</a>
            </div>

        </div>
        <div class="my-3">
            <div style="display: flex; justify-content: center;">
                <table class="table table-bordered border-secondary" id="dataTable">
                    <thead class="border-bottom" style="padding: 20px;">
             <!-- Table headers -->
                    </thead>
                        <div style="padding: 0 20px;">
                                <tbody class="table-border-bottom-0">
                                            <tr>
                                                <th scope="col">

                                                    <div class="d-flex flex-column justify-content-center align-items-center">
                                                        <p class="mb-1">ID </p>
                                                    </div>

                                                </th>
                                                <!-- <th scope="col">
                                                    

                                                    <div class="d-flex flex-column justify-content-center align-items-center">
                                                        <p class="mb-1 ">OJT ID </p>
                                                    </div>

                                                </th> -->
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


                                            
                                                
                                                <th scope="col">

                                                                    
                                                    <div class="d-flex flex-column justify-content-center align-items-center">
                                                        <p class="mb-1 ">ACCOMPLISHMENT</p>
                                                    </div>


                                                <th scope="col">

                                                                    
                                                    <div class="d-flex flex-column justify-content-center align-items-center">
                                                        <p class="mb-1 ">CHALLENGES/p>
                                                    </div>


                                              
                                                
                                                <th scope="col">

                                                                    
                                                    <div class="d-flex flex-column justify-content-center align-items-center">
                                                        <p class="mb-1 ">LEARNINGS</p>
                                                    </div>


                                                    </th>

                                                    <th scope="col">

                                                                                                                            
                                                        <div class="d-flex flex-column justify-content-center align-items-center">
                                                            <p class="mb-1 ">STATUS</p>
                                                        </div>


                                                   
                                            
                                        </thead>
                                     
                                            
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
                                                        <!-- <td>

                                                            <div class="d-flex flex-column justify-content-center align-items-center">
                                                                <p class="mb-1 "> <?= $row['ojt_id']; ?></p>
                                                            </div>
                                                            </div>   
                                                        
                                                        </td> -->
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
    
    
                                            <a href="../Biweekly/UpdateReports.php? update_report=<?= $row['id'] ?>" class="btn btn-warning btn-lg row-"id='save_<?= $row['id'] ?>'>
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



            <!-- / Content -->
            <div class="content-backdrop fade"></div>
          </div>
        </div>
          <!-- Content wrapper -->
          