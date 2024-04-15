<?php
$conn = mysqli_connect('localhost', 'root', '', 'time_tracking');

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if(isset($_POST['time']) && isset($_POST['date']) && isset($_POST['timeInOut'])) {
    $time = $_POST['time'];
    $date = $_POST['date'];
    $timeInOut = $_POST['timeInOutBtn'];

    $sql = "INSERT INTO time_tracking_db (time_in,  time_out) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iii", $time, $date, $timeInOut);

    // if ($stmt->execute()) {
    //   echo "New record created successfully";
    // } else {
    //   echo "Error: " . $sql . "<br>" . $conn->error;
    // }

    // $stmt->close();
  }
}

$conn->close();
?>