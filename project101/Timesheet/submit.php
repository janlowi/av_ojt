<?php
include ('../Php/db_connect.php');



   

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    
    $time_in = $_POST['time_in'];

}
    
    
    $sql = "INSERT INTO timesheet (trainee_id , time_in) VALUES ('1' , '$time_in')";
    if (mysqli_query($connect, $sql)) {
        echo "Record added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connect);
    }

   
    mysqli_close($connect);






?>