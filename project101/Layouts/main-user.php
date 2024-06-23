<?php 

    include '../Php/db_connect.php';
    $department_id=$_SESSION['department_id'];
    $userId = $_SESSION['user_id'];
    $sql = "SELECT * FROM notifications WHERE department_id = '$department_id' AND user_id = '$userId' AND comment_status IN (1,0)";
    $result=$connect->query($sql);
    $result_count = $result->num_rows; 
?>
<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-menu-fixed layout-compact"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
      <title><?php echo $title; ?></title>

    <meta name="description" content="" />
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/avlogo.png" />

   <!-- Font awersome -->
   <script src="https://kit.fontawesome.com/19fed37d60.js" crossorigin="anonymous"></script>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet" />

    <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />

    <!-- leaflet.js -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
  
    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="../assets/vendor/libs/apex-charts/apex-charts.css" />
    
<!-- jquerr -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  
  <!-- ajax -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

<!-- data tables -->
<link href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.7/af-2.7.0/b-3.0.2/b-colvis-3.0.2/b-html5-3.0.2/b-print-3.0.2/cr-2.0.2/date-1.5.2/fc-5.0.0/fh-4.0.1/kt-2.12.0/r-3.0.2/rg-1.5.0/rr-1.5.0/sc-2.4.2/sb-1.7.1/sp-2.3.1/sl-2.0.1/sr-1.4.1/datatables.min.css" rel="stylesheet">

    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>
  
    <script src="../assets/js/config.js"></script>
  </head>
<style>
      #hover a:hover {
    background-color: var( --bs-link-hover-color);
    color: var(--bs-light);
}
.read-notification {
    color: var(--bs-danger);
}.footer{
  margin-top: 40px;
  width: 100vh;
  height: 50px;
  z-index:1 ;
  background: transparent;

} .valid{
  color: var(--bs-success);

 }
 #message{
  display: none;
 }  .modal-backdrop {
    opacity: 0.5; /* Adjust opacity as needed */
    z-index: 0; /* Ensure z-index is higher than modal (1050 is default for modals) */
    background-color: rgba(0, 0, 0, 0.5); /* Adjust background color and transparency */
  }

  .currPass {
    position: absolute;
    right: 20px;
    bottom: 170px;   
  } 
  .newPass{
    position: absolute;
    right: 20px;
    bottom: 100px;    
  } 
  .confirmPass {
    position: absolute;
    right: 20px;
    bottom: 30px;  
  }
  #message{
    padding:30px;
  }




</style>
  <body>
    <!-- Layout wrapper -->
    <div class="layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
 <!-- Menu -->
 <aside id="layout-menu" class=" layout-menu menu-vertical menu table-responsive bg-menu-theme px-2 ">
    <div class=" bg-dark mt-2 " style = "height: 100%;">
    <div class="app-brand demoh-25 d-inline-block d-flex justify-content-center mt-2">
      <a href="https://www.avegabros.com/" class="app-brand-link">
        <span class="app-brand-logo demo d-flex justify-content-center fixed">
         <img  class="mt-3" width= '90' height= '60'  src="../assets/img/favicon/av.jpg" alt="" xlink:href="https://www.avegabros.com/" >
        </span>
        <span class="app-brand-text demo menu-text fw-bold ms-2  text-uppercase mt-3 fs-2">tams</span>
      </a>

      <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
        <i class="bx bx-chevron-left bx-sm align-middle"></i>
      </a>
    </div>



    <div class="menu-inner-shadow"></div>
    <li class="menu-header small text-uppercase"><span class="menu-header-text">Dashboard</span></li>
