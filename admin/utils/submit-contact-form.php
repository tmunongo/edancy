<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'path/to/PHPMailer/src/Exception.php';
require 'path/to/PHPMailer/src/PHPMailer.php';

// SMTP Configuration
$mail = new PHPMailer();
$mail->isSMTP();
$mail->Host = 'smtp.example.com'; // Replace with your SMTP server
$mail->SMTPAuth = true;
$mail->Username = 'inquiries@edancy.co.zw'; // Replace with your SMTP username
$mail->Password = 'Ed@ncy2023!'; // Replace with your SMTP password
$mail->Port = 587; // Replace with the appropriate SMTP port
$mail->SMTPSecure = 'tls';

// Set From, To, Subject, and Body
$mail->setFrom('inquiries@edancy.zo.zw', 'Inquiries'); // Replace with the sender's email and name
$mail->addAddress('edimunongo@edancy.co.zw', 'The Directors'); // Replace with the recipient's email and name
$mail->Subject = 'New Contact Form Submission';

// Get form input values
$name = $_POST['name'];
$email = $_POST['email'];
$content = $_POST['content'];

// Set the email body
$body = "Name: $name\n";
$body .= "Email: $email\n";
$body .= "Content:\n$content";

$mail->Body = $body;

// Send the email
if ($mail->send()) {
    // Email sent successfully
    echo 'Thank you for your message. We will get back to you soon.';
} else {
    // Email sending failed
    echo 'Sorry, there was an error sending your message. Please try again later.';
}
