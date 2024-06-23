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

                    if( $_SESSION['logged_in']=true) {
                        $sql = "SELECT user_id, timestamp, us.department_id 
                        FROM timesheet t1
                        INNER JOIN users us ON us.id = t1.user_id
                        WHERE event_type = 'In'
                          AND NOT EXISTS (
                              SELECT 1
                              FROM timesheet t2
                              WHERE t2.user_id = t1.user_id
                                AND event_type = 'Out'
                                AND DATE(t2.timestamp) = DATE(t1.timestamp) 
                          )
                          AND DATE(t1.timestamp) != CURDATE()
                                ";
                        $result = mysqli_query($connect, $sql);
                        
                    
                            // Step 3: Process the Results
                            if (mysqli_num_rows($result) > 0) {
                    
                                while ($row_out = mysqli_fetch_assoc($result)) {
                    
                                    $user_id = $row_out['user_id'];
                                    $timestamp =  date('Y-m-d h:i:s a', strtotime($row['timestamp']));
                                    $departmentId = $row_out['department_id'];
                    
                                    $subject = "User $user_id  failed to clock out.  ";
                                    $body = "User $user_id  has failed to clock out yesterday. Please reach to your admin or manager. ";
                                    $status_notif = 0;
                    
                                    $sql_notif = $connect->prepare("INSERT INTO notifications (comment_subject, comment_text, department_id, user_id, comment_status) VALUES (?, ?, ?, ?, ? )");
                                    $sql_notif->bind_param('ssiii', $subject, $body, $departmentId, $user_id,  $status_notif);
                                    $sql_notif->execute();
                                    $sql_notif-> close();
                                }
                               }
               
                    if ($_SESSION['usertype'] === 'Admin') {
                        $_SESSION['Admin']=true;
                        $_SESSION['department_id'] = $row['department_id'];
                        header('location: ../Admin/AdminDashboard.php');
                        unset($_SESSION['login_incorrect']);
                        exit();
                    } elseif ($_SESSION['usertype'] === 'Trainee') {
                        $_SESSION['Trainee']=true;
                        $_SESSION['department_id'] = $row['department_id'];
                        header('location: ../Users/UserDashboard.php');
                        unset($_SESSION['login_incorrect']);
                        exit();
                    }elseif ($_SESSION['usertype'] === 'Manager') {
                        $_SESSION['Manager']=true;
                        $_SESSION['department_id'] = $row['department_id'];
                        header('location: ../Manager/ManagerDashboard.php');
                        unset($_SESSION['login_incorrect']);
                        exit();

                        
                    } else {
                        $_SESSION['error'] ="Unknown user type: " . $_SESSION['usertype'];
                    }
                   

                    }
                } 
            } else {
                // Increment login attempt count on incorrect password
                $_SESSION['login_incorrect'] = isset($_SESSION['login_incorrect']) ? $_SESSION['login_incorrect'] + 1 : 1;

                if ($_SESSION['login_incorrect'] >= $max_login_attempts) {
                    $account_deactivate = "UPDATE users SET status ='Deactivated' WHERE email = '$email'";
                    $query = mysqli_query($connect, $account_deactivate);
                    $_SESSION['login_incorrect']=true;
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
