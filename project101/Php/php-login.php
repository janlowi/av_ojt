<?php
session_start();
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $max_login_attempts= 3;
    $status='Deactivated';
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $_SESSION['error'] = "Fill all required fields";
        header('location: ../Login/index.php');
        exit();
    } else {
        $query = "SELECT  *
                    FROM users 
                    WHERE email = ?";
        
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
                        $default_image = '../Assets/img/avatars/av.png'; 
                      

                        $update_query = "UPDATE users SET profile ='$default_image' WHERE id = '$user_id'";
                        $update_result = mysqli_query($connect, $update_query);
                        $_SESSION['profile'] = $profile_image_path;
                    } else {
                        $_SESSION['profile'] = $row['profile'];
                    }
                    $_SESSION['logged_in']=true;
                    if ($_SESSION['usertype'] === 'Admin') {
                        $_SESSION['Admin']=true;
                        header('location: ../Admin/AdminDashboard.php');
                        unset($_SESSION['login_incorrect']);
                        exit();
                    } elseif ($_SESSION['usertype'] === 'Trainee') {
                        $_SESSION['Trainee']=true;
                        header('location: ../Users/UserDashboard.php');
                        unset($_SESSION['login_incorrect']);
                        exit();

                        
                    } else {
                        $_SESSION['error'] ="Unknown user type: " . $_SESSION['usertype'];
                    }
                } 
            } else {
                // Increment login attempt count on incorrect password
                $_SESSION['login_incorrect'] = isset($_SESSION['login_incorrect']) ? $_SESSION['login_incorrect'] + 1 : 1;

                if ($_SESSION['login_incorrect'] >= $max_login_attempts) {
                    $account_deactivate = "UPDATE users SET status ='Deactivated' WHERE email = '$email'";
                    $query = mysqli_query($connect, $account_deactivate);
                    $_SESSION['error'] = "Your account has been deactivated due to multiple failed login attempts.";
                } else {
                    $_SESSION['error'] = "Incorrect password. Attempt " . $_SESSION['login_incorrect'] . " of $max_login_attempts";
                }

                header('location: ../Login/index.php');
                exit();
            }
            }else {
            $_SESSION['error'] = "User does not exist.";
            header('location: ../Login/index.php');
            exit();
        }
    }
}
?>
