<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    header("Location: login.html"); // Redirect to login if not logged in
    exit;
}

// reCAPTCHA verification
$recaptchaSecret = 'YOUR_SECRET_KEY';
$recaptchaResponse = $_POST['g-recaptcha-response'];
$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$recaptchaSecret&response=$recaptchaResponse");
$responseData = json_decode($response);

if (!$responseData->success) {
    echo "reCAPTCHA verification failed!";
    exit;
}

// Feedback details
$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

// Send email to admin
$adminEmail = 'admin@example.com';
$headers = "From: $email\r\n";
mail($adminEmail, "New Feedback: $subject", "From: $name\n\n$message", $headers);

// Send acknowledgment email to user
$ackSubject = "Thank you for your feedback!";
$ackMessage = "Dear $name,\n\nThank you for your feedback. We will review it soon.\n\nRegards,\nTeam";
mail($email, $ackSubject, $ackMessage, "From: $adminEmail");

echo "Feedback submitted successfully!";
?>
