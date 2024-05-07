

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 20px;
            background-color: #f0f0f0; /* Added a background color */
            color: #000; /* Set text color to black */
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
        .description {
            font-size: 10px;
            text-align:left;
            color: white;
            margin-top: 50px; /* Move to the bottom */
            }
        .abisc-container h2 {
            font-size: 15px;
            text-align: center;
            color: white;
            margin-top: 80px;
        }

        .sign {
            position: absolute;
            right: 150px;
            top: 20px;
        }

        .login-form {
    position: relative;
    top: 100px; /* Adjust this value to move the input boxes down */
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
            background-color: black;
            border-radius: 20px 0 0 20px;
        }

        .image {
            position: relative;
            justify-content: center;
            text-align: center;
        }

        .image img {           
            box-shadow: -2px 5px 8px 2px rgba(248,248,248,0.30);
            -webkit-box-shadow: -2px 5px 8px 2px rgba(248,248,248,0.30);
            -moz-box-shadow: -2px 5px 8px 2px rgba(248,248,248,0.30);
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
            color: #000; /* Set text color to black */
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

        input[type="checkbox"] {
            margin-right: 5px;
        }

        a {
            color: #000; /* Set link color to black */
            text-decoration: none;
        }

        button {
    background-color: black;
    color: white; /* Changed to black */
    border-radius: 40px;
    cursor: pointer;
    display: block; /* Make it a block element */
    margin: 20px auto; /* Center it horizontally and move it down */
    width: 170px;
    height: 35px;
}
        

        button:hover {
            background-color: black;
            border-color: white;
        }
        .error {
            background: #F2DEDE;
            color: #A94442;
            padding: 10px;
            width:95%;
            border-radius: 5px;
            margin: 20px auto;

        }

    </style>
</head>
<body>

    <form action="../Php/php-login.php" method="POST">
    <?php 
                if( isset ($_SESSION ['error']))
                {
        ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Invalid Email Address!</strong> <?= $_SESSION['error']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
        <?php
                    unset($_SESSION['error']);
                }
        ?>
    <div class="login-container">
        <div class="img-cont">
            <div class="image"><img src="avega.png" alt="Logo" width="110" height="80"></div> 
            <div class="welcome-container">
                <strong><p>Welcome to Avega</p></strong>
            </div>
            <div class="description">
                <p>We are a complete logistics provider company
                    with full-range of services that can cater 
                    all logistical needs of the flourishing 
                    Philippine market through our ICHS system.</p>
            </div>
            <div class="abisc-container">    
                <strong><h2>ABISC OJT'S ATTENDANCE & REPORT TRACKING</h2></strong>
            </div>
        </div>
        <div class="sign"><h2>Sign in</h2></div>

        <?php 
                if( isset ($_SESSION ['error']))
                {
        ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Password must be 8 characters long!</strong> <?= $_SESSION['error']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
        <?php
                    unset($_SESSION['error']);
                }
        ?>
        <div class="login-form">
            <div class="input-container">
  <input type="email" id="email" name="email" placeholder="Email" required>
  <i class="fa fa-envelope icon"></i>
</div>

<div class="input-container">
  <input type="password" id="password" name="password" placeholder="Password" required>
  <i class="fa fa-lock icon"></i>
</div>
                <button type="submit">LOGIN</button>
            </form>
        </div>
        
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>