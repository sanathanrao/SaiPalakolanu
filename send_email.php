<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $phone = htmlspecialchars($_POST['phone']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    
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
        $mail->Body    = "Name: $name<br>Phone: $phone<br>Email: $email<br>Subject: $subject<br>";
        $mail->AltBody = "Name: $name\nPhone: $phone\nEmail: $email\nSubject: $subject";

        $mail->send();
        http_response_code(200);
    } catch (Exception $e) {
        error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
        http_response_code(500);
    }
}
?>