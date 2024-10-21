<?php
include('../../auth.php');
include('../../connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $campus_id = isset($_POST['campus_id']) ? intval($_POST['campus_id']) : 0;
    $action = isset($_POST['action']) ? $_POST['action'] : '';

    if ($campus_id > 0 && ($action === 'Approve' || $action === 'Decline')) {
        $newStatus = $action === 'Approve' ? 'Approved' : 'Declined';

        // Update the yearbook status
        $update_sql = "UPDATE campus_tour SET status = '$newStatus' WHERE id = $campus_id";
        if ($conn->query($update_sql) === TRUE) {
            if ($newStatus === 'Approved') {
                        echo "<script>alert('Campus Tour Status updated to Approved.'); window.location.href='view_campus_tour.php';</script>";
                    }
                 else {
                    echo "<script>alert('Campus Tour Status Declined.'); window.location.href='view_campus_tour.php';</script>";
                }
    
}}}

?>
