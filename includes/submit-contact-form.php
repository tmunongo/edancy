<?php
require 'phpmailer/src/PHPMailer.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    // Configure PHPMailer
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = 'smtp.example.com';  // Set your SMTP server hostname
    $mail->SMTPAuth = true;
    $mail->Username = 'your-email@example.com';  // Set your SMTP username
    $mail->Password = 'your-password';  // Set your SMTP password
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Set sender and recipient
    $mail->setFrom('your-email@example.com', 'Your Name');  // Set the sender's email address and name
    $mail->addAddress('recipient@example.com', 'Recipient Name');  // Set the recipient's email address and name

    // Set email content
    $mail->isHTML(true);
    $mail->Subject = 'New Contact Form Submission';
    $mail->Body = "
        <h3>Contact Details:</h3>
        <p><strong>Name:</strong> $name</p>
        <p><strong>Email:</strong> $email</p>
        <p><strong>Message:</strong> $message</p>
    ";

    // Send the email
    if ($mail->send()) {
        // Email sent successfully
        $response = [
            "success" => true,
            "message" => "Thank you for your message! We will get back to you soon."
        ];
    } else {
        // Error sending email
        $response = [
            "success" => false,
            "message" => "Failed to send the email. Please try again later."
        ];
    }

    // Send JSON response
    header("Content-Type: application/json");
    echo json_encode($response);
} else {
    // Invalid request method
    http_response_code(405);
    echo "Invalid request method";
}
