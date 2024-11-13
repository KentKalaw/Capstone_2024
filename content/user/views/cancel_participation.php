<?php
include('../../auth.php');
include('../../connect.php');

$event_id = $_POST['event_id'];
$alumni_id = $_POST['alumni_id'];

// Check if the user has a pending participation request
$participation_sql = "SELECT participation_id FROM events_participation WHERE event_id = $event_id AND alumni_id = $alumni_id AND participationStatus = 'Pending'";
$participation_result = $conn->query($participation_sql);

if ($participation_result->num_rows > 0) {

    $update_sql = "DELETE FROM events_participation WHERE participation_id = " . $participation_result->fetch_assoc()['participation_id'];
    if ($conn->query($update_sql) === TRUE) {
        echo '<script>alert("Participation request cancelled successfully."); window.location="events.php";</script>';
    } else {
        echo "Error cancelling participation request: " . $conn->error;
    }
} else {
    echo "No pending participation request found.";
}
?>