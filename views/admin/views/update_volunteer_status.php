<?php
include('../../auth.php');
include('../../connect.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $volunteer_id = isset($_POST['volunteer_id']) ? intval($_POST['volunteer_id']) : 0;
    $event_id = isset($_POST['event_id']) ? intval($_POST['event_id']) : 0;
    $action = isset($_POST['action']) ? $_POST['action'] : '';

    if ($volunteer_id > 0 && ($action === 'Approve' || $action === 'Decline')) {
        $newStatus = $action === 'Approve' ? 'Approved' : 'Declined';

        // Update the volunteer status
        $update_sql = "UPDATE events_volunteer SET volunteerStatus = '$newStatus' WHERE volunteer_id = $volunteer_id";
        
        if ($conn->query($update_sql) === TRUE) {
            echo "<script>alert('Volunteer status updated to $newStatus!'); window.location.href='view_event_volunteer.php?event_id=$event_id';</script>";
        } else {
            echo "<script>alert('Error updating volunteer status: " . $conn->error . "'); window.location.href='view_event_volunteer.php?event_id=$event_id';</script>";
        }
    }
}
?>