<li class="menu-item">
  <ul class="menu-inner py-2 ">
    <ul class="menu-item ">
      <li class="menu-item  mb-3 mx-3" id="hover">
            <a href="../Users/UserDashboard.php" class="menu-link ">
              <div data-i18n="Analytics">Dashboard</div>
            </a>
          </li>
          <!-- <li class="menu-item  mb-3 mx-3" id="hover">
            <a href="../Users/UserProfile.php" class="menu-link">
              <div data-i18n="Analytics">Profile</div>
            </a>
          </li> -->
          <li class="menu-item mb-3 mx-3 " id="hover">
            <a href="../Reports/DisplayReports.php" class="menu-link">
              <div data-i18n="Analytics">Weekly Reports</div>
            </a>
          </li>

          <li class="menu-item  mb-3 mx-3" id="hover">
            <a href="../Timesheet/DisplayUser.php" class="menu-link">
              <div data-i18n="Notifications">Attendance Record</div>
            </a>
          </li>  
      </li>

     <!-- Misc -->
     <li class="menu-header small text-uppercase"><span class="menu-header-text">Misc</span></li>
      </li>
          <li class="menu-item  mb-3 mx-3">
    
            <a href="../Functions/aboutus.php" class="menu-link ">
            <i class='fa-solid fa-gear' style='color: var(--bs-mute)'></i>
              <div data-i18n="Notifications">About Us</div>
            </a>
          </li> 
      </li>
      </li>
      </li>

      <li class="menu-item mb-3 mx-3"id ="hover">
      <a href="#" class="menu-link mx-3">
      © avams
      <script>
              document.write(new Date().getFullYear());
      </script><br>
      All Rights Reserved.
      </a>
      </li> 
      </ul>
    </ul>
    </div>
  </aside>

   <!-- Layout container -->
   <div class="layout-page =-2">
  <!-- Navbar -->

  <nav
    class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme "
    id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
      <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
        <i class="bx bx-menu bx-sm"></i>
      </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
      <!-- Search -->
      <div class="navbar-nav align-items-center">
        <div class="nav-item d-flex align-items-center">
          <i class="bx bx-search fs-4 lh-0"></i>
          <input
            type="text"
            class="form-control border-0 shadow-none ps-1 ps-sm-2"
            placeholder="Search..."
            aria-label="Search..." />
        </div>
      </div>
      <!-- /Search -->

      <ul class="navbar-nav flex-row align-items-center ms-auto">
        <!-- Place this tag where you want the button to render. -->

           <!-- time -->
           <li class="nav-item lh-7 me-3">               
                                              
            <div class="display-date  ">
              <span id="day">day</span>,
              <span id="daynum" >00</span>
              <span id="month" >month</span>
              <span id="year" >0000</span>
            <span  id ="currentTime">	</span>
      
            </div>
      
 <!-- Show current time -->
 <script src="../Assets/js/dateTime.js"> </script>
 <!-- Show current time -->
 </li>

<div class="dropdown read mx-3">
<i class="fa-regular fa-bell" style="font-size: 22px;" id="notification" data-bs-toggle="dropdown" aria-expanded="false">
<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id = "count" style="font-size:12px;"> 
<?php        $result=$connect->query($sql);
            if($result_count = $result->num_rows) {
              echo $result_count;
            }else{
              echo '
                  <style>
                      #count{
                        display:none;
                      }
                  </style>
              ';
            }
            ?> </span>
</i>
<ul class="dropdown-menu" id = "dropdown" aria-labelledby="notification"  aria-expanded="false">
<?php 
$sql_all = "SELECT * FROM notifications  WHERE department_id = '$department_id' AND user_id = '$userId' ORDER BY comment_status ASC, id DESC LIMIT 5";
$result_all = $connect->query($sql_all);
if ($result_all->num_rows > 0) {
    while ($message = $result_all->fetch_assoc()) {
        $messageId = $message['id'];
        $messageStatus = $message['comment_status'];
        $modal = 'modal_'.$message['id'];

        // Check if the status is 1 (read), then set the class accordingly
        $spanClass = ($messageStatus == 1 || $messageStatus == 0 ) ? 'read-notification' : '';

        // Output the list item with the appropriate span class
        ?>
        <li>
            <span class="dropdown-item <?=$spanClass?>" data-bs-toggle="modal" data-bs-target="#<?=$modal?>">
                <input type="text" value="<?=$messageId?>" hidden>
                <strong class="pe-auto strong"><?=$message['comment_subject']?></strong><br>
                <small class="pe-auto small">User : <?=$message['user_id']?></small>
            </span>
          <div class="dropdown-divider"></div>

                <!-- Modal -->
                <div class="modal fade overflow-visible" id="<?=$modal?>"  data-bs-backdrop="false" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" >
                  <div class="modal-dialog modal-dialog-centered ">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel"> <?=$message['comment_subject']?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                      <p><?=$message['timestamp']?> </p><br>
                      <?=$message['comment_text']?>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <?php if($message['comment_status']== 1 || $message['comment_status']== 0) {?>
                        <a href="../Php/php-notification.php?mark_as_read=<?= $message['id'] ?>" class="btn btn-info">Mark as read</a>
                        <?php } else { ?>
                          <span class="badge rounded-pill bg-success">Checked</span>
                          <?php } ?>
                      </div>
                    </div>
                  </div>
                </div>
                </li> 
            <?php
            }
          }
      ?>
   
  </ul>
