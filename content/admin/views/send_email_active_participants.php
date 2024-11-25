<?php
require '../../../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Create a new PHPMailer instance
        $mail = new PHPMailer(true);

        // Set up the SMTP configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'alumnitetest@gmail.com';  
        $mail->Password = 'gtqr ixub vntg ehld'; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        // Sender's email address
        $mail->setFrom('alumnitetest@gmail.com', 'Alumnite');

        // Recipient email from the form
        $recipient_email = $_POST['recipient_email'];
        $mail->addAddress(trim($recipient_email)); 

        // Set email format to HTML
        $mail->isHTML(true);
        $mail->Subject = $_POST['subject'];
        
        // Create email body with formatting
        $mail->Body = nl2br(htmlspecialchars($_POST['message']));

        // Send the email
        $mail->send();


    echo "<script>alert('Email sent successfully!'); window.location.href='active_events_participantion.php';</script>";
} catch (Exception $e) {
    echo "<script>alert('Mailer Error: {$mail->ErrorInfo}'); window.location.href='active_events_participantion.php';</script>";
}}
?>