<?php
// Basic login validation (expand this as needed for security)
session_start();
$email = $_POST['email'];
$password = $_POST['password'];

// Check if the email and password match (replace with your authentication logic)
if ($email == "user@example.com" && $password == "password123") {
    $_SESSION['logged_in'] = true;
    header("Location: feedback_form.php"); // Redirect to feedback form
} else {
    echo "Invalid login credentials";
}
?>
