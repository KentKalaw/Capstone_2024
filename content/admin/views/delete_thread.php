<?php
include('../../connect.php');
session_start();
$id =$_GET['id'];
mysqli_query($conn,"DELETE FROM forums WHERE id = '$id'");


					date_default_timezone_set('Asia/Manila');
					$message = 'Administrator deleted a post';
					$date = date('F d, Y h:i A');
					$username =$_SESSION['username'];
				$save = $conn->query("INSERT INTO audit (username,action, timestamp)VALUES ('$username','$message','$date')");
?>
<script>
alert("Admin has deleted a forum thread");
window.location='forums.php';
</script>