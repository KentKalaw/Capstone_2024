<?php
include('../../connect.php');
session_start();
$id =$_GET['id'];
mysqli_query($conn,"DELETE FROM post WHERE id = '$id'");


					date_default_timezone_set('Asia/Manila');
					$message = 'Admin deleted a post';
					$date = date('F d, Y h:i A');
					$username =$_SESSION['username'];
				$save = $conn->query("INSERT INTO audit (username,action, timestamp)VALUES ('$username','$message','$date')");
?>
<script>
alert("Record has been deleted");
window.location='index.php';
</script>