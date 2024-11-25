<?php

$email = $_POST['email'];

$token = bin2hex(random_bytes(16));

$token_hash = hash('sha256', $token); 

date_default_timezone_set('Asia/Manila');
$expiry = date("Y-m-d H:i:s", time() + 60 * 30);

include "connect.php";

$sql = "UPDATE users 
        SET reset_token_hash = ?,
            reset_token_expires_at = ?
        WHERE username = ?";
$stmt = $conn->prepare($sql);

$stmt->bind_param("sss", $token_hash, $expiry, $email);

$stmt->execute();

if ($stmt->affected_rows > 0) {

    $mail = require __DIR__ . '/mailer.php';

    $mail->setFrom('noreply@alumnite.com', 'Alumnite'); 
    $mail->addAddress($email);
    $mail->Subject = 'Password Reset Request';
    $mail->Body = <<<END
    
    Click <a href="http://192.168.18.8:8080/content/reset_password.php?token=$token">here</a>
    to reset your password. This link will expire in 30 minutes.
    
    END;

    try {
        $mail->send();
        
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

}

echo "Message sent check your email for the reset link";