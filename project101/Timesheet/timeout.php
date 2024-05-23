<?php
session_start(); 
include '../Php/db_connect.php'; // Include database connection

// Check connection
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

$user_id = $_SESSION['user_id'] ?? null; // Get user ID from session or set to null if not exists

if ($user_id) {
    // Call the function to calculate total hours
    $totalHours = calculateTotalHours($connect, $user_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .time-box {
            background: #007bff;
            color: #fff;
            width: 200px;
            height: 200px;
            border-radius: 8px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            cursor: pointer; /* Added cursor pointer to indicate clickability */
        }

        .time-display {
            margin: 0;
            font-size: 2.5em;
        }

        .time-description {
            margin: 0;
            font-size: 1.2em;
        }
    </style>
</head>
<body>
    
    <div class="time-box" onclick="displayTime()">
        <p class="time-description">Time Out</p>
        <p class="time-display" id="timeDisplay"></p> <!-- Added element for time display -->
    </div>

    <script>
        function displayTime() {
            var now = new Date();
            var hours = now.getHours();
            var minutes = now.getMinutes();
            var ampm = hours >= 12 ? 'pm' : 'am';
            hours = hours % 12;
            hours = hours ? hours : 12;
            minutes = minutes < 10 ? '0' + minutes : minutes; // Ensure minutes have leading zero if necessary
            var timeString = hours + ':' + minutes + ' ' + ampm;
            document.getElementById('timeDisplay').textContent = timeString; // Update time display
        }
    </script>
</body>
</html>

<?php
}

// Function to calculate total hours
function calculateTotalHours($connect, $user_id) {
    $totalHours = 0; // Initialize total hours variable

    // Prepare and execute SQL query
    $sql = "SELECT total_hours FROM timesheet WHERE user_id=? AND event_type IN ('In', 'Out')";
    $stmt = mysqli_prepare($connect, $sql);
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Check for query errors
    if (!$result) {
        die("Query failed: " . mysqli_error($connect));
    }

    // Fetch and sum total hours
    while ($row = mysqli_fetch_assoc($result)) {
        $totalHours += $row['total_hours'];
    }

    return $totalHours;
}
?>
