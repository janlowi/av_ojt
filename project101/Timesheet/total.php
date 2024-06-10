
<?php
session_start(); // Start the session if not started already

// Function to calculate total hours
function calculateTotalHours($connect, $user_id) {
    $totalHours = 0; // Initialize total hours variable
    
    // Prepare and execute SQL query
    $sql = "SELECT total_hours
            FROM timesheet
            WHERE user_id=? AND event_type IN ('In', 'Out')";
    $stmt = mysqli_prepare($connect, $sql);
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    // Fetch and sum total hours
    while ($row = mysqli_fetch_assoc($result)) {
        $totalHours += $row['total_hours'];
    }
    
    return $totalHours;
}
include '../Php/db_connect.php';


$connect = mysqli_connect($servername, $username, $password, $database);

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

            .dashboard {
                width: 80%;
                max-width: 1200px;
                border-radius: 8px;
                padding: 20px;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .total-hours-box {
                background: #007bff;
                color: #fff;
                width: 200px;
                height: 200px;
                border-radius: 8px;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
            }

            .total-hours-box h2 {
                margin: 0;
                font-size: 2.5em;
            }

            .total-hours-box p {
                margin: 0;
                font-size: 1.2em;
            }
        </style>
    </head>
    <body>
        <div class="dashboard">
            <div class="total-hours-box">
                <h2><?php echo $totalHours; ?></h2>
                <p>Total Hours</p>
            </div>
        </div>
    </body>
    </html>

    <?php
} else {

}
?>