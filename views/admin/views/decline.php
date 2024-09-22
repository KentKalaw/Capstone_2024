<?php
include('../../connect.php');
$id =  $_GET['id'];

$sql = "DELETE FROM login WHERE id = '$id'";
$conn->query($sql);
// send email
$email = $_GET['email'];
 $from = "dontreply.alumnite@gmail.com";
   $to = $email;
   $subject = "Alumnite Regitration Confirmation";
   $message = "
<!DOCTYPE html>
<html>
<head>
  <title>Invoice Management</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
    }
    h1 {
      font-family: fantasy;
      font-size: 70px;
      text-align: center;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      border: 1px solid black;
    }
    th, td {
      border: 1px solid black;
      padding: 5px;
    }
    th {
      text-align: center;
    }
    table.yellowTable thead {
      background-color: #FFFF00;
    }
    table.yellowTable tbody tr:nth-child(even) {
      background-color: #FFFFFF;
    }
    table.yellowTable tbody tr:nth-child(odd) {
      background-color: #ecebeb;
    }
    img {
      float: right;
      width: 200px;
      height: 200px;
      transform: translateY(-90px);
        padding-right: 50px;
    }
	
	@media print {
    body {
      font-family: Arial, sans-serif;
      margin: 0;
    }
    h1 {
      font-family: fantasy;
      font-size: 70px;
      text-align: center;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      border: 1px solid black;
    }
    th, td {
      border: 1px solid black;
      padding: 5px;
    }
    th {
      text-align: center;
    }
    table.yellowTable thead {
      background-color: #FFFF00;
    }
    table.yellowTable tbody tr:nth-child(even) {
      background-color: #FFFFFF;
    }
    table.yellowTable tbody tr:nth-child(odd) {
      background-color: #ecebeb;
    }
    img {
      float: right;
      width: 200px;
      height: 200px;
      transform: translateY(-90px);
        padding-right: 50px;
    }
}
  </style>
</head>
<body>
Hello,<br>
Thank you for your interest in joining the University of Batangas alumni network through Alumnite.<br>
Unfortunately, we are unable to approve your registration at this time due to insufficient proof of records or an unclear picture provided during the sign-up process.<br>
<br>
To ensure successful registration, we kindly request that you resubmit your application and upload suggested documents such as your Diploma, Transcript of Records (TOR), Alumni Card, or Certificate of Graduation. Clear and legible documentation will enable us to verify your alumni status accurately.<br>
<br>
We apologize for any inconvenience caused and appreciate your cooperation in providing the necessary information. Your commitment to reconnecting with the University of Batangas alumni community is highly valued.<br>
Should you have any questions or need further assistance, please feel free to contact our support team at facebook.com/ubbcsaep.<br>
<br>
Thank you for your understanding and cooperation.<br>
Best regards,<br>
Alumnite
</div>
 
</body>
</html>



   
   ";
   
  // The content-type header must be set when sending HTML email
 $headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= "From: dontreply.alumnite@gmail.com\r\n"."X-Mailer: php";
   if(mail($to,$subject,$message, $headers)) {
      echo "Message was sent.";
   } else {
      echo "Message was not sent.";
   }
//end send email

					date_default_timezone_set('Asia/Manila');
					$message = 'Administrator declined alumni registration request';
					$date = date('F d, Y h:i A');
				$save = $conn->query("INSERT INTO audit (username,action, timestamp)VALUES ('admin','$message','$date')");
?>
<script>
	alert("Alumni Registration request has been declined");
	window.location="approval.php";
</script>