<?php
session_start();

if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Check if the username and password are correct
  if ($username === 'admin' && $password === 'password') {
    // Redirect to the dashboard page
    header('Location: login.php');
    exit();
  } else {
    // Increment the failed login attempts counter
    if (!isset($_SESSION['attempts'])) {
      $_SESSION['attempts'] = 1;
    } else {
      $_SESSION['attempts']++;
    }

    // If the number of failed attempts exceeds 3, disable the form inputs
    if ($_SESSION['attempts'] > 3) {
      echo '<script>document.getElementById("username").disabled = true;</script>';
      echo '<script>document.getElementById("password").disabled = true;</script>';
      echo '<script>document.getElementById("login-form").innerHTML += "<p>The form inputs have been disabled due to too many failed login attempts. Please try again later.</p>";</script>';
      exit();
    }

    // Display a message to the user if the login attempt was unsuccessful
    echo '<script>document.getElementById("login-form").innerHTML += "<p>Invalid username or password. Please try again.</p>";</script>';
  }
}
?>

<form id="login-form" method="post">
  <label for="username">Username:</label>
  <input type="text" id="username" name="username" required>

  <label for="password">Password:</label>
  <input type="password" id="password" name="password" required>

  <button type="submit" name="login">Login</button>
</form>