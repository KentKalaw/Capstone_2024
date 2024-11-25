<?php

require '../../../vendor/autoload.php';

// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);
?>

<?php
include('../../auth.php');
include('../../connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $alumni_id = $_POST['alumni_id'];  // Get the alumni ID
    $student_number = $_POST['student_number'];
    $fullname = $_POST['fullname'];     // Get the full name
    $address = $_POST['address'];       // Get the delivery address
    $latitude = $_POST['latitude'];   
    $longitude = $_POST['longitude'];   
    $number = $_POST['number'];         // Get the phone number
    $username = $_SESSION['username'];  // Get the username

    // Check if the alumni has already requested a yearbook
    $check_sql = "SELECT * FROM yearbook WHERE alumni_id = $alumni_id";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        // If a record exists, show alert
        echo '<script>alert("You have already submitted a Yearbook Delivery request."); window.location="index.php";</script>';
        exit; // Exit to prevent further processing
    } else {
        // Insert a new record with Pending status
        $insert_sql = "INSERT INTO yearbook (alumni_id, student_number, fullname, address, latitude, longitude, number, request_status) VALUES ($alumni_id, '$student_number', '$fullname', '$address', '$latitude', '$longitude', '$number', 'Pending')";
        
        if ($conn->query($insert_sql) === TRUE) {
            try {
                // Server settings
                $mail->isSMTP();                                         // Set mailer to use SMTP
                $mail->Host = 'smtp.gmail.com';                          // Specify main SMTP server
                $mail->SMTPAuth = true;                                  // Enable SMTP authentication
                $mail->Username = 'alumnitetest@gmail.com';              // SMTP username
                $mail->Password = 'gtqr ixub vntg ehld';                 // SMTP password or App Password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         // Enable TLS encryption; PHPMailer::ENCRYPTION_SMTPS is preferred
                $mail->Port = 465;                                       // TCP port to connect to
            
                // Recipients
                $mail->setFrom('alumnitetest@gmail.com', 'Alumnite');     // Sender's email and name
                $mail->addAddress($username, $fullname);           // Add a recipient
            
                // Content
                $mail->isHTML(true);                                     // Set email format to HTML
                $mail->Subject = 'Alumnite Yearbook Delivery Request Submitted!';
            
                // HTML Body for Yearbook Delivery
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
                        <h1>Thank you for your Yearbook delivery request, <span class="highlight">'.$fullname.'</span>!</h1>
                        <p>We’ve received your request for Yearbook delivery. Your details have been successfully submitted.</p>
                        <p>Your Yearbook will be processed and delivered soon if we verified your information. We will send you further updates regarding the delivery status via email.</p>
                        <p>If you have any questions or need assistance, feel free to contact us at any time.</p>
                        <div class="footer">
                            <p>Best regards,<br>The Alumnite Team</p>
                        </div>
                    </div>
                </body>
                </html>
                ';
            
                // Plain text version
                $mail->AltBody = "Thank you for your Yearbook delivery request, $fullname!\n\nWe’ve received your request for Yearbook delivery. Your details have been successfully submitted.\n\nYour Yearbook will be processed and delivered soon. We will send you further updates regarding the delivery status via email.\n\nBest regards,\nThe Alumnite Team";
            
                $mail->send();
                
            } catch (Exception $e) {
                
            }
            echo '<script>alert("Yearbook Delivery request submitted. We will verify if you are elligible or not. Please wait for further details"); window.location="yearbook.php";</script>';
        } else {
            echo '<script>alert("Error: ' . $conn->error . '"); window.location="index.php";</script>';
        }
        exit; // Exit to prevent further processing
    }
}
?>