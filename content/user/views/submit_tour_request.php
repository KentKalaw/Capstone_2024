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
    $alumni_id = $_POST['alumni_id']; 
    $student_number = $_POST['student_number'];
    $fullname = $_POST['fullname'];    
    $email = $_POST['email'];       
    $number = $_POST['number'];   
    $fromDate = $_POST['fromDate'];
    $toDate = $_POST['toDate'];
    $special_request = $_POST['special_request'];   
    
    if (!empty($fromDate)) {
        $fromDate = date('F j, Y g:ia', strtotime($fromDate));
    } else {
        $fromDate = null;
    }

    if (!empty($toDate)) {
        $toDate = date('F j, Y g:ia', strtotime($toDate));
    } else {
        $toDate = null;
    }

    // Check if the alumni has already requested
    $check_sql = "SELECT * FROM campus_tour WHERE alumni_id = $alumni_id";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        // If a record exists, show alert
        echo '<script>alert("You have already submitted a Campus Tour request."); window.location="index.php";</script>';
        exit; // Exit to prevent further processing
    } else {
        // Insert a new record with Pending status
        $insert_sql = "INSERT INTO campus_tour (alumni_id, student_number, fullname, email, number, status, fromDate, toDate, special_request) 
                       VALUES ($alumni_id, '$student_number', '$fullname', '$email', '$number', 'Pending', '$fromDate', '$toDate', '$special_request')";
        
        if ($conn->query($insert_sql) === TRUE) {
            
            // Send confirmation email

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
                $mail->addAddress($email, $fullname);                     // Add a recipient

                // Content
                $mail->isHTML(true);                                     // Set email format to HTML
                $mail->Subject = 'Alumnite Campus Tour Request Submitted!';

                if (!empty($fromDate) && !empty($toDate)) {
    $tourDatesMessage = "Your requested tour dates are <span class='highlight'>$fromDate</span> to <span class='highlight'>$toDate</span>.";
} else {
    // If dates are empty, notify that the admin will decide
    $tourDatesMessage = "The tour dates will be decided by the admin, and you will receive an update shortly.";
}

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
        <h1>Thank you for your Campus Tour request, <span class="highlight">'.$fullname.'</span>!</h1>
        <p>We’ve received your request for a Campus Tour. '.$tourDatesMessage.'</p>
        <p>Your request is currently under review. We will send you further details regarding the tour shortly.</p>
        <p>If you have any special requests or need assistance, feel free to contact us anytime.</p>
        <div class="footer">
            <p>Best regards,<br>The Alumnite Team</p>
        </div>
    </div>
</body>
</html>
';

// Plain text version
$mail->AltBody = "Thank you for your Campus Tour request, $fullname!\n\nWe’ve received your request for a Campus Tour. $tourDatesMessage\n\nYour request is currently under review. We will send you further details regarding the tour shortly.\n\nBest regards,\nThe Alumnite Team";
                $mail->send();

            } catch (Exception $e) {

            }
            
            echo '<script>alert("Campus Tour request submitted. Please wait for further details."); window.location="campus_tour.php";</script>';
        } else {
            echo '<script>alert("Error: ' . $conn->error . '"); window.location="index.php";</script>';
        }
        exit; // Exit to prevent further processing
    }
}
?>