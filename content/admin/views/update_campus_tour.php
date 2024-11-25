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
    $campus_id = isset($_POST['campus_id']) ? intval($_POST['campus_id']) : 0;
    $action = isset($_POST['action']) ? $_POST['action'] : '';

    if ($campus_id > 0 && ($action === 'Approve' || $action === 'Decline')) {
        $newStatus = $action === 'Approve' ? 'Approved' : 'Declined';

        // Update the campus tour status
        $update_sql = "UPDATE campus_tour SET status = '$newStatus' WHERE id = $campus_id";
        
        if ($conn->query($update_sql) === TRUE) {
            // Fetch the campus tour details to send an email
            $sqlQuery = "SELECT * FROM campus_tour WHERE id = $campus_id";
            $result = $conn->query($sqlQuery);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $email = $row['email'];
                $fullname = $row['fullname'];

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
                    $mail->addAddress($email, $fullname);                     // Add a recipient by email
                
                    // Content
                    $mail->isHTML(true);                                     // Set email format to HTML
                    if ($newStatus === 'Approved') {
                        $mail->Subject = 'Alumnite Campus Tour Approved';
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
                                <h1>Your Campus Tour Request is Approved, <span class="highlight">'.$fullname.'</span>!</h1>
                                <p>We are excited to inform you that your campus tour request has been approved.</p>
                                <p>We look forward to hosting you on the tour! Please check the Alumnite website for any updates regarding your scheduled campus tour.</p>
                                <p>If you have any questions or need further assistance, feel free to contact us.</p>
                                <div class="footer">
                                    <p>Best regards,<br>The Alumnite Team</p>
                                </div>
                            </div>
                        </body>
                        </html>';
                    } else { // When status is Declined
                        $mail->Subject = 'Alumnite Campus Tour Request Declined';
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
                                <h1>Your Campus Tour Request is Declined, <span class="highlight">'.$fullname.'</span>!</h1>
                                <p>We regret to inform you that your campus tour request has been declined.</p>
                                <p>We understand this may be disappointing, and we encourage you to stay connected with the Alumnite community for future events. Feel free to reach out if you have any questions or would like to know more.</p>
                                <p>If you need assistance or have any concerns, dont hesitate to contact us.</p>
                                <div class="footer">
                                    <p>Best regards,<br>The Alumnite Team</p>
                                </div>
                            </div>
                        </body>
                        </html>';
                    }

                    // Plain text version
                    $mail->AltBody = "Your Campus Tour Request is $newStatus, $fullname!\n\nWe are excited to inform you that your campus tour request has been $newStatus.\n\nWe look forward to hosting you on the tour! Please check the Alumnite website for any updates regarding your scheduled campus tour.\n\nIf you have any questions or need further assistance, feel free to contact us.\n\nBest regards,\nThe Alumnite Team";
                    
                    // Send the email
                    $mail->send();
                
                } catch (Exception $e) {
                    // Handle the exception (e.g., log error message)
                }

                if ($newStatus === 'Approved') {
                    echo "<script>alert('Campus Tour Status updated to Approved.'); window.location.href='view_campus_tour.php';</script>";
                } else {
                    echo "<script>alert('Campus Tour Status Declined.'); window.location.href='view_campus_tour.php';</script>";
                }
            }
        } else {
            echo "<script>alert('Error updating campus tour status: " . $conn->error . "'); window.location.href='view_campus_tour.php';</script>";
        }
    }
}
?>
