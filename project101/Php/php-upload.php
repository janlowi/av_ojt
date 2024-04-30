<?php
  include('../Php/db_connect.php');
session_start();
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
   
</head>
<body>
    <?php if (isset($_GET['error'])): ?>
        <p><?php echo $_GET['error']; ?></p>
        
        <?php endif ?>
   <form method="POST" enctype="multipart/form-data">
    <input type="file" name="image" />
    <br /> <br />
    <button type="submit" name="submit">Submit</button>
</form>
<div>
    <?php
        $user_id=$_SESSION['user_id'];
        $res = mysqli_query($connect, "SELECT tr.profile
        
        FROM trainees tr
        
        WHERE tr.user_id='$user_id'
        
        ");
        while($row = mysqli_fetch_assoc($res)) {
            ?>
            <img src="../Assets/img/avatars/<?php echo $row['file']; ?>" />
        <?php } ?>
        </div>
</body>
</html>