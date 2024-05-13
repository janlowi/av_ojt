<?php
session_start();


if (isset($_SESSION['logged_in']) ||isset($_SESSION['logged_in'])===true   || isset($_SESSION['Admin'])  || isset($_SESSION['Trainee']) ) {
    // Redirect user to login page if not logged in
    session_destroy();

}
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
// Redirect the user to the login page or any other page after logout

header("Location: ../Login/index.php");
exit();
?>

