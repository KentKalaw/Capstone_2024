<?php
include('../../connect.php');
session_start();
$id =$_GET['id'];
mysqli_query($conn,"DELETE FROM ub_wall WHERE id = '$id'");

					date_default_timezone_set('Asia/Manila');
					$message = 'Administrator deleted a news';
					$date = date('F d, Y h:i A');
					$username =$_SESSION['username'];
				$save = $conn->query("INSERT INTO audit (username,action, timestamp)VALUES ('$username','$message','$date')");
?>
<script>
alert("Admin has deleted a news");
window.location='ub_wall.php';
</script>