<?php
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // SMTP Configuration
    $mail->isSMTP();
    $mail->Host = 'mail.edancy.co.zw'; // Replace with your SMTP server
    $mail->SMTPAuth = true;
    $mail->Username = 'inquiries@edancy.co.zw'; // Replace with your SMTP username
    $mail->Password = 'fakepassword'; // Replace with your SMTP password
    $mail->Port = 465; // Replace with the appropriate SMTP port
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption

    // Set From, To, Subject, and Body
    $mail->setFrom('inquiries@edancy.co.zw', 'Edancy Consultancy Inquiries'); // Replace with the sender's email and name
    $mail->addAddress('edimunongo@edancy.co.zw', 'The Directors'); // Replace with the recipient's email and name
    $mail->Subject = 'New Contact Form Submission';

    // Get form input values
    $name = $_POST['name'];
    $email = $_POST['email'];
    $content = $_POST['message'];

    // Set the email body
    $body = "Name: $name\n";
    $body .= "Email: $email\n";
    $body .= "Content:\n$content";

    $mail->Body = $body;

    // Send the email
    if ($mail->send()) {
        // Email sent successfully
        echo "<script> alert('Thank you for your message! We will get back to you soon.'); </script>";
        header('Location: ../../index.php');
    } else {
        // Email sending failed
        echo "<script> alert('Failed to send the email. Please try again later.'); </script>";
    }
} else {
    // Invalid request method
    http_response_code(405);
    echo "Invalid request method";
    header('Location: ../index.php');
}
