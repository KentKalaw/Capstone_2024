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
    $participation_id = isset($_POST['participation_id']) ? intval($_POST['participation_id']) : 0;
    $event_id = isset($_POST['event_id']) ? intval($_POST['event_id']) : 0;
    $action = isset($_POST['action']) ? $_POST['action'] : '';

    $sqlQuery = "SELECT * FROM events_participation WHERE participation_id = $participation_id";
    $result = $conn->query($sqlQuery);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $username = $row['username'];
        $fname = $row['fname'];
        $lname = $row['lname'];
        $fullname = $fname . ' ' . $lname;

        if ($participation_id > 0 && ($action === 'Approve' || $action === 'Decline')) {
            $newStatus = $action === 'Approve' ? 'Approved' : 'Declined';

            // Update the participation status
            $update_sql = "UPDATE events_participation SET participationStatus = '$newStatus' WHERE participation_id = $participation_id";
            
            if ($conn->query($update_sql) === TRUE) {
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
                    if ($newStatus === 'Approved') {
                        $mail->Subject = 'Alumnite Event Participation Approved';
                        $mail->Body = '
                        <html>
                        <head>
                            <style>
                                body { font-family: "Helvetica Neue", Helvetica, Arial, sans-serif; background-color: #f8f8f8; color: #333; margin: 0; padding: 0; }
                                .email-container { width: 100%; max-width: 600px; margin: 20px auto; background-color: #ffffff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); }
                                h1 { font-size: 24px; color: #333; margin-bottom: 10px; }
                                p { font-size: 16px; line-height: 1.6; margin: 0 0 20px 0; }
                                .highlight { font-weight: bold; color: #2a9d8f; }
                                .footer { font-size: 14px; color: #777; text-align: center; margin-top: 20px; }
                            </style>
                        </head>
                        <body>
                            <div class="email-container">
                                <h1>Your Event Participation is Approved, <span class="highlight">'.$fullname.'</span>!</h1>
                                <p>We are delighted to inform you that your participation in the event has been approved.</p>
                                <p>We look forward to seeing you there! Please check the Alumnite website regularly for updates about the event, including schedules and additional details.</p>
                                <p>If you have any questions or require further assistance, feel free to contact us anytime.</p>
                                <div class="footer">
                                    <p>Best regards,<br>The Alumnite Team</p>
                                </div>
                            </div>
                        </body>
                        </html>';
                    } else { // When status is Declined
                        $mail->Subject = 'Alumnite Event Participation Rejected';
                        $mail->Body = '
                        <html>
                        <head>
                            <style>
                                body { font-family: "Helvetica Neue", Helvetica, Arial, sans-serif; background-color: #f8f8f8; color: #333; margin: 0; padding: 0; }
                                .email-container { width: 100%; max-width: 600px; margin: 20px auto; background-color: #ffffff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); }
                                h1 { font-size: 24px; color: #333; margin-bottom: 10px; }
                                p { font-size: 16px; line-height: 1.6; margin: 0 0 20px 0; }
                                .highlight { font-weight: bold; color: #e74c3c; }
                                .footer { font-size: 14px; color: #777; text-align: center; margin-top: 20px; }
                            </style>
                        </head>
                        <body>
                            <div class="email-container">
                                <h1>Your Event Participation Request is Rejected, <span class="highlight">'.$fullname.'</span>!</h1>
                                <p>We regret to inform you that your participation in the event has been rejected.</p>
                                <p>We understand this may be disappointing, and we encourage you to stay connected with the Alumnite community for future events. Please feel free to reach out if you have any questions or would like more information.</p>
                                <p>If you need assistance or have any concerns, don’t hesitate to contact us.</p>
                                <div class="footer">
                                    <p>Best regards,<br>The Alumnite Team</p>
                                </div>
                            </div>
                        </body>
                        </html>';
                    }
                    
                    // Plain text version
                    $mail->AltBody = "Your Event Participation is $newStatus, $fullname!\n\nWe are pleased to inform you that your participation in the event has been $newStatus.\n\nWe look forward to seeing you there! Please check the Alumnite website regularly for updates about the event, including schedules and additional details.\n\nIf you have any questions or require further assistance, feel free to contact us anytime.\n\nBest regards,\nThe Alumnite Team";
                    
                    // Send the email
                    $mail->send();
                
                } catch (Exception $e) {
                    // Handle the exception (e.g., log error message)
                }

                echo "<script>alert('Participation status updated to $newStatus!'); window.location.href='view_event_participation.php?event_id=$event_id';</script>";
            } else {
                echo "<script>alert('Error updating participation status: " . $conn->error . "'); window.location.href='view_event_participation.php?event_id=$event_id';</script>";
            }
        }
    }
}
?>