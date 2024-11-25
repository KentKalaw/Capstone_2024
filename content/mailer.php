<?php
require '../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

$mail->isSMTP();                                          // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';                           // Specify main SMTP server
$mail->SMTPAuth = true;                                   // Enable SMTP authentication
$mail->Username = 'alumnitetest@gmail.com';               // SMTP username
$mail->Password = 'gtqr ixub vntg ehld';                  // SMTP password or App Password
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;          // Enable TLS encryption; PHPMailer::ENCRYPTION_SMTPS is preferred
$mail->Port = 465;                                        // TCP port to connect to

// Content
$mail->isHTML(true);   

return $mail;

?>