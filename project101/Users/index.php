<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    
</head>
<body>
    <style>

body {
    margin: 0;
    font-family: Arial, sans-serif;
}

.dashboard-container {
    display: flex;
}

.sidebar {
    background-color: #333;
    color: #fff;
    padding: 20px;
    min-width: 200px;
}

.sidebar h2 {
    margin-top: 0;
}

.sidebar ul {
    list-style-type: none;
    padding: 0;
}

.sidebar ul li {
    margin-bottom: 10px;
}

.sidebar ul li a {
    color: #fff;
    text-decoration: none;
}

.main-content {
    padding: 20px;
}
</style>








    <div class="dashboard-container">
        <div class="sidebar">
            <h2>Dashboard</h2>
            <ul>
                <li><a href="dashboard.php">Home</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
        <div class="main-content">
            <h2>Welcome to Your Dashboard!</h2>
            <!-- Your dashboard content goes here -->
        </div>
    </div>
</body>
</html>
