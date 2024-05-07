<?php
session_start();

include "authenticate.php";
if (isset($_SESSION['Admin']) ||isset($_SESSION['Trainee'])   || isset($_SESSION['email'])  || isset($_SESSION['user_id']) ) {
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

<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>