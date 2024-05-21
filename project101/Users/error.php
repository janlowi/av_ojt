<?php
include '../Login/index.php';
session_start();
include '../Php/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Fetch user data from the database
    $stmt = $conn->prepare("SELECT id, password, is_active, login_attempts FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($user_id, $hashed_password, $is_active, $login_attempts);
    $stmt->fetch();

    // Check if user exists
    if ($stmt->num_rows == 1) {
        // Check if account is active
        if ($is_active) {
            // Verify password
            if (password_verify($password, $hashed_password)) {
                // Successful login, reset login attempts
                $stmt = $conn->prepare("UPDATE users SET login_attempts = 0 WHERE id = ?");
                $stmt->bind_param("i", $user_id);
                $stmt->execute();

                echo "<div class='success'>Login successful!</div>";
                // Perform any other login success logic (e.g., set session variables)
            } else {
                // Increment login attempts
                $login_attempts++;
                $stmt = $conn->prepare("UPDATE users SET login_attempts = ? WHERE id = ?");
                $stmt->bind_param("ii", $login_attempts, $user_id);
                $stmt->execute();

                if ($login_attempts >= 3) {
                    // Disable the account after 3 unsuccessful attempts
                    $stmt = $conn->prepare("UPDATE users SET is_active = FALSE WHERE id = ?");
                    $stmt->bind_param("i", $user_id);
                    $stmt->execute();

                    echo "<div class='error'>Maximum login attempts exceeded. Your account has been deactivated. Please contact support.</div>";
                } else {
                    echo "<div class='error'>Invalid login credentials. Attempt $login_attempts of 3.</div>";
                }
            }
        } else {
            echo "<div class='error'>Your account is deactivated. Please contact support.</div>";
        }
    } else {
        echo "<div class='error'>Invalid username or password.</div>";
    }

    $stmt->close();
    $conn->close();
}
?>