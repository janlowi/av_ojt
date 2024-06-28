<?php
session_start();
$usertype = $_SESSION['usertype'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>ERROR 101 </title>
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/avlogo.png" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <script src="https://kit.fontawesome.com/19fed37d60.js" crossorigin="anonymous"></script>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
  <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
  </symbol>
  <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
  </symbol>
  <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
  </symbol>
</svg>

<div class="container position-relative">

<br>
  <div class="position-absolute top-50 start-50 translate-middle-x ">
    <img src="Assets/img/illustrations/nope-despicable-me-4.gif" alt=" " >
    <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                    <div class="align-items-center">
                    Ooops !!! , to're non rawtui !! bananana !!!<br>
                     <small>Ooops !!! , You're not allowed. bananana !!!</small>
                    </div>
                    </div>
            <?php 
                if($usertype === "Admin"){
                    echo '
                    <div class=" d-flex justify-content-center">
                    <a href="/project101/Admin/AdminDashboard.php" class = "btn btn-danger">GO BACK</a>
                    </div>
                    ';
                }elseif($usertype === "Manager") {
                    echo '
                    <div  class=" d-flex justify-content-center">
                    <a href="/project101/Manager/ManagerDashboard.php" class = "btn btn-danger">GO BACK</a>
                    </div>
                    ';
                }elseif($usertype === "Trainee") {
                    echo '
                    <div  class=" d-flex justify-content-center">
                    <a href="/project101/Users/UserDashboard.php" class = "btn btn-danger">GO BACK</a>
                    </div>
                    ';
                }
            ?>
  </div>
</div>
    

</body>
</html>


