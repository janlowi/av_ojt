<?php 

session_start();
include 'db_connect.php';
$usertype = $_SESSION['usertype'];
?>
<?php
if(isset($_GET['deactivate'])){
        $id=$_GET['deactivate'];
        $status='Deactivated';

        $sql = "UPDATE users SET status= '$status' WHERE id='$id'";
        $query=mysqli_query($connect,$sql);
        if ($query==1) {
           $_SESSION['success']= "Status updated successfully";
        }else {
            $_SESSION['error']= "Error updating trainee status. ";

        }

         $redirect_url = ($usertype === 'Admin') ? '../Admin/AdminDashboard.php' : '../Manager/ManagerDashboard.php' ;
         header("location: $redirect_url");
         exit();
}

if(isset($_GET['activate'])){
    $id=$_GET['activate'];
    $status='Active';

    $sql = "UPDATE users SET status= '$status' WHERE id='$id'";
    $query=mysqli_query($connect,$sql);
    if ($query==1) {  
       $_SESSION['success']= "Status updated successfully";
       unset($_SESSION['login_incorrect']);
    }else {
        $_SESSION['error']= "Error updating trainee status. ";

    }
    
    $redirect_url = ($usertype === 'Admin') ? '../Admin/AdminDashboard.php' : '../Manager/ManagerDashboard.php' ;
    header("location: $redirect_url");
    exit();

}
?>