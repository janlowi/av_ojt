<?php
session_start();
    include 'db_connect.php';


?>

<?php

$user_id= $_SESSION['user_id'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    date_default_timezone_set('Asia/Manila'); // local timezone

    if (isset($_POST['selfie_in'])) {
        $lat = $_POST['lat'];
        $long = $_POST['long'];
        $selfie = $_POST['selfie_in'];
        $selfie = str_replace('data:image/png;base64,', '', $selfie);
        $selfie = str_replace(' ', '+', $selfie);
        $imageData = base64_decode($selfie);
        $file = 'uploads/' . uniqid() . '.png';

        if (!is_dir('uploads')) {
            mkdir('uploads', 0777, true);
        }
        if (file_put_contents($file, $imageData)) {


        if (empty($selfie)) {
            echo "<script>alert('Error: Please capture an image.');</script>";
        } else {
             
            $query = "INSERT INTO timesheet (user_id, event_type, total_hours, image, location) VALUES ( ?, ?, ?, ?, ?)";

             
            $stmt = $connect->prepare($query);

            if ($stmt) {
                
                $stmt->bind_param("issss", $user_id, $event_type, $total_hours, $file, $coordinates);

                 
                $user_id = $user_id;  
                $coordinates = $lat. ','. $long;
                $event_type = 'In'; 
                $total_hours = 0;  

                if ($stmt->execute()) {

                    $_SESSION['success'] = "Time In Successfully";
                            header("location: ../Users/UserDashboard.php"); 
                            exit();
                } else {
                    $error_msg="Failed to time in: " . $stmt->error;
                    $_SESSION['error'] = $error_msg;
                    header("location: ../Users/UserDashboard.php");
                    exit();
                }

                
                $stmt->close();
            } else {
                $error_msg= "Prepare failed: " . $connect->error;
                $_SESSION['error'] = $error_msg;
                    header("location: ../Users/UserDashboard.php");
                    exit();
            }
        }
    }
    }elseif(isset($_POST['selfie_out'])) {

        $lat = $_POST['lat'];
        $long = $_POST['long'];
        $selfie = $_POST['selfie_out'];
        $selfie = str_replace('data:image/png;base64,', '', $selfie);
        $selfie = str_replace(' ', '+', $selfie);
        $imageData = base64_decode($selfie);
        $file = 'uploads/' . uniqid() . '.png';

        $user_id = $_SESSION['user_id'];

        $sql = "SELECT timestamp, event_type FROM timesheet WHERE DATE(timestamp) = CURDATE() AND user_id = '$user_id'";
        $query = mysqli_query($connect, $sql);
        $row = mysqli_fetch_assoc($query);

        if ($row) {
            $current_time = time();
            $timeIn = strtotime($row['timestamp']);
            $timeOut = $current_time;

            // echo "Time In: " . date('Y-m-d H:i:s', $timeIn) . "<br>";
            // echo "Time Out: " . date('Y-m-d H:i:s', $timeOut) . "<br>";
            // echo "Time Out: " . date('Y-m-d H:i:s', $current_time) . "<br>";

            if ($timeOut > $timeIn) {


                $timeDifferenceSeconds = $timeOut - $timeIn;
                $totalHours = $timeDifferenceSeconds/3600;
                $totalHours = round($totalHours, 2);
            
                // echo "Time Difference (Seconds): " . $timeDifferenceSeconds . "<br>";
                if ($timeDifferenceSeconds < (2 * 3600)) {
                    $_SESSION['error'] = "You cannot time out within 2 hours of your last time in.";
                    header("location: ../Users/UserDashboard.php");
                    exit();
                }

                if (!is_dir('uploads')) {
                    mkdir('uploads', 0777, true);
                }
                if (file_put_contents($file, $imageData)) {
                    echo "Selfie uploaded successfully!";
                } else {
                    echo "Failed to upload selfie.";
                }
        
                if (empty($selfie)) {
                    echo "<script>alert('Error: Please capture an image.');</script>";
                } else {
                     
                    $query = "INSERT INTO timesheet (user_id, event_type, total_hours, image, location) VALUES ( ?, ?, ?, ?, ?)";
        
                     
                    $stmt = $connect->prepare($query);
        
                    if ($stmt) {
                        
                        $stmt->bind_param("issss", $user_id, $event_type, $totalHours, $file, $coordinates);
        
                         
                        $user_id = $user_id;  
                        $coordinates = $lat. ','. $long;
                        $event_type = 'Out'; 
      
                         echo $coordinates;
                        if ($stmt->execute()) {
                            $_SESSION['success'] = "Time Out Successfully";
                            header("location: ../Users/UserDashboard.php"); 
                            exit();
                        } else {
                            $_SESSION['error'] ="Failed to upload selfie: " . $stmt->error;
                            header("location: ../Users/UserDashboard.php");
                            exit();
                        }
        
                        
                        $stmt->close();
                    } else {
                        $_SESSION['error'] = "Prepare failed: " . $connect->error;
                        header("location: ../Users/UserDashboard.php");
                        exit();
                    }
                }
            } else {
                "Invalid time out. Time out cannot be before time in.";
                header("location: ../Users/UserDashboard.php");
                exit();
            }

                } else {
                    $_SESSION['error'] = "Failed to time out";
                    header("location: ../Users/UserDashboard.php");
                    exit();
                }
            } else {
                $_SESSION['error'] = "No corresponding 'In' entry found";
                header("location: ../Users/UserDashboard.php");
                exit();
            
        } 
        }
 
// displayImages($connect);

 
// $connect->close();


?>