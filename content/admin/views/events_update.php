<?php
include('../../auth.php');
include('../../connect.php');
$sql1 = "SELECT * FROM login WHERE username = '$username'";
$result1 = $conn->query($sql1);
while($row1 = $result1->fetch_assoc()) {
	$type = $row1['type'];
	if($type != 'admin') {
		echo '<script>window.location="../logout.php";</script>';
	}

}

if (isset($_POST['submit'])) {
    // Collect form data
    $event_id = $_POST['event_id'];
    $eventName = $_POST['eventName'];
    $eventDetails = $_POST['eventDetails'];
    $eventStartDate = $_POST['eventStartDate'];
    $eventEndDate = $_POST['eventEndDate'];
    $eventType = $_POST['eventType'];
    $eventStatus = $_POST['eventStatus'];
    $username = $_SESSION['username'];
    

    // Update event details in the database
    $conn->query("UPDATE events SET eventName = '$eventName', eventDetails = '$eventDetails', eventStartDate = '$eventStartDate', eventEndDate = '$eventEndDate', eventType = '$eventType', eventStatus = '$eventStatus' WHERE event_id = '$event_id'");

    date_default_timezone_set('Asia/Manila');
    $message = 'Administrator updated Event ID: '.$event_id;
    $date = date('F d, Y h:i A');
    $username =$_SESSION['username'];
    $save = $conn->query("INSERT INTO audit (username,action, timestamp)VALUES ('$username','$message','$date')");
    // Success message and redirect
    echo '<script>alert("Event Page has been updated"); window.location="events.php";</script>';
}
?>