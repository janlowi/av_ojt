<?php
$conn = mysqli_connect('localhost','root','','time_tracking');
if($conn){
   
}

$time_in=$_POST['time_in'];

$data = "INSERT INTO time_tracking_db('', '$time_in',)";
$check = mysqli_query($conn,$data);
if($check){
    echo "save";
}
// else{
//     echo "data not send";
// }
?>