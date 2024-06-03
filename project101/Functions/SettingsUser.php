<?php 
session_start();
include '../Php/authenticate.php';
checkLoggedIn();
// checkUserType();
$title="Settings";
include '../Layouts/main-user.php';
 include '../Php/db_connect.php';

  ?>
  <style>
 .valid{
  color: var(--bs-success);

 }
 #message{
  display: none;
 }

  </style>
<div class="row">
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title"> 
<i class='fa fa-edit'></i>Change Password</h5>
        <p class="card-text"></p>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#changePass">
          
<i class='fa fa-edit'></i>Change
        </button>
</div>

<!-- Modal -->
<div class="modal fade" id="changePass" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirm this is you</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

      <form action="../Php/php-changepass.php" method="POST">
          <div class="col-md-12">
                  <label for="inputZip" class="form-label">Current Password</label>
                  <input type="password" class="form-control" id="inputZip"name = "CurrentPassword" required>
          </div>    

          <div class="col-md-12">
                  <label for="inputZip" class="form-label">New Password</label>
                  <input type="password" class="form-control" id="password"name = "NewPassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                 
                  <div id="message">
                    <h6>Password must contain the following:</h6>
                    <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
                    <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
                    <p id="number" class="invalid">A <b>number</b></p>
                    <p id="length" class="invalid">Minimum <b>8 characters</b></p>
                  </div>
          </div>    

          <div class="col-md-12">
                  <label for="inputZip" class="form-label">Confirm New Password</label>
                  <input type="password" class="form-control" id="inputZip"name = "ConfirmNewPassword" >
          </div>    

             <?php $user_id=$_SESSION['user_id'];?>
            <input type="text" value="<?= $user_id ?>" name="user_id" hidden>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name ="submit" class="btn btn-dark ">Change</button>
      </div>
      </form>
    </div>
  </div>
</div>
<script src="../Assets/js/pass_verify.js"></script>


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
        <div
        class="bs-toast toast fade show toast-placement-ex m-2 bottom-0 end-0 bg-danger"
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
    <?php include '../Layouts/footer.php';?>