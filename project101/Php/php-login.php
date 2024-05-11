<?php
session_start();
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $email = $_POST['email'];
    $password = $_POST['password'];
    $error_msg = '';

    if (empty($email) || empty($password)) {
        $error_msg = "Fill all required fields";
    } else {
        $query = "SELECT  u.password,
                          u.id,
                          u.email,
                          u.profile,
                          u.status,
                          u.user_type,
                          t.first_name
                    FROM users u
                    LEFT JOIN trainees t ON u.id = t.user_id
                    WHERE u.email = ?";
        
        $stmt = mysqli_prepare($connect, $query);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        if ($row = mysqli_fetch_assoc($result)) {
            $hashed_password = $row['password'];
            $status = $row['status'];

            if (password_verify($password, $hashed_password)) {
                if ($status == "Deactivated") {
                    $error_msg = "Your account has been deactivated";
                } elseif ($status === "Active") {
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['user_id'] = $row['id'];
                    $_SESSION['usertype'] = $row['user_type'];
                    $_SESSION['profile'] = !empty($row['profile']) ? $row['profile'] : '../Assets/img/avatars/av.png';

                    if ($_SESSION['usertype'] === 'Admin') {
                        $_SESSION['Admin'] = true;
                    } elseif ($_SESSION['usertype'] === 'Trainee') {
                        $_SESSION['Trainee'] = true;
                        $_SESSION['firstname'] = $row['first_name'];
                    } 

                    $_SESSION['logged_in'] = true;
                    
                    if ($_SESSION['usertype'] === 'Admin') {
                        header('location: ../Admin/AdminDashboard.php');
                        exit();
                    } elseif ($_SESSION['usertype'] === 'Trainee') {
                        header('location: ../Users/UserDashboard.php');
                        exit();
                    }
                } 
            } else {
                $error_msg = "Incorrect password.";
            }
        } else {
            $error_msg = "User does not exist.";
        }
    }
    $_SESSION['error'] = $error_msg;
    header('location: ../Login/index.php');
    exit();
}
?>
