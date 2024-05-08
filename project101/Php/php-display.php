
<?php
session_start();
include 'db_connect.php';
$user_id = $_SESSION['user_id'];
        echo $user_id;
if ($_SERVER['REQUEST_METHOD']=='POST') {

}
?>