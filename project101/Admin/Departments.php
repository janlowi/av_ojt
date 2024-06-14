<?php 
session_start();
$usertype = 'Admin';
include '../Php/authenticate.php'; 
checkLoggedIn();
// checkUserType();
$title="Departmenst";
include '../Layouts/main-admin.php'; 
 include '../Php/db_connect.php';
  ?>

<div class="col">
<div class="card">
<div class="card-body  "> 

         <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#department">
         Add Department
         </button> <br> <br>

<div class="table-responsive">
  <table class="table align-middle table-bordered border-primary">
        <thead class="table-info table-bordered border-primary">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Department Name</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>

        <?php 
         $sql = "SELECT * FROM departments ";
         $stmt = $connect->prepare($sql);
         $stmt->execute();
         $result = $stmt->get_result();
         if($result->num_rows > 0){
             while($row = $result->fetch_assoc()){
        ?>
          <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['departments'] ?></td>
            <td>
                <button class = "btn btn-info"  data-bs-toggle="modal" data-bs-target="#departmentModal_<?= $row['id'] ?>"><i class="fa-regular fa-pen-to-square" ></i>Edit</button>
            </td>
          </tr>

          <!-- modal -->
<div class="modal fade" id="departmentModal_<?= $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
<div class="modal-content">
<div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Department</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
        <form action="../Php/php-profile-update.php" method="POST">
                <div class="col-md-12">
               <label for="inputZip" class="form-label">Update Department</label>
               <input type="text" class="form-control" id="inputZip"name = "department" value = "<?= $row['departments'] ?>">
               <input type="text" class="form-control" id="inputZip"name = "department_id" value = "<?= $row['id'] ?>" hidden>
               </div><br>
               <div>
                <div class=" d-grid gap-2 col-6 mx-auto ">
                        <button id="register-btn" type="submit" name ="editDepartment" class="btn btn-dark ">Update</button>
                        </div>  
                </div>
        </form>
</div>
<div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
          <?php 
          }
        }
        ?>
        </tbody>
    </table>
    </div>
    </div>
</div>
</div>

<!-- modal -->
<div class="modal fade" id="department" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
<div class="modal-content">
<div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Department</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
        <form action="../Php/php-add.php" method="POST">
                <div class="col-md-12">
               <label for="inputZip" class="form-label">Add a new department</label>
               <input type="text" class="form-control" id="inputZip"name = "department" required>
               </div><br>
               <div>
                <div class=" d-grid gap-2 col-6 mx-auto ">
                        <button id="register-btn" type="submit" name ="addDepartment" class="btn btn-dark ">Add</button>
                        </div>  
                </div>
        </form>
</div>
<div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>

<?php include '../Layouts/realfooter.php'; ?>
<?php include '../Layouts/footer.php';?>