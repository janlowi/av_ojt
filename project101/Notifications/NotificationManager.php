<?php 
session_start();
$usertype = 'Manager';
$title="Notification Board";
include '../Php/authenticate.php'; 
checkLoggedIn();
// checkUserType();
include '../Layouts/main-manager.php'; 
 include '../Php/db_connect.php';
?>
<div class="col-2 col-12" >
    <div class="card p-4">

    <form class="row gy-2 gx-3 align-items-center" method="POST" action = "../Php/php-notification.php">
        <div class="col-9 mx-3 px-5" style="border-right: 1px solid var(--bs-secondary);">
        <div class="mb-3 row-2">
        <label for="exampleFormControlTextarea1" class="form-label">Subject</label>
            <input type="text" class="form-control" name="Subject" id="exampleFormControlTextarea1" placeholder="Subject">
        </div>
        <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Body</label>
        <textarea class="form-control" name = "Body" id="exampleFormControlTextarea1" rows="5"></textarea>
        </div>
        </div> 

        <div class="col mx-5">
            <h5>Select Recipients</h5>
            <?php 
    $sql = "SELECT * FROM departments ";
    $result = $connect->query($sql);

    if($result->num_rows > 0){
        while($department = $result->fetch_assoc()){  
?>
    <div class="form-check">
        <input class="form-check-input" name="department_ids[]" type="checkbox" id="department_<?= $department['id'] ?>" value="<?= $department['id'] ?>">
        <label class="form-check-label" for="department_<?= $department['id'] ?>">
            <?= $department['departments'] ?>
        </label>     
    </div>       
<?php 
        }
    }
?>

        </div>
        <div class="row-2 mx-5">
            <button type="submit" name="insertNotification" class="btn btn-primary">Submit</button>
        </div>
    </form>

    </div>
</div>
 <!-- toast -->
   
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
        <div class="bs-toast toast fade show toast-placement-ex m-2 bottom-0 end-0 bg-danger"
                  role="alert"
                  aria-live="assertive"
                  aria-atomic="true">
                  <div class="toast-header">
                    <i class="bx bx-bell me-2"></i>
                    <div class="me-auto fw-medium">Error</div>

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
    <!-- /toast -->
<script>
</script>
<?php include '../Layouts/footer.php';?>