<?php
include('../../auth.php');
include('../../connect.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $participation_id = isset($_POST['participation_id']) ? intval($_POST['participation_id']) : 0;
    $event_id = isset($_POST['event_id']) ? intval($_POST['event_id']) : 0;
    $action = isset($_POST['action']) ? $_POST['action'] : '';

    if ($participation_id > 0 && ($action === 'Approve' || $action === 'Decline')) {
        $newStatus = $action === 'Approve' ? 'Approved' : 'Declined';

        // Update the participation status
        $update_sql = "UPDATE events_participation SET participationStatus = '$newStatus' WHERE participation_id = $participation_id";
        
        if ($conn->query($update_sql) === TRUE) {
            echo "<script>alert('Participation status updated to $newStatus!'); window.location.href='view_event_participation.php?event_id=$event_id';</script>";
        } else {
            echo "<script>alert('Error updating participation status: " . $conn->error . "'); window.location.href='view_event_participation.php?event_id=$event_id';</script>";
        }
    }
}
?>