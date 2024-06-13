<?php
session_start();
$usertype = $_SESSION['usertype'];
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
<div class="container position-relative">

<br>
  <div class="position-absolute top-50 start-50 translate-middle-x ">
    <img src="Assets/img/illustrations/nope-despicable-me-4.gif" alt=" " >
    <div class="d-flex justify-content-center">
            <?php 
                if($usertype === "Admin"){
                    echo '
                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                    <div>
                      Ooops !!! , You\'re not allowed. to\'re non rawtui, bananana!!
                    </div>
                    </div>
                    ';
                    echo '<br><br>';

                    echo '
                    <a href="/av_ojt/Project101/Admin/AdminDashboard.php" class = "btn btn-danger btn-lg">GO BACK</a>
                    ';
                }elseif($usertype === "Manager") {
                    echo '
                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                    <div>
                      Ooops !!! , You\'re not allowed. to\'re non rawtui, bananana
                    </div>
                    </div> 
                    ';
                    echo '<br><br>';
                    echo '
                    <a href="/av_ojt/Project101/Manager/ManagerDashboard.php" class = "btn btn-danger btn-lg">GO BACK</a>
                    ';
                }elseif($usertype === "Trainee") {
                    echo '
                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                    <div>
                      Ooops !!! , You\'re not allowed. to\'re non rawtui, bananana
                    </div>
                    </div>
                    ';
                    echo '<br><br>';
                    echo '
                    <a href="/av_ojt/Project101/Users/UserDashboard.php" class = "btn btn-danger btn-lg">GO BACK</a>
                    ';
                }
            ?>
    </div>
  </div>
</div>
    

</body>
</html>
