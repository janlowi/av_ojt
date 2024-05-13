<?php
session_start();
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $_SESSION['error'] = "Fill all required fields";
        header('location: ../Login/index.php');
        exit();
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
            $user_id = $row['id'];
            $status = $row['status'];
            $_SESSION['usertype'] = $row['user_type'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['user_id'] = $user_id;
            $_SESSION['firstname'] = $row['first_name'];

            if (password_verify($password, $hashed_password)) {
                if ($status == "Deactivated") {
                    $_SESSION['error'] = "Your account has been deactivated";
                    header('location: ../Login/index.php');
                    exit();
                } elseif ($status == "Active")  {
                    if (empty($row['profile'])) {
                        $default_image = 'av.png'; 
                        $profile_image_path = '../Assets/img/avatars/' . $default_image;

                        $update_query = "UPDATE users SET profile ='$profile_image_path' WHERE id = '$user_id'";
                        $update_result = mysqli_query($connect, $update_query);
                        $_SESSION['profile'] = $profile_image_path;
                    } else {
                        $_SESSION['profile'] = $row['profile'];
                    }
                    $_SESSION['logged_in']=true;
                    if ($_SESSION['usertype'] === 'Admin') {
                        $_SESSION['Admin']=true;
                        header('location: ../Admin/AdminDashboard.php');
                        exit();
                    } elseif ($_SESSION['usertype'] === 'Trainee') {
                        $_SESSION['Trainee']=true;
                        header('location: ../Users/UserDashboard.php');
                        exit();
                    } else {
                        $_SESSION['error'] ="Unknown user type: " . $_SESSION['usertype'];
                    }
                } 
            }  else {
                $_SESSION['error'] = "Incorrect password.";
                header('location: ../Login/index.php');
                exit();
            }
        } else {
            $_SESSION['error'] = "User does not exist.";
            header('location: ../Login/index.php');
            exit();
        }
    }
}
?>
