<?php 
session_start();
if(isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === true){
    header("location: ../Login/index.php");
    exit();
}
$title= "Log in";
include "../Layouts/main.php";
?>

    <style>
        body {
            position: relative;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #000; /* Set text color to black */
        }
        .bg-image{
            height:100%;
            width:100%;
            position: fixed;
            background-image: url(../Assets/img/illustrations/bck.jpg);
            background-image: cover;
        }

        .form-container{

                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);

        }




        .input-container {
             position: relative;
}
        .input-container input[type="text"],
        .input-container input[type="email"],
        .input-container input[type="password"] {
             padding-left: 30px; /* Adjust the value according to your icon size */
}

        .input-container .icon {
             position: absolute;
             left: 5px; /* Adjust the value to position the icon properly */
            top: 50%;
            transform: translateY(-50%);
}

        .login-container {
            position: relative;
            display: flex;
            width: 750px;
            height: 450px;
            border-radius: 20px;
            box-shadow: 1px 1px 13px 2px rgba(23,21,21,0.72);
            -webkit-box-shadow: 1px 1px 13px 2px rgba(23,21,21,0.72);
            -moz-box-shadow: 1px 1px 13px 2px rgba(23,21,21,0.72);
        }

        .welcome-container {
            justify-content: center;
            font-size: 20px;
            text-align: center;
            color: white;
            margin-top: 30px; /* Move to the bottom */
        }
 
        .abisc-container p {
            position:relative;
            font-size: 15px;
            top: 90px;
            text-align: center;
        }

        .sign h2 {
            color: white;
            position: absolute;
            right: 150px;
            top: 20px;
        }

        .login-form {
    position: relative;
    top: 120px; /* Adjust this value to move the input boxes down */
        }

        .img-cont,
        .login-form {
            flex: 1;
            padding: 30px;
            font-size: 12px;
        }

        .img-cont {
            text-align: center;
            justify-content: center;
            border-radius: 20px 0 0 20px;
        }

        .image {
            position: relative;
            justify-content: center;
            text-align: center;
        }        
        .manual a{
            position: relative;
            top: 50px;
            color: white;
            text-decoration: underline;
        }



        input[type="text"],input[type="email"],
        input[type="password"] {
            font-size: 12px;
            width: calc(100% - 30px);
            padding: 10px;
            margin: 5px 0;
            border: none;
            border-bottom: 1px solid rgba(0,0,0,0.30); /* Changed to underline style */
            background-color: transparent; /* Transparent background */
            color: white; /* Set text color to black */
            outline: none; /* Remove default outline */
            position: relative; /* Ensure position is relative */
        }

        input[type="text"]::placeholder,input[type="email"]::placeholder,
        input[type="password"]::placeholder {
            color: rgba(0,0,0,0.32);
            padding-left: 0; /* Adjusted padding to move placeholders to the left */
            background-repeat: no-repeat;
            background-position: right center;
            background-size: 16px 16px;
        }

        input[type="text"]::placeholder:before,input[type="email"]::placeholder:before {
            font-family: "Font Awesome 5 Free";
            content: "\f0e0"; /* Envelope icon */
            padding-right: 5px;
        }

        input[type="password"]::placeholder:before {
            font-family: "Font Awesome 5 Free";
            content: "\f023"; /* Lock icon */
            padding-right: 5px;
        }

        button {
            position: relative;
            top: 15px;
    color: white; /* Changed to black */
    border-radius: 10px;
    cursor: pointer;
    margin: 20px auto; /* Center it horizontally and move it down */
    width: 240px;
    height: 45px;
}
        
        .error {
            background: #F2DEDE;
            color: #A94442;
            padding: 10px;
            width:95%;
            border-radius: 5px;
            margin: 20px auto;

        }
        .copyright-container p {
        margin-top: 50px;
        color: #b4bdc6;
    }   
    #showPassword:hover{
        color: #b4bdc6;
    }

    </style>
    <div class="bg-image"></div>
<div class="form-container ">
     <form action="../Php/php-login.php" method="POST">
     
     <div class="login-container">
         <div class="img-cont  bg-dark">
             
         <div class="image"><img src="avega.png" alt="Logo" width="110" height="80"></div> 
             <div class="welcome-container text-light fs-2 fw-bold">
                 <p>TAMS</p>
               
             </div>
             <p class = " text-light fs-5">Trainees Attendance Monitoring System</p>
             <div class=" text-light fw-medium mt-5">
                 <p>This is an attendance and weekly reports monitoring system . Developed to provide a real-time tracking of Avega OJTs 
                    attendance and reports.
                 </p>
             </div>
             <div class="abisc-container text-light fw-medium">    
                                                                                             
                 </div>
                 <p> <?php  ?> <div class="copyright-container">
                 <p>&copy; <?php echo date("Y"); ?> Developed by AVega IT OJTs</p>
             </div> </p>
             </div>
             <div class="form-container ">
                                         
         </div>
         <div class="sign"><h2>Sign in</h2></div>

     
         <div class="login-form">
             <div class="input-container">
 <input type="email" id="email" name="email" placeholder="Email" >
 <i class="fa fa-envelope icon"></i>
 </div>

 <div class="input-container">
 <input type="password" id="password" name="password" placeholder="Password" >
 <i class="fa fa-lock icon"></i>
 <i class="fa fa-eye" aria-hidden="true" id= "showPassword"></i>
 </div>

 <div class=" d-flex justify-content-center col-10 mx-auto">
              <button type="submit" name =""class="btn btn-dark">Login</button>
 </div>
                                                             
 </form>
 </div>

<script>
    const togglePassword = document.querySelector("#showPassword");
const password = document.querySelector("#password");

togglePassword.addEventListener("click", function () {
    if(password.type === 'password'){
        password.type = 'text';
        togglePassword.classList.remove('fa-eye');
        togglePassword.classList.add('fa-eye-slash');
    }else{
        password.type = 'password';
        togglePassword.classList.remove('fa-eye-slash');
        togglePassword.classList.add('fa-eye');
    }

});

</script>

 