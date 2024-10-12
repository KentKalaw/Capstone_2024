<?php
include('../../auth.php');
include('../../connect.php');
$username = $_SESSION['username'];
$sql1 = "SELECT * FROM users WHERE username = '$username'";
$result1 = $conn->query($sql1);
while($row1 = $result1->fetch_assoc()) {
	$type = $row1['type'];
	if($type != 'admin') {
		echo '<script>window.location="../logout.php";</script>';
	}
}
?>