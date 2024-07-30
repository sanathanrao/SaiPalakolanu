<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = htmlspecialchars($_POST['firstname']);
    $lastname = htmlspecialchars($_POST['lastname']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);
    
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';  // SMTP server
        $mail->SMTPAuth   = true;                // Enable SMTP authentication
        $mail->Username   = 'sanathan6522@gmail.com';  // SMTP username
        $mail->Password   = 'vxqxseqoankrreri';     // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  // Enable TLS encryption
        $mail->Port       = 587;                 // TCP port

        //Recipients
        $mail->setFrom('sanathan6522@gmail.com', 'Mailer');
        $mail->addAddress('sanathan@digicarotene.com', 'Recipient Name');  // Add a recipient

        //Content
        $mail->isHTML(true);  // Set email format to HTML
        $mail->Subject = 'New Contact Form Submission';
        $mail->Body    = "First Name: $firstname<br>Last Name: $lastname<br>Email: $email<br>Subject: $subject<br>Message:<br>$message";
        $mail->AltBody = "First Name: $firstname\nLast Name: $lastname\nEmail: $email\nSubject: $subject\nMessage:\n$message";

        $mail->send();
        http_response_code(200);
    } catch (Exception $e) {
        error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
        http_response_code(500);
    }
}
?>