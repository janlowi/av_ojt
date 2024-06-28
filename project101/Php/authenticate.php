<?php
function checkLoggedIn() {
    // Start session
  
    // Check if 'logged_in' key is not set or not true
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
        // Redirect to login page
        header('location: ../Login/index.php');
        exit();
    }
}

//  function checkUserType(){
//      if(isset($_SESSION['usertype'])&& $_SESSION['usertype'] === 'Admin') {
//        header('location: ../Error_101.php');
//         exit();
//   }elseif(isset($_SESSION['usertype'])&& $_SESSION['usertype'] === 'Trainee') {
//         header('location: ../Error_101.php');
//          exit();
//     }elseif(isset($_SESSION['usertype'])&& $_SESSION['usertype'] === 'Manager') {
//         header('location: ../Error_101.php');
//          exit();
//     }
//  }

// Check if 'usertype' session variable is set
if (!isset($_SESSION['usertype'])) {
    header('location: ../Error_101.php'); // Redirect to error page
    die(); // Stop further execution
}

// Check if the user is not an admin
if ($_SESSION['usertype'] !== $usertype) {
    header('location: ../Error_101.php'); // Redirect to error page
    die(); // Stop further execution
}

// Check if the user is not a manager
if ($_SESSION['usertype'] !== $usertype) {
    header('location: ../Error_101.php'); // Redirect to error page
    die(); // Stop further execution
}

// Check if the user is not a trainee
if ($_SESSION['usertype'] !== $usertype) {
    header('location: ../Error_101.php'); // Redirect to error page
    die(); // Stop further execution
}


?>