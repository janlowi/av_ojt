<?php 
session_start();

include '../Layouts/main.php'; 
 include '../Layouts/sidebar-.php';
 include '../Layouts/navbar.php';
 include '../Php/db_connect.php';


  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Time Tracker</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 80%;
            margin: 0 auto;
        }
        .button {
            padding: 10px 20px;
            margin-top: 10px;
            cursor: pointer;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        .progress-container {
            width: 100%;
            background-color: #ddd;
        }
        .progress-bar {
            height: 30px;
            background-color: #4CAF50;
            text-align: center;
            line-height: 30px;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome, User!</h1>
        <div>
            <strong>Total Hours:</strong> <span id="totalHours">0</span>
        </div>
        <nav>
  <ul>
    <li><a href="/">Home</a></li>
    <li><a href="/blog">Blog</a></li>
    <li><a href="/contact">Contact</a></li>
    <li><a href="/about">About</a></li>
  </ul>
</nav>
        <button class="button" id="timeInOutBtn">Time-in/Time-out</button>
        
        <table id="timeTable">
            <tr>
                <th>Day</th>
                <th>Time-in</th>
                <th>Time-out</th>
                <th>Total Hours</th>
            </tr>
            <!-- PHP code to populate table with data will go here -->
        </table>
        
        <div class="progress-container">
            <div class="progress-bar" id="progressBar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
        </div>
    </div>

    <script>
        // JavaScript to handle time-in/time-out button click and progress bar update
        document.getElementById('timeInOutBtn').addEventListener('click', function() {
            // This is where you would make an AJAX request to a PHP script to handle time-in/time-out
            console.log('Time-in/Time-out button clicked');
        });
    </script>
</body>
</html>
