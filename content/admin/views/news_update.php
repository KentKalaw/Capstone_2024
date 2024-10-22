<?php
include('../../auth.php');
include('../../connect.php');
$sql1 = "SELECT * FROM users WHERE username = '$username'";
$result1 = $conn->query($sql1);
while($row1 = $result1->fetch_assoc()) {
	$type = $row1['type'];
	if($type != 'admin') {
		echo '<script>window.location="../logout.php";</script>';
	}

}

if (isset($_POST['submit'])) {
    // Collect form data
    $news_id = $_POST['news_id'];
    $postTitle = $_POST['postTitle'];
    $postSubTitle = $_POST['postSubTitle'];
    $postContent = $_POST['postContent'];

    // Update event details in the database
    $conn->query("UPDATE ub_wall SET postTitle = '$postTitle', postSubTitle = '$postSubTitle', postContent = '$postContent' WHERE id = '$news_id'");

    date_default_timezone_set('Asia/Manila');
    $message = 'Administrator updated News ID: '.$news_id;
    $date = date('F d, Y h:i A');
    $username =$_SESSION['username'];
    $save = $conn->query("INSERT INTO audit (username,action, timestamp)VALUES ('$username','$message','$date')");
    // Success message and redirect
    echo '<script>alert("News Page has been updated"); window.location="ub_wall.php";</script>';
}
?>
