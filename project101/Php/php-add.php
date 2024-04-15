
<?php
include 'db_connect.php';


 if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $ojtid = $_POST["Ojtid"];
    $firstname = $_POST["Firstname"];
     $middlename = $_POST["Middlename"];
      $lastname = $_POST["Lastname"];
      $age = $_POST["Age"];
       $sex = $_POST["Sex"];
         $course = $_POST["Course"];
         $university = $_POST["University"];
          $hours_to_render = $_POST["Hours"];
           $dos = $_POST["Dos"];
            $office = $_POST["Office"];
             $email = $_POST["Email"];
              $password = $_POST["Password"];
               $confirm_pass = $_POST["Confirm"];
               $user_type = $_POST["Usertype"];
               $contact_num = $_POST["Contact"];


// $sql =  "INSERT INTO trainees (ojt_id', 'firstname', 'middlename', 'lastname', 'age', 'sex', 'course', 'university', 'hours_to_render', 'dos', 'office_assigned', 'email', 'password') 
// VALUES ('$ojtid', '$firstname', '$middlename', '$lastname', '$age', '$sex', '$course', '$university', '$hours_to_render', '$dos','$office', '$email', '$password' )";

// if ($connect->query($sql) === TRUE) {
//   echo "New record created successfully";
// } else {
//   echo "Error: " . $sql . "<br>" . $connect->error;
// }


        
$sql = "INSERT INTO trainees (id, ojt_id, first_name, middle_name, last_name, age, sex, contact_num, degree, university, hours_to_render, dos, office_assigned, email, password, user_type)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?)";

$stmt = mysqli_stmt_init($connect);

if ( ! mysqli_stmt_prepare($stmt, $sql)) {
 
    die(mysqli_error($connect));
}

mysqli_stmt_bind_param($stmt, "isssssisssiissss",
                       $id,
                       $ojtid,
                       $firstname,
                       $middlename,
                       $lastname,
                       $age,
                       $sex,
                       $contact_num,
                       $course,
                       $university,
                       $hours_to_render,
                       $dos,
                       $office,
                       $email,
                       $password,
                       $user_type
                      
                      );

mysqli_stmt_execute($stmt);


}



?>