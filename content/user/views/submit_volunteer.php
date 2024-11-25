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
    $event_id = $_POST['event_id'];
    $alumni_id = $_POST['alumni_id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $role = $_POST['role']; // Capture the selected role
    $username = $_SESSION['username'];

    if (isset($_POST['volunteer'])) {
        // Check if the volunteer request already exists
        $check_sql = "SELECT * FROM events_volunteer WHERE event_id = $event_id AND alumni_id = $alumni_id";
        $check_result = $conn->query($check_sql);

        if ($check_result->num_rows > 0) {
            // If the record exists, show alert
            echo '<script>alert("You already submitted a volunteer request."); window.location="events.php";</script>';
            exit; // Exit to prevent further processing
        } else {
            // Insert a new record with 'Pending' status and the selected role
            $insert_sql = "INSERT INTO events_volunteer (event_id, alumni_id, fname, lname, username, role, volunteerStatus) 
                           VALUES ($event_id, $alumni_id, '$fname', '$lname', '$username', '$role', 'Pending')";
            if ($conn->query($insert_sql) === TRUE) {
                
                try {
                    // Server settings
                    $mail->isSMTP();                                         // Set mailer to use SMTP
                    $mail->Host = 'smtp.gmail.com';                          // Specify main SMTP server
                    $mail->SMTPAuth = true;                                  // Enable SMTP authentication
                    $mail->Username = 'alumnitetest@gmail.com';                // SMTP username
                    $mail->Password = 'gtqr ixub vntg ehld'; // SMTP password or App Password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         // Enable TLS encryption; PHPMailer::ENCRYPTION_SMTPS is preferred
                    $mail->Port = 465;                                       // TCP port to connect to
                
                    // Recipients
                    $mail->setFrom('alumnitetest@gmail.com', 'Alumnite');     // Sender's email and name
                    $mail->addAddress($username, $fname.' '.$lname); // Add a recipient
                
                    // Content
                    $mail->isHTML(true);                                     // Set email format to HTML
                    $mail->Subject = 'Alumnite Volunteer Request Submitted!';
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
            <h1>Thank you for your volunteer request, <span class="highlight">'.$fname.' '.$lname.'</span>!</h1>
            <p>We’ve received your volunteer request for the upcoming event. Your selected role is <span class="highlight">'.$role.'</span>.</p>
            <p>We will review your submission and send you further details via email shortly. We appreciate your willingness to contribute and look forward to your participation.</p>
            <p>If you have any questions, feel free to contact us at any time.</p>
            <div class="footer">
                <p>Best regards,<br>The Alumnite Team</p>
            </div>
        </div>
    </body>
    </html>
';

// Plain text version
$mail->AltBody = "Thank you for your volunteer request, $fname $lname!\n\nWe’ve received your volunteer request for the upcoming event. Your selected role is $role.\n\nWe will review your submission and send you further details via email shortly. We appreciate your willingness to contribute and look forward to your participation.\n\nBest regards,\nThe Alumnite Team";

                
                    $mail->send();
                    
                } catch (Exception $e) {
                   
                }

                echo '<script>alert("Volunteer request submitted as ' . $role . ' is successful. We will email you for further details. Please wait for an update."); window.location="events.php";</script>';
            } else {
                echo '<script>alert("Error: ' . $conn->error . '"); window.location="events.php";</script>';
            }
            exit; // Exit to prevent further processing
        }
    }
}
?>