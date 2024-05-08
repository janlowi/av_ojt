<?php 

session_start();
include 'db_connect.php';
include 'authenticate.php';
?>
<?php
if(isset($_GET['deactivate'])){
        $id=$_GET['deactivate'];
        $status='Deactivated';

        $sql = "UPDATE users SET status= '$status' WHERE id='$id'";
        $query=mysqli_query($connect,$sql);
        if ($query==1) {
           $_SESSION['success']= "Status updated successfully";
           header("location:../Admin/AdminDashboard.php");
        }else {
            $_SESSION['error']= "Error updating trainee status. ";
           header("location:../Admin/AdminDashboard.php");

        }

}

if(isset($_GET['activate'])){
    $id=$_GET['activate'];
    $status='Active';

    $sql = "UPDATE users SET status= '$status' WHERE id='$id'";
    $query=mysqli_query($connect,$sql);
    if ($query==1) {
       $_SESSION['success']= "Status updated successfully";
       header("location:../Admin/AdminDashboard.php");
    }else {
        $_SESSION['error']= "Error updating trainee status. ";
       header("location:../Admin/AdminDashboard.php");

    }

}
?>