</div>
<script>
  document.querySelector('.dropdown-menu').addEventListener('click', function(event) {
   event.stopPropagation();
});
document.addEventListener('DOMContentLoaded', function() {
    const messageStatus = <?= json_encode($messageStatus) ?>;
    console.log(messageStatus);

    if (messageStatus === 1) {
      const strongElements = document.querySelectorAll('.dropdown-menu strong');
      const smallElements = document.querySelectorAll('.dropdown-menu small');
      
      strongElements.forEach(function(strong) {
        strong.classList.add('notif-info');
      });

      smallElements.forEach(function(small) {
        small.classList.add('notif-info');
      });
    }
  });
</script>
<li class="nav-item lh-1 me-3">
  <a
    class="text-muted"
    href="#"> <?= $_SESSION['usertype']. " " .$_SESSION['firstname'] ?> </a>

</li>

 <!-- User -->
  <li class="nav-item navbar-dropdown dropdown-user dropdown">
    <a class="nav-link dropdown-toggle hide-arrow" href="#" data-bs-toggle="dropdown">
    <div class="avatar avatar-online">
      <img src="../assets/img/avatars/<?= $_SESSION['profile']; ?>" alt class="w-px-40 h-px-40 rounded-circle" />
    </div>
  </a>
  <ul class="dropdown-menu dropdown-menu-end">
    <li>
      <a class="dropdown-item" href="#">
        <div class="d-flex">
          <div class="flex-shrink-0 me-3">
            <div class="avatar avatar-online">
              <img src="../assets/img/avatars/<?= $_SESSION['profile']; ?>" alt class="w-px-40 h-px-40 rounded-circle" />
            </div>
          </div>
          <div class="flex-grow-1">
            <span class="fw-medium d-block"><?= $_SESSION['email'];?></span>
            <small class="text-muted"><?= $_SESSION['usertype'];?></small>
          </div>
        </div>
      </a>
    </li>
    <li>
      <div class="dropdown-divider"></div>
    </li>
    <li>
      <a class="dropdown-item" href="../Users/UserProfile.php">
        <i class="bx bx-user me-2"></i>
        <span class="align-middle">My Profile</span>
      </a>
    </li>
    <li>
      <div class="dropdown-divider"></div>
    </li>
    <li>
     <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#changePass" id = "changePasswordLink">
       <i class='fa-solid fa-gear'></i>
         <span class="align-middle">Change Password</span>
      </a>
    </li>
     <li>
<!-- changepass modal -->
<!-- Modal -->
<div class="modal fade overflow-visible" id="changePass"  data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" >
  <div class="modal-dialog modal-dialog-centered ">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Change Password</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="../Php/php-changepass.php" method="POST">
          <div class="col-md-11">
                  <label for="inputZip" class="form-label">Current Password</label>
                  <input type="password" class="form-control" id="currPass"name = "CurrentPassword" required>  
                  <span class = "currPass">
                  <i class="fa fa-eye" aria-hidden="true" id= "showCurrPassword"></i>
                  </span>
          </div>    

          <div class="col-md-11">
                  <label for="inputZip" class="form-label">New Password</label>
                  <input type="password" class="form-control" id="password"name = "NewPassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                  <span class = "newPass">
                  <i class="fa fa-eye" aria-hidden="true" id= "showNewPassword"></i>
                  </span>
          </div>    

          <div class="col-md-11">
                  <label for="inputZip" class="form-label">Confirm New Password</label>
                  <input type="password" class="form-control" id="confirmPass" name = "ConfirmNewPassword">
                  <span class = "confirmPass">
                  <i class="fa fa-eye" aria-hidden="true" id= "showConfirmPassword"></i>
                  </span>
          </div>    
            <input type="text" value="<?= $userId ?>" name="user_id" hidden>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name ="submit" class="btn btn-dark ">Change</button>
      </div>
      <div id="message">
                    <h6>Password must contain the following:</h6>
                    <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
                    <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
                    <p id="number" class="invalid">A <b>number</b></p>
                    <p id="length" class="invalid">Minimum <b>8 characters</b></p>
                    </div>
      </form>
    </div>
  </div>
</div>
<script src="../Assets/js/pass_verify.js"></script>
<script src="../Assets/js/form.js"></script>
    <li>
      <div class="dropdown-divider"></div>
    </li>
    <li>
      <a class="dropdown-item" href="../Php/php-logout.php">
        <i class="bx bx-power-off me-2"></i>
        <span class="align-middle">Log Out</span>
      </a>
    </li>
  </ul>
</li>
<!--/ User -->  
    </ul>
  </div>
</nav>

 <!-- / Navbar -->


 <!-- / Navbar -->
 <!-- Content wrapper -->
 <div class="content-wrapper">
   <!-- Content -->

   <div class="container-xxl flex-grow-1 container-p-y">
     <div class="row">

<!-- content -->








<!-- content -->


        
