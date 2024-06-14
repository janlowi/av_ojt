<?php 
session_start();
$title = "About us";
include '../Layouts/main.php';
$usertype = $_SESSION['usertype'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <style>
        /* Basic styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('sea.jpg'); /* Replace 'sea.jpg' with your actual image path */
            background-size: cover;
            background-repeat: no-repeat;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .trainee {
            display: inline-block;
            margin: 20px;
            text-align: center;
        }
        .trainee img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
        }
        .trainee h3 {
            margin: 0;
            font-size: 18px;
        }
      
          
    </style>
</head>
<body>

<div class="container">
<?php
  $redirect_url = ($usertype === 'Trainee') ? '../Users/UserDashboard.php' : ($usertype === 'Admin' ? '../Admin/AdminDashboard.php' : '../Manager/ManagerDashboard.php');;
?>
    <a href="<?php echo $redirect_url ?>"> 
        <button class ="btn- btn-dark">
        Back
    </button></a>
   



    <h2>About Us</h2>
    <p>Welcome to our team! 
We're the backbone of technology solutions.
Join us to innovate and drive excellence.
    </p>

    <!-- Trainee 1 -->
     
    <div class="trainee">
        <img src="../Assets/img/us/stuart.jpg" alt="Trainee 3">
        <h3>John Louie T. Gastardo</h3>
    </div>
    

    <!-- Trainee 2 -->
   
    <!-- Trainee 3 -->
    <div class="trainee">
        <img src="../Assets/img/us/bebe.jpg" alt="Trainee 3">
        <h3>Bebelyn P. Rodrigo</h3>

    </div> <div class="trainee">
        <img src="../Assets/img/us/cha.jpg" alt="Trainee 3">
        <h3>Charity N. Salgarino</h3>
    </div>
    <div class="trainee">
        <img src="../Assets/img/us/chu.jpg" alt="Trainee 2">
        <h3>Marichu P. Arriesgado</h3>
    </div>

    <div class="trainee">
        <img src="../Assets/img/us/zyrah.jpg" alt="Trainee 1">
        <h3>Zyrah M. Pepito</h3>
    </div>
    <div class="trainee">
        <img src="../Assets/img/us/yang.jpg" alt="Trainee 3">
        <h3>Rhealyn O. Arnoco</h3>
    </div>


    <!-- Add more trainees as needed -->

</div>

</body>
</html>