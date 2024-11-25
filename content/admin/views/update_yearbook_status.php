<?php
 require '../../../vendor/autoload.php';
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\Exception;
 
 $mail = new PHPMailer(true);
 
 ?>

<?php
include('../../auth.php');
include('../../connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $yearbook_id = isset($_POST['yearbook_id']) ? intval($_POST['yearbook_id']) : 0;
    $action = isset($_POST['action']) ? $_POST['action'] : '';
    $alumni_id = isset($_POST['alumni_id']) ? intval($_POST['alumni_id']) : 0;

    $sqlQuery = "SELECT * FROM alumni WHERE id = $alumni_id";
    $result = $conn->query($sqlQuery);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $username = $row['username'];
        $fullname = $row['fname'] . ' ' . $row['lname'];

        if ($yearbook_id > 0 && ($action === 'Approve' || $action === 'Decline')) {
            $newStatus = $action === 'Approve' ? 'Approved' : 'Declined';
    
            // Update the yearbook status
            $update_sql = "UPDATE yearbook SET request_status = '$newStatus' WHERE id = $yearbook_id";
            if ($conn->query($update_sql) === TRUE) {
                if ($newStatus === 'Approved') {
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
                        $mail->addAddress($username, $fullname);                     // Add a recipient
        
                        // Content
                        $mail->isHTML(true);                                     // Set email format to HTML
                        $mail->Subject = 'Alumnite Yearbook Delivery Request Approved';

        
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
        <h1>Your Yearbook Delivery Request is Approved, <span class="highlight">'.$fullname.'</span>!</h1>
        <p>We are pleased to inform you that your yearbook delivery request has been approved.</p>
        <p>We will update you with the delivery tracking details once your yearbook is shipped. Make sure to always check the Alumnite website.\n\n If you have any questions or concerns, feel free to contact us anytime.</p>
        <div class="footer">
            <p>Best regards,<br>The Alumnite Team</p>
        </div>
    </div>
</body>
</html>
';

$mail->AltBody = "Your Yearbook Delivery Request is Approved, $fullname!\n\nWe are pleased to inform you that your yearbook delivery request has been approved.\n\n\nWe will update you with the delivery tracking details once your yearbook is shipped. Make sure to always check the Alumnite website.\n\n If you have any questions or concerns, feel free to contact us anytime.\n\nBest regards,\nThe Alumnite Team";             $mail->send();
        
                    } catch (Exception $e) {
        
                    }
                    
                            echo "<script>alert('Yearbook Status updated to Approved.'); window.location.href='yearbook.php';</script>";
                        }
                     else {
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
                            $mail->addAddress($username, $fullname);                 // Add a recipient
                        
                            // Content
                            $mail->isHTML(true);                                     // Set email format to HTML
                            $mail->Subject = 'Alumnite Yearbook Delivery Request Declined';
                        
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
                                    color: #e63946;
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
                                <h1>Your Yearbook Delivery Request is Declined, <span class="highlight">'.$fullname.'</span>.</h1>
                                <p>We regret to inform you that your yearbook delivery request has been declined.</p>
                                <p>This decision was made due to incomplete information or other issues with your request. We encourage you to review your submission and contact our support team if you believe this was done in error.</p>
                                <p>If you have any questions or need further clarification, feel free to reach out to us at any time.</p>
                                <div class="footer">
                                    <p>Best regards,<br>The Alumnite Team</p>
                                </div>
                            </div>
                        </body>
                        </html>
                        ';
                        
                            $mail->AltBody = "Your Yearbook Delivery Request is Declined, $fullname.\n\nWe regret to inform you that your yearbook delivery request has been declined.\n\nThis decision was made due to incomplete information or other issues with your request. We encourage you to review your submission and contact our support team if you believe this was done in error.\n\nIf you have any questions or need further clarification, feel free to reach out to us at any time.\n\nBest regards,\nThe Alumnite Team";
                        
                            $mail->send();
                        
                        } catch (Exception $e) {
                            
                        }
                        
                        echo "<script>alert('Yearbook Status Declined.'); window.location.href='yearbook.php';</script>";
                    }
        
    }}}
    
    }
    


?>
