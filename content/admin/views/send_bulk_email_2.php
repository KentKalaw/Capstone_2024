<?php
require '../../../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $subject = isset($_POST['emailSubject']) ? $_POST['emailSubject'] : '';
    $body = isset($_POST['emailBody']) ? $_POST['emailBody'] : '';
    $emails = isset($_POST['emails']) ? $_POST['emails'] : '';

    $event_id = isset($_GET['event_id']) ? intval($_GET['event_id']) : 
            (isset($_POST['event_id']) ? intval($_POST['event_id']) : 0);

    if ($emails && $subject && $body) {
        $emailList = explode(',', $emails);  // Split the emails into an array


        try {
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

            // Add all recipients
            foreach ($emailList as $email) {
                $mail->addAddress(trim($email)); 
            }

            // Set email format to HTML
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $body;

            // Send the email
            $mail->send();

            echo "<script>alert('Emails sent successfully!'); window.location.href='view_approved_volunteer.php?event_id=" . $event_id . "';</script>";
        } catch (Exception $e) {
            echo "<script>alert('Mailer Error: {$mail->ErrorInfo}'); window.location.href='view_approved_volunteer.php?event_id=" . $event_id . "';</script>";
        }
    } else {
        echo "<script>alert('Please fill in all fields.'); window.location.href='view_approved_volunteer.php?event_id=" . $event_id . "';</script>";
    }
}
?>