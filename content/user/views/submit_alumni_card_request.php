<?php
include('../../auth.php');
include('../../connect.php');

// Include PHPMailer classes
require '../../../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $alumni_id = $_POST['alumni_id']; 
    $fullname = $_POST['fullname'];    
    $student_number = $_POST['student_number'];
    $department = $_POST['department'];      
    $course = $_POST['course'];   
    $year_graduated = $_POST['year_graduated'];   
    $file = $_POST['file'];
    $username = $_SESSION['username'];
    // Check if the alumni has already requested a privilege card
    $check_sql = "SELECT * FROM alumni_privilege_card WHERE alumni_id = $alumni_id";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        // If a record exists, show alert
        echo '<script>alert("You have already submitted an Alumni Privilege Card request."); window.location="index.php";</script>';
        exit; // Exit to prevent further processing
    } else {
        // Insert a new record with Pending status
        $insert_sql = "INSERT INTO alumni_privilege_card (alumni_id, fullname, student_number, department, course, year_graduated, date, file, status) 
                       VALUES ($alumni_id, '$fullname', '$student_number', '$department', '$course', '$year_graduated', CURRENT_TIMESTAMP, '$file', 'Pending')";
        
        if ($conn->query($insert_sql) === TRUE) {
            // Send confirmation email
            try {
                // Server settings
                
                $mail->isSMTP();                                          // Set mailer to use SMTP
                $mail->Host = 'smtp.gmail.com';                           // Specify main SMTP server
                $mail->SMTPAuth = true;                                   // Enable SMTP authentication
                $mail->Username = 'alumnitetest@gmail.com';               // SMTP username
                $mail->Password = 'gtqr ixub vntg ehld';                  // SMTP password or App Password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;          // Enable TLS encryption; PHPMailer::ENCRYPTION_SMTPS is preferred
                $mail->Port = 465;                                        // TCP port to connect to

                // Recipients
                $mail->setFrom('alumnitetest@gmail.com', 'Alumnite');      // Sender's email and name
                $mail->addAddress($username, $fullname); // Add recipient (alumni email)

                // Content
                $mail->isHTML(true);                                      // Set email format to HTML
                $mail->Subject = 'Alumnite Alumni Privilege Card Request Submitted!';
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
            <h1>Thank you for your Alumni Privilege Card request, <span class="highlight">'.$fullname.'</span>!</h1>
            <p>We’ve received your request for the Alumni Privilege Card. Your details are as follows:</p>
            <ul>
                <li><strong>Student Number:</strong> <span class="highlight">'.$student_number.'</span></li>
                <li><strong>Department:</strong> <span class="highlight">'.$department.'</span></li>
                <li><strong>Course:</strong> <span class="highlight">'.$course.'</span></li>
                <li><strong>Year Graduated:</strong> <span class="highlight">'.$year_graduated.'</span></li>
            </ul>
            <p>Your request is currently under review, and we will notify you regarding the eligibility and further steps shortly.</p>
            <p>If you have any questions or need assistance, please don’t hesitate to reach out.</p>
            <div class="footer">
                <p>Best regards,<br>The Alumnite Team</p>
            </div>
        </div>
    </body>
    </html>
';

                // Plain text version
                $mail->AltBody = "Thank you for your Alumni Privilege Card request, $fullname!\n\nWe’ve received your request for the Alumni Privilege Card. Your details are as follows:\n\nStudent Number: $student_number\nDepartment: $department\nCourse: $course\nYear Graduated: $year_graduated\n\nYour request is currently under review, and we will notify you regarding eligibility and further steps shortly.\n\nBest regards,\nThe Alumnite Team";

                // Send the email
                $mail->send();
                echo '<script>alert("Alumni Privilege Card request submitted. We will verify if you are eligible or not. Please wait for further details."); window.location="alumni_card.php";</script>';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        } else {
            echo '<script>alert("Error: ' . $conn->error . '"); window.location="index.php";</script>';
        }
        exit; // Exit to prevent further processing
    }
}
?>