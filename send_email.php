<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);
    
    $to = 'sanathan6522@gmail.com'; // Replace with your email address
    $subject = 'New Form Submission';
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    
    $emailBody = "Name: $name\nEmail: $email\n\nMessage:\n$message";

    if (mail($to, $subject, $emailBody, $headers)) {
        echo 'Success';
    } else {
        echo 'Error';
    }
} else {
    http_response_code(405);
    echo 'Method Not Allowed';
}
?>
