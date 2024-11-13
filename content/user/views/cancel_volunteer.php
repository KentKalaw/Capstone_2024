<?php
include('../../auth.php');
include('../../connect.php');

$event_id = $_POST['event_id'];
$alumni_id = $_POST['alumni_id'];

// Check if the user has a pending volunteer request
$volunteer_sql = "SELECT volunteer_id FROM events_volunteer WHERE event_id = $event_id AND alumni_id = $alumni_id AND volunteerStatus = 'Pending'";
$volunteer_result = $conn->query($volunteer_sql);

if ($volunteer_result->num_rows > 0) {

    $update_sql = "DELETE FROM events_volunteer WHERE volunteer_id = " . $volunteer_result->fetch_assoc()['volunteer_id'];
    if ($conn->query($update_sql) === TRUE) {
        echo '<script>alert("Volunteer request cancelled successfully."); window.location="events.php";</script>';
    } else {
        echo "Error cancelling volunteer request: " . $conn->error;
    }
} else {
    echo "No pending volunteer request found.";
}
?>