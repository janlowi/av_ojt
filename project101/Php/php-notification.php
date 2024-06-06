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
if(isset($_GET['message_id'])) {
    $message_id = $_GET['message_id'];
    $user_id = $_SESSION['user_id'];
    
    // Update notification status
    $sql_update = "UPDATE notifications SET comment_status = 0 WHERE id = '$message_id' ";
    $sql_updated = $connect->query($sql_update);
    header('location: ../Users/UserDashboard.php');
    exit();

    // // Fetch latest notifications for the logged-in user's department
    // $query = "SELECT * FROM notifications WHERE department_id = '$department_id' ORDER BY id DESC LIMIT 5";
    // $result = $connect->query($query);
    // $output = '';

    // if($result->num_rows > 0) {
    //     while($row = $result->fetch_assoc()) {
    //         $output .= '<li><a href="#"><strong>'.$row["comment_subject"].'</strong><br /><small><em>'.$row["comment_text"].'</em></small></a></li><div class="dropdown-divider"></div>';
    //     }
    // } else {
    //     $output .= '<li><a href="#" class="text-bold text-italic">No notifications found</a></li>';
    // }

    // // Count unseen notifications
    // $status_query = "SELECT * FROM notifications WHERE deparment_id = '$department_id' AND comment_status = 1";
    // $status_result = $connect->query($status_query);
    // $status_count = $status_result->num_rows;

    // // Prepare data to be sent back as JSON
    // $data = array (  
    //     'notification' => $output,
    //     'count_notification' => $status_count
    // );

    // echo json_encode($data);
}
?>
