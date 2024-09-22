<?php
include('../../connect.php');
$id =  $_GET['id'];
$sql = "UPDATE login SET status = 'Approved' WHERE id = '$id'";
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
Your registration for Alumnite has been approved! Log in now with your credentials.<br>
Thank you once again for being a part of the University of Batangas alumni network. We're excited to have you on board and look forward to seeing your active participation on UB Link!<br>
Best regards,<br><br>
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
					$message = 'Administrator approved alumni registration request';
					$date = date('F d, Y h:i A');
				$save = $conn->query("INSERT INTO audit (username,action, timestamp)VALUES ('admin','$message','$date')");
?>
<script>
	alert("Alumni Registration request has been approved");
	window.location="approval.php";
</script>