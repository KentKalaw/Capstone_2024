<?php

require '../../../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);


include('../../connect.php');
$id =  $_GET['id'];
$username =  $_GET['email'];


$sql = "DELETE FROM users WHERE id = '$id'";
$conn->query($sql);
$sql2 = "DELETE FROM alumni WHERE username = '$username'";
$conn->query($sql2);
// send email
$email = $_GET['email'];
try {
  // Server settings
  $mail = new PHPMailer(true);
  $mail->isSMTP();                                          // Set mailer to use SMTP
  $mail->Host = 'smtp.gmail.com';                           // Specify main SMTP server
  $mail->SMTPAuth = true;                                   // Enable SMTP authentication
  $mail->Username = 'alumnitetest@gmail.com';               // SMTP username
  $mail->Password = 'gtqr ixub vntg ehld';                  // SMTP password or App Password
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;          // Enable TLS encryption; PHPMailer::ENCRYPTION_SMTPS is preferred
  $mail->Port = 465;                                        // TCP port to connect to

  // Recipients
  $mail->setFrom('alumnitetest@gmail.com', 'Alumnite');
  $mail->addAddress($email, $fname . ' ' . $lname);

  // Content
  $mail->isHTML(true);                                      // Set email format to HTML
  $mail->Subject = 'REGISTRATION DECLINED';
  $mail->Body = '
  <html>
  <head>
  <style>
  body {
      font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
      background-color: #f8f8f8;
      color: #333;
      margin: 0;
      padding: 0;
  }
  .email-container {
      width: 100%;
      max-width: 600px;
      margin: 20px auto;
      background-color: #ffffff;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  }
  h1 {
      font-size: 24px;
      color: #333;
      margin-bottom: 10px;
  }
  p {
      font-size: 16px;
      line-height: 1.6;
      margin: 0 0 20px 0;
  }
  .highlight {
      font-weight: bold;
      color: #2a9d8f;
  }
  .footer {
      font-size: 14px;
      color: #777;
      text-align: center;
      margin-top: 20px;
  }
  </style>
  </head>
  <body>
  <div class="email-container">
  <h1>Hello <span class="highlight">' . $fname . ' ' . $lname . '</span>,</h1>
  <p>We regret to inform you that your alumni account registration has been declined.</p>
  
  <p>Unfortunately, we are unable to approve your registration at this time due to insufficient proof of records or an unclear picture provided during the sign-up process. If you believe this decision was made in error, you can reach out to our support team for clarification.</p>
  <p>We understand this may be disappointing, but we appreciate your understanding and hope to resolve any issues. Feel free to contact us with any questions or concerns.</p>
  <div class="footer">
      <p>Best regards,<br>The Alumnite Team</p>
  </div>
  </div>
</body>
  </html>
  ';

  // Plain text version
  $mail->AltBody = "Hello $fname $lname,\n\n
We regret to inform you that your alumni account registration has been declined.\n\n
Unfortunately, we are unable to approve your registration at this time due to insufficient proof of records or an unclear picture provided during the sign-up process. If you believe this decision was made in error, you can reach out to our support team for clarification.\n\n
We understand this may be disappointing, but we appreciate your understanding and hope to resolve any issues. Feel free to contact us with any questions or concerns.\n\n
Best regards,\n
The Alumnite Team";
  // Send the email
  $mail->send();

} catch (Exception $e) {
  echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

					date_default_timezone_set('Asia/Manila');
					$message = 'Administrator declined alumni registration request';
					$date = date('F d, Y h:i A');
				$save = $conn->query("INSERT INTO audit (username,action, timestamp)VALUES ('admin','$message','$date')");
?>
<script>
	alert("Alumni Registration request has been declined");
	window.location="approval.php";
</script>