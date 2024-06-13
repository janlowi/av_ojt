<?php 
session_start();
$usertype = 'Manager';
include '../Php/authenticate.php'; 
checkLoggedIn();
$title="Manager Dashboard";
include '../Layouts/main-manager.php'; 
 include '../Php/db_connect.php';
$department_id = $_SESSION['department_id'];
  ?>
                          <!-- Content wrapper -->
<div class="col-lg-3 col-md-12 col-6 mb-4">
    <div class="card">
        <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
                <i class="fa-solid fa-users" alt="chart success"></i>
            </div>
            <?php
              
                $sql = "SELECT us.*, dp.id, dp.departments
                        FROM users us
                        INNER JOIN departments dp ON us.department_id = dp.id 
                        WHERE department_id = ? ";
                $stmt = $connect->prepare($sql);
                $stmt->bind_param('i', $department_id);
                $stmt->execute();
                $result = $stmt->get_result();
                $count = mysqli_num_rows($result);
                $row = $result->fetch_assoc();
                $department_name = $row['departments'];
            ?>
            <span class="card-title text-success">NO. OF USERS UNDER <span class= "badge bg-info text-dark"><?= $department_name ?></span></span>
            <h3 class="card-title mb-2"><?php echo $count.' ',' ','Users' ?></h3>
            <!-- <small class="text-success fw-medium"><i class="bx bx-up-arrow-alt"></i></small> -->
        </div>
    </div>
</div>

                <!-- trainee table -->
                <!-- Bootstrap Dark Table -->

                        <!-- Table -->

<div class="card ">
<div class="card-body">
                       
                <h3 class="card-header text-success">USERS UNDER IT-DEPT</h3>
                <div class=" table-responsive    text-nowrap">
                  <table class="table table-dark">
                    <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Sex</th>
                    <th scope="col">Department</th>
                    <th scope="col">Office</th>
                    <th scope="col">Email</th>
                    <th scope="col">Usertype</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
            <?php 
    
    $sql = "SELECT us.*,
                        dp.departments,
                        dp.id AS department_id
                        FROM users us
                        INNER JOIN departments dp ON dp.id= us. department_id 
                        WHERE us.department_id = '$department_id'
                        ";

    $query =mysqli_query($connect, $sql);
   if( $count = mysqli_num_rows($query)>0) {
    while ($row=mysqli_fetch_assoc($query))  {

     ?>
                     <tr>
                        <td><?= $row ['id']; ?></td>
                        <td><?=  $row ['last_name'].","." ". $row['first_name']." ". $row['middle_name']; ?></td>;                     
                        <td><?= $row ['sex']; ?></td>
                        <td><?= $row ['departments']; ?></td>
                        <td><?= $row ['office_assigned']; ?></td>
                        <td><?= $row ['email']; ?></td>
                        <td><?= $row ['user_type']; ?></td>
                       <td><?php  
                            $status = $row ['status'];
                            if($status==='Active') {

                                echo ' <a class="item" href="../Php/php-status.php? deactivate='.$row['id'].'"
                                ><button class= "btn btn-danger">Deactivate</button></i></a
                              > ';
                            }elseif($status==='Deactivated'){
                                echo ' <a class="item" href="../Php/php-status.php? activate= '.$row['id'].'"
                                ><button class= "btn btn-success">Acivate</button></i></a
                              > ';
                            }else{
                                echo ' <a class="item" href="../Php/php-status.php? deactivate='.$row['id'].'"
                                ><button class= "btn btn-danger">Deactivate</button></i></a
                              > ';
                            }
                            ?>
                            </td>
                      </tr> 
<?php
}
    }
?>
                      </tbody>
                  </table>

              <!--/ Bootstrap Dark Table -->
              </div>                            
  </div>



    <?php

include '../Layouts/footer.php'; 

 ?>