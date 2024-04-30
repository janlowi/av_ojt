<?php

include 'db_connect.php';





session_destroy();+


header("Location: ../Login/index.php");
exit();
?>