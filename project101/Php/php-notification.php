<?php
session_start();
include 'db_connect.php';

if(isset($_POST['insertNotification'])){
    $subject = $_POST['Subject'];
    $body = $_POST['Body'];
    $status =  1 ;
    $department_ids = $_POST['department_ids'];


    if(!empty($subject) && !empty($body) && !empty($department_ids)){

        $sql_users = "SELECT id, department_id FROM users";
        $sql_result = $connect->query($sql_users);
        // Loop through each user
        while($user = $sql_result->fetch_assoc()) {
            $userId = $user['id'];
            $userDepartmentId = $user['department_id'];

            if(in_array($userDepartmentId, $department_ids)) {
                // Insert notification
                $sql = $connect->prepare("INSERT INTO notifications (comment_subject, comment_text, department_id, user_id, comment_status) VALUES (?, ?, ?, ?, ? )");
                $sql->bind_param('ssiii', $subject, $body, $userDepartmentId, $userId,  $status);
                $sql->execute();
                
                // Check for errors after execution
                if($sql->affected_rows <= 0){
                    $_SESSION['error'] = 'Message failed for user ID ' . $userId;
                    header('location: ../Notifications/Notification.php');
                    exit();
                }
        }
    }

        // If all notifications were inserted successfully
        $_SESSION['success'] = 'Message delivered successfully.';
        header('location: ../Notifications/Notification.php');
        exit();
    } else {
        $_SESSION['error'] = 'Empty fields or department IDs.';
        header('location: ../Notifications/Notification.php');
        exit();
    }

    $sql->close(); // Close the prepared statement

}
?>

<?php
if (isset($_GET['mark_as_read']) && !empty($_GET['mark_as_read'])) {
    $notification_id = $_GET['mark_as_read'];
    
    $sql = "UPDATE notifications SET comment_status = 0 WHERE id = '$notification_id'";
    $result = $connect->query($sql);

    if ($result) {
      header("Location: ../Users/UserDashboard.php");
      exit();
    } else {
      $_SESSION['error'] = "Failed to mark notification as read";
      header("Location: ../Users/UserDashboard.php");
      exit();
    }
  } else {
    $_SESSION['error'] = "Invalid request";
    header("Location: ../Users/UserDashboard.php");
    exit();
  }
?>
   