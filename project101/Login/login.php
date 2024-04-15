<?php
$conn = mysqli_connect('localhost','root','','login_page');
if($conn){
   
}
else{
    echo "Failed";
}

$email=$_POST['email'];
$password=$_POST['password'];

$data = "INSERT INTO login VALUES('', '$email','$password')";
$check = mysqli_query($conn,$data);
if($check){
    echo ";;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;";
}
else{
    echo "data not send";
}
?>