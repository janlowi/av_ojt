<?php
session_start();


// unset($_SESSION['logged_in']);
    // Redirect user to login page if not logged in
    $_SESSION = array ();
    session_destroy();



header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

header("Location: ../Login/index.php");


?>

