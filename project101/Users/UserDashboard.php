<?php 
session_start();

include '../Layouts/main.php'; 
 include '../Layouts/sidebar copy.php';
 include '../Layouts/navbar.php';
 include '../Php/db_connect.php';


  ?>
<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User DAshboard</title>
    <!-- <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 80%;
            margin: 0 auto;
        }
        .container 2 {
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
    </style> -->
</head>
<body>
    <div class="container">
        <h1>Welcome, User!</h1>
        
        <table class="table table-dark">
  <thead>
            <tr>
                <th>no. of total hours</th>
                <th>Time-in/Time-out</th>
                <th>Weekly Reports</th>
                <th>Progress bar (hours to end)</th>
               
            </tr>
        </table>


                <div class="row">
                <!-- <div class="col-sm-4"> -->
                    <p>OJT ID</p> 
                    <p>NAME</p> 
                    <p>SEX</p> 
                    <p>BIRTHDAY</p> 
                    <p>COURSE</p> 
                    <p>UNIVERSITY</p> 
                    <p>DATE STARTED</p> 
                </div>

</body>
</html>
