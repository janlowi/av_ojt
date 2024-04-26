<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>OJT Table</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    
    .table-container {
      margin-top: 20px;
    }
  </style>
</head>
<body>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="table-container">
        <table class="table table-dark table-hover">
          <thead>
            <tr>
              <th>OJT ID</th>
              <th>Timestamp In</th>
              <th>Timestamp Out</th>
              <th>Date</th>
              
              <th>Total Hours</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <!-- <td>1</td>
              <td>John Doe</td>
              <td>2024-04-26</td>
              <td>09:00 AM</td>
              <td>05:00 PM</td>
              <td>8</td>
            </tr> -->
            <!-- Add more rows as needed -->
       

<?php

include '../Php/db_connect.php';




$sql = "SELECT * FROM timesheet";
$result = $connect->query($sql);

if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["timestamp"] . "</td>";
       
        echo "<td>" . $row["date"] . "</td>";
        echo "<td>" . $row["total_hours"] . "</td>";

        echo "</tr>";
    }
} else {
    echo "0 results";
}
$connect->close();
?>
   </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

</body>
</html>