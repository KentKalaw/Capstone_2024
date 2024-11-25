<?php

require '../../../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

include('../../connect.php');
$id =  $_GET['id'];
$sql = "UPDATE users SET status = 'Approved' WHERE id = '$id'";
$conn->query($sql);
$email = $_GET['email'];


$sql = "SELECT * FROM alumni WHERE username = '$email'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $fname = $row['fname'];
    $lname = $row['lname'];
    $studentnumber = $row['studentnumber']; 
    $department = $row['department'];
    $course = $row['course'];
    $year = $row['year'];
}

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
    $mail->addAddress('$email', $fname . ' ' . $lname);

    // Content
    $mail->isHTML(true);                                      // Set email format to HTML
    $mail->Subject = 'Welcome to Alumnite!';
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
    <h1>Welcome to Alumnite, <span class="highlight">' . $fname . ' ' . $lname . '</span>!</h1>
    <p>Your alumni account has been successfully created. Here are your details:</p>
    <ul>
        <li><strong>Full Name:</strong> <span class="highlight">' . $fname . ' ' . $lname . '</span></li>
        <li><strong>Student Number:</strong> <span class="highlight">' . $studentnumber . '</span></li>
        <li><strong>Department:</strong> <span class="highlight">' . $department . '</span></li>
        <li><strong>Course:</strong> <span class="highlight">' . $course . '</span></li>
        <li><strong>Year Graduated:</strong> <span class="highlight">' . $year . '</span></li>
    </ul>
    <p>We are excited to have you as part of our alumni community! Please feel free to explore the platform and make the most of the available features.</p>
    <p>If you have any questions or need support, dont hesitate to reach out to us at any time.</p>
    <div class="footer">
        <p>Best regards,<br>The Alumnite Team</p>
    </div>
    </div>
    </body>
    </html>
    ';

    // Plain text version
    $mail->AltBody = "Welcome to Alumnite, $fname.' '.$lname.!\n\nYour alumni account has been successfully created. Here are your details:\n\nFull Name: $fname.' '.$lname\nStudent Number: $student_number\nDepartment: $department\nCourse: $course\nYear Graduated: $year\n\nWe are excited to have you as part of our alumni community! Please feel free to explore the platform and make the most of the available features.\n\nBest regards,\nThe Alumnite Team";

    // Send the email
    $mail->send();

} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

$date = date('F d, Y h:i A', time());
$message = 'Administrator approved alumni registration request for ' . $fname . ' ' . $lname;
$save = $conn->query("INSERT INTO audit (username, action, timestamp) VALUES ('admin', '$message', '$date')");
?>
<script>
    alert("Alumni Registration request has been approved");
    window.location="approval.php";
</script>