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
    $card_id = isset($_POST['card_id']) ? intval($_POST['card_id']) : 0;
    $alumni_id = isset($_POST['alumni_id']) ? intval($_POST['alumni_id']) : 0;
    $action = isset($_POST['action']) ? $_POST['action'] : '';

    if ($card_id > 0 && ($action === 'Approve' || $action === 'Decline')) {
        $newStatus = $action === 'Approve' ? 'Approved' : 'Declined';

        // Update the alumni privilege card status
        $update_sql = "UPDATE alumni_privilege_card SET status = '$newStatus' WHERE id = $card_id";
        
        if ($conn->query($update_sql) === TRUE) {
            // Fetch the alumni details and email by joining the alumni table
            $sqlQuery = "SELECT a.username, a.fname, a.lname 
                         FROM alumni a 
                         JOIN alumni_privilege_card apc ON a.id = apc.alumni_id 
                         WHERE apc.id = $card_id";
            $result = $conn->query($sqlQuery);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $fullname = $row['fname'] . ' ' . $row['lname'];
                $username = $row['username'];

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
                    $mail->addAddress($username, $fullname);                     // Add a recipient by email
                
                    // Content
                    $mail->isHTML(true);                                     // Set email format to HTML
                    if ($newStatus === 'Approved') {
                        $mail->Subject = 'Alumnite Alumni Privilege Card Approved';
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
                                <h1>Your Alumni Privilege Card Request is Approved, <span class="highlight">'.$fullname.'</span>!</h1>
                                <p>We are pleased to inform you that your request for an Alumni Privilege Card has been approved.</p>
                                <p>You are elligible to get Alumni Privilege Card. Please go to the SAEP Office located at University of Batangas for more information on how to claim your Card.</p>
                                <p>Also prepare some money if your status is for ReApplication as it has a price.</p>
                                <p>If you have any questions or need further assistance, feel free to contact us.</p>
                                <div class="footer">
                                    <p>Best regards,<br>The Alumnite Team</p>
                                </div>
                            </div>
                        </body>
                        </html>';
                    } else { // When status is Declined
                        $mail->Subject = 'Alumnite Alumni Privilege Card Request Declined';
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
                                <h1>Your Alumni Privilege Card Request is Declined, <span class="highlight">'.$fullname.'</span>!</h1>
                                <p>We regret to inform you that your request for an Alumni Privilege Card has been declined.</p>
                                <p>We understand this may be disappointing, and we encourage you to stay connected with the Alumnite community for future opportunities. Feel free to reach out if you have any questions or would like to know more.</p>
                                <p>If you need assistance or have any concerns, dont hesitate to contact us.</p>
                                <div class="footer">
                                    <p>Best regards,<br>The Alumnite Team</p>
                                </div>
                            </div>
                        </body>
                        </html>';
                    }

                    // Plain text version
                    $mail->AltBody = "Your Alumni Privilege Card Request is $newStatus, $fullname!\n\nWe are pleased to inform you that your request for an Alumni Privilege Card has been $newStatus.\n\nYou can now use your Alumni Privilege Card for various benefits. Please check the Alumnite website for further details and updates.\n\nIf you have any questions or need further assistance, feel free to contact us.\n\nBest regards,\nThe Alumnite Team";
                    
                    // Send the email
                    $mail->send();
                
                } catch (Exception $e) {
                    // Handle the exception (e.g., log error message)
                }

                if ($newStatus === 'Approved') {
                    echo "<script>alert('Alumni Privilege Card Status updated to Approved.'); window.location.href='view_alumni_privilege_card.php';</script>";
                } else {
                    echo "<script>alert('Alumni Privilege Card Status Declined.'); window.location.href='view_alumni_privilege_card.php';</script>";
                }
            }
        } else {
            echo "<script>alert('Error updating Alumni Privilege Card status: " . $conn->error . "'); window.location.href='view_alumni_privilege_card.php';</script>";
        }
    }
}
?>
