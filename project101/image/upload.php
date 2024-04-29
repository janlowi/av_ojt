<?php
  include('../Php/db_connect.php');
  
  if(isset($_POST['submit'])) {
      // Check if file is selected
      if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
          // Get file details
          $file_name = $_FILES['image']['name'];
          $tempname = $_FILES['image']['tmp_name'];
          $folder = 'image/'.$file_name;
          
          // Check file type
          $allowed_types = array('image/jpeg', 'image/png');
          $file_type = $_FILES['image']['type'];
          if (!in_array($file_type, $allowed_types)) {
              $error = "Only PNG and JPG files are allowed.";
              header("Location: upload.php?error=$error");
              exit();
          }
          
          // Check file size (in bytes)
          $max_size = 5 * 1024 * 1024; // 5 MB
          if ($_FILES['image']['size'] > $max_size) {
              $error = "File size exceeds the limit of 5MB.";
              header("Location: upload.php?error=$error");
              exit();
          }
  
          // Insert file into database
          $query = mysqli_query($connect, "INSERT INTO image(file)  VALUES ('$file_name')");
          
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
        $res = mysqli_query($connect, "SELECT * FROM `image`");
        while($row = mysqli_fetch_assoc($res)) {
            ?>
            <img src="image/<?php echo $row['file']; ?>" />
        <?php } ?>
        </div>
</body>
</html>