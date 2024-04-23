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
  <style>
    /* Custom styling */
.container {
    margin: 20px auto;
    padding: 20px;
    border-radius: 10px;
    background-color: #f8f9fa;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    max-width: 800px;
}

button {
    padding: 10px 20px;
    font-size: 16px;
    border: none;
    border-radius: 5px;
    margin-right: 10px;
    margin-bottom: 10px;
    background-color: #5BBCFF;
    color: #0C0C0C;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color:#5BBCFF;
}

.table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

.table th, .table td {
    border: 1px solid #000;
    padding: 8px;
    text-align: left;
}

.row {
    display: flex;
    flex-wrap: wrap;
    margin-top: 20px;
}

.row p {
    flex: 1;
    margin: 5px;
}

/* Bootstrap overrides */
.container button {
    margin: 10px 5px;
}

.table {
    margin-top: 30px;
}

.table th, .table td {
    border-color: #343a40;
}

.table-dark {
    background-color: #343a40;
    color: #fff;
}

.table-dark th, .table-dark td {
    border-color: #454d55;
}
.row {
    display: flex;
    flex-direction: column; /* Change the direction to column /
    align-items: flex-start; / Align items to the start of the column */
    margin-top: 20px;
}

.row p {
    margin: 5px 0; /* Adjust margin for spacing */
}
    </style> 
</head>
<body>
    <div class="container">
               <button>No. of total hours</button>
               <button>Time in/ Time out</button>
               <button>Weekly Reports</button>
               <button>Progress bar (hours to end)</button>

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
