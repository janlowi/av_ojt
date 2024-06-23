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
            position: relative;
            max-width: 1000px;
            margin: auto;
            padding: 0 30px 0 30px;
            background-color: white;
            height: 1200px;
        }


        .logo-container {
    position:absolute;
    left:0px;
    margin-bottom: 20px; 
    width: 100%;
    height: 150px;
    /* background-color:white; */
}

.logo-ctu {
    width: 140px;
    height: 140px;
    object-fit: cover;
    margin: 0 0 10px 20px;

}
.logo-av {
    position: absolute;
    right: 0px;
    transform:scale(.8);
    width: 180px;
    height: 140px;
    object-fit: cover;
    margin-bottom: 10px;
}
.logo-container .content-container {
    width: 300px;

}
.logo-container .content{
    padding-top: 20px;
    align-items: middle;
    position: absolute;
    top:0;
    right: 50%;
    transform: translateX(50%);
}

        .text-center {
    text-align: center;
}
.about{
    position: relative;
    top: 250px;
}
.images{
    position: relative;
    top: 250px;
}
.Trainee{
    margin: 20px 15px 0 0;
    width: 220px;
    height: 220px;
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
   

    <div class="logo-container">
        <img src="../Assets/img/us/ctu.jpg" alt="CTU Logo" class="logo-ctu">
       <img src="../Assets/img/us/avega.png" alt="CTU Logo" class="logo-av">
       <div class = "content-container">
        <p class="text-center content">
                <strong>
                Cebu Techonological University
                </strong> <br>
                <small>
                    Daanbantayan-Campus
                </small><br>  <small>
                   Bachelor of Industrial Technology major in Computer Technology
                </small><br>
                <strong>
                Avega Bros. Integrated Shipping Corp.
                </strong> <br>
                <small>
                  On-the-Job Trainees
                </small><br>
                <small>
                  Batch 2023-2024
                </small>
                
            </p>
        </div>
    </div>
    <div class = "about">
        <h5>About Us : </h5>
        <h5>
        We are the world
        We are the children
        We are the ones who make a brighter day, so let's start giving.
        </h5>
    </div>
    <div class=" images">
    <div class="row align-items-start">
        <div class="col">
        <figure class="figure">
        <img src="../Assets/img/us/gru.png" alt="Trainee 3" class ="Trainee" >
        <figcaption class="figure-caption">

        <div class="accordion accordion-flush" id="accordionPanelsStayOpenExample">
        <div class="accordion-item">
            <h2 class="accordion-header" id="panelsStayOpen-headingOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#Trainee-1" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
            John Louie T.Gastardo 
            </button>
            </h2>
            <div id="Trainee-1" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingOne">
            <div class="accordion-body">
                <strong>Project Manager</strong> <br>
                <strong>Developer</strong> <br>
               
                <strong>Personal Project x Profile : </strong> <br>
                : <a href="">Profile</a> <br> <br>

                <p>
                    "Minioons!<br>
                    Together, We will steal the mooooon !. "
                </p> 

            </div>
            </div>
        </div>
        </div>
        
        </figcaption>
        </figure>
        </div>


        <div class="col">
        <figure class="figure">
        <img src="../Assets/img/us/yang.jpg" alt="Trainee 3" class ="Trainee" >
        <figcaption class="figure-caption">
        <div class="accordion accordion-flush" id="accordionPanelsStayOpenExample">
        <div class="accordion-item">
            <h2 class="accordion-header" id="panelsStayOpen-headingOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#Trainee-2" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
            Rhealyn Arnoco
            </button>
            </h2>
            <div id="Trainee-2" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingOne">
            <div class="accordion-body">
                <strong>Project Manager</strong> <br>
                <strong>Minion 1 </strong> <br><br>
                <p>
                    Waaaaaaaah !!
                </p>


            </div>
            </div>
        </div>
        </div>
        
        </figcaption>
        </figure>
        </div>


        <div class="col">
        <figure class="figure">
        <img src="../Assets/img/us/bebe.jpg" alt="Trainee 3" class ="Trainee" >
        <figcaption class="figure-caption">
            <div class="accordion accordion-flush" id="accordionPanelsStayOpenExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#Trainee-3" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                Bebelyn Rodrigo
                </button>
                </h2>
                <div id="Trainee-3" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingOne">
                <div class="accordion-body">
                    <strong>Project Manager</strong> <br>
                <strong>Minion 2 </strong> <br><br>
                <p>
                    Bananaaaaaaa !!
                </p>


                </div>
                </div>
            </div>
            </div>
        
        </figcaption>
        </figure>
        </div>  


        <div class="col">
        <figure class="figure">
        <img src="../Assets/img/us/zyrah.jpg" alt="Trainee 3" class ="Trainee" >
        <figcaption class="figure-caption">
            <div class="accordion accordion-flush" id="accordionPanelsStayOpenExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#Trainee-4" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                Zyrah Pepito
                </button>
                </h2>
                <div id="Trainee-4" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingOne">
                <div class="accordion-body">
                    <strong>Project Manager</strong> <br>
                <strong>Minion 3 </strong> <br><br>
                <p>
                    coopee go !!
                </p>


                </div>
                </div>
            </div>
            </div>

        </figcaption>
        </figure>
        </div>  


        <div class="col">
        <figure class="figure">
        <img src="../Assets/img/us/cha.jpg" alt="Trainee 3" class ="Trainee" >
        <figcaption class="figure-caption">
            <div class="accordion accordion-flush" id="accordionPanelsStayOpenExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#Trainee-5" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                Charity Salgarino
                </button>
                </h2>
                <div id="Trainee-5" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingOne">
                <div class="accordion-body">
                    <strong>Project Manager</strong> <br>
                <strong>Minion 4 </strong> <br><br>
                <p>
                    Bananaaaaaaa !!
                </p>


                </div>
                </div>
            </div>
            </div>
        
        </figcaption>
        </figure>
        </div>  


        <div class="col">
        <figure class="figure">
        <img src="../Assets/img/us/chu.jpg" alt="Trainee 3" class ="Trainee" >
        <figcaption class="figure-caption">
            <div class="accordion accordion-flush" id="accordionPanelsStayOpenExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#Trainee-6" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                Marichu Arriesgado
                </button>
                </h2>
                <div id="Trainee-6" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingOne">
                <div class="accordion-body">
                    <strong>Project Manager</strong> <br>
                <strong>Minion 5 </strong> <br><br>
                <p>
                coopee go!!
                </p>


                </div>
                </div>
            </div>
            </div>
        
        </figcaption>
        </figure>
        </div>
    </div>
    </div>


</div>

</body>
</html>