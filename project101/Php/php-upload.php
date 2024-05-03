<?php
session_start();
  include('../Php/db_connect.php');
  include('../Php/authenticate.php');

  if(isset($_POST['submit'])) {

    $user_id=$_SESSION['user_id'];
    $tr_id=$_SESSION['id'];

    print_r($user_id, $tr_id);


      // Check if file is selected
      if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
          // Get file details
          $file_name = $_FILES['image']['name'];
          $tempname = $_FILES['image']['tmp_name'];
          $folder = '../Assets/img/avatars/'.$file_name;
          
          // Check file type
          $allowed_types = array('image/jpeg', 'image/png');
          $file_type = $_FILES['image']['type'];
          if (!in_array($file_type, $allowed_types)) {
              $error = "Only PNG and JPG files are allowed.";
              header("Location: php-upload.php?error=$error");
              exit();
          }
          
          // Check file size (in bytes)
          $max_size = 5 * 1024 * 1024; // 5 MB
          if ($_FILES['image']['size'] > $max_size) {
              $error = "File size exceeds the limit of 5MB.";
              header("Location: php-upload.php?error=$error");
              exit();
          }
  
          // Insert file into database
          $query = mysqli_query($connect, "INSERT INTO trainees(profile, user_id)  VALUES ('$file_name', '$user_id') WHERE id ='$tr_id' AND user_id='$user_id'");
          
          // Move uploaded file to destination folder
          if(move_uploaded_file($tempname, $folder)) {
              echo "<h2>File uploaded successfully</h2>";
          } else {
              echo "<h2>File not uploaded</h2>";
          }
      } else {
          echo "<h2>No file selected or an error occurred</h2>";
      }
  }
  ?>

